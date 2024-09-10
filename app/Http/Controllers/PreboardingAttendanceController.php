<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PreboardingAttendance;

class PreboardingAttendanceController extends Controller
{
    public function store(Request $request){
        $attributes = $request->validate([
            'name' => 'required',
            'email_address' => 'required',
            'intern_type' => 'required',
            'phone_number' => 'required',
            'facebook_link' => 'required',
            'course' => 'required',
            'school_name' => 'required',
            'school_contact' => 'required',
            'hours_requirement' => 'required',
            'discord_username' => 'required',
            'orientation_date' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        PreboardingAttendance::create($attributes);

        return response()->json(['message' => 'New intern added successfully!']);
        
    }

    public function index(Request $request){

        $response = PreboardingAttendance::get();

        return response()->json(['data' => $response]);

    }

    public function index_datatable(Request $request){

        $query = PreboardingAttendance::query();

        return Datatables::of($query)->make(true);

    }
}
