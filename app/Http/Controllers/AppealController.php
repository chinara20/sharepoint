<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use Auth;
use Illuminate\Http\Request;
use App\Models\Notification;

class AppealController extends Controller
{

    public function index()
    {
        $appeals = Appeal::query();
        if(Auth::user()->id != 1){
            $appeals = $appeals->where('user_id', Auth::user()->id);
        }

        $appeals = $appeals->orderBy('id', 'desc')->paginate(15);
        return view('pages.appeal.index', compact('appeals'));
    }

    public function create()
    {
        return view('pages.appeal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id']= Auth::user()->id;
        $appeal = Appeal::create($data);

        $department = Auth::user()->show_department->name ?? '';
        $branch = Auth::user()->show_branch->name ?? '';

        Notification::create([
            'user_id' => 1,
            'from_id' => Auth::user()->id,
            'url' => route('appeals.show', $appeal->id),
            'content' =>'sizə müraciət etdi.',
            'mail_data' => json_encode([
                'fullname' => '',
                'line1' => Auth::user()->name . ' ('. $department. $branch .')'. ' sizə müraciət etdi.',
                'url' => route('appeals.show', $appeal->id),
                'title' => $appeal->title ?? '',
                'content' =>  $appeal->content ?? '',
                'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.',
                'mail_template' => 'emails.appeal',
                'send_to' => 'anar@nbatech.az',
                'mail_title' => 'Müraciət bildirişi'
            ])
        ]);
        return redirect(route('appeals.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appeal = Appeal::find($id);
        if(Auth::user()->id != 1 || $appeal->user_id != Auth::user()->id){
            return redirect()->back();
        }

        return view('pages.appeal.show', compact('appeal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
