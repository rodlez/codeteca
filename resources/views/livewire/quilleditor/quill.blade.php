<div>
    <!-- Create the editor container -->
    <!-- wire:ignore will stop re-rendering the component when we type on the editor. -->
    <div wire:ignore>
        <div 
            id="{{ $quillId }}"
            wire:key={{$quillId}}
            style="
    font-size: 1rem;"
        >
        {!!$value!!}
        </div>
    </div>
 

    <!-- Initialize Quill editor -->
    <script>
       
       
        const quill = new Quill('#{{ $quillId }}', {
            theme: 'snow'
        });       
        
        console.log(quill);               
       
        // Data Binding to the Livewire Component, by adding a quill event listener. 
        quill.on('text-change', function() {
            let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
            @this.set('value', value)
        })
    </script>

</div>