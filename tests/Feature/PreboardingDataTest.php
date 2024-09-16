<?php

use App\Models\PreboardingAttendance;

// test('Preboarding Seed', function () {
//     $preboarding = PreboardingAttendance::factory()->count(40)->create();
// });

// The test below runs a cycle. Creation ->

describe('Preboarding Creation, Update, and Delete Lifecycle', function () {
    // Creation of random data for testing. Make creates a 'temporary data' for testing purposes only, this does not save on the database.
    beforeEach(function (){
        $this->preboarding = PreboardingAttendance::factory()->make();
    });
    

    test('Testing the GET function for Preboarding Data', function () {
        $response = $this->getJson('api/get_preboarding',
        ['app_id' => $this->preboarding->app_id]);

        $response->assertStatus(200);

    });

    test('Testing the POST to store preboarding data', function () {
        $response = $this->postJson('api/store_preboarding',
        ['name' => 'New Name',
        'email_address'=> $this->preboarding->email_address,
        'intern_type'=> $this->preboarding->intern_type,
        'phone_number'=> $this->preboarding->phone_number,
        'facebook_link'=> $this->preboarding->facebook_link,
        'course'=> $this->preboarding->course,
        'school_name'=> $this->preboarding->school_name,
        'school_contact'=> $this->preboarding->school_contact,
        'hours_requirement'=> $this->preboarding->hours_requirement,
        'discord_username'=> $this->preboarding->discord_username,
        'orientation_date'=> $this->preboarding->orientation_date->format('Y-m-d'),
        'start_date'=> $this->preboarding->start_date->format('Y-m-d'),
        'end_date'=> $this->preboarding->end_date->format('Y-m-d')]
        );

        $response->assertStatus(200);
    });

    test('Testing whether data can be updated.', function () {
        // Replace App ID with existing app id.
        $response = $this->putJson('api/update_preboarding',
        [
        'app_id' => '7008',    
        'name' => 'Edited Name',
        'email_address'=> 'Edited Address',
        'intern_type'=> 'Edited Type',
        'phone_number'=> 'Edited No.',
        'facebook_link'=> 'Edited Link',
        'course'=> 'Edited Course',
        'school_name'=> 'Edited School',
        'school_contact'=> 'Edited Contact',
        'hours_requirement'=> 'Edited Hours',
        'discord_username'=> 'Edited Discord',
        'orientation_date'=> '2024-01-05',
        'start_date'=> '2024-01-05',
        'end_date'=> '2024-01-05',
        'status'=>'Approved']
        );

        $response->assertStatus(200);
    });

    test('Testing whether controller rejects the update of non-existent app_id.', function () {
        // Replace App ID with non-existent app id.
        $response = $this->putJson('api/update_preboarding',
        [
        'app_id' => '1',    
        'name' => 'Edited Name',
        'email_address'=> 'Edited Address',
        'intern_type'=> 'Edited Type',
        'phone_number'=> 'Edited No.',
        'facebook_link'=> 'Edited Link',
        'course'=> 'Edited Course',
        'school_name'=> 'Edited School',
        'school_contact'=> 'Edited Contact',
        'hours_requirement'=> 'Edited Hours',
        'discord_username'=> 'Edited Discord',
        'orientation_date'=> '2024-01-05',
        'start_date'=> '2024-01-05',
        'end_date'=> '2024-01-05',
        'status'=>'Pending']
        );

        $response->assertStatus(422);
    });

    test('Testing whether controller will reject a valudation if Status is not pending or approved', function () {
        // Replace App ID with non-existent app id.
        $response = $this->putJson('api/update_preboarding',
        [
        'app_id' => '7000',    
        'name' => 'Edited Name',
        'email_address'=> 'Edited Address',
        'intern_type'=> 'Edited Type',
        'phone_number'=> 'Edited No.',
        'facebook_link'=> 'Edited Link',
        'course'=> 'Edited Course',
        'school_name'=> 'Edited School',
        'school_contact'=> 'Edited Contact',
        'hours_requirement'=> 'Edited Hours',
        'discord_username'=> 'Edited Discord',
        'orientation_date'=> '2024-01-05',
        'start_date'=> '2024-01-05',
        'end_date'=> '2024-01-05',
        'status'=>'Denied']
        );

        $response->assertStatus(422);
    });

    test('Testing whether data can be deleted.', function () {
        // Uses ->create which seeds actual data and pushes it to the database instead of ->make since make does not generate a 
        // primary key (app_id).
        $created_data = PreboardingAttendance::factory()->create();
        $response = $this->deleteJson('api/delete_preboarding',
        ['app_id' => $created_data->app_id]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success', 
                    'message' => 'Preboarding Data successfully deleted.'
                ]);

    });

    test('Testing whether non-existent data can be deleted..', function () {
        // As per the migration, the default primary increment starts with 7000 onwards. Anything below it can be used unless
        // the schema is modified.
        $response = $this->deleteJson('api/delete_preboarding',
        ['app_id' => '1']);

        $response->assertStatus(422);

    });

});
