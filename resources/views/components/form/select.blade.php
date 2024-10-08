@props(['name', "store", 'options'])

<label for="{{ $name }}" class="form-label"> {{  ucwords($name) }}</label>

<select class="form-select form-select-lg" name="{{ $store }}" id="$name">
    <option selected> Pilih ... </option>
    @foreach ($options as $option)
    <option value="{{ $option->id }}" {{ old('{{ $store }}')==$option->id ? 'selected':''}}>
        {{ $option->name }}
    </option>
    @endforeach

</select>
@error($store)
    <div class="alert alert-danger"> {{ $message }} </div>
@enderror
