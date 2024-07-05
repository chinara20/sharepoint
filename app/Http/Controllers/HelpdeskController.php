<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use App\Models\HelpdeskCategory;
use App\Models\HelpdeskConversation;
use App\Models\HelpdeskForward;
use App\Models\Notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class HelpdeskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        // dd($user->id);
        if ($user->department_id == 7) {
            if ($user->id == 9 || $user->id == 140) {
                $user_id = $request->input('user_id');
                $status = $request->input('status');
                $time_start = $request->input('time_start');
                $time_end = $request->input('time_end');
                // $desks = Helpdesk::with('forwards')->get()->reverse();
                $query = Helpdesk::query();


                if ($user_id) {
                    $query->where('user_id', $user_id);
                }

                if ($status) {
                    $query->where('status', $status);
                }

                if ($time_start && !$time_end) {
                    $query->where('created_at', '>=', $time_start);
                }

                if (!$time_start && $time_end) {
                    $query->where('created_at', '<=', $time_end);
                }

                if ($time_start && $time_end) {
                    $query->whereBetween('created_at', [$time_start, $time_end]);
                }

                $desks = $query->get();
                // $desks = Helpdesk::all()->reverse();
                $users = Helpdesk::with('user')->orderBy('id', 'desc')->get()->unique('user_id');
                $monthly_success_desks = $desks->where('status', 'success')->count();
                $monthly_unsuccess_desks = $desks->where('status', 'unsuccess')->count();
                $monthly_pending_desks = $desks->where('status', 'pending')->count();

                $desks = $query->orderBy('id', 'desc')->paginate(15);
                return view('pages.helpdesk.index', compact('desks', 'monthly_success_desks', 'monthly_unsuccess_desks', 'monthly_pending_desks', 'users'));
                // dd($desks);
            } else {
                $desks = Helpdesk::where('status', 'pending')->orderBy('id', 'desc')->paginate(15);
            }
        } else {
            $desks = Helpdesk::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(15);
        }

        return view('pages.helpdesk.index', compact('desks'));
    }


    public function create()
    {
        $categories = HelpdeskCategory::all();
        return view('pages.helpdesk.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|integer',
            'message' => 'required',
            'title' => 'required'
        ]);
        $request['user_id'] = Auth::user()->id;

        $new_desk = Helpdesk::create($request->all());

        $request['helpdesk_id'] = $new_desk->id;
        $store_message = new HelpdeskConversationController;
        $store_message->store($request, true);

        if (!HelpdeskCategory::find($request['category_id'])) return redirect()->back();

        Notification::create([
            'from_id' => Auth::user()->id,
            'mail_data' => json_encode([
                'fullname' => '',
                'line1' => Auth::user()->name . ', H-' . str_pad($new_desk->id, 6, 0, STR_PAD_LEFT) . '(' . $new_desk->title . ') nömrəli dəstək sorğusu yaratdı !',
                'url' => route('helpdesk.show', $new_desk->id),
                'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.',
                'mail_template' => 'emails.helpdesk.change_status',
                'send_to' => 'dl_it_support@nbatech.az',
                'mail_title' => 'Helpdesk sorğu bildirişi'
            ])
        ]);
        return redirect(route('helpdesk.show', $new_desk->id));
    }

    public function show($id)
    {
        $desk = Helpdesk::find($id);

        if ($desk && ($desk->user_id === Auth::user()->id || ($desk->status == 'pending' && Auth::user()->department_id == 7) || ($desk->responder &&  $desk->responder->user->id == Auth::user()->id) || (Auth::user()->id == 9 || Auth::user()->id == 140))) {

            $department_users = null;
            if (Auth::user()->department_id == 7) {
                $department_users = User::where('department_id', 7)->where('id', '!=', Auth::user()->id)->get();
            }


            return view('pages.helpdesk.show', compact('desk', 'department_users'));
        }
        return redirect(route('helpdesk.index'))->with('error', 'Sorğu tapılmadı !');
    }

    /** Show the form for editing the specified resource. */
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => ['required', 'regex:/(pending|forwarded|success|unsuccess|activ)/'],
            'action' => ['required', 'regex:/(start|success|unsuccess|activ|forward)/'],
            'helpdesk_id' => 'integer',
            'department_user_id' => 'integer',
        ]);

        $request['user_id'] = Auth::user()->id;
        $desk = Helpdesk::find($id);

        $forward_is = false;

        switch ($request['action']) {
            case 'start':
                if ($desk->status === 'pending' && !$desk->responder && Auth::user()->department_id = 7) {
                    $desk->update(['status' => $request['status']]);
                    HelpdeskForward::create($request->all());
                    $user_id = $desk->user_id;
                    $content = 'sorğu üzrə sizə yardımcı olmağa hazırdır.';
                    $fullname = $desk->user->name;
                    $line1 = 'nömrəli sorğu üzrə sizə yardımcı olmağa hazırdır.';
                    $send_to = $desk->user->email;
                    $mail_title = 'Helpdesk sorğu bildirişi';
                } else {
                    return redirect()->back();
                }
                break;

            case 'unsuccess':
            case 'success':
                if ($desk->responder && ($desk->status === 'activ' || $desk->status === 'forwarded') && $desk->responder->user->id == Auth::user()->id) {
                    $desk->update(['status' => $request['status']]);
                    HelpdeskForward::where('helpdesk_id', $desk->id)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first()->update([
                        'finished_at' => Carbon::now()->toDateTimeString()
                    ]);

                    $user_id = $desk->user_id;
                    $content = 'sorğunuzu ' . ($request['action'] == 'success' ? 'uğurla tamamladı.' : 'uğursuz olaraq tamamladı.');
                    $fullname = $desk->user->name;
                    $line1 = 'nömrəli sorğunu' . ($request['action'] == 'success' ? 'uğurla tamamladı.' : 'uğursuz olaraq tamamladı.');
                    $send_to = $desk->user->email;
                    $mail_title = 'Helpdesk sorğu bildirişi';
                } else {
                    return redirect()->back();
                }
                break;

            case 'activ':
                if ($desk->user_id == Auth::user()->id && ($desk->status === 'success' || $desk->status === 'unsuccess')) {
                    $desk->update(['status' => $request['status']]);
                    HelpdeskForward::where('helpdesk_id', $desk->id)->orderBy('id', 'DESC')->update([
                        'finished_at' => null
                    ]);
                    $user_id = $desk->responder->user->id;
                    $content = 'sorğunu bərpa etdi.';
                    $fullname = $desk->responder->user->name;
                    $line1 = 'nömrəli sorğunu bərpa etdi.';
                    $send_to = $desk->responder->user->email;
                    $mail_title = 'Helpdesk sorğu bildirişi (bərpa)';
                } else {
                    return redirect()->back();
                }
                break;
            case 'forward':
                $department_user = User::find($request['department_user_id']);

                if (($desk->status === 'activ' || $desk->status === 'forwarded') && (($department_user->department_id == 7 && $desk->responder->user->id == Auth::user()->id))) {
                    $desk->update(['status' => $request['status']]);
                    $request['user_id'] = $request['department_user_id'];
                    HelpdeskForward::where('helpdesk_id', $request['helpdesk_id'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first()->update([
                        'forward_to' => $request['department_user_id'],
                        'forwarded_at' => Carbon::now()->toDateTimeString(),
                        // 'finished_at' => Carbon::now()->toDateTimeString()
                    ]);


                    $user_id = $desk->user_id;
                    $content = 'sorğunuzu ' . $department_user->name . ' adlı əməkdaşa yönləndirdi.';
                    $fullname = $desk->user->name;
                    $line1 = 'nömrəli sorğunuzu ' . $department_user->name == ' adlı IT əməkdaşına yönləndirdi.';
                    $send_to = $desk->user->email;
                    $mail_title = 'Helpdesk sorğu bildirişi (yönləndirmə)';


                    $request['forwarded_from'] = Auth::user()->id;
                    HelpdeskForward::create($request->all());
                    HelpdeskConversation::create([
                        'helpdesk_id' => $desk->id,
                        'user_id' => $department_user->id,
                        'forwarded_from' => Auth::user()->id
                    ]);

                    Notification::create([
                        'user_id' => $department_user->id,
                        'from_id' => Auth::user()->id,
                        'url' => route('helpdesk.show', $desk->id),
                        'content' => str_pad($desk->id, 6, 0, STR_PAD_LEFT) . ' nömrəli dəstək sorğusunu sizə yönləndirdi.',
                        'mail_data' => json_encode([
                            'fullname' =>  $department_user->name,
                            'line1' => Auth::user()->name . ', H-' . str_pad($desk->id, 6, 0, STR_PAD_LEFT) . '(' . $desk->title . ') ' . 'nömrəli dəstək sorğusunu sizə yönləndirdi.',
                            'url' => route('helpdesk.show', $desk->id),
                            'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.',
                            'mail_template' => 'emails.helpdesk.change_status',
                            'send_to' => $department_user->email,
                            'mail_title' => 'Helpdesk sorğu bildirişi (yönləndirmə)'
                        ])
                    ]);

                    $forward_is = true;
                } else {
                    return redirect()->back();
                }
                break;
        }

        Notification::create([
            'user_id' => $user_id,
            'from_id' => Auth::user()->id,
            'url' => route('helpdesk.show', $desk->id),
            'content' => $content,
            'mail_data' => json_encode([
                'fullname' =>  $fullname,
                'line1' => Auth::user()->name . ', H-' . str_pad($desk->id, 6, 0, STR_PAD_LEFT) . '(' . $desk->title . ') ' . $line1,
                'url' => route('helpdesk.show', $desk->id),
                'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.',
                'mail_template' => 'emails.helpdesk.change_status',
                'send_to' => $send_to,
                'mail_title' => $mail_title
            ])
        ]);

        if ($forward_is) {
            return redirect(route('helpdesk.index'));
        } else {
            return redirect()->back();
        }


        // return 'Update method is work!';
    }


    public function destroy($id)
    {
        //
    }


    public function downloadExcel(Request $request, $type)
    {
        $user_id = $request->input('user_id');
        $status = $request->input('status');
        $time_start = $request->input('time_start');
        $time_end = $request->input('time_end');

        $query = Helpdesk::query();

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($time_start && !$time_end) {
            $query->where('created_at', '>=', $time_start);
        }

        if (!$time_start && $time_end) {
            $query->where('created_at', '<=', $time_end);
        }

        if ($time_start && $time_end) {
            $query->whereBetween('created_at', [$time_start, $time_end]);
        }

        $desks = $query->get();

        // $desks = Desk::get()->reverse();


        $desk_arr[] = array('№', 'AD / SOYAD', 'STRUKTUR \ BÖLMƏ', 'SORĞU', 'BAŞLIQ', 'YARADILMA TARİXİ', 'QƏBUL TARİXİ', 'YÖNLƏNDİRİLMƏ TARİXİ', 'ICRAÇI', 'BAĞLANMA TARİXİ', 'İCRA VAXTI', 'İCRA MÜDDƏTİ', 'STATUS');

        foreach ($desks as $desk) {
            $status = $desk->get_status()['text'];
            $startIndex = strpos($status, '<i class');
            $status = substr($status, 0, $startIndex);

            if (count($desk->forwards) > 0) {

                $var = 0;
                foreach ($desk->forwards as $forward) {
                    // if ($desk->status == 'success' || $desk->status == 'unsuccess') {
                    if ($desk->forwards->last()->id == $forward->id) {
                        $status = $desk->get_status()['text'];
                        $startIndex = strpos($status, '<i class');
                        $status = substr($status, 0, $startIndex);
                    } else {
                        $status = 'Yönləndirildi';
                    }

                    if (count($desk->forwards) == 1 && !$forward->forwarded_at && !$forward->finished_at) {
                        $status = 'Aktiv';
                    }
                    // } else {
                    // }
                    $icra_muddeti = '';
                    $icra_vaxti = '';

                    if ($forward->finished_at) {
                        $start = Carbon::parse($desk->created_at);
                        $end = Carbon::parse($forward->finished_at);
                        $diff = $end->diff($start);
                        $icra_muddeti = str_pad($diff->d * 24 + $diff->h, 2, 0, STR_PAD_LEFT) . ':' . str_pad($diff->i, 2, 0, STR_PAD_LEFT) . ':' . str_pad($diff->s, 2, 0, STR_PAD_LEFT);
                    }

                    if ($forward->finished_at || $forward->forwarded_at) {
                        $start = Carbon::parse($forward->created_at);
                        if ($forward->finished_at) {
                            $end = Carbon::parse($forward->finished_at);
                        } else {
                            $end = Carbon::parse($forward->forwarded_at);
                        }

                        $diff = $end->diff($start);
                        $icra_vaxti = str_pad($diff->d * 24 + $diff->h, 2, 0, STR_PAD_LEFT) . ':' . str_pad($diff->i, 2, 0, STR_PAD_LEFT) . ':' . str_pad($diff->s, 2, 0, STR_PAD_LEFT);
                    }

                    $forwads_count = count($desk->forwards) - 1;

                    $desk_arr[] = array(
                        '№' => $var == 0 ? str_pad($desk->id, 6, 0, STR_PAD_LEFT) : '',
                        'AD \ SOYAD' => $var == 0 ? $desk->user->name : '',
                        'STRUKTUR \ BÖLMƏ' => $var == 0 ? $desk->user->show_department->name : '',
                        'SORĞU' => $var == 0 ? $desk->subject->name : '',
                        'BAŞLIQ' => $var == 0 ? $desk->title : '',
                        'YARADILMA TARİXİ' => $var == 0 ? $desk->created_at->format('m.d.Y H:i:s') : '',
                        'QƏBUL TARİXİ' => $var == 0 ?  $forward->created_at : '',
                        'YÖNLƏNDİRİLMƏ TARİXİ' => $var != 0 ? $forward->created_at : '-',
                        'ICRAÇI' => $forward->user->name,
                        'BAĞLANMA TARİXİ' => $forwads_count == $var && $forward->finished_at ? $forward->finished_at : '-',
                        'İCRA VAXTI' => $icra_vaxti,
                        'İCRA MÜDDƏTİ' => $icra_muddeti,
                        'STATUS' => $status,
                    );
                    // 'YÖNLƏNDİRİLMƏ TARİXİ', 'ICRAÇI', 'BAĞLANMA TARİXİ', 'İCRA VAXTI', 'İCRA MÜDDƏTİ', 'STATUS'
                    ++$var;
                }
            } else {
                $desk_arr[] = array(
                    '№' => str_pad($desk->id, 6, 0, STR_PAD_LEFT),
                    'AD \ SOYAD' => $desk->user->name,
                    'STRUKTUR \ BÖLMƏ' => $desk->user->show_department->name,
                    'SORĞU' => $desk->subject->name,
                    'BAŞLIQ' => $desk->title,
                    'YARADILMA TARİXİ' => $desk->created_at->format('m.d.Y H:i:s'),
                    'QƏBUL TARİXİ' => '-',
                    'YÖNLƏNDİRİLMƏ TARİXİ' => '-',
                    'ICRAÇI' => '-',
                    'BAĞLANMA TARİXİ' => '-',
                    'İCRA VAXTI' => '-',
                    'İCRA MÜDDƏTİ' => '-',
                    'STATUS' => 'Gözləmədə',
                );
            }
        }

        return Excel::create('desks-list', function ($excel) use ($desk_arr) {
            $excel->sheet('Helpdesk sorğular', function ($sheet) use ($desk_arr) {
                $sheet->fromArray($desk_arr, null, 'A1', false, false);
            });
        })->download($type);
        //
    }

    public function my_ongoing_desks()
    {
        if (Auth::user()->department_id != 7) return redirect(route('helpdesk.index'));
        $my_desks = HelpdeskForward::where('user_id', Auth::user()->id)->get()->unique('helpdesk_id');
        // $my_desks = HelpdeskForward::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(2);

        return view('pages.helpdesk.my_desks', compact('my_desks'));
    }
}
