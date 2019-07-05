<table id='tblreponseList' class="table table-condensed">
    <thead>
            <tr>
                <th style="width: 10%;">ID</td>
                <th style="width: 80%">Intitulé</td>
                <th style="width: 10%;">Vrai ?</td>
            </tr>
    </thead>
    <tbody>
        @foreach ($reponses as $reponse)
        <tr>
            <td><input type="text" name="reponse_id[]" id="reponse_id_{{ $reponse->id }}" value="{{ $reponse->id }}" class="form-control" /></td>
            <td><input type="text" name="libelle[]" id="libelle_{{ $reponse->id }}" value="{{ $reponse->libelle }}" class="form-control" /></td>
            <td><input type="check" name="correcte[]" id="correcte_{{ $reponse->id }}" value="{{ $reponse->correcte }}"  class="form-control" /></td>
            <td><input type="button" name="delrow[]" id="delrow_{{ $reponse->id }}" value="supprimer" class="btn btn-sm btn-danger delrow" /></td>
        </tr>
        @endforeach
    </tbody>
</table>