<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
	
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- component -->
		<div class="bg-white p-8 rounded-md w-full">
			<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<div class="px-6 py-4 flex items-center">
						<div class="flex items-center">
							<span>Mostrar</span>
							<select wire:model="cant" class="mx-2 form-control">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<span>entradas</span>
						</div>
						<x-jet-input class="flex-1 mx-4" type="text" placeholder="Buscar" wire:model="search" />
						@livewire('create-post')
					</div>
					@if ($posts->count())

						<table class="min-w-full leading-normal">
    						<thead>
    							<tr>
    								<th class="w-24 cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider" wire:click="order('id')">
    									ID

										@if ($sort == 'id')
											@if ($direction == 'asc')
												<i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
											@else
												<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
												
											@endif
										@else	
											<i class="fas fa-sort float-right mt-1"></i>
										@endif
    								</th>
    								<th class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider" wire:click="order('title')">
    									Título

										@if ($sort == 'title')
											@if ($direction == 'asc')
												<i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
											@else
												<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
												
											@endif
										@else	
											<i class="fas fa-sort float-right mt-1"></i>
										@endif

    								</th>
    								<th class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider" wire:click="order('content')">
    									Contenido

										@if ($sort == 'content')
											@if ($direction == 'asc')
												<i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
											@else
												<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
												
											@endif
										@else	
											<i class="fas fa-sort float-right mt-1"></i>
										@endif
    								</th>
									<th class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider" wire:click="order('content')">
									
									</th>
    							</tr>
    						</thead>
							<tbody class="bg-white divide-y divide-gray-200 border-b">
								@foreach ($posts as $item)
	    							<tr >
	    								<td class="px-6 py-4">
											<div class="text-sm text-gray-900">
												{{$item->id}}
											</div>
	    								</td>
	    								<td class="px-6 py-4">
											<div class="text-sm text-gray-900">
	    										{{$item->title}}
											</div>
	    								</td>
	    								<td class="px-6 py-4">
											<div class="text-sm text-gray-900">
	    										{{$item->content}}
											</div>
	    								</td>
										<td class="px-1 py-4 whitespace-nowrap text-sm font-medium">
											<a class="btn btn-green" wire:click="edit({{$item->id}})">
												<i class="fas fa-edit"></i>
											</a>
										</td>
	    							</tr>    							
								@endforeach
    						</tbody>
    					</table>

					@else
						<div class="px-6 py-4">
							No existe ningún registro que coincida
						</div>
					@endif

					@if ($posts->hasPages())						
						<div class="px-6 py-3">
							{{ $posts->links() }}
						</div>
					@endif
					
					
				</div>
			</div>
		</div>

    </div>

	<x-jet-dialog-modal wire:model="open_edit" > 

		<x-slot:title>
			Editar el post
		</x-slot>

		<x-slot:content>

			<div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
				<strong class="font-bold">Imagen cargando!</strong>
				<span class="block sm:inline">Por favor espere un momento...</span>
			  </div>

			@if ($image)
				<img class="mb-4" src="{{$image->temporaryUrl()}}">
			@else
				{{-- <img src="{{Storage::url($post->image)}}" alt=""> --}}

				@if($post->id)
					@if ( substr($post->image, 0, 4) === 'http' )
						<img src="{{ $post->image }}" alt="">
					@else
						<img src="{{ Storage::url($post->image) }}" alt="">
					@endif
				@endif

			@endif
			  
			<div class="mb-4">
				<x-jet-label value="Título del post" />
				<x-jet-input type="text" class="w-full" wire:model="post.title" />             
				<x-jet-input-error for="title" />
			</div>

			<div class="mb-4">
				<x-jet-label value="Contenido del post" />
				<textarea wire:model="post.content" class="form-control w-full" rows="6"></textarea>
				<x-jet-input-error for="content" />
			</div>

			<div>
				<input type="file" wire:model="image" id="{{$identificador}}">
				<x-jet-input-error for="image" />
			</div>

		</x-slot>

		<x-slot:footer>
			<x-jet-secondary-button wire:click="$set('open_edit', false)">
				Cancelar    
			</x-jet-secondary-button>

			<x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update, image" class="ml-4 disabled:opacity-50">
				Actualizar
			</x-jet-danger-button>
		</x-slot>

	</x-jet-dialog-modal>
	
	
</div>