@extends('layout')


@section('content')

<h3 id="action-header">Add a new note</h3>

<!-- <form method="POST" action="/cards/{{ $card->id }}/notes">
 -->	<!--{{ csrf_field() }}-->
	<input type="hidden" name="_token" id="_csrf" value="{{csrf_token()}}">
	<input type="hidden" name="_action" id="_action" value="save">
	<input type="hidden" name="_card_id" id="_card_id" value="{{$card->id}}">
	<input type="hidden" name="_id" id="_id" value="-1">


	<div class="form-group">
		<textarea id="note" name="note" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<button id="action-button" class="btn btn-primary">Add Note</button>
		<button id="action-reset" class="btn btn-success">Add New</button>
	</div>
<!-- </form> -->

<hr>

<style type="text/css">
	#action-reset {
		visibility: hidden;
	}

</style>

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
		var controller = {
			note:{
				body:""
			}
		};

		$("#action-reset").click(function() {
			reset();
		});

		$("#action-button").click(function() {
			var token = $("#_csrf").val();
			
			var card_id = $("#_card_id").val();
			var url = "/cards/"+card_id+"/new_note";

			var note = $("#note").val();
			var action = $("#_action").val();
			var id =  $("#_id").val();

			controller.note.body = note;

			var data={
				_token:token,
				note: note,
				_card_id: card_id,
				_action: action,
				_id: id 
			};

			var copied_data = data;

			

			$.post(url, data, function(data, status){
		        var id = data;
		        var body = controller.note.body;
		        if (copied_data._action != 'update') {
		        	addNote(id, body);
		        }
		        else {
		        	updateNote(id, body);
		        	$("#action-reset").css("visibility", "visible");
		        }
		       	
		        body = "";
		    });

		});


		function deleteNote(){
			event.stopPropagation();

			var target = event.target;
    		var tag_id = $(target).data("id");
    		var values = tag_id.split("_");

			var note_id = values[1];
			var card_id = $("#_card_id").val();
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

		function addNote(id, noteText){
			var html = '<li id="note_' + id + '" class = "list-group-item">';
			html += '<div class="">';
			html += '<span id="txt_' + id +'">';

			html += noteText+ '<button data-id="del_' + id + '" type="button" class="btn btn-danger btn-sm pull-right del-btn">';
			html += '<span data-id="del_' + id +'" class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
			html += '</button>';

			html += '<button data-id="upd_' + id + '" type="button" class="btn btn-default btn-sm pull-right upd-btn">';
			html += '<span data-id="upd_' + id +'" class="glyphicon glyphicon-pencil" aria-hidden="true"></span>';
			html += '</button>'

			$('.list-group').append(html);

			document.getElementById("note").value = "";

		}


		function updateNote(id, noteText) {

			document.getElementById("txt_"+id).innerText = noteText;


		}

	    function changeAction()
    	{
    		var target = event.target;
    		var tag_id = ""+$(target).data("id");
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
    		var action = document.getElementById("_action");
	    		action.value = "save";

    		var header = document.getElementById("action-header");
    		header.innerText = "Add a new note";

    		var button = document.getElementById("action-button");
    		button.innerText = "Add note";

    		document.getElementById("note").value = "";

    		$("#action-reset").css("visibility", "hidden");
    		
    	}
    	$(document).ready(function(){
    		//onclick="deleteNote()
    		//onclick="changeAction()"
    		$(document).on("click",".del-btn", deleteNote);
    		$(document).on("click", ".upd-btn", changeAction);
    	})
    	</script>
@endsection