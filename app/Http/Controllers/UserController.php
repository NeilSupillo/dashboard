<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

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
}
