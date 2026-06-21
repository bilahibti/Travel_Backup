@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal -->

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6 gy-6">
            <div class="col-xxl">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('v1.backend.transportation.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Add Transportation</h5>
                        </div>
                        <div class="card-body">
                            {{-- Transportation Type --}}
                            <div class="row mt-1 g-5">
                                <label class="col-sm-2 col-form-label" for="basic-default-transportation-type">Transportation Type</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="transportation_type" value="{{ old('transportation_type') }}" class="form-control @error('transportation_type') is-invalid @enderror" placeholder="Enter Transportation Type"> 
                                    @error('transportation_type') 
                                    <span class="invalid-feedback alert-danger" role="alert"> 
                                        {{ $message }} 
                                    </span> 
                                    @enderror
                                </div>
                            </div>

                            {{-- Transportation Name --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Transportation Name
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        name="transportation_name"
                                        value="{{ old('transportation_name') }}"
                                        class="form-control @error('transportation_name') is-invalid @enderror"
                                        placeholder="Enter Transportation Name">
                                    @error('transportation_name')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Departure Destination --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Departure Destination
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        name="departure"
                                        value="{{ old('departure') }}"
                                        class="form-control @error('departure') is-invalid @enderror"
                                        placeholder="Enter Departure Destination">
                                    @error('departure')
                                         <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Arrival Destination --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Arrival Destination
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        name="arrival"
                                        value="{{ old('arrival') }}"
                                        class="form-control @error('arrival') is-invalid @enderror"
                                        placeholder="Enter Arrival Destination">
                                    @error('arrival')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Departure Time --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Departure Time
                                </label>
                                <div class="col-sm-9">
                                    <input type="datetime-local"
                                        name="departure_time"
                                        value="{{ old('departure_time') }}"
                                        class="form-control @error('departure_time') is-invalid @enderror">
                                    @error('departure_time')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Arrival Time --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Arrival Time
                                </label>
                                <div class="col-sm-9">
                                    <input type="datetime-local"
                                        name="arrival_time"
                                        value="{{ old('arrival_time') }}"
                                        class="form-control @error('arrival_time') is-invalid @enderror">
                                    @error('arrival_time')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Price Per Person --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Price Per Person
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        onkeypress="return hanyaAngka(event)"
                                        name="price_per_person"
                                        value="{{ old('price_per_person') }}"
                                        class="form-control @error('price_per_person') is-invalid @enderror"
                                        placeholder="Enter Price">
                                    @error('price_per_person')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Quota --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Quota
                                </label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        onkeypress="return hanyaAngka(event)"
                                        name="quota"
                                        value="{{ old('quota') }}"
                                        class="form-control @error('quota') is-invalid @enderror"
                                        placeholder="Enter Quota">
                                    @error('quota')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row mt-3">
                                <label class="col-sm-3 col-form-label">
                                    Status
                                </label>
                                <div class="col-sm-9">
                                    <select name="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="">
                                            -- Select Status --
                                        </option>
                                        <option value="Available"
                                            {{ old('status') == 'Available' ? 'selected' : '' }}>
                                            Available
                                        </option>
                                        <option value="Full Booked"
                                            {{ old('status') == 'Full Booked' ? 'selected' : '' }}>
                                            Full Booked
                                        </option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Button --}}
                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('v1.backend.transportation.index') }}" class="btn btn-secondary">
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