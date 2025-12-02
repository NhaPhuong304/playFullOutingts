<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Hiển thị profile
    public function profile($id){
        $user = User::findOrFail($id);
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id){
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'fullname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['nullable', 'regex:/^\d{10}$/'],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/avatars'), $filename);

            if($user->photo && file_exists(public_path('storage/avatars/'.$user->photo))){
                unlink(public_path('storage/avatars/'.$user->photo));
            }

            $user->photo = $filename;
        }

        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function changePassword(Request $request, $id){
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed'
        ]);

        $user = User::find($id);

        if(!Hash::check($request->currentPassword, $user->password)){
            return response()->json(['error'=>'Mật khẩu hiện tại không đúng'], 422);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json(['success'=>true, 'message'=>'Đổi mật khẩu thành công']);
    }

}
