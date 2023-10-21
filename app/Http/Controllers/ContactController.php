<?php

namespace App\Http\Controllers;

use App\Lbc\Themes\Liara\Mail\Contact as MailContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactMessages = Contact::all();

        return view('admin.pages.message.index', compact('contactMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('misc.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required', // Add validation for the 'message' field
        ]);

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message'); // Use 'message' field

        $contact->save();

        Session::flash('message', 'Message sent successfully');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('contact.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $MessageId)
    {
        $contactMessage = Contact::find($MessageId);

        return view('admin.pages.message.show', compact('contactMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
