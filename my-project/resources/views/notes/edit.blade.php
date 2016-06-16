@extends('layout')


@section('content')
	<h1>Edit the note</h1>
	<form method="POST" action="">
		{{ csrf_field() }}

		<input type="hidden" name="_action" id="_action" value="save">
		<input type="hidden" name="_id" id="_id" value="-1">


		<div class="form-group">
			<textarea name="body" class="form-control"></textarea>
		</div>

		<div class="form-group">
			<button type="submit" id="action-button" class="btn btn-primary">Update Note</button>
		</div>
	</form>
@stop