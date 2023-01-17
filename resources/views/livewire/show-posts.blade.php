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
							{{-- <input type="text" wire:model="search"> --}}
							<x-jet-input class="flex-1 mr-4" type="text" placeholder="Buscar" wire:model="search" />
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
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach ($posts as $post)
		    							<tr>
		    								<td class="px-6 py-4">
												<div class="text-sm text-gray-900">
													{{$post->id}}
												</div>
		    								</td>
		    								<td class="px-6 py-4">
												<div class="text-sm text-gray-900">
		    										{{$post->title}}
												</div>
		    								</td>
		    								<td class="px-6 py-4">
												<div class="text-sm text-gray-900">
		    										{{$post->content}}
												</div>
		    								</td>
											<td class="px-6 py-4 border-b whitespace-nowrap text-sm font-medium">
												@livewire('edit-post', ['post' => $post], key($post->id))
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
    					
    					
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>