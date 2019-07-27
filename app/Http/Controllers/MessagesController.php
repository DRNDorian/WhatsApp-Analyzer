<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    public function popular()
    {
          //Список уникальнвх пользователей
         // $listusers = DB::table('messages')->select('user')->distinct()->get();

            $users = DB::table('messages')
            ->select(DB::raw('count(user) as message_count, user'))
            ->groupBy('user')
            ->orderByDesc('message_count')
            ->paginate(25);

            $all_users = DB::table('messages')
                ->select(DB::raw('count(distinct user) as message_count'))
                ->get();

        return view('analysis', compact('users', 'all_users'));
    }
    public function popular_date()
    {

    }
}
