@extends('layout.main')

@section('style')
    <style>
        .card{
            width: 500px!important;
        }
    </style>
@endsection
@section('content')
    <section aria-label="User's Profile Section">
        <div class="card shadow-sm p-4  mx-auto">
            <h1 class="text-center mb-4">{{Auth::user()->name}}</h1>
            @if(Session::has('success'))
                <div class="alert alert-success text-center">{{Session::get('success')}}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
            @endif
            <ul class="list-group">
                <li class="list-group-item">Joined At:  <strong>{{Auth::user()->created_at}}</strong></li>
                <li class="list-group-item"><button class="btn btn-primary" data-bs-target="#modal-password" data-bs-toggle="modal">Update Password</button></li>
            </ul>
        </div>
    </section>

    <div class="modal fade" id="modal-password">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h2 class="modal-title">Update Password</h2>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('users.updatePassword', $user)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary d-block mx-auto mb-2" type="submit">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




