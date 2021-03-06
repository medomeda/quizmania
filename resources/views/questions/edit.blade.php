@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card uper">
            <div class="card-header">
            Edit categorie
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
            <form method="post" action="{{ route('questions.update', $question->id) }}">
                @method('PATCH')
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
                            <option value="{{ $categorie->id }}" >{{ $categorie->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="intitule">Libellé:</label>
                    <input type="text" class="form-control" name="intitule" value="{{ $question->intitule}}" />
                </div>
                <div class="form-group">
                    <label for="reponse">reponse :</label>
                    <input type="text" class="form-control" name="reponse" value="{{ $question->reponse}}"/>
                </div>
                <div class="card">
                    <div class="card-header">
                        <input type="button" class="btn btn-sm btn-primary addrow" value="Ajouter une reponse"/>
                    </div>
                    <div class="card-body">
                        @include('partials.reponse-list', ['reponses' => $question->reponses()->get()])    
                    </div>
                </div>     



                <button type="submit" class="btn btn-primary">Update</button>
            </form>
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
                html += '<td><input type="text" name="reponse_id[]" id="reponse_id' + rowCount + '" value="' + rowCount + '" class="form-control" /></td>';
                html += '<td><input type="text" name="libelle[]" id="libelle_' + rowCount + '" value="" class="form-control" /></td>';
                html += '<td><input type="check" name="correcte[]" id="correcte_' + rowCount + '" value="0" class="form-control" /></td>';
                html += '<td><input type="button" name="delrow[]" id="delrow_' + rowCount + '" value="supprimer" class="btn btn-sm btn-danger delrow" /></td>';
                html += '</tr>'

            $('#tblreponseList tbody').append(html);

        });

        $(document).on('click', '.delrow', function(e){
            e.preventDefault();
            $(this).closest('tr').remove();

        });

        $('#frmquestion1').on('submit', function(e){
            e.preventDefault(e);
            
            var frm = $(this);
        
            var reponseItems = [];
             $('#tblreponseList tbody tr').each(function () {
                reponseItems.push({
                    id: $(this).find('input[name*="id"]').val(),
                    question_id: $(this).find('input[name*="question_id"]').val(),
                    libelle: $(this).find('input[name*="libelle"]').val(),
                    correcte: $(this).find('input[name*="estcorrecte"]').val(),
                });

            });

            var dataInfo = {
                intitule: $('#intitule').val(),
                reponse: $('#reponse').val(),
                quiz_id: $('#quiz_id option:selected').val(),
                categorie_id: $('#categorie_id option:selected').val(),
                points: $('#points').val(),
                options : reponseItems
            }

            $.ajax({
                type: frm.attr('method'),
                url:frm.attr('action') ,
                data: dataInfo,
                success: function(data){
                    console.log(data);
                },
                error: function(data){

                }
            });

    });

    </script>   
@endsection