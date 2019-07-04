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
                <form id="frmquestion" method="post" action="{{ route('questions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="quiz_id">Quiz:</label>
                        <select name="quiz_id" id="quiz_id" class="form-control">
                            @foreach($quizs as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categorie_id">Catégorie:</label>
                        <select name="categorie_id" id="categorie_id" class="form-control">
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="intitule">Libellé:</label>
                        <input type="text" class="form-control" name="intitule"/>
                    </div>
                    <div class="form-group">
                        <label for="reponse">reponse :</label>
                        <input type="text" class="form-control" name="reponse"/>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Reponses
                            <input type="button" class="btn btn-sm btn-primary addrow" value="Ajouter une reponse"/>
                        </div>
                        <div class="card-body">
                             
                            <table id='tblreponseList' class="table table-condensed">
                                <thead>
                                        <tr>
                                            <th style="width: 10%;">ID</td>
                                            <th style="width: 80%">Intitulé</td>
                                            <th style="width: 10%;">Vrai ?</td>
                                        </tr>
                                </thead>

                                <tbody></tbody>
                            </table>
                        </div>
                    </div>    
   
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>    

@endsection
@section('script')
    <script type="text/javascript">

        $(document).on('click', '.addrow', function(e){
             e.preventDefault();
            var rowCount = $('#tblreponseList tbody tr').length;
            rowCount++;
            var html  = '<tr>';
                html += '<td><input type="text" name="id[]" id="id' + rowCount + '" value="' + rowCount + '" class="form-control" /></td>';
                html += '<td><input type="text" name="qty[]" id="ingQTY' + rowCount + '" value="" class="form-control" /></td>';
                html += '<td><input type="check" name="chkvrai[]" id="chkvrai' + rowCount + '" value="0" class="form-control" /></td>';
                html += '<td><input type="button" name="btndel[]" id="btndel' + rowCount + '" value="supprimer" class="btn btn-sm btn-danger delrow" /></td>';
                html += '</tr>'

            $('#tblreponseList tbody').append(html);

        });

        $(document).on('click', '.delrow', function(e){
            e.preventDefault();
            $(this).closest('tr').remove();

        });

        $('#frmquestion').on('submit', function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(e);

            $.ajax({
                type:"PUT",
                url:"{{ url('/questions/store') }}" ,
                data:{ test:1, b:5 },
                success: function(data){
                    console.log(data);
                },
                error: function(data){

                }
            })
    });


    
  

    </script>   
@endsection


