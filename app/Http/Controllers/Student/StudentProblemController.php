<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StudentProblemController extends Controller
{
    // app/Http/Controllers/Student/StudentProblemController.php
public function index()
{
    return view('student.problems');
}
}
