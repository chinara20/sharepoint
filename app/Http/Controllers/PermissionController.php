<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;

use App\Exports\PermissionsDataExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Maatwebsite\Excel\Facades\Excel;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Auth::user()->department_id == 10 || Auth::user()->email == 'rauf.a@nbatech.az'|| Auth::user()->email == 'nicat.b@nbatech.az') {

            $user_id = $request->input('user_id');
            $time_start = $request->input('time_start');
            $time_end = $request->input('time_end');

            $query = Permission::with('user', 'confirmed_by');

            if ($user_id) {
                $query->where('user_id', $user_id);
            }

            if ($time_start && !$time_end) {
                $query->where('time_start', '>=', $time_start);
            }

            if (!$time_start && $time_end) {
                $query->where('time_start', '<=', $time_end);
            }

            if ($time_start && $time_end) {
                $query->whereBetween('time_start', [$time_start, $time_end]);
            }

            $permissions = $query->orderBy('time_start', 'desc')->paginate(15);

            $users = Permission::with('user')->orderBy('id', 'desc')->get()->unique('user_id');

            foreach ($permissions as $permission) {

                $start = Carbon::parse($permission->time_start);
                $end = Carbon::parse($permission->time_end);

                $diff = $end->diff($start);

                $hours = $diff->h;
                $minutes = $diff->i;

                $permission->permission_time = $hours . ' saat ' . $minutes . ' dəqiqə';
            }


            // $permissions =  Permission::all()->reverse();
            return view('pages.permission.all', compact('permissions', 'users'));
        } else {
            $permissions =  Permission::where('user_id', Auth::user()->id)->get()->reverse();
        }
        $permissions_access =  Permission::where('to_id', Auth::user()->id)->get()->reverse();

        return view('pages.permission.index', compact('permissions', 'permissions_access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = Carbon::parse(date('Y-m-d H:i:s'));
        $startOfMonth = $date->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = $date->endOfMonth()->format('Y-m-d H:i:s');
        $current_user_id = Auth::user()->id;
        $user_permissions = Permission::where('user_id', $current_user_id)->where('status', '!=', 3)->whereBetween('time_start', [$startOfMonth, $endOfMonth])->get();
        $permission_limit = 240; // ? minute
        $user_current_minute = 0; // ? minute

        foreach ($user_permissions as $per) {
            $start = Carbon::parse($per->time_start);
            $end = Carbon::parse($per->time_end);
            $diffInMinutes = $start->diffInMinutes($end);
            $user_current_minute += $diffInMinutes;
        }
        $minutes = $permission_limit - $user_current_minute;

        $currentMonthLimit = str_pad(floor($minutes / 60), 2, 0, STR_PAD_LEFT) . ':' . str_pad(($minutes -   floor($minutes / 60) * 60), 2, 0, STR_PAD_LEFT);

        $currentMonthDayCount = Carbon::parse(date('Y-m-d H:i:s'))->endOfMonth()->format('d');
        


$currentYear = Carbon::now()->year;
$currentMonth = Carbon::now()->month;

$remainingMonths = [];

for ($month = $currentMonth; $month <= 12; $month++) {
    $date = Carbon::createFromDate($currentYear, $month, 1);
    $localizedMonth = $date->formatLocalized('%B'); // Ayı yerel dilde al

    $remainingMonths[] = [
        "label" => $localizedMonth,
        "value" => $month
    ];
}

if ($currentMonth === 12) {
    $nextYear = $currentYear + 1;
    $date = Carbon::createFromDate($nextYear, 1, 1);
    $localizedMonth = $date->formatLocalized('%B'); // Ayı yerel dilde al

    $remainingMonths[] = [
        "label" => $localizedMonth,
        "value" => 1
    ];
}
        return view('pages.permission.create', compact('currentMonthLimit', 'currentMonthDayCount', 'remainingMonths' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Todo : Validate request datas
        $permission = $request->all();
        $permission['user_id'] = Auth::user()->id;

        $tmStart = date('Y')."-".$request->month."-".$request->day;
        $tmEnd = date('Y')."-".$request->month."-".$request->day;

        $permission['time_start'] = $tmStart . ' ' . $request->time_start_hours . ':00';
        $permission['time_end'] = $tmEnd . ' ' . $request->time_end_hours . ':00';
        $admin_permission = User::where('email', Auth::user()->permission)->first();
        $permission['to_id'] = $admin_permission->id;

        if ($request->subject === 'Digər') {
            $permission['description'] = $request->description;
        } else {
            $permission['description'] = null;
        }

        // 

        $start = Carbon::parse($tmStart . ' ' . $request->time_start_hours . ':00');
        $end = Carbon::parse($tmEnd . ' ' . $request->time_end_hours . ':00');
        $perbyminute = $start->diffInMinutes($end);


        $date = Carbon::parse($tmStart);
        $startOfMonth = $date->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = $date->endOfMonth()->format('Y-m-d H:i:s');

        $current_user_id = Auth::user()->id;

        $user_permissions = Permission::where('user_id', $current_user_id)->where('status', '!=', 3)->whereBetween('time_start', [$startOfMonth, $endOfMonth])->get();


        $permission_limit = 240; // ? minute
        $user_current_minute = 0; // ? minute

        foreach ($user_permissions as $per) {
            $start = Carbon::parse($per->time_start);
            $end = Carbon::parse($per->time_end);
            $diffInMinutes = $start->diffInMinutes($end);
            $user_current_minute += $diffInMinutes;
        }

        if (($user_current_minute + $perbyminute) > $permission_limit) {
            return redirect(route('permission.create'))->with('error', 'Hazırki ay üçün 4 saat limitini keçirsiniz !');
        }


        Permission::create($permission);
        $send_mail = Auth::user()->permission;

        $result = Mail::send('emails.permission_request', [
            'fullname' => Auth::user()->name,
            'time_start' => $permission['time_start'],
            'time_end' => $permission['time_end'],
            'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.'
        ], function ($message) use ($send_mail) {
            $message->subject('İcazə Bildirişi');
            $message->to($send_mail);
        });

        return redirect(route('permission.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        return view('pages.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('pages.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->update($request->all());
        return redirect(route('permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->status = 1;
        $permission->save();

        $send_mail = 'hr@nbatech.az';
        $send_mail_more = $permission->user->email;

        Session::put('name', $permission->user->name);

        $result = Mail::send('emails.permission_request_admin', [
            'fullname' => Session::get('name'),
            'time_start' => '',
            'time_end' => '',
            'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.'
        ], function ($message) use ($send_mail, $send_mail_more) {
            $message->subject('İcazə Bildirişi');
            $message->to($send_mail);
            $message->to($send_mail_more);
        });


        // $permission->delete();
        return redirect(route('permission.index'));
    }
    public function change_permission($id, $status)
    {
        $permission = Permission::find($id);
        $permission->status = $status;
        $permission->save();

        $send_mail = 'hr@nbatech.az';
        if ($permission->user->email) {
            $send_mail_more = $permission->user->email;
        } else {
            $send_mail_more = 'noreply@nbatech.az';
        }

        Session::put('name', $permission->user->name);
        if ($status == 1) {
            $result = Mail::send('emails.permission_request_admin', [
                'fullname' => Session::get('name'),
                'time_start' => '',
                'time_end' => '',
                'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.'
            ], function ($message) use ($send_mail, $send_mail_more) {
                $message->subject('İcazə Bildirişi');
                $message->to($send_mail);
                $message->to($send_mail_more);
            });
        } else {
            $result = Mail::send('emails.permission_request_decline', [
                'fullname' => Session::get('name'),
                'time_start' => '',
                'time_end' => '',
                'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.'
            ], function ($message) use ($send_mail, $send_mail_more) {
                $message->subject('İcazə Bildirişi');
                $message->to($send_mail_more);
            });
        }
        return back();
    }

    public function downloadExcel(Request $request, $type)
    {
        $user_id = $request->input('user_id');
        $time_start = $request->input('time_start');
        $time_end = $request->input('time_end');

        $query = Permission::query();

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        if ($time_start && !$time_end) {
            $query->where('time_start', '>=', $time_start);
        }

        if (!$time_start && $time_end) {
            $query->where('time_start', '<=', $time_end);
        }

        if ($time_start && $time_end) {
            $query->whereBetween('time_start', [$time_start, $time_end]);
        }

        $permissions = $query->orderBy('time_start', 'desc')->get();



        // $permissions = Permission::get()->reverse();


        $permission_arr[] = array('№', 'AD / SOYAD', 'İCAZƏ SƏBƏBİ', 'İCAZƏ SƏBƏBİ MƏTN', 'BAŞLAMA TARİXİ', 'BİTMƏ TARİXİ', 'İCAZƏ MÜDDƏTİ', 'NÖV', 'RƏHBƏR', 'STATUS');


        foreach ($permissions as $permission) {
            if ($permission->status == 0)
                $status = 'Gözləmədə';
            elseif ($permission->status == 3)
                $status = 'Ləğv Olunub';
            else
                $status = 'Təsdiqlənib';


            $start = Carbon::parse($permission->time_start);
            $end = Carbon::parse($permission->time_end);

            $diff = $end->diff($start);


            $permission_arr[] = array(
                '№' => $permission->id,
                'AD / SOYAD' => $permission->user->name,
                'İCAZƏ SƏBƏBİ' => $permission->subject,
                'İCAZƏ SƏBƏBİ MƏTN' => $permission->description ? $permission->description : '-',
                'BAŞLAMA TARİXİ' => Carbon::parse($permission->time_start)->format('d.m.Y H:i:s'),
                'BİTMƏ TARİXİ' => Carbon::parse($permission->time_end)->format('d.m.Y H:i:s'),
                'İCAZƏ MÜDDƏTİ' => $diff->h . ' saat, ' . $diff->i . ' dəqiqə',
                'NÖV' => "Ödənişli",
                'RƏHBƏR' => $permission->confirmed_by->name,
                'STATUS' => $status,
            );
        }

        return Excel::create('permissions-list', function ($excel) use ($permission_arr) {
            $excel->sheet('İcazələr', function ($sheet) use ($permission_arr) {
                $sheet->fromArray($permission_arr, null, 'A1', false, false);
            });
        })->download($type);
    }
}
