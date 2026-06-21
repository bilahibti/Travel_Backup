@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal -->

<div  class="card">
    <h5 class="card-header">Travel Packages</h5> 
    <div class="table-responsive text-nowrap">
        <a href="{{ route('v1.backend.travel-packages.create') }}">
            <button class="btn rounded-pill btn-primary btn-sm" style="border:none; outline:none; border-radius:12px; padding:6px 14px;">Add Travel Package</button>
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Package Name</th>
                    <th>Destination</th>
                    <th>Hotel</th>
                    <th>Transportation</th>
                    <th>Package Type</th>
                    <th>Price</th>
                    <th>Quota</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @foreach ($index as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->packages_name }}</td>
                    <td>
                        {{ $row->destination->destination_name ?? '-' }}
                    </td>
                    <td>
                        {{ $row->hotel->hotel_name ?? '-' }}
                    </td>
                    <td>
                        {{ $row->transportation->transportation_name ?? '-' }}
                    </td>
                    <td>
                        <span class="badge bg-label-info rounded-pill">
                            {{ $row->package_type }}
                        </span>
                    </td>
                    <td>
                        Rp {{ number_format($row->price_packages, 0, ',', '.') }}
                    </td>
                    <td>
                        {{ $row->quota }}
                    </td>
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
                            <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                data-bs-toggle="dropdown">
                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">

                                {{-- Edit --}}
                                <a class="dropdown-item"
                                    href="{{ route('v1.backend.travel-packages.edit', $row->id) }}">
                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form method="POST"
                                    action="{{ route('v1.backend.travel-packages.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="dropdown-item"
                                        data-konf-delete="{{ $row->packages_name }}">
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