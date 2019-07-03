@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card uper">
            <div class="card-header">
            Edit quiz
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="post" action="{{ route('quizs.update', $quiz->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                <label for="libelle">Libellé:</label>
                <input type="text" class="form-control" name="libelle" value="{{ $quiz->libelle }}" />
                </div>
                <div class="form-group">
                <label for="description">Description :</label>
                <input type="text" class="form-control" name="description" value="{{ $quiz->description }}" />
                </div>
            
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>    
    
@endsection