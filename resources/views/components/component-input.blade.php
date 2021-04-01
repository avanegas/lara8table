<div class="mr-1 mb-3">

	<div>
	  <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
	  <div class="mt-1 relative rounded-md shadow-sm">
	    <input type="{{$type}}"
			   wire:model="{{$name}}" 
			   id="{{$name}}"
			   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-1 pr-12 sm:text-sm border-gray-300 rounded-md"
			   placeholder="{{$placeholder}}">
	  </div>
	  @if($errors->has($name))
	  	<small class="text-red-600">{{$errors->first($name)}}</small>
	  @endif
	</div>
</div>