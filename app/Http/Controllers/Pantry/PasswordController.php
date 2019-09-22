<?php

namespace App\Http\Controllers\Pantry;

use Validator;
use Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function viewChangePassword()
    {
        return view('password.change');
    }

    public function changePassword(Request $request) {
        $user = User::where('name', $request->name)->first();

        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|string',
            'newRetype' => 'required|string|same:newPassword'
        ],[
            'required' => 'This field is required.',
            'string' => 'What you typed here was invalid.',
            'newRetype.same' => 'The password you typed didn\'t match the new password you created.' 
        ]);
        $validatedData = $validator->validate();

        $user->password = Hash::make($validatedData['newPassword']);
        $user->save();
        
        return redirect('/password/change')->with('status', true)->withInput();
    }
}