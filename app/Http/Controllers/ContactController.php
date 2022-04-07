<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\ContactCollection;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class ContactController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'name' =>'required|string|max:255', 
        'email' =>'required|string|email|max:255', 
        'phone' => 'required|string',  
        'description' => 'required|string', 
    ];

    public function index(){
        $this->authorize('viewAny', Contact::class);
        return new ContactColection(Contact::paginate(10));
    }

    public function all(){
        $this->authorize('viewAny', Contact::class);
        return new ContactColection(Contact::all());
    }

    public function show(Contact $contact){
        $this->authorize('view', $contact);
        return response()->json(new ContactResource($contact), 200);
    }

    public function store (Request $request){
        $request->validate(self::$rules, self::$messages);
        $contact = Contact::create($request->all() + ['state' => 'Pendiente']);
        $contact->save();


        Mail::to(env('MAIL_CONTACT'))->send(new NewContact($contact));

        return response()->json(new ContactResource($contact), 201);
    }

    public function update (Request $request, Contact $contact){
        $this->authorize('update',$contact);
        $request->validate([
            'name' =>'required|string|max:255', 
            'email' =>'required|string|email|max:255', 
            'phone' => 'required|string',  
            'description' => 'required|string', 
            'state' => 'required|string'
        ], self::$messages);
        $contact->update($request->all());
        return response()->json($contact, 200);
    }

    public function delete (Contact $contact ){
        $this->authorize('delete',$contact);
        $contact->delete();
        return response()->json(null, 204);
    }
}
