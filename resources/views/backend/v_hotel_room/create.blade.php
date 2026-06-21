@extends('Backend.V_Layouts.App')
@section('content')
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal"
                          action="{{ route('v1.backend.hotel-room.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Hotel Room</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- LEFT COLUMN -->
                                <div class="col-md-8">

                                    <!-- HOTEL -->
                                    <div class="mb-4">
                                        <label class="form-label">Hotel</label>
                                        <select name="hotel_id"
                                            class="form-control @error('hotel_id') is-invalid @enderror">
                                            <option value="">-- Select Hotel --</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}"
                                                    {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                                    {{ $hotel->hotel_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- ROOM TYPE -->
                                    <div class="mb-4">
                                        <label class="form-label">Room Type</label>
                                        <select name="room_type"
                                            class="form-control @error('room_type') is-invalid @enderror">
                                            <option value="">-- Select Room Type --</option>
                                            @foreach (['Standard', 'Deluxe', 'Suite', 'Superior', 'Family', 'Executive'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('room_type') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('room_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- CAPACITY -->
                                    <div class="mb-4">
                                        <label class="form-label">Capacity (Persons)</label>
                                        <input type="number"
                                            name="capacity"
                                            value="{{ old('capacity') }}"
                                            class="form-control @error('capacity') is-invalid @enderror"
                                            placeholder="Enter Capacity"
                                            min="1">
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- PRICE PER NIGHT -->
                                    <div class="mb-4">
                                        <label class="form-label">Price Per Night</label>
                                        <input type="text"
                                            name="price_per_night"
                                            value="{{ old('price_per_night') }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('price_per_night') is-invalid @enderror"
                                            placeholder="Enter Price Per Night">
                                        @error('price_per_night')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- TOTAL ROOMS -->
                                    <div class="mb-4">
                                        <label class="form-label">Total Rooms</label>
                                        <input type="number"
                                            name="total_rooms"
                                            value="{{ old('total_rooms') }}"
                                            class="form-control @error('total_rooms') is-invalid @enderror"
                                            placeholder="Enter Total Rooms"
                                            min="1">
                                        @error('total_rooms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- AMENITIES -->
                                    <div class="mb-4">
                                        <label class="form-label">Amenities</label>
                                        <div id="amenities-container">
                                            @if (old('amenities'))
                                                @foreach (old('amenities') as $amenity)
                                                    <div class="input-group mb-2 amenity-row">
                                                        <input type="text"
                                                            name="amenities[]"
                                                            value="{{ $amenity }}"
                                                            class="form-control"
                                                            placeholder="e.g. WiFi, AC, TV">
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-remove-amenity">
                                                            <i class="ri ri-delete-bin-line"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="input-group mb-2 amenity-row">
                                                    <input type="text"
                                                        name="amenities[]"
                                                        class="form-control"
                                                        placeholder="e.g. WiFi, AC, TV">
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-remove-amenity">
                                                        <i class="ri ri-delete-bin-line"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button"
                                            id="btn-add-amenity"
                                            class="btn btn-outline-primary btn-sm mt-1">
                                            <i class="ri ri-add-line me-1"></i> Add Amenity
                                        </button>
                                        @error('amenities')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div><!-- /col-md-8 -->

                                <!-- RIGHT COLUMN – Photo Upload -->
                                <div class="col-lg-4 text-center">
                                    <img id="preview-image"
                                         src="{{ asset('backend/img/avatars/1.png') }}"
                                         class="img-fluid rounded mb-3"
                                         style="max-width:180px; height:150px; object-fit:cover;">

                                    <div class="mb-3">
                                        <label for="upload" class="btn btn-primary btn-sm">
                                            Upload Room Photo
                                        </label>
                                        <input type="file"
                                            name="foto"
                                            id="upload"
                                            class="d-none"
                                            accept="image/png, image/jpeg"
                                            onchange="previewImage(this)">
                                        @error('foto')
                                            <div class="invalid-feedback d-block alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="button"
                                        class="btn btn-outline-danger btn-sm mb-2"
                                        onclick="resetPreview()">
                                        Reset
                                    </button>

                                    <p class="text-muted small">
                                        Allowed JPG or PNG. Max size 1024 KB
                                    </p>
                                </div>
                            </div><!-- /row -->

                            <!-- BUTTONS -->
                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('v1.backend.hotel-room.index') }}"
                                       class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </div><!-- /card-body -->
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
        document.getElementById('preview-image').src = "{{ asset('backend/img/avatars/1.png') }}";
        document.getElementById('upload').value = '';
    }

    // Dynamic amenity rows
    document.getElementById('btn-add-amenity').addEventListener('click', function () {
        const container = document.getElementById('amenities-container');
        const row = document.createElement('div');
        row.className = 'input-group mb-2 amenity-row';
        row.innerHTML = `
            <input type="text" name="amenities[]" class="form-control" placeholder="e.g. WiFi, AC, TV">
            <button type="button" class="btn btn-outline-danger btn-remove-amenity">
                <i class="ri ri-delete-bin-line"></i>
            </button>`;
        container.appendChild(row);
        bindRemoveButtons();
    });

    function bindRemoveButtons() {
        document.querySelectorAll('.btn-remove-amenity').forEach(btn => {
            btn.onclick = function () {
                const rows = document.querySelectorAll('.amenity-row');
                if (rows.length > 1) {
                    this.closest('.amenity-row').remove();
                }
            };
        });
    }

    bindRemoveButtons();
</script>
@endpush
