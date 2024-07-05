<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Hash;
use App\User;
use App\Department;
use App\Branch;
use App\Models\News;
use Password;
use Mail;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function home()
    {
        return redirect('chat');
    }
    public function about()
    {
        return view('pages.nba.about');
    }
    public function managment()
    {
        return view('pages.nba.managment');
    }
    public function partners()
    {
        return view('pages.nba.partners');
    }
    public function interest()
    {
        return view('pages.nba.interest');
    }
    public function our_luck()
    {
        return view('pages.nba.our_luck');
    }
    public function gallery()
    {
        return view('pages.gallery.index');
    }
    public function faq()
    {
        return view('pages.faq');
        // return Hash::make('random3003');
    }
    public function all_structure(Request $request)
{
    $branches = Branch::all()->reverse();
    $departments = Department::all();
    $users = User::query()->where('status', 1);

    if ($request->name) {
        $users = $users->where('name', 'like', '%' . $request->name . '%');
    }
    if ($request->department_id) {
        $users = $users->where('department_id', $request->department_id);
    }
    if ($request->branch_id) {
        $users = $users->where('branch_id', $request->branch_id);
    }

    // Özel sıralama: Önce ID'leri 1, 2 ve 20 olanlar, sonra diğerleri
    $users = $users->orderByRaw("FIELD(id, 20, 5,4,3,2, 1) DESC, id ASC");

    $users = $users->get();

    return view('pages.sturucture.all', compact('users', 'branches', 'departments'));
}

    public function logout()
    {
        \Auth::logout();
        return back();
    }
    public function index_page()
    {
        $birthdays =  User::where('status', 1)->whereMonth('birthday_date', Carbon::now()->format('m'))
            ->whereDay('birthday_date', Carbon::now()->format('d'))
            ->get();

        $news = News::orderBy('id', 'desc')->limit(4)->get();
        return view('pages.index', compact('news', 'birthdays'));
    }
    public function rasima()
    {
        $user = User::where('email', 'ilkin.a@nbatech.az')->first();
        \Auth::login($user);
        return redirect('/');
        // return  Hash::make('1');
// try {
//             $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
//             $crawler = $client->request('GET', 'https://banker.az');
//             // News::truncate();

//             foreach ([1, 4, 8, 10] as $index) {
//                 $thumbnail = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-image-container > div > a > span')->attr('data-bg');
//                 $title = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-module-meta-info > h3 > a')->text();
//                 $url = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-module-meta-info > h3 > a')->attr('href');

//                 // $client = new Client(HttpClient::create(['timeout' => 3000]));
//                 $crawlers = $client->request('GET', $url);
//                 $text = $crawlers->filter('#tdi_77 > div > div.vc_column.tdi_80.wpb_column.vc_column_container.tdc-column.td-pb-span8 > div > div.td_block_wrap.tdb_single_content.tdi_88.td-pb-border-top.td_block_template_1.td-post-content.tagdiv-type > div')->html();

//                 News::create([
//                     'title' => $title,
//                     'thumbnail' => $thumbnail,
//                     'url' => $url,
//                     'text' => $text
//                 ]);
//             }
//         } catch (\Throwable $th) {
//             return $th;
//         }
        
    }
    public function news(Request $request)
    {
        $news = News::where('id', $request->id)->first();
        return view('pages.news.both', compact('news'));
    }
    public function news_daxili(Request $request)
    {
        return view('pages.news.both');
    }
    public function conver(Request $request)
    {
        $users = User::all()->reverse();
        return view('pages.chat',compact('users'));
    }


    public function reset()
    {


        // $users = User::where('email','parvana.a@nbatech.az')->get();

        // $sentEmails = [];
        // foreach($users as $k=>$v){
        //     $broker = Password::broker();

        //     $sentEmails[] = $v->email;

        //     $user = User::where("email", $v->email)->first();
        //     // dd($user);

        //     $reset_token = $broker->createToken($user); // flat token

        //     $reset_link = url(config('app.url').route('password.reset', ['token' => $reset_token, 'email' => $user->email], false));

        //     $result = Mail::send('emails.password_reset_custom', [
        //         'fullname' => $user->name,
        //         'reset_url' => $reset_link,
        //         'line1' => 'Bu maili hesabınızı aktivləşdirmək üçün almısınız.',
        //         'line2' => '',
        //         'line3' => '.',
        //         'line4' => 'Əgər "Hesabı Aktiv Et" düyməsini klikləməklə bağlı problem yaşayırsınızsa, aşağıdakı URL-i kopyalayıb veb brauzerinizə yapışdırın:',
        //         'copyright' => '© '.date('Y').' '.env('APP_NAME').'. All rights reserved.'
        //     ], function($message) use ($user){
        //         $message->subject('Hesabınızı aktiv edin');
        //         $message->to($user->email);
        //     });           
        //     $user->password='update';
        //     $user->save();
        //     //Remove below sleep() when you have proper smtp or adjust it based on your need
        //     sleep(2); // in cash time out issue
        // }  

        // echo "<pre>";
        // echo "<h2>Reset password email sent to below users</h2>";
        // print_r($sentEmails);
        // exit;      
    }
    public function report_send(Request $request)
    {
        if ($request->type == 1) {
            $send_mail = 'dl_bpm@nbatech.az';
        } else {
            $send_mail = 'hr@nbatech.az';
        }

        $result = Mail::send('emails.send_report', [
            'fullname' => Auth::user()->name,
            'text' => request('text'),
            'title' => request('title'),
            'type' => request('type'),
            'time_start' => '',
            'time_end' => '',
            'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.'
        ], function ($message) use ($send_mail) {
            $message->subject('SharePoint Bildiriş');
            $message->to($send_mail);
        });
        return back();
    }
     public function test_data()
    {
        $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
            $crawler = $client->request('GET', 'https://banker.az');
            // News::truncate();

                dd($crawler->html());


            foreach ([1, 4, 8, 10] as $index) {
                $thumbnail = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-image-container > div > a > span')->attr('data-bg');
                $title = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-module-meta-info > h3 > a')->text();
                $url = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-module-meta-info > h3 > a')->attr('href');

                // $client = new Client(HttpClient::create(['timeout' => 3000]));
                $crawlers = $client->request('GET', $url);
                $text = $crawlers->filter('#tdi_77 > div > div.vc_column.tdi_80.wpb_column.vc_column_container.tdc-column.td-pb-span8 > div > div.td_block_wrap.tdb_single_content.tdi_88.td-pb-border-top.td_block_template_1.td-post-content.tagdiv-type > div')->html();


                // News::create([
                //     'title' => $title,
                //     'thumbnail' => $thumbnail,
                //     'url' => $url,
                //     'text' => $text
                // ]);
    }
}
}
