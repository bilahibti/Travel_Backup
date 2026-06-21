@extends('backend.v_layouts.app') 
@section('content') 
<!-- template --> 
 
<div class="row"> 
    <div class="col-12"> 
        <div class="card"> 
            <form class="form-horizontal" action="{{ route('v1.backend.user.report.printuser') }}" method="post" target="_blank"> 
                @csrf 
                 <div class="card-body"> 
                    <h4 class="card-title"> {{$judul}} </h4> 
 
                    <div class="form-group"> 
                        <label>Start Date</label> 
                        <input type="date" name="start_date" onkeypress="return hanyaAngka(event)" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror" placeholder="Enter Start Date"> 
                        @error('start_date') 
                        <span class="invalid-feedback alert-danger" role="alert"> 
                            {{ $message }} 
                        </span> 
                        @enderror 
                    </div> 
 
                    <div class="form-group"> 
                        <label>End Date</label> 
                        <input type="date" name="end_date" onkeypress="return hanyaAngka(event)" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror" placeholder="Enter End Date"> 
                        @error('end_date') 
                        <span class="invalid-feedback alert-danger" role="alert"> 
                            {{ $message }} 
                        </span> 
                        @enderror 
                    </div> 
 
                    <br> 
                    <button type="submit" class="btn btn-primary">Print</button> 
 
            </form> 
        </div> 
    </div> 
</div> 
 
<!-- end template--> 
@endsection 