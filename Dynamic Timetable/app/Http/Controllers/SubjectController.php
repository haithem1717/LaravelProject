<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Lecturer;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subjects = Subject::all();
        $lecturers = Lecturer::all();
        foreach ($subjects as  $subject) {
            $a = $lecturers->where('id', $subject->lecturer_id);
            $subject->lecturer_name = $a->first()->name;
        }

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lecturers = Lecturer::all();

        return view('subjects.create', compact('lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required|max:120',
            'code' => 'required|unique:subjects',
            ]);
        $subject = new Subject;
        $subject->lecturer_id = $request->lecturer;
        $subject->name = $request->name;
        $subject->code = $request->code;
        $subject->save();
        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $lecturers = Lecturer::all();

        return view('subjects.edit', compact('subject','lecturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required|max:120',
            'code' => 'required',
            ]);
        $subject = Subject::find($request->id);
        $subject->name = $request->name;
        $subject->code = $request->code;
        $subject->lecturer_id = $request->lecturer;
        $subject->save();
        return redirect('/subjects');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect('/subjects');    }
}
