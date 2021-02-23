<div class="form-group row">
    <label for="student_course"
           class="col-md-4 col-form-label text-md-right">{{$label}}</label>

    <div class="col-md-6">
        <select id="{{$field_name}}" name="{{$field_name }}" class="form-control">
            @foreach(array_keys($options) as $option)
                <option @if($value==$option) selected @endif value="{{$option}}">
                    {{$options[$option]}}</option>
            @endforeach
        </select>
    </div>
</div>
