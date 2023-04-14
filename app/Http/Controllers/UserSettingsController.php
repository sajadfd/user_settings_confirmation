<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationCode;
use App\Models\UserSetting;
use App\Services\ConfirmationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserSettingsController extends Controller
{

    public function index(UserSetting $settings)
    {
        return view('user_settings.index', compact('settings'));
    }


    public function edit($id)
    {
        $setting = UserSetting::find($id);
        return view('user_settings.edit', compact('setting'));
    }

    public function update(Request $request, UserSetting $setting)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $setting->value = $request->input('value');
        $setting->save();

        $confirmationMethod = $request->input('confirmation_method', auth()->user()->selected_confirmation_method);
        $confirmationCode = app(ConfirmationService::class)->generateCode($setting, $confirmationMethod);

        return redirect()->route('user_settings.show')->with('success', 'Setting updated. Please check your ' . ucfirst($confirmationMethod) . ' for a confirmation code.');
    }

    // public function confirm(Request $request, UserSetting $setting)
    // {
    //     $request->validate([
    //         'confirmation_code' => 'required',
    //     ]);

    //     $confirmation = $setting->confirmations()->where('code', $request->input('confirmation_code'))->first();

    //     if ($confirmation && !$confirmation->isExpired()) {
    //         $setting->value = $confirmation->value;
    //         $setting->save();
    //         $setting->confirmations()->delete();
    //         return redirect()->route('user_settings.show')->with('success', 'Setting updated.');
    //     } else {
    //         return redirect()->back()->withErrors(['confirmation_code' => 'Invalid or expired confirmation code.']);
    //     }
    // }


    public function confirm(Request $request, UserSetting $setting, ConfirmationService $confirmationService)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $code = $request->input('code');
        $result = $confirmationService->validateCode($setting, $code);

        if (!$result['success']) {
            return redirect()->back()->withErrors(['code' => $result['message']]);
        }

        $setting->value = $result['value'];
        $setting->save();

        return redirect()->route('user_settings.index');
    }
}
