<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmations()
    {
        return $this->hasMany(UserSettingConfirmation::class);
    }
}
