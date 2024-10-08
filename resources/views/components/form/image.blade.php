@props([
    'name',
    'store',
    'maxSize' => 2048,
    'value' => '',
    'img_path' => ''
])

<div style="margin-top: 20px;">
    <label for="{{ $store }}" style="font-weight: bold; font-size: 1.2em; color: #333; margin-bottom: 10px; display: block;">
        {{ ucwords($name) }}
    </label>

    <input id="{{ $store }}" type="file" name="{{ $store }}" accept="image/*"
        style="display: block; width: 100%; padding: 10px; font-size: 1em; color: #555; border: 2px solid #ccc; border-radius: 5px; cursor: pointer; transition: border-color 0.3s ease-in-out;"
        class="@error($store) is-invalid @enderror" onchange="previewImages(event, '{{ $store }}')">

    <small style="display: block; margin-top: 5px; color: #666;">
        Maximum file size: {{ $maxSize }} KB
    </small>

    <div id="preview-{{ $store }}" style="margin-top: 10px; display: flex; gap: 10px; flex-wrap: wrap;">
        <!-- Preview images will be appended here -->
        @if($value)
            <img src="{{ route($img_path, $value) }}" alt="{{ $name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; border: 2px solid #ccc;">
        @endif
    </div>

    <button id="cancel-{{ $store }}" type="button" onclick="cancelUpload('{{ $store }}')"
        style="display: {{ $value ? 'block' : 'none' }}; margin-top: 10px; padding: 5px 10px; font-size: 0.9em; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Cancel
    </button>

    @error($store)
    <div style="margin-top: 10px; padding: 10px; border-radius: 5px; font-size: 0.9em; color: red; background-color: #f8d7da;">
        {{ $message }}
    </div>
    @enderror
</div>

<script>
    function previewImages(event, inputId) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-' + inputId);
        const cancelBtn = document.getElementById('cancel-' + inputId);
        const files = input.files;
        const maxSize = {{ $maxSize }}; // in KB

        // Clear the preview container
        previewContainer.innerHTML = '';

        // Iterate over files
        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Validate file size
            if (file.size > maxSize * 1024) {
                alert(`File size must be less than ${maxSize} KB.`);
                input.value = ''; // Clear input
                cancelBtn.style.display = 'none'; // Hide cancel button
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('File must be an image.');
                input.value = ''; // Clear input
                cancelBtn.style.display = 'none'; // Hide cancel button
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.width = '100px';
                imgElement.style.height = '100px';
                imgElement.style.objectFit = 'cover';
                imgElement.style.borderRadius = '5px';
                imgElement.style.border = '2px solid #ccc';

                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(file);
        }

        // Show cancel button if files are selected
        cancelBtn.style.display = files.length > 0 ? 'block' : 'none';
    }

    function cancelUpload(inputId) {
        const input = document.getElementById(inputId);
        const previewContainer = document.getElementById('preview-' + inputId);
        const cancelBtn = document.getElementById('cancel-' + inputId);

        input.value = ''; // Clear input
        previewContainer.innerHTML = ''; // Clear preview
        cancelBtn.style.display = 'none'; // Hide cancel button
    }
</script>
