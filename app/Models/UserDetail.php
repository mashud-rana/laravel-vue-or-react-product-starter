<?php

namespace App\Models;

use App\Traits\ModelBootHandler;
use Database\Factories\UserDetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_details';
    public const FILE_STORE_PATH    = 'user_details';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return UserDetailFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
