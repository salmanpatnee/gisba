@push('scripts')
<script src="/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#body',
    height: 500,
    menubar: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'wordcount'
    ],
    toolbar:
        'undo redo | blocks | ' +
        'bold italic underline | forecolor | ' +
        'alignleft aligncenter alignright | ' +
        'bullist numlist | link image | ' +
        'blockquote code | removeformat',
    content_style: 'body { font-family: system-ui, sans-serif; font-size: 15px; line-height: 1.7; color: #374151; }',
    branding: false,
});
</script>
@endpush
