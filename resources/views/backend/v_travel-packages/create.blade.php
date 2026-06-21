@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.travel-packages.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Add Travel Package</h5>
                        </div>
                        <div class="card-body">

                            {{-- Package Name --}}
                            <div class="col-lg-9">
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Package Name
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            name="packages_name"
                                            value="{{ old('packages_name') }}"
                                            class="form-control @error('packages_name') is-invalid @enderror"
                                            placeholder="Enter Package Name">
                                        @error('packages_name')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Destination --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Destination
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="destination_id"
                                            class="form-control @error('destination_id') is-invalid @enderror">
                                            <option value="">-- Select Destination --</option>
                                            @foreach ($destination as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('destination_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->destination_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('destination_id')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Hotel --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Hotel
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="hotel_id"
                                            class="form-control @error('hotel_id') is-invalid @enderror">
                                            <option value="">-- Select Hotel --</option>
                                            @foreach ($hotel as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('hotel_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->hotel_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Transportation --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Transportation
                                    </label>

                                    <div class="col-sm-10">
                                        <select name="transportation_id"
                                            class="form-control @error('transportation_id') is-invalid @enderror">
                                            <option value="">-- Select Transportation --</option>
                                            @foreach ($transportation as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('transportation_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->transportation_name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('transportation_id')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Description
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea
                                            name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            rows="4"
                                            placeholder="Enter Description">{{ old('description') }}</textarea>

                                        @error('description')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Package Type --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Package Type
                                    </label>

                                    <div class="col-sm-10">
                                        <select name="package_type"
                                            class="form-control @error('package_type') is-invalid @enderror">
                                            <option value="">-- Select Package Type --</option>
                                            <option value="Domestic"
                                                {{ old('package_type') == 'Domestic' ? 'selected' : '' }}>
                                                Domestic
                                            </option>
                                            <option value="International"
                                                {{ old('package_type') == 'International' ? 'selected' : '' }}>
                                                International
                                            </option>
                                        </select>

                                        @error('package_type')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Include --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Include
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            name="include"
                                            value="{{ old('include') }}"
                                            class="form-control @error('include') is-invalid @enderror"
                                            placeholder="Example: Hotel, Meals, Ticket">
                                        @error('include')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Exclude --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Exclude
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            name="exclude"
                                            value="{{ old('exclude') }}"
                                            class="form-control @error('exclude') is-invalid @enderror"
                                            placeholder="Example: Personal Expenses">
                                        @error('exclude')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Package Price
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            name="price_packages"
                                            value="{{ old('price_packages') }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('price_packages') is-invalid @enderror"
                                            placeholder="Enter Package Price">
                                        @error('price_packages')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Quota --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Quota
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="number"
                                            name="quota"
                                            value="{{ old('quota', 1) }}"
                                            class="form-control @error('quota') is-invalid @enderror"
                                            placeholder="Enter Quota">
                                        @error('quota')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">
                                        Status
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="">-- Select Status --</option>
                                            <option value="Available"
                                                {{ old('status') == 'Available' ? 'selected' : '' }}>
                                                Available
                                            </option>
                                            <option value="Full Booked"
                                                {{ old('status') == 'Full Booked' ? 'selected' : '' }}>
                                                Full Booked
                                            </option>
                                        </select>

                                        @error('status')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Photo --}}
                            <div class="col-lg-2 text-center">
                                <img id="preview-image" src="{{ asset('backend/img/avatars/1.png') }}"
                                class="img-fluid rounded mb-3"
                                style="max-width:180px"
                                id="uploadedAvatar">

                                <div class="mb-3">
                                    <label for="upload" class="btn btn-primary btn-sm">
                                        Upload New Photo
                                    </label>
                                    <input type="file"
                                        name="foto"
                                        id="upload"
                                        class="d-none"
                                        accept="image/png, image/jpeg"
                                        onchange="previewImage(this)"> 
                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="button"
                                    class="btn btn-outline-danger btn-sm mb-2"
                                    onclick="resetPreview()">
                                    Reset
                                </button>

                                <p class="text-muted small">
                                    Allowed JPG, GIF or PNG. Max size 800K
                                </p>
                            </div>

                            {{-- Button --}}
                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('v1.backend.travel-packages.index') }}" class="btn btn-secondary">
                                         Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@push('scripts')
<script>
    function previewImage(input) {
        const img = document.getElementById('preview-image');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => img.src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetPreview() {
        document.getElementById('preview-image').src =
            "{{ asset('storage/img-user/1.png') }}";
        document.getElementById('upload').value = '';
    }
</script>
@endpush