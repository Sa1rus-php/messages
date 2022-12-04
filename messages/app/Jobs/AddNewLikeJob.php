<?php

namespace App\Jobs;

use App\Models\Likes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddNewLikeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id_message;

    protected $id_user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id_message, $id_user)
    {
        $this->id_message = $id_message;
        $this->id_user = $id_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Likes::firstOrCreate([
            'id_user' => $this->id_user,
            'id_message' => $this->id_message,
        ]);
    }
}
