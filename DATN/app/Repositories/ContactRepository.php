<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAllContact() {
        $Contact = Contact::getAll();
        return view('admin.contact.listContact', ['Contact' => $Contact]);
    }
}
