<?php

namespace App\Http\Controllers;

use App\Models\Talant;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\Reminder;

class TalantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talants = Talant::all()->reverse();
        return view('pages.talant.index',compact('talants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.talant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $talants = $request->all();
        if ($request->file('file')) {
        $image = $request->file('file')->store('talants','public');
        }else{
            $image=null;
        }
        $talants['file'] = $image;
        $talants['user_id'] = Auth::user()->id;
        $talant = Talant::create($talants);

    // \Mail::send('emails.talant', $talant, function($message) use ($talant) {
    //     $message->to('nicat.b@nbatech.az');
    //     $message->subject('Talant Müraciət');
    // });
       Mail::send('emails.talant', [
                'title' => $talant->title,
                'user' => $talant->user->name
            ],
                function ($message) {
                        $message->from('noreply@nbatech.az');
                        $message->to('dl_bpm@nbatech.az', '')
                                ->subject('SharePoint Bildiriş');
        });

        // return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
       return redirect(route('talant.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
