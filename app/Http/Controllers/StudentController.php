<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\ClassesResource;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentResource;
use App\Models\Classess;
use Redirect;

class StudentController extends Controller
{
    public function index(Request $request) {
        $limit = $request->input('limit', 10); // Default to 10 if not provided
    $students = StudentResource::collection(Student::paginate($limit));

    return inertia('Students/Index', [
        'students' => $students,
        'limit' => $limit
    ]);
    }

    public function create(Request $request) {
        $classes = ClassesResource::collection(Classess::all());

        return inertia('Students/Create', [
            'classes' => $classes
        ]);
    }

    public function store(StoreStudentRequest $request) {
        Student::create($request->validated());

        return redirect()->route('students.index');
    }
}
