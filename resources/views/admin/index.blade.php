@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin-Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    <table class="table">
                    <span class="pull-right">
                        <a href="{{route('admin.create')}}"><button type="button" class="btn btn-sm btn-primary">Add New User</button></a>
                    </span>
                        <thead>
                            <tr>
                            <th scope="col">Sl.No</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($users->count() > 0)
                            <input type="hidden" value = "{{$i = ($users->currentpage()-1)* $users->perpage() + 1}}"></input>
                            @foreach($users as $user)
                            <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$user->fname}}</td>
                            <td>{{$user->lname}}</td>
                            <td>
                                @if($user->user_type == 2)
                                    Doctor
                                @else
                                    Patient
                                @endif
                            </td>
                            <td>
                                <form class="delete" action="{{route('admin.destroy',$user->id)}}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm btn-danger dimension
                                    " value="Delete">Delete</button>
                                </form>
                                <a href="{{route('admin.edit',$user->id)}}"><button type="button" class="btn btn-sm btn-secondary">Edit</button></a>
                                @if($user->user_type==2)
                                    <a href="{{route('book.appointment',$user->id)}}"><button type="button" class="btn btn-sm btn-info">Book Appointment</button></a>
                                @endif
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
                    <div class="pull-right">
                        {{$users->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $(".delete").on("submit", function(){
            return confirm("Are you sure?");
        });
    });
</script>
@endpush