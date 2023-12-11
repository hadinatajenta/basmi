<div>
    <script src="https://cdn.tiny.cloud/1/83u0cy42uodkss4mi1i1tebecrg7edigufe4onidqdaa4w3k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#editor', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'image code table lists',
            images_upload_url: 'postAcceptor.php',
            automatic_uploads: false,
            file_picker_types: 'image',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>   
</div>