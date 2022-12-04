<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMessages extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_child_message',
        'id_user',
        'id_parent_message',
        'user_name',
        'text',
    ];

    /**
     * @var array
     */
    protected $hidden = [
    ];

}
