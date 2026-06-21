@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal -->

<div  class="card">
    <h5 class="card-header">Transportation</h5> 
    <div class="table-responsive text-nowrap">
        <a href="{{ route('v1.backend.transportation.create') }}">
            <button class="btn rounded-pill btn-primary btn-sm" style="border:none; outline:none; border-radius:12px; padding:6px 14px;">Add Transportation</button>
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Transportation Type</th>
                    <th>Transportation Name</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Price / Person</th>
                    <th>Quota</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @foreach ($index as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->transportation_type }}</td>
                    <td>{{ $row->transportation_name }}</td>
                    {{-- Foreign Key Relation --}}
                    <td>
                        {{ $row->departure }}
                    </td>
                    <td>
                        {{ $row->arrival }}
                    </td>
                    <td>{{ $row->departure_time }}</td>

                    <td>{{ $row->arrival_time }}</td>
                    <td>
                        Rp {{ number_format($row->price_per_person, 0, ',', '.') }}
                    </td>
                    <td>{{ $row->quota }}</td>
                    <td>
                        @if ($row->status == 'Available')
                            <span class="badge bg-label-success rounded-pill">
                                Available
                            </span>
                        @else
                            <span class="badge bg-label-warning rounded-pill">
                                Full Booked
                            </span>
                        @endif
                    </td>

                    <td>
                        <div class="dropdown">
                            <button type="button"
                                class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                data-bs-toggle="dropdown">
                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">

                                {{-- Edit --}}
                                <a class="dropdown-item"
                                    href="{{ route('v1.backend.transportation.edit', $row->id) }}">
                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form method="POST"
                                    action="{{ route('v1.backend.transportation.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="dropdown-item"
                                        data-konf-delete="{{ $row->transportation_name }}">
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