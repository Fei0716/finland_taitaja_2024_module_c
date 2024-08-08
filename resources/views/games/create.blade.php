@extends('layout.main')

@section('style')

@endsection
@section('content')
    <section aria-label="Add User Section">
        <div class="w-50 mx-auto p-4 border shadow-sm">
            <h1 class="mb-4 border-bottom border-dark">Add New Game</h1>
            <form action="{{route('games.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image">Thumbnail Image</label>
                    <input type="file" name="image" id="image" accept=".png,.jpeg,.jpg,.webp" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="number">No of Results to Show on the Hall of Fame</label>
                    <input type="number" min="1" step="1" name="result_no" id="result_no" class="form-control @error('result_no') is-invalid @enderror">
                    @error('result_no')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="d-flex gap-3 mb-2">
                    <button type="submit" class="btn btn-primary">Add Game</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection




