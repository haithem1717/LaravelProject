@extends('adminlte::page')

@section('title', 'AdminLTE')



@section('content_header')
    <h1>Subjects</h1>
@stop


@section('content')
<p>Create Subjects</p>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Insert Informations</h3>
		</div>
		<form role='form' method="POST" action="/subjects">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group">
					<label>Name</label>
					<input class='form-control' type="text" name="name" placeholder="Enter name" value="{{ old('name') }}" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
				</div>

				<div class="form-group">
					<label>Code</label>
					<input class='form-control' type="text" name="code" placeholder="Enter name" value="{{ old('code') }}" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
				</div>
				<div>
					<label>Lecturer</label>
					<br>
    			
					<select name="lecturer">
						@foreach ($lecturers as $lecturer)
					  <option value="{{$lecturer->id}}">{{$lecturer->name}}</option>
					    @endforeach

					</select>
				</div>
				
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
@stop