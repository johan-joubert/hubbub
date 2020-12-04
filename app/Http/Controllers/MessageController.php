<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersMessages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Commentaire;
use Illuminate\Support\Facades\DB;








class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['search', 'show']);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'content' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Message
     */
    protected function create()
    {
        return view('message.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHubb(User $user)
    {
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);

        // $messages = DB::table('messages')
        // ->where('user_id', '=', $userId)
        // ->get();
    
    return view('user/showHubb', ['user' => $user]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Gate::allow('update-messages'));


        $request->validate([
            'content' => 'required|min:5',
            'image' => '',
            'tags' => '',
        ]);

        $message = new Message;
        $message->content = $request->input('content');
        $message->image = $request->input('image');
        $message->tags = $request->input('tags');
        $message->user_id = auth()->id();
        $message->save();

        return redirect()->route('home');
    }



    public function show(Message $message)
    {
        
        return view('zoomHubb', ['message' => $message]);
    }

    // public function zoomHubb()
    // {
    //     $messageId = auth()->user();
    //     $message = Message::findOrFail($messageId);

    //     return view('zoomHubb', ['message' => $message]);
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {

        // $this->authorize('update', $message);
        return view('messageEdit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {

        $message->content = $request->input('content');
        $message->tags = $request->input('tags');
        $message->image = $request->input('image');
        $message->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {

            $message->delete();

            Commentaire::where('message_id', $message->id)->delete();

            return redirect()->route('home');
    }

    
    public function search(Request $request) {
        $q = $request->input('q');
        $messages = DB::table('messages')
            ->where('messages.tags', 'like', "%$q%")
            ->orWhere('messages.content', 'like', "%$q%")
            ->join('users', 'messages.user_id', '=', 'users.id')
            // ->leftJoin('commentaires', 'commentaires.message_id', '=', 'messages.id')
            ->select('messages.*', 'messages.content as postMessage','users.pseudo as pseudo')
            ->get();
        
        return view('searchPage', ['messages' => $messages]);
    }
}
