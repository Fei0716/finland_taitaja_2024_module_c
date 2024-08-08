@extends('layout.main')

@section('style')

@endsection
@section('content')
    <section aria-label="Add Game Result Section">
        <div class="w-50 mx-auto p-4 border shadow-sm">
            <h1 class="mb-4 border-bottom border-dark">Add New Result For {{$game->title}}</h1>
            <form action="{{route('scores.store', $game)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="" selected disabled>Select A User</option>
                        @foreach($users as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="score">Score</label>
                    <input type="number" name="score" id="score" class="form-control @error('score') is-invalid @enderror">
                    @error('score')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="d-flex gap-3 mb-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection




