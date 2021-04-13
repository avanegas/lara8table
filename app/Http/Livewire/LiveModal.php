<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use App\Models\Apellido;
use App\Http\Requests\RequestUpdateUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;

class LiveModal extends Component
{
    use WithFileUploads;

	public $showModal = 'hidden';
    public $name = '';
    public $lastname = '';
    public $email = '';
    public $role = '';
    public $user = null;
    public $action = '';
    public $method ='';
    public $password = '';
    public $password_confirmation = '';
    public $profile_photo_path = null;

	protected $listeners = [
	  	'showModal' => 'abrirModal',
        'showModalNewUser' => 'AbrirModalNuevo',
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
        
        $this->action = 'Actualizar';
        $this->method = 'actualizarUsuario';

    	$this->showModal = '';
    }

    public function AbrirModalNuevo()
    {
        $this->user = null;
        $this->action = 'Registrar';
        $this->method = 'registrarUsuario';
        $this->showModal = '';
    }

    public function cerrarModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    	$this->reset();
    }

    public function actualizarUsuario()
    {
        $requestUser = new RequestUpdateUser();
        
        $values = $this->validate($requestUser->rules($this->user), $requestUser->messages());
    
        $this->removeImage($this->user->profile_photo_path);
        if($values['profile_photo_path']){
            $profile = ['profile_photo_path' => $this->loadImage($values['profile_photo_path'])];
            $values = array_merge($values, $profile);            
        }

        $this->user->update($values);
        
        $this->user->apellido()->update(['lastname' => $values['lastname']]);

        $this->emit('userListUpdate');
        
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function updated($label)
    {
        $requestUser = new RequestUpdateUser();

        $this->validateOnly($label, $requestUser->rules($this->user), $requestUser->messages());
    }

    public function registrarUsuario()
    {
        $requestUser = new RequestUpdateUser();

        $values = $this->validate($requestUser->rules($this->user), $requestUser->messages());

        $user = new User;
        $apellido = new Apellido;
        $apellido->lastname = $values['lastname'];

        $user->fill($values);

        if($values['profile_photo_path']){
           $user->profile_photo_path = $this->loadImage($values['profile_photo_path']); 
        }
        
        $user->password = bcrypt($values['password']);
        
        DB::transaction(function () use ($user, $apellido){
            $user->save();
            $apellido->user()->associate($user)->save();
        });

        $this->cerrarModal();
    }

    private function loadImage(TemporaryUploadedFile $image)
    {
        $extension = $image->getClientOriginalExtension();
        $location = \Storage::disk('public')->put('img', $image);

        return $location;
    }

    private function removeImage($profile_photo_path)
    {
        if(!$profile_photo_path){
            return;
        }
        if(Storage::disk('public')->exists($profile_photo_path)){
            Storage::disk('public')->delete($profile_photo_path);    
        }
        
    }
}
