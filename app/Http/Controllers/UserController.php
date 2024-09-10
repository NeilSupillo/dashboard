<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index_datatable(Request $request){
        $query = User::query();

        return Datatables::of($query)->make(true);
    }

    public function store(Request $request){
        $attributes = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|min:10|unique:users, email',
            'password' => 'required|min:6',
            'account_type' => 'required|in:Onboarding, Admin',
        ]);

        User::create($attributes);

        return json_encode(['success' => true, 'message' => "A new account has been successfully created!"]);
    }
    
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

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            return response()->json(['message' => 'Login successful.']);
        }
        else {
            return response()->json(['message' => 'Login failed.']);
        }
    }

    public function login_user_custom(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $username = $request->input('email');
        $password = $request->input('password');

        $credentials = [
            'user_name' => $username,
            'password' => $password
        ];

        if (Auth::attempt($credentials)){
            return response()->json(['message' => 'Login successful.']);
        }
        else {
            return response()->json(['message' => 'Login failed.']);
        }
    }
}
