@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin/Edit-Doctor') }}</div>

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

                    <form method="POST" action="{{ route('admin.update',$user->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="row mb-3">
                            <label for="first-name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control" name="fname" value="{{$user->fname}}" required autocomplete="fname" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last-name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="{{$user->lname}}" required autocomplete="lname" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$user->phone}}" autocomplete="phone">
                            </div>
                        </div>

                        <div class="row mb-3 doctor">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control" name="department" value="{{$user->department}}" >
                            </div>
                        </div>

                        <div class="row mb-3 doctor">
                            <label for="fees" class="col-md-4 col-form-label text-md-end">{{ __('Fees') }}</label>

                            <div class="col-md-6">
                                <input id="fees" type="number" class="form-control" name="fees" value="{{$user->fees}}" >
                            </div>
                        </div>

                        <div class="row mb-3 doctor">
                            <label for="visiting-day" class="col-md-4 col-form-label text-md-end">{{ __('Visiting Day') }}</label>

                            <div class="col-md-6">
                                <select id="visiting_day" class="form-control" name="visiting_day">
                                    <option value="">Select</option>
                                    <option value="Sunday"  @if($user->visiting_day == "Sunday") Selected @endif>Sunday</option>
                                    <option value="Monday" @if($user->visiting_day == "Monday") Selected @endif>Monday</option>
                                    <option value="Tuesday" @if($user->visiting_day == "Tuesday") Selected @endif>Tuesday</option>
                                    <option value="Wednesday" @if($user->visiting_day == "Wednesday") Selected @endif>Wednesday</option>
                                    <option value="Thursday" @if($user->visiting_day == "Thursday") Selected @endif>Thursday</option>
                                    <option value="Friday" @if($user->visiting_day == "Friday") Selected @endif>Friday</option>
                                    <option value="Saturday" @if($user->visiting_day == "Saturday") Selected @endif>Saturday</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 doctor">
                            <label for="visiting-time" class="col-md-4 col-form-label text-md-end">{{ __('Visiting Time') }}</label>

                            <div class="col-md-3">
                                <input id="visiting_time" type="number" class="col-md-4" name="visiting_time" value="{{$user->visiting_time}}" >
        
                                    <select id="visiting_time_format" class="col-md-4" name="visiting_time_format">
                                        <option value="">Select</option>
                                        <option value="AM" @if($user->visiting_time_format == "AM") Selected @endif>AM</option>
                                        <option value="PM" @if($user->visiting_time_format == "PM") Selected @endif>PM</option>
                                    </select>
                                
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <span class="pull-right col-md-6 offset-md-4">
                                    <a href="{{route('admin.index')}}"><button type="button" class="btn btn-danger">
                                        {{ __('Cancel') }}
                                    </button></a>
                                </span>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
