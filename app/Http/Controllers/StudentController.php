<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\ClassesResource;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentResource;
use App\Http\Requests\UpdateStudentReques;
use App\Models\Classess;
use Redirect;

class StudentController extends Controller
{
    public function index(Request $request) {

        $studentQuery = Student::query();

        $this->searchQuery($studentQuery, $request->search);


        $limit = $request->input('limit', 10); // Default to 10 if not provided
    $students = StudentResource::collection($studentQuery->paginate($limit));

    return inertia('Students/Index', [
        'students' => $students,
        'limit' => $limit,
        'search' => $request->search ?? ''
    ]);
    }

    protected function searchQuery($query, $search) {
        return $query->when($search, function($query, $search) {
            $query->where('name' , 'like', '%'.$search.'%')
            ->Orwhere('email', 'like', '%'.$search.'%');
        });
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

    public function edit(Student $student) {
        $classes = ClassesResource::collection(Classess::all());

        return inertia('Students/Edit', [
            'classes' => $classes,
            'student' => StudentResource::make($student)
    ]);
    }

    public function update(UpdateStudentReques $request, Student $student) {

        $student->update($request->validated());

        return redirect()->route('students.index');
    }

    public function destroy(Student $student) {
            $student->delete();

            return redirect()->route('students.index');
    }
}
