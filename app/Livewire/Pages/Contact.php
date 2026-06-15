<?php

namespace App\Livewire\Pages;

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
        $this->submitted = true;
    }

    public function render()
    {
        return view('pages.contact')
            ->layout('layouts.public', ['title' => 'Contact']);
    }
}
