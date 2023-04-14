<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.show', $id)
            ->with('success', 'User updated successfully.');
    }
}



// namespace App\Http\Controllers;

// use App\Models\User;
// use App\Models\UserSetting;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     /**
//      * Show the form for editing the specified user setting.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function editSetting($id)
//     {
//         $user = User::findOrFail($id);

//         return view('user_settings.edit', compact('user'));
//     }

//     /**
//      * Update the specified user setting in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function updateSetting(Request $request, $id)
//     {
//         $userSetting = UserSetting::findOrFail($request->input('user_setting_id'));

//         $userSetting->update([
//             'setting_value' => $request->input('setting_value'),
//             'confirmation_code' => null,
//             'confirmation_code_expiry' => null,
//         ]);

//         return redirect()->route('user_settings.edit', ['id' => $id])
//             ->with('success', 'User setting updated successfully.');
//     }

//     /**
//      * Send a confirmation code for the specified user setting.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function sendConfirmationCode(Request $request, $id)
//     {
//         $userSetting = UserSetting::findOrFail($request->input('user_setting_id'));

//         // Code generation logic here...
//         $confirmationCode = rand(100000, 999999);

//         $userSetting->update([
//             'confirmation_code' => $confirmationCode,
//             'confirmation_code_expiry' => now()->addMinutes(5),
//         ]);

//         // Send code via SMS/Email/Telegram here...

//         return redirect()->route('user_settings.edit', ['id' => $id])
//             ->with('success', 'Confirmation code sent successfully.');
//     }
// }
