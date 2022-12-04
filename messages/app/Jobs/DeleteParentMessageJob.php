<?php

namespace App\Jobs;

use App\Models\ChildMessages;
use App\Models\ParentMessages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteParentMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    protected $id_user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $id_user)
    {
        $this->id = $id;
        $this->id_user = $id_user;
    }

    /**
     * @return void
     */
    public function handle()
    {
        ChildMessages::where('id_parent_message' , $this->id)
            ->where('id_user', $this->id_user)
            ->delete();
        ParentMessages::where('id', $this->id)
            ->where('id_user', $this->id_user)
            ->delete();

    }

}
