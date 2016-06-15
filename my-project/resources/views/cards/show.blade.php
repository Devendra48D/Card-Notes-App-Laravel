@extends('layout')


@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<h1>{{$card->title}}</h1>
<ul class="list-group">
	@foreach ($card->notes as $note)
		<li class = "list-group-item">{{$note->body}}</li>
	@endforeach
</ul>
<hr>
<h3 id="action-header">Add a new note</h3>

<form method="POST" action="/cards/{{ $card->id }}/notes">
{{ csrf_field() }}

	<div class="form-group">
	<textarea name="body" class="form-control"></textarea>
</div>

	<div class="form-group">
	<button type="submit" class="btn btn-primary">Add note</textarea>
</div>
</form>

<form method="POST" action="/cards/{{ $card->id }}/notes">
{{ csrf_field() }}


<hr>
<h3>Delete a note</h3>
<form method="DELETE" action="/cards/{{ $card->id }}/updatednotes">
{{ csrf_field() }}
	<div class="form-group">
	<textarea name="body" class="form-control"></textarea>
</div>

	<div class="form-group">
	<button type="submit" class="btn btn-primary">Delete note</textarea>
</div>
</form>
</div>
</div>
@endsection 
@section('script')
	<script>
	        function changeActionHeader()
    	{
    		var header = document.getElementById("action-header");
    		alert (header.innerText);
    		header.innerText="Edit text";

    	}
    	alert('Hi');
    	window.changeActionHeader();
    	</script>
@endsection