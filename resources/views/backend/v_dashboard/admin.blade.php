@extends('backend.v_layouts.app')
@section('content')
{{-- contentAwal --}}

<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">
            <i class="iconify me-2" data-icon="tabler:layout-dashboard"></i>
            Dashboard Admin
        </h4>
        <span class="text-muted small">{{ now()->translatedFormat('l, d F Y') }}</span>
    </div>

    {{-- ===================== STATISTIK KARTU ===================== --}}
    <div class="row g-3 mb-4">

        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="iconify" data-icon="tabler:calendar-check" data-width="24"></i>
                        </span>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small">Total Booking</p>
                        <h5 class="mb-0 fw-bold">{{ number_format($totalBookings) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="iconify" data-icon="tabler:clock" data-width="24"></i>
                        </span>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small">Pending</p>
                        <h5 class="mb-0 fw-bold">{{ number_format($pendingBookings) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="iconify" data-icon="tabler:currency-dollar" data-width="24"></i>
                        </span>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small">Total Pendapatan</p>
                        <h5 class="mb-0 fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-info">
                            <i class="iconify" data-icon="tabler:users" data-width="24"></i>
                        </span>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small">Total User</p>
                        <h5 class="mb-0 fw-bold">{{ number_format($totalUsers) }}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== STATUS BOOKING ===================== --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Booking Terbaru</h5>
                    {{-- Tombol ke halaman booking jika ada --}}
                    {{-- <a href="{{ route('v1.backend.booking.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a> --}}
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Pelanggan</th>
                                    <th>Tipe</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $b)
                                <tr>
                                    <td><code>{{ $b->booking_code }}</code></td>
                                    <td>{{ $b->contact_name ?? ($b->user->name ?? '-') }}</td>
                                    <td>{{ $b->typeLabel() }}</td>
                                    <td>Rp {{ number_format($b->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $b->statusBadgeClass() }}">
                                            {{ $b->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $b->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">Belum ada booking</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Status</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span><span class="badge bg-warning me-2">●</span>Pending</span>
                            <strong>{{ $pendingBookings }}</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span><span class="badge bg-primary me-2">●</span>Dikonfirmasi</span>
                            <strong>{{ $confirmedBookings }}</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span><span class="badge bg-success me-2">●</span>Selesai</span>
                            <strong>{{ $completedBookings }}</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center py-2">
                            <span><span class="badge bg-danger me-2">●</span>Dibatalkan</span>
                            <strong>{{ $cancelledBookings }}</strong>
                        </li>
                    </ul>

                    <hr>

                    <div class="d-flex justify-content-between text-muted small">
                        <span>Total Destinasi</span>
                        <strong>{{ $totalDestinations }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== FILTER ===================== --}}
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari nama...">
                </div>
                <div class="col-md-3">
                    <select id="filterStatus" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="col-md-5 text-end text-muted small">
                    <i class="iconify" data-icon="tabler:filter"></i> Filter aktif pada tab yang terbuka
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== TAB ===================== --}}
    <ul class="nav nav-tabs mb-0" id="tabMenu" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#travel" role="tab">
                <i class="iconify me-1" data-icon="tabler:map-2"></i> Paket Wisata
                <span class="badge bg-primary ms-1">{{ $paket->count() }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#hotel" role="tab">
                <i class="iconify me-1" data-icon="tabler:building"></i> Hotel
                <span class="badge bg-success ms-1">{{ $hotel->count() }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#transport" role="tab">
                <i class="iconify me-1" data-icon="tabler:plane"></i> Transportasi
                <span class="badge bg-warning ms-1">{{ $transportation->count() }}</span>
            </a>
        </li>
    </ul>

    <div class="tab-content border border-top-0 rounded-bottom p-3 bg-white">

        {{-- ================= TRAVEL PACKAGES ================= --}}
        <div class="tab-pane fade show active" id="travel" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle filterable-table" id="travelTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Paket</th>
                            <th>Destinasi</th>
                            <th>Tipe</th>
                            <th>Kuota</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paket as $i => $item)
                        @php
                            $quota  = $item->quota  ?: 1;
                            $booked = $item->booked ?? 0;
                            $percent = min(100, ($booked / $quota) * 100);
                        @endphp
                        <tr>
                            <td class="text-muted small">{{ $i + 1 }}</td>
                            <td>
                                <strong>{{ $item->packages_name }}</strong>
                            </td>
                            <td>{{ $item->destination->destination_name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-label-secondary">{{ ucfirst($item->package_type ?? '-') }}</span>
                            </td>
                            <td style="min-width:130px">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>{{ $booked }} / {{ $quota }}</span>
                                    <span>{{ round($percent) }}%</span>
                                </div>
                                <div class="progress" style="height:6px">
                                    <div class="progress-bar bg-primary" style="width: {{ $percent }}%"></div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->price_packages, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status === 'Available')
                                    <span class="badge bg-label-success">Available</span>
                                @else
                                    <span class="badge bg-label-danger">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('v1.backend.travel-packages.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="iconify" data-icon="tabler:edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada paket wisata</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= HOTEL ================= --}}
        <div class="tab-pane fade" id="hotel" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle filterable-table" id="hotelTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Hotel</th>
                            <th>Destinasi</th>
                            <th>Bintang</th>
                            <th>Kuota</th>
                            <th>Harga / Malam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hotel as $i => $item)
                        @php
                            $quota  = $item->quota  ?: 1;
                            $booked = $item->booked ?? 0;
                            $percent = min(100, ($booked / $quota) * 100);
                        @endphp
                        <tr>
                            <td class="text-muted small">{{ $i + 1 }}</td>
                            <td><strong>{{ $item->hotel_name }}</strong></td>
                            <td>{{ $item->destination->destination_name ?? '-' }}</td>
                            <td>
                                @for($s = 1; $s <= 5; $s++)
                                    <span style="color:{{ $s <= $item->star_rating ? '#f5a623' : '#ccc' }}">★</span>
                                @endfor
                            </td>
                            <td style="min-width:130px">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>{{ $booked }} / {{ $quota }}</span>
                                    <span>{{ round($percent) }}%</span>
                                </div>
                                <div class="progress" style="height:6px">
                                    <div class="progress-bar bg-success" style="width: {{ $percent }}%"></div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->price_per_night, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status === 'Available')
                                    <span class="badge bg-label-success">Available</span>
                                @else
                                    <span class="badge bg-label-danger">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('v1.backend.hotel.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="iconify" data-icon="tabler:edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data hotel</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= TRANSPORTASI ================= --}}
        <div class="tab-pane fade" id="transport" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle filterable-table" id="transportTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Rute</th>
                            <th>Kuota</th>
                            <th>Harga / Orang</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transportation as $i => $item)
                        @php
                            $quota  = $item->quota  ?: 1;
                            $booked = $item->booked ?? 0;
                            $percent = min(100, ($booked / $quota) * 100);
                        @endphp
                        <tr>
                            <td class="text-muted small">{{ $i + 1 }}</td>
                            <td><strong>{{ $item->transportation_name }}</strong></td>
                            <td>
                                <span class="badge bg-label-info">{{ ucfirst($item->transportation_type ?? '-') }}</span>
                            </td>
                            <td>
                                {{ $item->departureDestination->destination_name ?? '?' }}
                                <i class="iconify" data-icon="tabler:arrow-right"></i>
                                {{ $item->arrivalDestination->destination_name ?? '?' }}
                            </td>
                            <td style="min-width:130px">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>{{ $booked }} / {{ $quota }}</span>
                                    <span>{{ round($percent) }}%</span>
                                </div>
                                <div class="progress" style="height:6px">
                                    <div class="progress-bar bg-warning" style="width: {{ $percent }}%"></div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->price_per_person, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status === 'Available')
                                    <span class="badge bg-label-success">Available</span>
                                @else
                                    <span class="badge bg-label-danger">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('v1.backend.transportation.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="iconify" data-icon="tabler:edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data transportasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- end tab-content --}}

</div>

@push('scripts')
<script>
// Filter sederhana: search + status
function applyFilter() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const status  = document.getElementById('filterStatus').value.toLowerCase();

    document.querySelectorAll('.filterable-table tbody tr').forEach(row => {
        const text   = row.innerText.toLowerCase();
        const match  = (!keyword || text.includes(keyword)) &&
                       (!status  || text.includes(status));
        row.style.display = match ? '' : 'none';
    });
}

document.getElementById('searchInput').addEventListener('input',  applyFilter);
document.getElementById('filterStatus').addEventListener('change', applyFilter);
</script>
@endpush

{{-- contentAkhir --}}
@endsection