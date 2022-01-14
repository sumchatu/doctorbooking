@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin/Doctor/Appointment-Booking') }}</div>
                <div class="alert alert-danger">
                    <p class="text-dark">
                        <strong>
                            &nbsp Doctor's Name: <u>Dr. {{$doctor->fname}} {{$doctor->lname}}</u><br>
                            &nbsp Department: <u>{{$doctor->department}}</u>
                            &nbsp Visiting Day: <u>{{$doctor->visiting_day}}</u>
                            &nbsp Visiting Time: <u>{{$doctor->visiting_time}}  {{$doctor->visiting_time_format}}</u>
                        </strong>
                    </p>
                </div>
                <div class="alert alert-success">
                    <p><strong>Existing All Appointments</strong></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sl.No</th>
                                <th scope="col">Patient-Name</th>
                                <th scope="col">Date-of-Booking</th>
                                <th scope="col">Time</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($appointments->count() > 0)
                            <input type="hidden" value = "{{$i = ($appointments->currentpage()-1)* $appointments->perpage() + 1}}"></input>
                            @foreach($appointments as $app)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$app->patient->fname}}&nbsp{{$app->patient->lname}}</td>
                                <td>{{Carbon\Carbon::parse($app->date_of_appointment)->format('d-m-Y')}}</td>
                                <td>{{$app->time}}</td>
                                <td>
            
                                </td>
                            </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="5"><div class="alert alert-danger">No record found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
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