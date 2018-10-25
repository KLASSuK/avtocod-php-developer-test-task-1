<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('showList');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showList()
    {
        $messages = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('messages.*', 'users.name')
            ->orderByDesc('created_at')->get();
        return view('message.list', ['messages' => $messages]);
    }
}
