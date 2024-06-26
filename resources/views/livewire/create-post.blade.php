<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="block sm:inline">Por favor espere un momento...</span>
              </div>

            @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}">
            @endif

            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input type="text" class="w-full" wire:model.defer="title"/>             
                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <div wire:ignore>
                    <textarea id="editor" 
                        wire:model.defer="content" 
                        class="form-control w-full" 
                        rows="6">
                    </textarea>
                </div>

                <x-jet-input-error for="content" />
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-jet-input-error for="image" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar    
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="ml-4 disabled:opacity-50">
                Crear post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')	
		<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
		<script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    });
                    Livewire.on('resetCKEditor', () => {
                        editor.setData('');
                    })
                })
				.catch( error => {
					console.error( error );
				} );
		</script>
	@endpush
</div>
