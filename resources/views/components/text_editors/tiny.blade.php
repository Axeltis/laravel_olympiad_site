<div class="form-group row">
    <div class="col">

        <textarea id="{{$field_name}}" name="{{$field_name}}">{!! $value !!}</textarea>
        <script src="https://cdn.tiny.cloud/1/2i8c69vqe58wfqgxnbzmdng3du8rpdg3gor7thb8eq2sfjoe/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>


            $(document).ready(function () {
            tinymce.init({
                selector: '#{{$field_name}}',
                height : "150",
                //width : "1000"
		plugins: [
  			'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount imagetools textpattern noneditable help charmap  quickbars emoticons'
  			],
		menubar: 'file edit view insert format tools table tc help',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
		contextmenu: 'link image imagetools table configurepermanentpen',
		toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',

		toolbar_mode: 'sliding',
		image_advtab: true,
    
 		image_caption: true,
  		
    		content_css:"/storage/tinymce/content.css"

            });


            });
        </script>
    </div>
</div>
