<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Jobs\AddNewParentMessageJob;
use App\Jobs\DeleteParentMessageJob;
use App\Models\ChildMessages;
use App\Models\ParentMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentMessageController extends Controller
{
    public function create(Request $request)
    {
        dispatch(new AddNewParentMessageJob(
            Auth::user()->id,
            $request->input('text'),
            Auth::user()->name)
        );

        return redirect()->route('home');
    }

    public function delete($id)
    {
        dispatch(new DeleteParentMessageJob(
            $id,
            Auth::user()->id
        ));

        return 'Success delete reply and message';
    }

}
