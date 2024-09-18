<?php

use App\Models\User;

describe('Testing admin middleware while authenticated but unauthorized (Onboarding Account)', function () {

    beforeEach(function(){
        // Used for authentication
        $this->user = User::factory()->make(['account_type' => 'Onboarding']);
        // Used for input generation
        $this->input = User::factory()->make();
    });

    test('Create user test as Onboarding', function (){
        dd($this->input);
        $response = $this->actingAs($this->user)
        ->postJson('api/add_user',
        ['name' => $this->input->name,
         'email' => 'newemail@example.com',
         'password' => 'secret',
         'account_type' => 'Onboarding'],
        );

        $response->assertStatus(403);
    });

    test('Update password test as Onboarding', function() {
        $response = $response = $this->actingAs($this->user)
        ->putJson('api/update_password',
        ['id' => '1',
         'old_password' => 'secret',
         'new_password' => 'secret2',
         'new_password_confirmation' => 'secret2']);

         $response->assertStatus(403);
    });
});

describe('Testing admin middleware without proper authentication (Not logged in)', function () {

    test('Create user test without proper auth', function (){

        $response = $this->postJson('api/add_user',
        ['name' => 'Member Name',
         'email' => 'newemail@example.com',
         'password' => 'secret',
         'account_type' => 'Onboarding'],
        );

        $response->assertStatus(401);
    });

    test('Update password test without proper auth', function() {
        $response = $response = $this->putJson('api/update_password',
        ['id' => '1',
         'old_password' => 'secret',
         'new_password' => 'secret2',
         'new_password_confirmation' => 'secret2']);

         $response->assertStatus(401);
    });
});

describe('Testing admin middleware with proper authorization (logged in as Administrator account)', function () {

    beforeEach(function(){
        $this->user = User::factory()->make(['account_type' => 'Admin']);
    });

    test('Create user test as Admin', function (){

        $response = $this->actingAs($this->user)
        ->postJson('api/add_user',
        ['name' => 'Member Name',
         'email' => 'newemail10@example.com',
         'password' => 'secret',
         'account_type' => 'Admin'],
        );

        $response->assertStatus(200);
    });

    test('Update password test as Admin', function() {
        $response = $response = $this->actingAs($this->user)
        ->putJson('api/update_password',
        ['id' => '3',
         'old_password' => 'secret',
         'new_password' => 'secret2',
         'new_password_confirmation' => 'secret2']);


         $response->assertStatus(200);
    });
});
