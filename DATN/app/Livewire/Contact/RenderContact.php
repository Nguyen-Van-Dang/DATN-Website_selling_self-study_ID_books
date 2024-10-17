<?php

namespace App\Livewire\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class RenderContact  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Contact = Contact::paginate(5);

        return view('livewire.contact.render-contact', [
            'Contact' => $Contact,
        ]);
    }
}