<?php

use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

dataset('courses', ['crisc', 'cissp', 'prince2']);

it('lists enrollments for the given course', function (string $course) {
    CourseEnrollment::factory()->create(['course' => $course, 'name' => 'Jane Doe']);
    CourseEnrollment::factory()->create(['course' => $course === 'crisc' ? 'cissp' : 'crisc', 'name' => 'Other Course Person']);

    $this->actingAs(User::factory()->create())
        ->get(route('admin.course-enrollments.index', $course))
        ->assertSuccessful()
        ->assertSee('Jane Doe')
        ->assertDontSee('Other Course Person');
})->with('courses');

it('returns 404 for an unknown course', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.course-enrollments.index', 'not-a-course'))
        ->assertNotFound();
});

it('redirects guests', function () {
    $this->get(route('admin.course-enrollments.index', 'crisc'))
        ->assertRedirect(route('login'));
});
