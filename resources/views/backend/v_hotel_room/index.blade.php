@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->

<div class="card">
    <h5 class="card-header">Hotel Room</h5>
    <div class="table-responsive text-nowrap">
        <a href="{{ route('v1.backend.hotel-room.create') }}">
            <button class="btn rounded-pill btn-primary btn-sm"
                style="border:none; outline:none; border-radius:12px; padding:6px 14px;">
                Add Hotel Room
            </button>
        </a>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hotel</th>
                    <th>Room Type</th>
                    <th>Capacity</th>
                    <th>Price / Night</th>
                    <th>Total Rooms</th>
                    <th>Amenities</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($index as $row)
                <tr>
                    <!-- NUMBER -->
                    <td>{{ $loop->iteration }}</td>

                    <!-- HOTEL -->
                    <td>
                        @if ($row->hotel)
                            {{ $row->hotel->hotel_name }}
                        @else
                            <span class="text-muted">No Hotel</span>
                        @endif
                    </td>

                    <!-- ROOM TYPE -->
                    <td>{{ $row->room_type }}</td>

                    <!-- CAPACITY -->
                    <td>{{ $row->capacity }} Person(s)</td>

                    <!-- PRICE -->
                    <td>Rp {{ number_format($row->price_per_night, 0, ',', '.') }}</td>

                    <!-- TOTAL ROOMS -->
                    <td>{{ $row->total_rooms }} Room(s)</td>

                    <!-- AMENITIES -->
                    <td>
                        @if (!empty($row->amenities))
                            @foreach ($row->amenities as $amenity)
                                <span class="badge bg-label-info rounded-pill me-1">{{ $amenity }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>

                    <!-- ACTION -->
                    <td>
                        <div class="dropdown">
                            <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                data-bs-toggle="dropdown">
                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">
                                <!-- EDIT -->
                                <a class="dropdown-item"
                                    href="{{ route('v1.backend.hotel-room.edit', $row->id) }}">
                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form method="POST"
                                    action="{{ route('v1.backend.hotel-room.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="dropdown-item"
                                        data-konf-delete="{{ $row->room_type }}">
                                        <i class="icon-base ri ri-delete-bin-6-line me-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No hotel room data available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- contentAkhir -->
@endsection
