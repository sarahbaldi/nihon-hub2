<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::inRandomOrder()->paginate(9);
        return view('welcome', ['courses' => $courses]);
    }

    public function home()
    {
        $courses = Course::inRandomOrder()->paginate(9);
        return view('home', ['courses' => $courses]);
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $courses = Course::where('title', 'like', '%' . $search . '%')->get();
        return view('courses.search',  compact('courses'));
    }
}
