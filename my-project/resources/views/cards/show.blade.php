@extends('layout')


@section('content')

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

<hr>


<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<h1>{{$card->title}}</h1>
<ul class="list-group">
	@foreach ($card->notes as $note)
		<li class = "list-group-item">
			{{$note->body}} 
			<button type="button" class="btn btn-default">
  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
</button>

			<button type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
</button>
		</li>
	@endforeach
</ul>



</div>
</div>
@endsection 
@section('script')
	<script>
	    public function changeActionHeader()
    	{
    		var header = document.getElementById("action-header");
    		alert (header.innerText);
    		header.innerText="Edit text";

    	}
    	window.changeActionHeader();
    	</script>
@endsection