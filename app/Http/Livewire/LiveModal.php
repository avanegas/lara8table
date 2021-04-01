<?php

namespace App\Http\Livewire;

use App\Http\Requests\RequestUpdateUser;
use App\Models\User;
use Livewire\Component;

class LiveModal extends Component
{
	public $showModal = 'hidden';
    public $name = '';
    public $lastname = '';
    public $email = '';
    public $role = '';
    public $user = null;

	protected $listeners = [
	  	'showModal' => 'abrirModal'
	  ];

    public function render()
    {
        return view('livewire.live-modal');
    }

    public function abrirModal(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->lastname = $user->apellido->lastname;
        $this->email = $user->email;
        $this->role = $user->role;

    	$this->showModal = '';
    }

    public function cerrarModal()
    {
    	$this->reset();
    }

    public function actualizarUsuario()
    {
        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules(), $requestUser->messages());
        $this->user->update($values);
        $this->user->apellido()->update(['lastname' => $values['lastname']]);

        $this->emit('userListUpdate');
        $this->reset();
    }

    public function updated($label)
    {
        $requestUser = new RequestUpdateUser();
        $this->validateOnly($label, $requestUser->rules(), $requestUser->messages());
    }
}
