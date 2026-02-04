<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use App\Models\Course;

class LearnerProgressController extends Controller
{
    public function index()
    {
        $courseFilter = request('course');
        $sortBy = request('sort', 'name');

        $learners = Learner::with('courses')->get();
        $courses = Course::orderBy('name')->get();

        // Filter by course if selected
        if ($courseFilter) {
            $learners = $learners->filter(function ($learner) use ($courseFilter) {
                return $learner->courses->contains('id', $courseFilter);
            });
        }

        // Sort learners
        if ($sortBy === 'progress') {
            $learners = $learners->sort(function ($a, $b) {
                $avgA = $a->courses->avg('pivot.progress') ?? 0;
                $avgB = $b->courses->avg('pivot.progress') ?? 0;
                return $avgB <=> $avgA; // Descending
            });
        } else {
            $learners = $learners->sortBy(function ($learner) {
                return $learner->firstname . ' ' . $learner->lastname;
            });
        }

        return view('learner-progress', [
            'learners' => $learners,
            'courses' => $courses,
            'selectedCourse' => $courseFilter,
            'sortBy' => $sortBy,
        ]);
    }
}
