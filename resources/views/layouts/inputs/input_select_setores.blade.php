<div class="form-group {{$classe??'col-12'}}">
    @if (isset($label))
    <label for="{{$campo??'setor'}}" class="form-label">Setores</label>
    @endif
    <select class="form-control" name="{{$campo??'setor'}}" id="{{$campo??'setor'}}" data-trigger>
        <option value="0">Escolha...</option>
        @foreach ($setores as $setor)
        <option value="{{$setor->id}}" {{isset($idSelect)&&$idSelect==$setor->id?'selected':''}}>{{$setor->nome . ' - ' .$setor->sigla}}</option>
        @endforeach
    </select>
</div>