<div>
    <!-- Create the editor container -->
    <!-- wire:ignore will stop re-rendering the component when we type on the editor. -->
    <div wire:ignore>
        <textarea id="editor"
                wire:model="info"
                class="min-h-fit h-48"
                rows="6">
            </textarea>
    </div>
 

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('info', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>

</div>
