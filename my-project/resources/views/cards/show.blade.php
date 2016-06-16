@extends('layout')


@section('content')

<h3 id="action-header">Add a new note</h3>

<form method="POST" action="/cards/{{ $card->id }}/notes">
	<!--{{ csrf_field() }}-->
	<input type="hidden" name="_token" id="_csrf" value="{{csrf_token()}}">
	<input type="hidden" name="_action" id="_action" value="save">
	<input type="hidden" name="_card_id" id="_card_id" value="{{$card->id}}">
	<input type="hidden" name="_id" id="_id" value="-1">


	<div class="form-group">
		<textarea id="note" name="note" class="form-control"></textarea>
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
		<li id="{{'note_' . $note->id}}" class = "list-group-item">
			<div class="">
				
				<span id="{{'txt_' . $note->id }}">
					{{$note->body}}
				</span>
				
				
				<button data-id="{{'del_' . $note->id }}" type="button" class="btn btn-danger btn-sm pull-right del-btn">
	  				<span data-id="{{'del_' . $note->id }}" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</button>

				<button data-id="{{'upd_' . $note->id }}" type="button" class="btn btn-default btn-sm pull-right upd-btn">
	  				<span data-id="{{'upd_' . $note->id }}" class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
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
			event.stopPropagation();

			var target = event.target;
    		var tag_id = $(target).data("id");
    		var values = tag_id.split("_");

			var note_id = values[1];
			var card_id = document.getElementById("_card_id").value;
			var url = "/cards/"+card_id+"/notes/"+note_id;
			var token = $("#_csrf").val();
			var data = {
				_token: token,
				id: note_id
			};

			$.post(url, data, function(data, status){
		        // location.reload();
		    });
		    $("#note_"+note_id).remove();

		    console.log("Deleting"+note_id);
		    var header = document.getElementById("action-header");
    		header.innerText = "Add a new Note";

    		var button = document.getElementById("action-button");
    		button.innerText = "Add Note";

    		document.getElementById("note").value = '';
		
		}


	    function changeAction()
    	{
    		var target = event.target;
    		var tag_id = $(target).data("id");
    		var values = tag_id.split("_");
    		if (values.length==2){
    			event.stopPropagation();
    			var id = values[1];

    			var action = document.getElementById("_action");
	    		action.value = "update";

	    		var note_id = document.getElementById("_id");
	    		note_id.value = id;

	    		//var text = document.getElementById();

	    		var header = document.getElementById("action-header");
	    		header.innerText = "Edit Note";

	    		var button = document.getElementById("action-button");
	    		button.innerText = "Update";

	    		document.getElementById("note").value = document.getElementById("txt_"+id).innerText;
    		}
    		


    	}

    	function reset()
    	    {
    	
    	    }
    	$(document).ready(function(){
    		//onclick="deleteNote()
    		//onclick="changeAction()"
    		$(".del-btn").click(deleteNote);
    		$(".upd-btn").click(changeAction);
    	})
    	</script>
@endsection