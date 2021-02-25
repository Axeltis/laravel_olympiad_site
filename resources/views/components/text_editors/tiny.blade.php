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
            });

            });
        </script>
    </div>
</div>
