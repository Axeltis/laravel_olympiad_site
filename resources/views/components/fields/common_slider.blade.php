<div class="form-group row">
    <label for="student_course"
           class="col-md-4 col-form-label text-md-right">{{$label}}</label>

    <div class="col-md-6">
        <input id="{{$field_name}}" name="{{$field_name}}" type="text" data-slider-min="{{$min_num}}"
               data-slider-max="{{$max_num}}" data-slider-step="{{$step}}" data-slider-value="{{$value}}"/>
        <script>
            $(document).ready(function () {
                $("#{{$field_name}}").slider({
                    tooltip: 'always'
                });
            });
        </script>
    </div>

</div>
