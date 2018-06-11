@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Lecturers' List</h1>
@stop

@section('content')
    <p>Here is the list of the lecturers</p>
    <div class="col-sm-12">
    	<table class="table table-bordered table-striped dataTable" role="grid" aria-describedly="example1-info">
    		<thead>
    			<tr role="row">
    				<th style="width:201px;">Name</th>
    				<th style="width:201px;">Email Address</th>
    				<th style="width:201px;">Phone Number</th>
    				<th style="width:201px;">Manage</th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach ($lecturers as $lecturer)
    			<tr role="row" class="odd">
    				<td>{{$lecturer->name}}</td>
    				<td>{{$lecturer->email}}</td>
    				<td>{{$lecturer->phone}}</td>
    				<td>
    				    <a href="lecturers/{{$lecturer->id}}/edit" class="btn btn-default">Edit</a>
				    	<form action="{{ url('lecturers' , $lecturer->id ) }}" method="POST">
				    		{{ csrf_field() }}
				    		{{ method_field('DELETE') }}
				    		<button class="btn btn-danger" {{$lecturer->disabled}}>Delete</button>
						</form>
    				</td>
    			</tr>
    			@endforeach

    		</tbody>
    	</table>
    </div>
    <a href="lecturers/create" class="btn btn-primary" >Create New Lecturer</a>
@stop