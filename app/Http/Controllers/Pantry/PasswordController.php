<?php

namespace App\Http\Controllers\Pantry;

use Validator;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function viewChangePassword()
    {
        return view('password.change');
    }

    public function changePassword(Request $request) {
        $user = \Auth::user();

        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required','string','different:newPassword',
            function($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('You did not corretly type your current password.');
                }
            }],
            'newPassword' => 'required|string',
            'newRetype' => 'required|string|same:newPassword'
        ],[
            'required' => 'This field is required.',
            'string' => 'What you typed here was invalid.',
            'oldPassword.different' => 'Your new password cannot be the same as the old one.',
            'newRetype.same' => 'The password you typed didn\'t match the new password you created.' 
        ]);
        $validatedData = $validator->validate();

        $user->password = Hash::make($validatedData['newPassword']);
        $user->save();
        
        return redirect('/password/change')->with('status', true);
    }
}