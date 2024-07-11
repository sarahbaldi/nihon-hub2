<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $sorting_options = [
            'title_asc' => ['title', 'asc'],
            'title_desc' => ['title', 'desc'],
            
        ];

        $default_sorting = ['title', 'asc'];
        $sort = $request->input('sort');

        $orderBy = $sorting_options[$sort] ?? $default_sorting;

        $courses = Course::orderBy($orderBy[0],$orderBy[1])->paginate(30);

        return view('admin.courses.index', compact('courses', 'sort'));
    }
    

    public function create()
    {
        $teachers = Teacher::all();
        $rooms = Room::all();
        return view('admin.courses.create', compact('teachers', 'rooms'));
    }

    private function validateCourseData(Request $request) {
        return $request->validate([
            'title' => 'required|string|max:255',
            'teachers' => 'required|array',
            'teachers.*' => 'exists:teachers,id',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $this->validateCourseData($request);
        $course = new Course();
        $course->fill($validateData);

        if($request->hasFile('poster')) {
        $fileName = time() . '_' .$request->file('poster')->getClientOriginalName();
        $posterPath = $request->file('poster')->storeAs('posters', $fileName, 'public');
        $course->poster = $posterPath;
        }

        if($course->save()){
            $course->teachers()->attach($validateData['teachers']);

        }

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $teachers = Teacher::all();
        $rooms = Room::all();

        return view('admin.courses.edit', compact('course', 'teachers', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $this->validateCourseData($request);
        $course = Course::findOrFail($id);
        $course->fill($validateData);

        if($request->hasFile('poster')) {
            $fileName = time() . '_' .$request->file('poster')->getClientOriginalName();
            $posterPath = $request->file('poster')->storeAs('posters', $fileName, 'public');
            $course->poster = $posterPath;
        }

        if($course->save()){
            $course->teachers()->sync($validateData['teachers']);
        }

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        if(!($course)) {
            return redirect()->route('courses.index')->with('success', 'Corso Assente');
        }

        $posterPath = 'public/posters/' . $course->poster;
        Storage::delete($posterPath);

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Corso Eliminato Con Successo');
    }
}
