@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin/New-User-Creation') }}</div>

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

                    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="user-type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>

                            <div class="col-md-6">
                                <select id="user-type" class="form-control" name="user_type" required >
                                    <option value="">Select</option>
                                    <option value=2>Doctor</option>
                                    <option value=3>Patient</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="first-name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last-name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" autocomplete="phone">
                            </div>
                        </div>
                        <div class="row mb-3 doctor">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control" name="department" value="{{ old('department') }}" >
                            </div>
                        </div>
                        <div class="row mb-3 doctor">
                            <label for="fees" class="col-md-4 col-form-label text-md-end">{{ __('Fees') }}</label>

                            <div class="col-md-6">
                                <input id="fees" type="number" class="form-control" name="fees" value="{{ old('fees') }}" >
                            </div>
                        </div>
                        <div class="row mb-3 doctor">
                            <label for="visiting-day" class="col-md-4 col-form-label text-md-end">{{ __('Visiting Day') }}</label>

                            <div class="col-md-6">
                                <select id="visiting_day" class="form-control" name="visiting_day">
                                    <option value="">Select</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 doctor">
                            <label for="visiting-time" class="col-md-4 col-form-label text-md-end">{{ __('Visiting Time') }}</label>

                            <div class="col-md-3">
                                <input id="visiting_time" type="number" class="col-md-4" name="visiting_time" value="{{ old('visiting_time') }}" >
        
                                    <select id="visiting_time_format" class="col-md-4" name="visiting_time_format">
                                        <option value="">Select</option>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" name="age" value="{{ old('age') }}" >
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="aadhar" class="col-md-4 col-form-label text-md-end">{{ __('Aadhar No') }}</label>

                            <div class="col-md-6">
                                <input id="aadhar" type="text" class="form-control" name="aadhar" value="{{ old('aadhar') }}" >
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="sex" class="col-md-4 col-form-label text-md-end">{{ __('Sex') }}</label>

                            <div class="col-md-6">
                                <select id="sex" class="form-control" name="sex">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Transgender">Transgender</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" >
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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

@push('scripts')
<script>
    $(document).ready(function(){
        $(".doctor").hide();
        $(".user").hide();

        $("#user-type").change(function(){
            if($(this).val()==2)
            {
                $(".user").hide();
                $(".doctor").show();
            }
            if($(this).val()==3)
            {
                $(".doctor").hide();
                $(".user").show();
            }
        });
    });
</script>
@endpush