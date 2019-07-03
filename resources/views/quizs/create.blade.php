@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card uper">
            <div class="card-header">
                Add Quiz
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
                <form method="post" action="{{ route('quizs.store') }}">
                    <div class="form-group">
                        @csrf
                        <label for="libelle">Libellé:</label>
                        <input type="text" class="form-control" name="libelle"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <input type="text" class="form-control" name="description"/>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>    
    
@endsection