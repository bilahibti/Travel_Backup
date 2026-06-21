@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.hotel.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Hotel</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <label class="form-label">Destination</label>
                                        <select name="destination_id"
                                            class="form-control @error('destination_id') is-invalid @enderror">
                                            <option value="">-- Select Destination --</option>

                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}">
                                                    {{ $destination->destination_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('destination_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- HOTEL NAME -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Hotel Name
                                        </label>
                                        <input type="text"
                                            name="hotel_name"
                                            value="{{ old('hotel_name') }}"
                                            class="form-control @error('hotel_name') is-invalid @enderror"
                                            placeholder="Enter Hotel Name">
                                        @error('hotel_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- ADDRESS -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Address
                                        </label>
                                        <input type="text"
                                            name="address"
                                            value="{{ old('address') }}"
                                            class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Enter Address">
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- DESCRIPTION -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Description
                                        </label>
                                        <textarea
                                            name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter Description"
                                            style="height: 80px">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- STAR RATING -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Star Rating
                                        </label>
                                        <input type="text"
                                            name="star_rating"
                                            value="{{ old('star_rating') }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('star_rating') is-invalid @enderror"
                                            placeholder="Enter Star Rating">
                                        @error('star_rating')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- PRICE -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Price Per Night
                                        </label>
                                        <input type="text"
                                            name="price_per_night"
                                            value="{{ old('price_per_night') }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('price_per_night') is-invalid @enderror"
                                            placeholder="Enter Price Per Night">
                                        @error('price_per_night')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- FACILITIES -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Facilities
                                        </label>
                                        <textarea
                                            name="facilities"
                                            class="form-control @error('facilities') is-invalid @enderror"
                                            placeholder="Enter Facilities"
                                            style="height: 80px">{{ old('facilities') }}</textarea>
                                        @error('facilities')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Quota</label>
                                        <input type="number"
                                            name="quota"
                                            value="{{ old('quota') }}"
                                            class="form-control @error('quota') is-invalid @enderror"
                                            placeholder="Enter Quota">

                                        @error('quota')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- STATUS -->
                                    <div class="mb-4">
                                        <label class="form-label">
                                            Status
                                        </label>
                                        <select name="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="">
                                                -- Select Status --
                                            </option>
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
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- IMAGE -->
                                <div class="col-lg-3 text-center">
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
                            </div>

                            <!-- BUTTON -->
                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('v1.backend.hotel.index') }}" class="btn btn-secondary">
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