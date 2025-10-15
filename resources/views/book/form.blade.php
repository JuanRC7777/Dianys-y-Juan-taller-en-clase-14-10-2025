@extends('layouts.app')

@section('template_title')
    {{ $book->id ? 'Edit Book' : 'Create Book' }}
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">{{ $book->id ? 'Edit Book' : 'Create Book' }}</h4>
        </div>
        <div class="card-body">

            <form method="POST" 
                action="{{ $book->id ? route('books.update', $book->id) : route('books.store') }}">
                @csrf
                @if($book->id)
                    @method('PUT')
                @endif

                <div class="row padding-1 p-1">
                    <div class="col-md-12">

                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $book->title) }}" id="title" placeholder="Enter title">
                            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>


                        <div class="form-group mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" name="year" class="form-control @error('year') is-invalid @enderror"
                                value="{{ old('year', $book->year) }}" id="year" placeholder="Enter year">
                            {!! $errors->first('year', '<div class="invalid-feedback">:message</div>') !!}
                        </div>


                        <div class="form-group mb-3">
                            <label for="author_id" class="form-label">Author</label>
                            <select name="author_id" id="author_id" class="form-control @error('author_id') is-invalid @enderror">
                                <option value="">Select an author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" 
                                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('author_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                    </div>


                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ $book->id ? 'Update' : 'Submit' }}
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
