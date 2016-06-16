@extends('layout')


@section('content')

<h3 id="action-header">Add a new note</h3>

<form method="POST" action="/cards/{{ $card->id }}/notes">
	{{ csrf_field() }}

	<input type="hidden" name="_action" id="_action" value="save">
	<input type="hidden" name="_id" id="_id" value="-1">


	<div class="form-group">
		<textarea name="body" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<button type="submit" id="action-button" class="btn btn-primary">Add Note</button>
	</div>
</form>

<hr>


<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<h1>{{$card->title}}</h1>
<ul class="list-group">
	@foreach ($card->notes as $note)
		@if($note->body)
		<li class = "list-group-item">
			<div class="">
				
				<span id="{{'txt_' . $note->id }}">
					{{$note->body}}
				</span>
				
				
				<button id="{{'del_' . $note->id }}" type="button" class="btn btn-danger btn-sm pull-right" onclick="deleteNote()">
	  				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</button>

				<a href="/cards/{{$card->id}}/notes/{{$note->id}}/edit"><button id="{{'upd_' . $note->id }}" type="button" class="btn btn-default btn-sm pull-right" onclick="changeAction()">
	  				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button></a>
			</div>
			
		</li>
		@endif
	@endforeach
</ul>



</div>
</div>
@endsection 
@section('script')
	<script>
		function deleteNote(){
			alert("Deleting note...");
		}


	    function changeAction()
    	{
    		var target = event.target;
    		alert(target.id);

    		var action = document.getElementById("_action");
    		action.value = "update";

    		var id = document.getElementById("_id");
    		id.value = "0";

    		//var text = document.getElementById();

    		var header = document.getElementById("action-header");
    		header.innerText = "Edit Note";

    		var button = document.getElementById("action-button");
    		button.innerText = "Update";


    	}

    	</script>
@endsection