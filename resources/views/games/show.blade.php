@extends('layout.main')

@section('style')
    <style>
        .img-game{
            width: 250px;
            max-width: 100%;
            height:auto;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    {{-- games table--}}
    <section aria-label="Game Rights Section">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">{{Session::get('success')}}</div>
        @endif
        <h1 class="text-center mb-4">Users with Write/Edit Access for {{$game->title}}</h1>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('game-rights.create' , $game)}}"><button class="btn btn-primary">Add Write/Edit Access For New User</button></a>
        </div>
        <table class="table table-responsive table-striped table-hover w-50 mx-auto">
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            {{--            datas--}}
            @foreach($game->rights as $r)
                <tr>
                    <td>{{$r->user->name}}</td>
                    <td>
                        <form action="{{route('game-rights.destroy', [$game,$r])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-primary" type="submit">Revoke Access</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection




