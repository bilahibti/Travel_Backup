@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">>
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.travel-packages.update', $edit->id) }}"  method="post" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Paket</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                {{-- FORM --}}
                                <div class="col-lg-8">

                                    {{-- Packages Name --}}
                                    <div class="mb-4">
                                        <label class="form-label">Packages Name</label>
                                        <input type="text"
                                            name="packages_name"
                                            value="{{ old('packages_name', $edit->packages_name) }}"
                                            class="form-control @error('packages_name') is-invalid @enderror"
                                            placeholder="Enter Package Name">
                                        @error('packages_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Destination --}}
                                    <div class="mb-4">
                                        <label class="form-label">Destination</label>
                                        <select name="destination_id"
                                            class="form-control @error('destination_id') is-invalid @enderror">
                                            <option value="">-- Select Destination --</option>

                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}"
                                                    {{ old('destination_id', $edit->destination_id) == $destination->id ? 'selected' : '' }}>
                                                    {{ $destination->destination_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('destination_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Hotel --}}
                                    <div class="mb-4">
                                        <label class="form-label">Hotel</label>
                                        <select name="hotel_id"
                                            class="form-control @error('hotel_id') is-invalid @enderror">
                                            <option value="">-- Select Hotel --</option>

                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}"
                                                    {{ old('hotel_id', $edit->hotel_id) == $hotel->id ? 'selected' : '' }}>
                                                    {{ $hotel->hotel_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('hotel_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Transportation --}}
                                    <div class="mb-4">
                                        <label class="form-label">Transportation</label>
                                        <select name="transportation_id"
                                            class="form-control @error('transportation_id') is-invalid @enderror">
                                            <option value="">-- Select Transportation --</option>

                                            @foreach ($transportations as $transportation)
                                                <option value="{{ $transportation->id }}"
                                                    {{ old('transportation_id', $edit->transportation_id) == $transportation->id ? 'selected' : '' }}>
                                                    {{ $transportation->transportation_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('transportation_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Description --}}
                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            rows="4">{{ old('description', $edit->description) }}</textarea>

                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Package Type --}}
                                    <div class="mb-4">
                                        <label class="form-label">Package Type</label>
                                        <select name="package_type"
                                            class="form-control @error('package_type') is-invalid @enderror">
                                            <option value="Domestic"
                                                {{ old('package_type', $edit->package_type) == 'Domestic' ? 'selected' : '' }}>
                                                Domestic
                                            </option>
                                            <option value="International"
                                                {{ old('package_type', $edit->package_type) == 'International' ? 'selected' : '' }}>
                                                International
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Include --}}
                                    <div class="mb-4">
                                        <label class="form-label">Include</label>
                                        <textarea name="include"
                                            class="form-control @error('include') is-invalid @enderror"
                                            rows="3">{{ old('include', $edit->include) }}</textarea>
                                    </div>

                                    {{-- Exclude --}}
                                    <div class="mb-4">
                                        <label class="form-label">Exclude</label>
                                        <textarea name="exclude"
                                            class="form-control @error('exclude') is-invalid @enderror"
                                            rows="3">{{ old('exclude', $edit->exclude) }}</textarea>
                                    </div>

                                    {{-- Price --}}
                                    <div class="mb-4">
                                        <label class="form-label">Package Price</label>
                                        <input type="text"
                                            name="price_packages"
                                            value="{{ old('price_packages', $edit->price_packages) }}"
                                            class="form-control @error('price_packages') is-invalid @enderror">
                                    </div>

                                    {{-- Quota --}}
                                    <div class="mb-4">
                                        <label class="form-label">Quota</label>
                                        <input type="text"
                                            name="quota"
                                            value="{{ old('quota', $edit->quota) }}"
                                            class="form-control @error('quota') is-invalid @enderror">
                                    </div>

                                    {{-- Status --}}
                                    <div class="mb-4">
                                        <label class="form-label">Status</label>
                                        <select name="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="Available"
                                                {{ old('status', $edit->status) == 'Available' ? 'selected' : '' }}>
                                                Available
                                            </option>

                                            <option value="Full Booked"
                                                {{ old('status', $edit->status) == 'Full Booked' ? 'selected' : '' }}>
                                                Full Booked
                                            </option>
                                        </select>
                                    </div>

                                </div>

                                {{-- FOTO --}}
                                <div class="col-lg-4 text-center">

                                    @if ($edit->foto)
                                        <img id="preview-image"
                                            src="{{ asset('storage/img-package/' . $edit->foto) }}"
                                            class="img-fluid rounded shadow-sm mb-3"
                                            style="width:250px;height:250px;object-fit:cover;">
                                    @else
                                        <img id="preview-image"
                                            src="{{ asset('storage/img-user/1.png') }}"
                                            class="img-fluid rounded shadow-sm mb-3"
                                            style="width:250px;height:250px;object-fit:cover;">
                                    @endif

                                    <div class="mb-3">
                                        <label for="upload" class="btn btn-primary">
                                            Upload New Photo
                                        </label>

                                        <input type="file"
                                            name="foto"
                                            id="upload"
                                            class="d-none"
                                            accept="image/png,image/jpeg,image/jpg"
                                            onchange="previewImage(this)">

                                        @error('foto')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>

                                    <a href="{{ route('v1.backend.travel-packages.index') }}"
                                        class="btn btn-secondary">
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
        reader.onload = function(e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function resetPreview() {
    const img = document.getElementById('preview-image');
    img.src = "{{ $edit->foto 
        ? asset('storage/img-package/'.$edit->foto) 
        : asset('storage/img-user/1.png') }}";
    document.getElementById('upload').value = '';
}
</script>
@endpush