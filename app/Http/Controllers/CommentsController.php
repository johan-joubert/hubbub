<?php

namespace App\Http\Controllers;
use App\Models\Commentaire;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['search','show']);
    }

    
    public function store (Request $request) {

        $request->validate([
            'content' => 'required|min:5',
        ]);

        
        Commentaire::create([
            'user_id' => auth()->user()->id,
            'message_id' => $request->input('messageId'),
            'content' => $request->input('content'),
            'image' => $request->input('imageComments'),

        ]);

        return back();
    }

    public function destroy(Commentaire $commentaire) 
    {

        $messageId = $commentaire->message_id;
        $message = Message::findOrFail($messageId);



            $commentaire->delete();


            return redirect()->route('home');


    }

    public function edit(Commentaire $commentaire)
    {

        return view('editComment', ['commentaire' => $commentaire]);

    }


    public function update(Request $request, Commentaire $commentaire)
    {

        $commentaire->content = $request->input('commentContent');
        $commentaire->save();

        return redirect()->route('home');  


    }


}
