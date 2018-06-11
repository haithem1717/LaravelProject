@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Subjects' List</h1>
@stop

@section('content')
    <p>Here is the list of the subjects</p>

    <div class="col-sm-12">
    	<table class="table table-bordered table-striped dataTable" role="grid" aria-describedly="example1-info">
    		<thead>
    			<tr role="row">
    				<th style="width:201px;">Name</th>
    				<th style="width:201px;">Code</th>
    				<th style="width:201px;">Lecturer</th>
    				<th style="width:201px;">Manage</th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach ($subjects as $subject)
    			<tr role="row" class="odd">
    				<td>{{$subject->name}}</td>
    				<td>{{$subject->code}}</td>
    				<td>{{$subject->lecturer_name}}</td>
    				<td>
    				    <a href="subjects/{{$subject->id}}/edit" class="btn btn-default">Edit</a>
				    	<form action="{{ url('subjects' , $subject->id ) }}" method="POST">
				    		{{ csrf_field() }}
				    		{{ method_field('DELETE') }}
				    		<button class="btn btn-danger">Delete</button>
						</form>
    				</td>
    			</tr>
    			@endforeach

    		</tbody>
    	</table>
    </div>
    <a href="subjects/create" class="btn btn-primary" >Create New Subject</a>
@stop