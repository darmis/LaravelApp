<?php

namespace Ciklas\Http\Controllers;

use Ciklas\Note;
use Ciklas\User;
use Illuminate\Http\Request;
use Ciklas\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function trackNote(Request $request){
        $content = $request->content;
        $user_id = auth()->user()->id;
        $notes = Note::where('user_id','=', $user_id)->first();
        
        $notes->note = $content;
               
        $notes->save();
        
        return;
    }
}
