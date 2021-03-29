<div>
	<x-component-modal :showModal="$showModal">
    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
      <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
        Edición de usuario
      </h3>
      <div class="mt-2">
        <p class="text-sm text-gray-500">
					<form>
						<div class="flex">
						<x-component-input placeholder="Ingrese su nombre" name="name" label="Nombre"></x-component-input>
						<x-component-input placeholder="Ingrese su apellido" name="lastname" label="Apellido"></x-component-input>							
						</div>
						<div class="flex">
						<x-component-input placeholder="Ingrese su email" name="email" label="Correo"></x-component-input>							
						</div>

					</form>
        </p>
      </div>
    </div>
	</x-component-modal>
</div>	