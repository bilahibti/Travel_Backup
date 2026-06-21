{{--
    Staff dashboard — di-include dari index.blade.php
    Variabel yang tersedia: $paket, $hotel, $transportation, $pendingBookingList, $pendingBookings
--}}

<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">
        <i class="iconify me-2" data-icon="tabler:layout-dashboard"></i>
        Dashboard Staff
    </h4>
    <span class="text-muted small">{{ now()->translatedFormat('l, d F Y') }}</span>
</div>

{{-- ===================== STATISTIK CEPAT ===================== --}}
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-warning">
                        <i class="iconify" data-icon="tabler:clock" data-width="24"></i>
                    </span>
                </div>
                <div>
                    <p class="mb-0 text-muted small">Booking Pending</p>
                    <h5 class="mb-0 fw-bold">{{ $pendingBookings }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-primary">
                        <i class="iconify" data-icon="tabler:map-2" data-width="24"></i>
                    </span>
                </div>
                <div>
                    <p class="mb-0 text-muted small">Total Paket</p>
                    <h5 class="mb-0 fw-bold">{{ $paket->count() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-success">
                        <i class="iconify" data-icon="tabler:building" data-width="24"></i>
                    </span>
                </div>
                <div>
                    <p class="mb-0 text-muted small">Total Hotel</p>
                    <h5 class="mb-0 fw-bold">{{ $hotel->count() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-info">
                        <i class="iconify" data-icon="tabler:plane" data-width="24"></i>
                    </span>
                </div>
                <div>
                    <p class="mb-0 text-muted small">Total Transportasi</p>
                    <h5 class="mb-0 fw-bold">{{ $transportation->count() }}</h5>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===================== BOOKING PENDING ===================== --}}
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">
            <i class="iconify me-1" data-icon="tabler:alert-circle"></i>
            Booking Perlu Ditangani
        </h5>
        @if($pendingBookings > 0)
            <span class="badge bg-warning">{{ $pendingBookings }} pending</span>
        @endif
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Pelanggan</th>
                        <th>Tipe</th>
                        <th>Tanggal Perjalanan</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingBookingList as $b)
                    <tr>
                        <td><code>{{ $b->booking_code }}</code></td>
                        <td>{{ $b->contact_name ?? ($b->user->name ?? '-') }}</td>
                        <td>{{ $b->typeLabel() }}</td>
                        <td>{{ $b->travel_date ? $b->travel_date->format('d/m/Y') : '-' }}</td>
                        <td>Rp {{ number_format($b->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-label-{{ $b->statusBadgeClass() }}">
                                {{ $b->statusLabel() }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="iconify me-1" data-icon="tabler:check"></i>
                            Tidak ada booking yang perlu ditangani
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ===================== TAB DATA ===================== --}}
<div class="card mb-2">
    <div class="card-body py-2">
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text" id="staffSearch" class="form-control form-control-sm" placeholder="Cari nama...">
            </div>
            <div class="col-md-3">
                <select id="staffStatus" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>
        </div>
    </div>
</div>

<ul class="nav nav-tabs mb-0" id="staffTabMenu" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#staffTravel" role="tab">
            <i class="iconify me-1" data-icon="tabler:map-2"></i> Paket Wisata
            <span class="badge bg-primary ms-1">{{ $paket->count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#staffTransport" role="tab">
            <i class="iconify me-1" data-icon="tabler:plane"></i> Transportasi
            <span class="badge bg-warning ms-1">{{ $transportation->count() }}</span>
        </a>
    </li>
</ul>

<div class="tab-content border border-top-0 rounded-bottom p-3 bg-white mb-4">

    {{-- ====== TRAVEL PACKAGES ====== --}}
    <div class="tab-pane fade show active" id="staffTravel" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-hover align-middle staff-filterable" id="staffTravelTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Destinasi</th>
                        <th>Tipe</th>
                        <th>Durasi</th>
                        <th>Kuota</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paket as $i => $item)
                    @php
                        $quota   = $item->quota  ?: 1;
                        $booked  = $item->booked ?? 0;
                        $percent = min(100, ($booked / $quota) * 100);
                    @endphp
                    <tr>
                        <td class="text-muted small">{{ $i + 1 }}</td>
                        <td><strong>{{ $item->packages_name }}</strong></td>
                        <td>{{ $item->destination->destination_name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-label-secondary">{{ ucfirst($item->package_type ?? '-') }}</span>
                        </td>
                        <td>{{ $item->duration_days ?? '-' }} hari</td>
                        <td style="min-width:120px">
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

    {{-- ====== TRANSPORTASI ====== --}}
    <div class="tab-pane fade" id="staffTransport" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-hover align-middle staff-filterable" id="staffTransportTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Rute</th>
                        <th>Keberangkatan</th>
                        <th>Kuota</th>
                        <th>Harga / Orang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transportation as $i => $item)
                    @php
                        $quota   = $item->quota  ?: 1;
                        $booked  = $item->booked ?? 0;
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
                            →
                            {{ $item->arrivalDestination->destination_name ?? '?' }}
                        </td>
                        <td class="small">{{ $item->departure_time ?? '-' }}</td>
                        <td style="min-width:120px">
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

</div>

@push('scripts')
<script>
function applyStaffFilter() {
    const keyword = document.getElementById('staffSearch').value.toLowerCase();
    const status  = document.getElementById('staffStatus').value.toLowerCase();

    document.querySelectorAll('.staff-filterable tbody tr').forEach(row => {
        const text  = row.innerText.toLowerCase();
        const match = (!keyword || text.includes(keyword)) &&
                      (!status  || text.includes(status));
        row.style.display = match ? '' : 'none';
    });
}

document.getElementById('staffSearch').addEventListener('input',  applyStaffFilter);
document.getElementById('staffStatus').addEventListener('change', applyStaffFilter);
</script>
@endpush