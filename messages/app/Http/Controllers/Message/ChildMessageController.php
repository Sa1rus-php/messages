<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Jobs\AddNewChildMessageJob;
use App\Jobs\DeleteChildMessageJob;
use App\Models\ChildMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildMessageController extends Controller
{
    public function index(Request $request)
    {
        return view('home', ['ChildMessages' => ChildMessages::all()]);
    }

    public function create(Request $request)
    {
        dispatch(new AddNewChildMessageJob(
            Auth::user()->id,
            $request->input('id_parent_message'),
            $request->input('text'),
            Auth::user()->name
        ));

        return redirect()->route('home');

    }

    public function delete($id)
    {
        dispatch(new DeleteChildMessageJob(
            $id,
            Auth::user()->id
        ));

        return 'Success delete reply';
    }
}
