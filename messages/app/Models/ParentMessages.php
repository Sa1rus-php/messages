<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMessages extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_parent_message',
        'id_user',
        'user_name',
        'text',
    ];

    /**
     * @var array
     */
    protected $hidden = [
    ];

    public function childMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ChildMessages::class, 'id_parent_message');
    }

}
