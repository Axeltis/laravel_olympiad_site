<div class="form-group row">
    <label for="{{$field_name}}"
           class="col-md-4 col-form-label text-md-right">{{ __($label) }}</label>

    <div class="col-md-6">
        <input id="{{$field_name}}" type="file"
               class="form-control @error($field_name) is-invalid @enderror"
               name="{{$field_name}}"
               autocomplete="{{$field_name}}">

        @error($field_name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
