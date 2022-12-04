<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Jobs\AddNewLikeJob;
use App\Jobs\DeleteLikeJob;
use App\Models\Likes;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        return view('home', ['Likes' => Likes::where('id_message', $request->input('id_message'))]);
    }

    public function create(Request $request)
    {
        dispatch(new AddNewLikeJob(
            $request->input('id_message'),
            auth()->id()
        ));

        return redirect()->route('home');
    }

    public function delete()
    {
        dispatch(new DeleteLikeJob(
            auth()->id()
        ));

        return redirect()->route('home');
    }
}
