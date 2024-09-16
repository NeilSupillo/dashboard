<?php
use App\Models\PreboardingAttendance;

test('Preboarding Seed', function () {
    $preboarding = PreboardingAttendance::factory()->count(10)->create();
});

