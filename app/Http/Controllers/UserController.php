<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index_datatable(Request $request){
        $query = User::query();

        return Datatables::of($query)->make(true);
    }

    public function store(Request $request){
        $attributes = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|min:10|unique:users,email',
            'password' => 'required|min:6',
            'account_type' => 'required|in:Onboarding,Admin',
        ]);

        User::create($attributes);

        return response()->json(['success' => true, 'message' => "A new account has been successfully created!"]);
    }
    
    // Testing purposes - ignore for now.
    public function create_user(Request $request){
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $response_data = $request->all();
        $name = $response_data['name'];
        $email = $response_data['email'];
        $password = $response_data['password'];

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,

        ]);

        return response()->json(['message' => "Registration Successful"]);
    }

    public function update_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $old_password = $request->input('old_password');
        // Auth::user() will work. Currently just adding User::find as it causes some intellisense errors even if the program works.
        $user_model = User::find(Auth::user()->id);

        if (Hash::check($old_password, $user_model->password)){
            $user_model->password = $request->input('new_password');
            $user_model->save();
            return response()->json(['status' => 'Success']);
        }
        else {
            return response()->json(['status' => 'Failure']);
        }
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'redirect' => route('update') // You can include a URL to redirect if needed
            ]);
        }
        else {
            return response()->json(['message' => 'Login failed.']);
        }
    }

    
    // Testing purposes, ignore for now.
    // public function login_user_custom(Request $request){
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    
    //     $username = $request->input('email');
    //     $password = $request->input('password');

    //     $credentials = [
    //         'user_name' => $username,
    //         'password' => $password
    //     ];

    //     if (Auth::attempt($credentials)){
    //         return response()->json(['message' => 'Login successful.', 'status' => 'success', 'redirect'=>'/update']);
    //     }
    //     else {
    //         return response()->json(['message' => 'Login failed.', 'status' => 'Failed', ]);
    //     }
    // }
}
