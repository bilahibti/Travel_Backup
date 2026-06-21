@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal --> 
<div class="card">
    <h5 class="card-header">Data User</h5> 
    <div class="table-responsive text-nowrap">
        <a href="{{ route('v1.backend.user.create') }}"> 
            <button class="btn rounded-pill btn-primary btn-sm" style="border:none; outline:none; border-radius:12px; padding:6px 14px;">Add User</button> 
        </a> 
        <table class="table table-striped"> 
            <thead>
                <tr> 
                    <th>No</th> 
                    <th>Name</th> 
                    <th>Email</th> 
                    <th>Phone Number</th> 
                    <th>Role</th> 
                    <th>Action</th> 
                </tr> 
            </thead>

            <tbody class="table-border-bottom-0">
                @foreach ($index as $row)
                <tr> 
                    <!-- Number -->
                    <td>{{ $loop->iteration }}</td> 
                    
                    <!-- Name -->
                    <td>{{ $row->nama }}</td> 
                    <!-- Email -->
                    <td>{{ $row->email }}</td> 
                    <!-- Phone -->
                    <td>{{ $row->hp }}</td>
                    <!-- Role -->
                    <td>
                        @if ($row->role)
                            <span class="badge bg-label-primary rounded-pill">
                                {{ $row->role->name }}
                            </span>
                        @else
                            <span class="badge bg-label-secondary rounded-pill">
                                No Role
                            </span>
                        @endif
                    </td>

                    <!-- Action -->
                    <td>
                        <div class="dropdown">
                            <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                data-bs-toggle="dropdown">
                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">

                                <!-- Edit -->
                                <a class="dropdown-item"
                                    href="{{ route('v1.backend.user.edit', $row->id) }}">
                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form method="POST"
                                    action="{{ route('v1.backend.user.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="dropdown-item"
                                        data-konf-delete="{{ $row->name }}">
                                        <i class="icon-base ri ri-delete-bin-6-line me-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td> 
                </tr> 
                @endforeach 
            </tbody> 
        </table> 
    </div>
</div>
 
<!-- contentAkhir -->
@endsection 