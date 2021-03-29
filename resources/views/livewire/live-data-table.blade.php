<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

      	<div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
	      	<div class="flex">
		      	<select wire:model="perPage"
		      					class="form-input text-gray-500 ml-6 border-b border-gray-200 sm:rounded-lg">
		      		<option value="5">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
		      	</select>
		      	<input  wire:model="search"
		      					type="text" 
		      					class="form-input w-full text-gray-500 ml-6 border-b border-gray-200 sm:rounded-lg" 
		      					placeholder="Buscar por Nombre y Email . ...">
		      	<select wire:model="user_role"
		      					class="form-input text-gray-500 ml-6 border-b border-gray-200 sm:rounded-lg">
		      		<option value="">Seleccione</option>
		      		<option value="admin">Admin</option>
							<option value="seller">Vendedor</option>
							<option value="client">Cliente</option>
		      	</select>				
		      	<button wire:click="clear" class="ml-6">
		      		<span class="fa fa-eraser"></span>
		      	</button>      		
	      	</div>
	      </div>	

        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                ID
                <button wire:click="sortable('id')">
                	<span class="fa fa{{$camp === 'id' ? $icon: '-circle'}}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nombre
                <button wire:click="sortable('name')">
                	<span class="fa fa{{$camp === 'name' ? $icon: '-circle'}}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Apellido
                <button wire:click="sortable('lastname')">
                	<span class="fa fa{{$camp === 'lastname' ? $icon: '-circle'}}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
                <button wire:click="sortable('email')">
                	<span class="fa fa{{$camp === 'email' ? $icon: '-circle'}}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          	@foreach($users as $user)
	            <tr>
	              <td class="px-6 py-4 whitespace-nowrap">
	                <div class="flex items-center">
	                  <div class="flex-shrink-0 h-10 w-10">
	                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
	                  </div>
	                  <div class="ml-4">
	                    <div class="text-sm font-medium text-gray-900">{{ $user->id }}</div>
	                  </div>
	                </div>
	              </td>
	              <td class="px-6 py-4 whitespace-nowrap">
	                <div class="text-sm text-gray-900">{{ $user->name }}</div>
	              </td>
	              <td class="px-6 py-4 whitespace-nowrap">
	                <div class="text-sm text-gray-900">{{ $user->apellido->lastname }}</div>
	              </td>
	              <td class="px-6 py-4 whitespace-nowrap">
	                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
	                  {{ $user->email }}
	                </span>
	              </td>
	              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
	                	{{ $user->rol }}
	              </td>
	              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
	                <a href="javascript:void(0)" wire:click="showModal({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</a>
	              </td>
	            </tr>
            @endforeach
            <!-- More items... -->
          </tbody>
        </table>

        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
        	{{ $users->links() }}
        </div>
        
      </div>
    </div>
  </div>
</div>
