@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add User</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="mb-4">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Name">
                                        @error('name')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="email"
                                            value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">You can use letters, numbers & periods</div>
                                    </div>

                                     <div class="mb-4">
                                        <label class="form-label">Role</label>
                                        <select name="role_id"
                                            class="form-control @error('role_id') is-invalid @enderror">
                                            <option value="">
                                                -- Select Role --
                                            </option>       
                                            @foreach ($roles as $role)

                                            <option value="{{ $role->id }}"
                                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">
                                            Phone Number
                                        </label>
                                        <input type="text"
                                            name="hp"
                                            value="{{ old('hp') }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('hp') is-invalid @enderror"
                                            placeholder="Enter Phone Number">
                                        @error('hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter Password">
                                        @error('password')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm Password">
                                    </div>
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
                                    <a href="{{ route('v1.backend.user.index') }}" class="btn btn-secondary">
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