<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PreboardingAttendance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function update(Request $request){
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

        $user_id = $request->input('id');

        try {
            $model = PreboardingAttendance::findorFail($user_id);

            $model->update($attributes);

            return response()->json(['message' => 'Intern data updated.']);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'You are trying to update data that does not exist.']);
        }

        
    }

    public function index_datatable(Request $request){

        $query = PreboardingAttendance::query();

        return Datatables::of($query)->make(true);

    }
}
