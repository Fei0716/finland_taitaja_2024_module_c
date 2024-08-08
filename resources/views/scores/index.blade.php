@extends('layout.main')

@section('style')
    <style>
        .img-game {
            width: 250px;
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    {{-- games table--}}
    <section aria-label="Games Section">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">{{Session::get('success')}}</div>
        @endif
        <h1 class="text-center mb-4">Game Result({{$game->title}})</h1>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('scores.create', $game)}}"><button class="btn btn-primary">Add New Result</button></a>
        </div>
        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>Participant</th>
                <th>Result</th>
                <th>Created Timestamp</th>
                <th></th>
                <th></th>
            </tr>
            {{--            datas--}}
            @foreach($game->scores as $s)
                    <tr>
                        <td>{{$s->user->name}}</td>
                        <td>{{$s->score}}</td>
                        <td>{{date('H:i a d/m/Y' , strtotime($s->created_at))}}</td>
                        <td><a href="{{route('scores.edit',[$game, $s])}}">
                                <button class="btn btn-primary">Update</button>
                            </a></td>
                        <td>
                            <form action="{{route('scores.destroy', [$game, $s])}}" method="post">
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




