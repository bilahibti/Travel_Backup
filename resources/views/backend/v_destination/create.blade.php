@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.destination.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Destination</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <label class="form-label">Destination Name</label>
                                        <input type="text" name="destination_name"
                                        value="{{ old('destination_name') }}"
                                        class="form-control @error('destination_name') is-invalid @enderror"
                                        placeholder="Enter Destination Name">
                                        @error('destination_name')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Country</label>
                                        <input type="text" name="country"
                                            value="{{ old('country') }}"
                                            class="form-control @error('country') is-invalid @enderror"
                                            placeholder="Enter Country">
                                        @error('country')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city"
                                            value="{{ old('city') }}"
                                            class="form-control @error('city') is-invalid @enderror"
                                            placeholder="Enter City">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter Description"
                                        style="height: 60px">{{ old('description') }}</textarea>
                                        @error('description') 
                                        <span class="invalid-feedback alert-danger" role="alert"> 
                                            {{ $message }} 
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Destination Type</label>
                                        <select name="destination_type"
                                            class="form-control @error('destination_type') is-invalid @enderror">
                                            <option value="">-- Select Type --</option>
                                            <option value="Domestic"
                                                {{ old('destination_type') == 'Domestic' ? 'selected' : '' }}>
                                                Domestic
                                            </option>
                                            <option value="International"
                                                {{ old('destination_type') == 'International' ? 'selected' : '' }}>
                                                International
                                            </option>
                                        </select>
                                        @error('destination_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Quota</label>
                                        <input type="number" name="quota"
                                            value="{{ old('quota') }}"
                                            class="form-control @error('quota') is-invalid @enderror"
                                            placeholder="Enter Quota">
                                        @error('quota')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Status</label>
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
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

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

                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('v1.backend.destination.index') }}" class="btn btn-secondary">
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