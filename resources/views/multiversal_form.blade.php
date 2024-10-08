@extends('template.template')
@section('content')
    <div class="container mt-4">
        <div style="
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
        margin-right: 20px;
    ">
        <div class="mx-auto col-lg-8">
            <!-- Form Header -->
            <h2>{{ $formTitle }}</h2>

            <!-- Form Start -->
            <form action="{{ $actionUrl }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($model)
                    @method('PUT') <!-- Menggunakan PUT untuk update jika model tersedia -->
                @endisset

                @foreach($form_datas as $form_data)
                    <x-dynamic-component
                        :component="'form.' . $form_data['type']"
                        :name="$form_data['name']"
                        :store="$form_data['store']"
                        :value="$form_data['value']"
                    />
                @endforeach

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-2">
                    {{ $submitButtonText }}
                </button>
            </form>
        </div>
    </div>
    </div>

@endsection
