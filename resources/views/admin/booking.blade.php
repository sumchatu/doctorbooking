@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin/Doctor/Appointment-Booking') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <p><strong>Opps Something went wrong</strong></p>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="alert alert-success">
                            <p><strong>Doctor's Name: Dr. {{$doctor->fname}} {{$doctor->lname}}</strong></p>
                            <ul>
                                <li>Department: {{$doctor->department}}</li>
                                <li>Visiting Day: {{$doctor->visiting_day}}</li>
                                <li>Visiting Time: {{$doctor->visiting_time}}  {{$doctor->visiting_time_format}}</li>
                            </ul>
                        </div>

                    <form method="POST" action="{{ route('appointment.save') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="user-type" class="col-md-4 col-form-label text-md-end">{{ __('Select Patient') }}</label>

                            <div class="col-md-6">
                                <select id="patient_id" class="form-control" name="patient_id" required >
                                    @foreach($patientArr as $key=>$val)
                                        <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                        <input type="hidden" name="time" value="{{$doctor->visiting_time}}{{$doctor->visiting_time_format}}">

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Select Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection