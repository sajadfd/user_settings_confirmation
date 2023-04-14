<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettingConfirmation extends Model
{
    use HasFactory;

    protected $fillable = ['confirmation_method', 'code', 'expiry_time', 'value'];

    public function setting()
    {
        return $this->belongsTo(UserSetting::class);
    }

    public function isExpired()
    {
        return now()->gt($this->expires_at);
    }
}
