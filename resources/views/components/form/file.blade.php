@props(['name', 'store'])

<div style="margin-top: 20px;">
    <label for="{{ $name }}" style="font-weight: bold; font-size: 1.2em; color: #333; margin-bottom: 10px; display: block;">
        {{ ucwords($name) }}
    </label>

    <input id="{{ $name }}" type="file" name="{{ $store }}"
        style="display: block; width: 100%; padding: 10px; font-size: 1em; color: #555; border: 2px solid #ccc; border-radius: 5px; cursor: pointer; transition: border-color 0.3s ease-in-out;"
        class="@error($store) is-invalid @enderror"
        onchange="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.5)';">

    @error($store)
    <div style="margin-top: 10px; padding: 10px; border-radius: 5px; font-size: 0.9em; color: red; background-color: #f8d7da;">
        {{ $message }}
    </div>
    @enderror
</div>
