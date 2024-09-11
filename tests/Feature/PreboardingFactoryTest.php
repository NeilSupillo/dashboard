<?php

use App\Models\PreboardingAttendance;

test('preboarding_seeding', function () {
    $preboarding = PreboardingAttendance::factory()->count(40)->create();
});
