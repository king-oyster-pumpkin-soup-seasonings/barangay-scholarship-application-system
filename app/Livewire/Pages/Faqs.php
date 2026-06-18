<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Faqs extends Component
{
    public function render()
    {
        return view('pages.faqs')
            ->layout('layouts.public', ['title' => 'FAQs']);
    }
}
