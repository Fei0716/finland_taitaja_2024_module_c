@extends('layout.main')

@section('style')

@endsection
@section('content')
    <section aria-label="Add User Section">
         <div class="w-50 mx-auto p-4 border shadow-sm">
             <h1 class="mb-4 border-bottom border-dark">Add New User</h1>
             <form action="{{route('users.store')}}" method="post">
                 @csrf
                 <div class="mb-3">
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
                 <div class="d-flex gap-3 mb-2">
                     <button type="submit" class="btn btn-primary">Add User</button>
                     <button type="reset" class="btn">Reset</button>
                 </div>
             </form>
         </div>
    </section>
@endsection




