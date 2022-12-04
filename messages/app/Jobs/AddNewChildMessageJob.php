<?php

namespace App\Jobs;

use App\Models\ChildMessages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class AddNewChildMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id_user;

    protected $id_parent_message;

    protected $text;

    protected $user_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id_user, $id_parent_message, $text, $user_name)
    {
        $this->id_user = $id_user;
        $this->id_parent_message = $id_parent_message;
        $this->text = $text;
        $this->user_name = $user_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ChildMessages::create([
            'id_user' => $this->id_user,
            'id_parent_message' => $this->id_parent_message,
            'text' => $this->text,
            'user_name' => $this->user_name
        ]);
    }
}
