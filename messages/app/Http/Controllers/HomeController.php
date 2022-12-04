<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\ParentMessages;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $likes_result = [];
        $likes = Likes::all()->groupBy('id_message');
        foreach ($likes as $key => $like){
            $likes_result[] = [
                'id' => $key,
                'count' => $like->count()
            ];
        }
        return view('home', [
            'parent_messages' => ParentMessages::all(),
            'likes_result' => $likes_result
        ]);
    }
}
