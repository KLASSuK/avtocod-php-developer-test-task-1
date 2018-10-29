<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'text.required' => 'Сообщение не может быть пустым.',
            'text.unique' => 'Такое сообщение уже отправлено',
        ];
    }

    /**
     * Show the list of messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function showList()
    {
        $messages = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('messages.*', 'users.name')
            ->orderByDesc('created_at')->paginate(50);
        return view('message.list', ['messages' => $messages]);
    }

    /**
     * Add new message
     *
     * @param $request
     * @return array
     */
    public function add(Request $request)
    {
        $message = new Message();
        Validator::make($request->all(), [
            'text' => 'required|unique:messages'
        ], $this->messages())->validate();
        $message->user_id = Auth::user()->id;
        $message->text = htmlentities($request->text);
        $message->save();
        return redirect('/');
    }

    /**
     * Delete message by id
     *
     * @param $message
     * @return array
     */
    public function delete(Message $message)
    {
        if(Auth::user()->is_admin || $message->user_id == Auth::user()->id) $message->delete();
        return redirect('/');
    }


}
