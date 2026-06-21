@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">>
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.transportation.update', $edit->id) }}"  method="post" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Transportation</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mt-1 g-5">
                                    <label class="col-sm-2 col-form-label" for="basic-default-transportation-type">Transportation Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="transportation_type" value="{{ old('transportation_type', $edit->jenis_transportasi) }}" class="form-control @error('transportation_type') is-invalid @enderror" placeholder="Enter Transportation Type"> 
                                        @error('transportation_type') 
                                        <span class="invalid-feedback alert-danger" role="alert"> 
                                            {{ $message }} 
                                        </span> 
                                        @enderror
                                    </div>
                                </div>

                                {{-- Transportation Name --}}
                                <div class="col-md-6">
                                    <label class="form-label">Transportation Name</label>
                                    <input type="text"
                                        name="transportation_name"
                                        value="{{ old('transportation_name', $edit->transportation_name) }}"
                                        class="form-control @error('transportation_name') is-invalid @enderror"
                                        placeholder="Enter transportation name">

                                    @error('transportation_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Departure Destination --}}
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Departure</label>
                                        <select name="departure"
                                            class="form-select @error('departure') is-invalid @enderror">
                                            <option value="">-- Select Destination --</option>
                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}"
                                                    {{ old('departure', $edit->departure) == $destination->id ? 'selected' : '' }}>
                                                    {{ $destination->destination_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('departure')
                                             <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Arrival Destination --}}
                                <div class="col-md-6">
                                    <label class="form-label">Arrival </label>
                                    <select name="arrival"
                                        class="form-select @error('arrival') is-invalid @enderror">
                                        <option value="">-- Select Destination --</option>
                                        @foreach ($destinations as $destination)
                                            <option value="{{ $destination->id }}"
                                                {{ old('arrival', $edit->arrival) == $destination->id ? 'selected' : '' }}>
                                                {{ $destination->destination_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('arrival')
                                    <div class="invalid-feedback">
                                            {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{-- Departure & Arrival Time --}}
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Departure Time</label>
                                        <input type="datetime-local"
                                            name="departure_time"
                                            value="{{ old('departure_time', \Carbon\Carbon::parse($edit->departure_time)->format('Y-m-d\TH:i')) }}"
                                            class="form-control @error('departure_time') is-invalid @enderror">
                                        @error('departure_time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Arrival Time</label>
                                        <input type="datetime-local"
                                            name="arrival_time"
                                            value="{{ old('arrival_time', \Carbon\Carbon::parse($edit->arrival_time)->format('Y-m-d\TH:i')) }}"
                                            class="form-control @error('arrival_time') is-invalid @enderror">
                                        @error('arrival_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Price & Quota --}}
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Price Per Person</label>
                                        <input type="text"
                                            name="price_per_person"
                                            value="{{ old('price_per_person', $edit->price_per_person) }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('price_per_person') is-invalid @enderror"
                                            placeholder="Enter price">
                                        @error('price_per_person')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Quota</label>
                                        <input type="text"
                                            name="quota"
                                            value="{{ old('quota', $edit->quota) }}"
                                            onkeypress="return hanyaAngka(event)"
                                            class="form-control @error('quota') is-invalid @enderror"
                                            placeholder="Enter quota">
                                        @error('quota')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status"
                                            class="form-select @error('status') is-invalid @enderror">
                                            <option value="">-- Select Status --</option>
                                            <option value="Available"
                                                {{ old('status', $edit->status) == 'Available' ? 'selected' : '' }}>
                                                Available
                                            </option>
                                            <option value="Full Booked"
                                                {{ old('status', $edit->status) == 'Full Booked' ? 'selected' : '' }}>
                                                Full Booked
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Button --}}
                                <div class="row justify-content-end mt-6">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                        <a href="{{ route('v1.backend.transportation.index') }}"> 
                                            <button type="button" class="btn btn-secondary">Kembali</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 