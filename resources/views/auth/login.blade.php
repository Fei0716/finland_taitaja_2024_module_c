@extends('layout.main')

@section('style')
    <style>
        .card{
            width: 350px!important;
        }
    </style>
@endsection
@section('content')
     <section aria-label="Login Form Section" class="d-flex align-items-center">
         <div class="card shadow-sm p-4  mx-auto">
                <h1 class="text-center mb-4 h2">Retro Game House <br>Intranet</h1>
                 <form action="{{route('login')}}" method="post" class="mb-2">
                     @csrf
                     <div class="mb-2">
                         <label for="name">Name</label>
                         <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                         @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                         @enderror
                     </div>
                     <div class="mb-4">
                         <label for="password">Password</label>
                         <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                         @error('password')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                     </div>
                     <div class="mb-2 d-flex justify-content-center gap-3">
                         <button type="submit" class="btn btn-primary">Login</button>
                         <button type="reset" class="btn">Reset</button>
                     </div>
                 </form>
         </div>
     </section>
@endsection


