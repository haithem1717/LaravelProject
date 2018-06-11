<?php

namespace App\Http\Controllers;
use DB;
use App\Lt_timeslot;
use App\Lab_timeslot;
use App\Subject;
use App\Session;
use App\Lecturer;
use App\Lab;
use App\Lecture_theatre;
use App\Timeslot;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        $lecturers = Lecturer::all();
        $sessions = Session::all();
        $lab_timeslots = Lab_timeslot::all();
        $lt_timeslots = Lt_timeslot::all();
        $labs = Lab::all();
        $lecture_theatres = Lecture_theatre::all();
        $timeslots = Timeslot::all();
        foreach ($sessions as  $session) {

            //retrieve subject record of the the session's subject_id
            $a = $subjects->where('id', $session->subject_id);
            //assign the subject's name to the session object
            $session->subject_name = $a->first()->name;
            
            
            //retrieve lecturer's record of the the session's subject_id
            $b = $lecturers->where('id', $a->first()->lecturer_id);
            //assign the lecturer's name to the session object
            $session->lecturer_name = $b->first()->name;

            
            //retrieve lab_timeslot record of the the session's lab_timeslot_id
            $d = $lab_timeslots->where('id', $session->lab_timeslot_id);    
            //retrieve lab record of the the session's lab_timeslot_id based on the lab_id of the lab_timeslot
            $c = $labs->where('id', $d->first()->lab_id);
            //assign the lab's name to the session object
            $session->lab_name = $c->first()->name;


            //retrieve lt_timeslot record of the the session's lt_timeslot_id
            $f = $lt_timeslots->where('id', $session->lt_timeslot_id);
            //retrieve lt record of the the session's lt_timeslot_id based on the lt_id of the lt_timeslot
            $e = $lecture_theatres->where('id', $f->first()->lt_id);
            //assign the lecture theatre's name to the session object
            $session->lt_name = $e->first()->name;

            $y = $timeslots->where('id', $d->first()->slot_id);
            $session->lab_timeslot_details = array(
                'day'   => $y->first()->day,
                'start' => $y->first()->start,
                'end'   => $y->first()->end
            );

            $z = $timeslots->where('id', $f->first()->slot_id);
            $session->lt_timeslot_details = array(
                'day'   => $z->first()->day,
                'start' => $z->first()->start,
                'end'   => $z->first()->end
            );

        }
        return view('sessions.index', compact('sessions'));
    }

    public function generate()
    {

        $lt_timeslots = Lt_timeslot::all();
        $lab_timeslots = Lab_timeslot::all();
        $subjects = Subject::all();
        $sessions = Session::all();


        /*foreach ($sessions as $key => $session) {
            for ($x=0; $x < count($subjects); $x++) { 
                $j = 0;
                $k = 0;

                while ($j < count($lt_timeslots)) {
                    if($lt_timeslots[$j]->id == $session->lt_timeslot_id)
                    {
                        $j++;
                    } 
                    else 
                    {
                        $lt_timeslot_temp = $lt_timeslots[$j]->id;
                        break;
                    }
                }
                while ($k < count($lab_timeslots)) {
                    if($lab_timeslots[$k]->id == $session->lab_timeslot_id){
                        $k++;
                    } 
                    else {
                        $lab_timeslot_temp = $lab_timeslots[$k]->id;
                        break;
                    }
                }
                // print_r($session); 
                $session->lab_timeslot_id = $lab_timeslot_temp;
                $session->lt_timeslot_id = $lt_timeslot_temp;
                $session->subject_id = $subjects[$x]->id;
                // dd($session);
                $session->save();       
            
            }
            
        }*/

        foreach ($subjects as $subject) {
            //for ($x=0; $x < count($subjects); $x++) { 
            $session = new Session;
            $session->subject_id = $subject->id;
            foreach ($lt_timeslots as $lt_timeslot) {

                $s = Session::where('lt_timeslot_id', '=', $lt_timeslot->id)->first();

                if ($s === null) {

                    $k = Session::where('lab_timeslot_id', '=', $lt_timeslot->id)->first();
                    
                    if ($k === null) {
                        $session->lt_timeslot_id = $lt_timeslot->id;
                        break;
                    }
                }

            }

            foreach ($lab_timeslots as $lab_timeslot) {
                if($lab_timeslot->id != $session->lt_timeslot_id)
                {


                    $s = Session::where('lab_timeslot_id', '=', $lab_timeslot->id)->first();
                    if ($s === null) {
                        $k = Session::where('lt_timeslot_id', '=', $lab_timeslot->id)->first();
                        if ($k === null) {
                            $session->lab_timeslot_id = $lab_timeslot->id;
                            break;
                        }
                    }
                }
            }

            //dd($session);
            $session->save(); 

            
        }

        

        return redirect('/generater/index');

    }
// DB::insert('insert into sessions values(?)',[$lt_timeslot_temp]);
//                     dd($lt_timeslots[0]);
// DB::insert('insert into sessions values(?)',[$lt_timeslot_temp]);
//                     dd($lt_timeslots[0]);
   
}
