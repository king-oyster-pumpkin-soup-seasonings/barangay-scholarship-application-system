<?php

namespace App\Livewire\Pages;

use App\Models\Feedback;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    public bool $submitted = false;

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10',
        ]);

        Feedback::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->submitted = true;
    }

    public function render()
{
    $layout = auth()->check() ? 'layouts.app' : 'layouts.public';

    return view('pages.contact')
        ->layout($layout, ['title' => 'Contact']);
}
}
