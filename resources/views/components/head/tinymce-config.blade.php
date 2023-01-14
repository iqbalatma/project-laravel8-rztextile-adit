<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    toolbar: 'undo redo  | bold italic',
    menubar: false,
    forced_root_block : false,
    setup: function (ed) {
    ed.on('keydown',function(e) {
        if(e.keyCode == 13){
        }
    });
  }
  });
</script>