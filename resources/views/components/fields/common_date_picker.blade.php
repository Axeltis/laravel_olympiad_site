<div class="form-group row">
    <label for="{{$field_name}}"
           class="col-md-4 col-form-label text-md-right">{{ $label}}</label>
    <div class="col-md-6">
        <input id="{{$field_name}}" name="{{$field_name}}" type="date"
               class="form-control @error($field_name) is-invalid @enderror"
               value="{{ $value }}" required autocomplete="{{$field_name}}">
        @error($field_name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
