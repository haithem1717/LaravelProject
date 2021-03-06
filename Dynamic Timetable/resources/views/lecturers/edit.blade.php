@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Lecturers</h1>
@stop

@section('content')
<p>Edit Lecturers</p>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Insert Informations</h3>
		</div>
		<form role='form' method="POST" action="/lecturers/{{$lecturer->id}}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<input type="hidden" name="id" value="{{$lecturer->id}}">
			<div class="box-body">
				<div class="form-group">
					<label>Email Address</label>
					<input class='form-control' name="email" placeholder="Enter email" value="{{$lecturer->email}}" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<label"> Name </label>
					<input class='form-control' type="text" name="name" placeholder="Enter name" value="{{$lecturer->name}}" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input class='form-control' type="tel" name="phone" placeholder="Enter phone" value="{{$lecturer->phone}}" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
@stop