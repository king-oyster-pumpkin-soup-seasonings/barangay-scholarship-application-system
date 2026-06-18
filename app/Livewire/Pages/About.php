<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class About extends Component
{
    public function render()
{
    $layout = auth()->check() ? 'layouts.app' : 'layouts.public';

    return view('pages.about')
        ->layout($layout, ['title' => 'About']);
}
}
