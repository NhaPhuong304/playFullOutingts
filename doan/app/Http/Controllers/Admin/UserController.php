<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(){
        $data = [
            'users' => User::where('is_delete', 0)->get()
        ];
        return view('admin/user')->with($data);
    }
    public function block(User $user)
    {
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->role_id = $request->role_id;

        // Upload ảnh nếu có
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time().'_'.$file->getClientOriginalName();

        // Lưu trực tiếp vào public/storage/avatars
        $file->move(public_path('storage/avatars'), $filename);

        $user->photo = $filename;
    }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function trash(){
        $data = [
            'users' => User::where('is_delete', 1)->get()
        ];
        return view('admin/trashUser')->with($data);
    }
    public function store(Request $request)
    {
    // Validate dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role_id' => 'required|in:1,2',
        'status' => 'required|in:0,1',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $photoName = null;
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $photoName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('storage/avatars'), $photoName);
    }

    // Tạo user mới
    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id,
        'status' => $request->status,
        'photo' => $photoName,
        'is_delete' => 0,
    ]);

    return redirect()->back()->with('success', 'User/Admin added successfully!');
    }



}
