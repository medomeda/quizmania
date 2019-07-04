@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Liste des catégories</h1>
   
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div><br />
        @endif

        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Créer</a>
       
        
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
                @foreach($categories as $categorie)
                <tr>
                    <td>{{$categorie->id}}</td>
                    <td>{{$categorie->libelle}}</td>
                    <td>{{$categorie->description}}</td>
                    <td>
                        <a href="{{ route('categories.edit',$categorie->id)}}" class="btn btn-sm btn-primary">Edit</a>
                  
                        <form action="{{ route('categories.destroy', $categorie->id)}}" method="post">
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