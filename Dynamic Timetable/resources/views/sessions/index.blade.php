@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Timetable</h1>
@stop

@section('content')
    <p>Here is the timetable</p>

    <div class="col-sm-12">
    	<table class="table table-bordered table-striped dataTable" role="grid" aria-describedly="example1-info">
    		<thead>
    			<tr role="row">
    				<th class="text-center" style="width:201px;">Lecturer Name</th>
    				<th class="text-center" style="width:201px;">Subejct Name</th>
    				<th class="text-center" colspan="3" style="width:201px;">Lecture Theatre</th>
    				<th class="text-center" colspan="3" style="width:201px;">Lab</th>
    			</tr>
    			<tr role="row">
    				<th style="width:201px;"></th>
    				<th style="width:201px;"></th>
    				<th style="width:201px;">Venue</th>
    				<th style="width:201px;">Day</th>
    				<th style="width:201px;">Time</th>
    				<th style="width:201px;">Venue</th>
    				<th style="width:201px;">Day</th>
    				<th style="width:201px;">Time</th>

    			</tr>
    		</thead>
    		<tbody>

    			@foreach ($sessions as $session)
    			<tr role="row" class="odd">
    				<td>{{$session->lecturer_name}}</td>
    				<td>{{$session->subject_name}}</td>
    				<td>{{$session->lt_name}}</td>
    				<td>{{$session->lt_timeslot_details['day']}}</td>
    				<td>{{$session->lt_timeslot_details['start']}} - {{$session->lt_timeslot_details['end']}}</td>
    				<td>{{$session->lab_name}}</td>
    				<td>{{$session->lab_timeslot_details['day']}}</td>
    				<td>{{$session->lab_timeslot_details['start']}} - {{$session->lab_timeslot_details['end']}}</td>

    			</tr>
    			@endforeach

    		</tbody>
    	</table>
    </div>
    <a href="subjects/create" class="btn btn-primary" >Create New Subject</a>
@stop