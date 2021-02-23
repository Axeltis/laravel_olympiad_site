<div class="form-group row">
    <label for="student_course"
           class="col-md-4 col-form-label text-md-right">{{$label}}</label>

    <div class="col-md-6">
        <select id="{{$field_name}}" name="{{$field_name }}" class="form-control">
            @for($i = $min_num; $i <= $max_num; $i++)
                <option @if($value==$i) selected @endif value="{{$i}}">
                    {{$i}}</option>
            @endfor
        </select>
    </div>
</div>
