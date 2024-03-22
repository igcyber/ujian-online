<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //search based on request q and get the data
        $students = Student::when(request()->q, function ($students) {
            $students = $students->where('name', 'like', '%' . request()->q . '%');
        })->with('classoom')->latest()->paginate(10);

        //append query string to pagination links
        $students->appends(['q' => request()->q]);

        //render with inertia to the page
        return inertia('Admin/Students/Index', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get all classrooms
        $classrooms = Classroom::all();

        return inertia('Admin/Students/Create', [
            'classrooms' => $classrooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        //validate Student Request
        $request->validate();

        //create student
        Student::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'gender' => $request->gender,
            'password' => $request->password,
            'classroom_id' => $request->classroom_id
        ]);

        //redirect after data created
        return redirect()->route('admin.students.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get student
        $student = Student::findOrFail($id);

        //get classrooms
        $classrooms = Classroom::all();

        //render with Inertia
        return inertia('Admin/Students/Edit', [
            'student' => $student,
            'classrooms' => $classrooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        //validate request
        $request->validate();

        //catch $password
        $password = $request->password;

        //check password
        if ($password = "") {

            DB::transaction(function () use ($request, $student) {
                $data = [
                    'name' => $request->name,
                    'nisn' => $request->nisn,
                    'gender' => $request->gender,
                    'classroom_id' => $request->classroom_id
                ];

                $student->update($data);
            });
        } else {

            DB::transaction(function () use ($request, $student) {
                $data = [
                    'name'          => $request->name,
                    'nisn'          => $request->nisn,
                    'gender'        => $request->gender,
                    'password'      => $request->password,
                    'classroom_id'  => $request->classroom_id
                ];

                $student->update($data);
            });
        }

        //redirect to index page
        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get student
        $student = Student::findOrFail($id);

        //delete student
        $student->delete();

        //redirect to index page
        return redirect()->route('admin.students.index');
    }
}
