<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveModal extends Component
{
	  public $showModal = 'hidden';
	  
	  protected $listeners = [
	  	'showModal' => 'abrirModal'
	  ];

    public function render()
    {
        return view('livewire.live-modal');
    }

    public function abrirModal($user)
    {
    	$this->showModal = '';
    }

    public function cerrarModal()
    {
    	$this->showModal = 'hidden';
    }
}
