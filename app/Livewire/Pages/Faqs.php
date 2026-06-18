<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Faqs extends Component
{
    public function render()
{
    $layout = auth()->check() ? 'layouts.app' : 'layouts.public';

    return view('pages.faqs')
        ->layout($layout, ['title' => 'FAQs']);
}
}
