@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Liste des quiz</h1>
   
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div><br />
        @endif

        <a href="{{ route('questions.create') }}" class="btn btn-sm btn-primary">Créer</a>
       
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Libellé</td>
                    <td>Quiz</td>
                    <td>Catégorie</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                    <td>{{$question->id}}</td>
                    <td>{{$question->intitule}}</td>
                    <td>{{$question->quiz_id}}</td>
                    <td>{{$question->categorie_id}}</td>
                    <td>
                        <a href="{{ route('questions.edit', $question->id)}}" class="btn btn-sm btn-primary">Edit</a>
                  
                        <form action="{{ route('questions.destroy', $question->id)}}" method="post">
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