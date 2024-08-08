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
        <h1 class="text-center mb-4">Games</h1>
        @if( Auth::user()->role === 'superuser')
            <div class="d-flex justify-content-end mb-2">
                <a href="{{route('games.create')}}"><button class="btn btn-primary">Add New Game</button></a>
            </div>
        @endif
        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>Title</th>
                <th>Thumbnail</th>
                <th>Created Timestamp</th>
                <th>Number of Results for Shown</th>
                @if( Auth::user()->role === 'superuser')
                <th></th>
                @endif
            </tr>
            {{--            datas--}}
            @foreach($games as $g)
{{--                for admin--}}
                @if( Auth::user()->role === 'superuser')
                    <tr>
                        <td><a href="{{route('games.show', $g)}}">{{$g->title}}</a></td>
                        <td><img
                                src="{{$g->image?asset('storage/'.$g->image) : asset('storage/images/default.thumbnail.jpeg')}}"
                                class="img-game" alt="{{$g->title}}" srcset=""></td>
                        <td>{{date('H:i a d/m/Y' , strtotime($g->created_at))}}</td>
                        <td>{{$g->result_no}}</td>
                        <td><a href="{{route('games.edit',$g)}}">
                                <button class="btn btn-primary">Update</button>
                            </a></td>
                    </tr>
{{--                for user with access right to the game--}}
                @elseif($g->rights->contains('user_id', Auth::user()->id))
                    <tr>
                        <td><a href="{{route('scores.index', $g)}}">{{$g->title}}</a></td>
                        <td><img
                                src="{{$g->image?asset('storage/'.$g->image) : asset('storage/images/default.thumbnail.jpeg')}}"
                                class="img-game" alt="{{$g->title}}" srcset=""></td>
                        <td>{{date('H:i a d/m/Y' , strtotime($g->created_at))}}</td>
                        <td>{{$g->result_no}}</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </section>
@endsection




