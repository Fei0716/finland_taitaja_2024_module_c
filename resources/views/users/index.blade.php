@extends('layout.main')

@section('style')

@endsection
@section('content')
{{-- users table--}}
    <section aria-label="Users Section">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">{{Session::get('success')}}</div>
        @endif
      <h1 class="text-center mb-4">Users</h1>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('users.create')}}"><button class="btn btn-primary">Add New User</button></a>
        </div>
        <table class="table table-responsive table-striped table-hover">
           <tr>
               <th>Name</th>
               <th></th>
               <th></th>
           </tr>
{{--            datas--}}
            @foreach($users as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td><a href="{{route('users.edit',$u)}}"><button class="btn btn-primary">Update</button></a></td>
                    <td>
                        <form action="{{route('users.destroy', $u)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-primary">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection




