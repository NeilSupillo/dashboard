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

        return response()->json(['status' => 'success', 'message' => 'New intern added successfully!']);
        
    }

    public function index(Request $request){

        $response = PreboardingAttendance::get();

        return response()->json(['data' => $response]);

    }

    public function destroy(Request $request){
        $request->validate([
            'app_id' => 'required|exists:preboarding_attendance'
        ]);

        $id = $request->input('app_id');

        PreboardingAttendance::destroy($id);

        return response()->json(['status' => 'success', 'message' => 'Preboarding Data successfully deleted.']);
    }

    public function update(Request $request){
        $attributes = $request->validate([
            'app_id' => 'required|exists:preboarding_attendance',
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
            'status' => 'required|in:Approved,Pending'
        ]);

        $user_id = $request->input('app_id');

        try {
            $model = PreboardingAttendance::findorFail($user_id);

            $model->name = $request->input('name');
            $model->email_address = $request->input('email_address');
            $model->intern_type = $request->input('intern_type');
            $model->phone_number = $request->input('phone_number');
            $model->facebook_link = $request->input('facebook_link');
            $model->course = $request->input('course');
            $model->school_name = $request->input('school_name');
            $model->school_contact = $request->input('school_contact');
            $model->hours_requirement = $request->input('hours_requirement');
            $model->orientation_date = $request->input('orientation_date');
            $model->start_date = $request->input('start_date');
            $model->end_date = $request->input('end_date');
            $model->status = $request->input('status');
            $model->save();


            return response()->json(['status'=> 'success', 'message' => 'Intern data updated.']);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['status'=> 'error', 'message' => 'You are trying to update data that does not exist.'], 404);
        }

        
    }

    public function index_datatable(Request $request){

        $query = PreboardingAttendance::query();

        return Datatables::of($query)
                            ->editColumn('status', function(PreboardingAttendance $preboarding) {
                                return $preboarding->status;
                                if ($preboarding->status == 'Pending'){
                                    return "<p class='text-orange-700 font-semibold'>" . $preboarding->status . "</p>";
                                }
                                else if ($preboarding->status == 'Approved'){
                                    return "<p class='text-green-700'>" . $preboarding->status . "</p>";
                                }
                            })
                            ->addColumn('actions', function(PreboardingAttendance $preboarding){
                                return "<button type='button' onclick=delete_attendance(this) class='edit-btn' data-id='". $preboarding->app_id."'>Delete</button>";
                            })
                            ->rawColumns(['status', 'actions'])
                            ->make(true);

    }
}
