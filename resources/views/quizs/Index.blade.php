@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Liste des quiz</h1>
   
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div><br />
        @endif

        <a href="{{ route('quizs.create') }}" class="btn btn-sm btn-primary">Créer</a>
       
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Libellé</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($quizs as $quiz)
                <tr>
                    <td>{{$quiz->id}}</td>
                    <td>{{$quiz->libelle}}</td>
                    <td>{{$quiz->description}}</td>
                    <td>
                        <a href="{{ route('quizs.edit',$quiz->id)}}" class="btn btn-sm btn-primary">Edit</a>
                  
                        <form action="{{ route('quizs.destroy', $quiz->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
 </div> 

@endsection