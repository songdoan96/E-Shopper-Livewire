<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $comment;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'comment' => 'required',
        ]);
    }
    public function sendMessage()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'comment' => 'required',
        ]);
        $contact = new Contact();
        $contact->name = $this->name;
        $contact->phone = $this->phone;
        $contact->email = $this->email;
        $contact->comment = $this->comment;
        $contact->save();
        session()->flash('success_msg', 'Cảm ơn phản hồi của bạn');
    }
    public function render()
    {
        return view('livewire.contact-component')->layout("layouts.base");
    }
}
