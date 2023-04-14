<?php

namespace App\Services;

use App\Models\UserSetting;
use App\Models\UserSettingConfirmation;
use Illuminate\Support\Str;

class ConfirmationService
{
    public function generateCode(UserSetting $setting, $confirmationMethod)
    {
        $code = Str::random(6);
        $expiryTime = now()->addMinutes(5);

        $confirmation = new UserSettingConfirmation([
            'code' => $code,
            'expiry_time' => $expiryTime,
            'confirmation_method' => $confirmationMethod,
        ]);

        $setting->confirmations()->save($confirmation);

        return $code;
    }

    public function validateCode(UserSetting $setting, $code)
    {
        $latestConfirmation = $setting->confirmations()
            ->where('expiry_time', '>=', now())
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$latestConfirmation) {
            return ['success' => false, 'message' => 'Confirmation code expired.'];
        }

        if ($latestConfirmation->code !== $code) {
            return ['success' => false, 'message' => 'Invalid confirmation code.'];
        }

        $value = $latestConfirmation->value;

        $latestConfirmation->delete();

        return ['success' => true, 'value' => $value];
    }
}
