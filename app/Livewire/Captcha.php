<?php

namespace App\Livewire;

use Livewire\Component;

class Captcha extends Component
{
    public $captchaSrc;

    public function mount()
    {
        $this->generateCaptcha();
    }

    public function generateCaptcha()
    {
        $this->captchaSrc = captcha_src('math') . '?' . time();
    }

    public function render()
    {
        return view('livewire.captcha');
    }
}
