<?php

namespace App\Jobs;

use App\Models\ParentMessages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddNewParentMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id_user;

    protected $user_name;

    protected $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id_user, $text, $user_name)
    {
        $this->id_user = $id_user;
        $this->user_name = $user_name;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ParentMessages::create([
            'id_user' => $this->id_user,
            'text' => $this->text,
            'user_name' => $this->user_name
        ]);
    }
}
