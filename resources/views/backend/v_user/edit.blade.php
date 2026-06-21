@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.user.update', $edit->id) }}"  method="post" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit User</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9"> 
                                    <div class="mb-4"> 
                                        <label class="form-label">
                                            Name
                                        </label> 
                                        <input type="text" name="name" value="{{ old('name', $edit->name) }}" class="form-control @error('name') is-invalid @enderror"> 
                                    </div> 
                                    <div class="mb-4"> 
                                        <label class="form-label">Email</label> 
                                        <input type="text" name="email" value="{{ old('email', $edit->email) }}" class="form-control @error('email') is-invalid @enderror"> 
                                    </div> 
                                    <div class="mb-4"> 
                                        <label class="form-label">Role</label> 
                                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror"> 
                                            <option value="">
                                                -- Select Role --
                                            </option> 
                                            
                                            @foreach($roles as $role) 
                                            <option value="{{ $role->id }}" {{ old('role_id',$edit->role_id)==$role->id ? 'selected' : '' }}> {{ $role->name }} </option> 
                                            @endforeach 
                                        </select> 
                                    </div> 

                                    <div class="mb-4"> 
                                        <label class="form-label">Phone Number</label> 
                                        <input type="text" name="hp" value="{{ old('hp',$edit->hp) }}" class="form-control"> 
                                    </div> 
                                </div>

                                <!-- Foto --> 
                                <div class="col-lg-3 text-center"> 
                                    <div class="card border-0 shadow-sm"> 
                                        <div class="card-body text-center"> 
                                            <img id="preview-image" src="{{ $edit->foto ? asset('storage/img-user/'.$edit->foto) : asset('storage/img-user/1.png') }}" class="img-fluid rounded mb-3" style="width:180px;height:180px;object-fit:cover;"> 
                                            <label for="upload" class="btn btn-primary w-100 mb-2"> 
                                                Upload New Photo 
                                            </label> 
                                            <input type="file" id="upload" name="foto" class="d-none" onchange="previewImage(this)"> 
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="resetPreview()"> 
                                                Reset 
                                            </button> 
                                            <small class="text-muted d-block mt-3"> 
                                                Allowed JPG, JPEG, PNG<br> Max size 800 KB 
                                            </small> 
                                        </div> 
                                    </div> 
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
        reader.onload = function(e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function resetPreview() {
    const img = document.getElementById('preview-image');
    img.src = "{{ $edit->foto 
        ? asset('storage/img-user/'.$edit->foto) 
        : asset('storage/img-user/1.png') }}";
    document.getElementById('upload').value = '';
}
</script>
@endpush