@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin/Edit-Patient') }}</div>

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

                        <div class="row mb-3 user">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" name="age" value="{{$user->age}}" >
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="aadhar" class="col-md-4 col-form-label text-md-end">{{ __('Aadhar No') }}</label>

                            <div class="col-md-6">
                                <input id="aadhar" type="text" class="form-control" name="aadhar" value="{{$user->aadhar_no}}" >
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="sex" class="col-md-4 col-form-label text-md-end">{{ __('Sex') }}</label>

                            <div class="col-md-6">
                                <select id="sex" class="form-control" name="sex">
                                    <option value="">Select</option>
                                    <option value="Male" @if($user->sex == "Male") Selected @endif>Male</option>
                                    <option value="Female" @if($user->sex == "Female") Selected @endif>Female</option>
                                    <option value="Transgender">Transgender</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 user">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$user->address}}" >
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
