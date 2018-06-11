<?php

namespace App\Http\Controllers;

use App\Lecturer;
use App\Subject;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = Lecturer::all();
        foreach ($lecturers as $lecturer) {
            $lec = Subject::where('lecturer_id', '=', $lecturer->id)->first();
            if ($lec === null) {
                $lecturer->disabled = '';
            }
            else
                $lecturer->disabled = 'disabled';
        }
        return view('lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lecturers.create');
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
            'email' => 'required|email|unique:lecturers',
            'phone' => 'required|digits:10|numeric',
            ]);
        $lecturer = new Lecturer;
        $lecturer->name = $request->name;
        $lecturer->email = $request->email;
        $lecturer->phone = $request->phone;
        //dd($lecturer);
        $lecturer->save();
        return redirect('/lecturers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:120',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            ]);
        $lecturer = Lecturer::find($request->id);
        $lecturer->name = $request->name;
        $lecturer->email = $request->email;
        $lecturer->phone = $request->phone;
        $lecturer->save();
        return redirect('/lecturers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect('/lecturers');
    }
}
