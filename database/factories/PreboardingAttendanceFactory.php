<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PreboardingAttendance;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PreboardingAttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PreboardingAttendance::class;


    public function definition(): array
    {

        $intern_type = ['New Intern', 'Returning Intern', 'Voluntary Intern'];
        $school = ['Cebu City Uni', 'CIIT', 'PUP', 'La Salle'];
        $facebook_links = ['facebook.com/profile1', 'facebook.com/profile2', 'facebook.com/profile3'];
        $course = ['BSCS', 'BSCE', 'BSIT'];
        $status = ['Pending', 'Approved'];

        return [
            'name'=>fake()->name(),
            'email_address'=>fake()->unique()->safeEmail(),
            'intern_type'=>fake()->randomElement($intern_type),
            'phone_number'=>fake()->phoneNumber(),
            'facebook_link'=>fake()->randomElement($facebook_links),
            'course'=>fake()->randomElement($course),
            'school_name'=>fake()->randomElement($school),
            'school_contact'=>fake()->phoneNumber(),
            'hours_requirement'=>fake()->randomNumber(3, true),
            'discord_username'=>fake()->word(),
            'orientation_date'=>fake()->date('Y_m_d'),
            'start_date'=>fake()->date('Y_m_d'),
            'end_date'=>fake()->date('Y_m_d'),
            'status'=>fake()->randomElement($status),
        ];
    }
}
