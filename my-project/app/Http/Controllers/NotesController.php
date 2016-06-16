<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Card;
use App\Http\Requests;

use App\Http\Controllers\Controller;

class NotesController extends Controller
{

	public function store(Request $request)
	    {
			if (!isset($request->_card_id)){
				//Invalid: No Card id
				return back();
			}
	    	//Validate action and note_id
			if (isset($request->_action) && isset($request->_id)){
				$card = Card::findOrFail($request->_card_id);
				$action = $request->_action;
				$note = null;
				if ($action=="save"){
					$note = new Note;
				} else {
					$id = $request->_id;
					$note = Note::findOrFail($id);
				}
				

				$note->body = $request->note;

				$card->notes()->save($note);
			}
			
			return back();
	    }
    //

	//public function edit(Note $note)
	  //  {
		//	return view('notes.edit', compact('note'));
	    //}




	public function delete(Request $request){
		if (!isset($request->id)){
			//Invalid: No Note id
			return back();
		}
    	
		
		$id = (int) $request->id;
		$note = Note::find($id);

		$note->delete();
		//return Response::json(array('data', json_encode($note), 'id', $request->_id));
		//return back();
	}
}
