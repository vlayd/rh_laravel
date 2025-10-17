<div class="form-group {{$classe??'col-12'}}">
    @if (isset($label))
    <label for="{{$campo??''}}" class="form-label">{{$label}}</label>        
    @endif
    <select class="form-control" name="{{$campo??''}}" id="{{$campo??''}}" data-trigger>
        <option value="0">Escolha...</option>
        @foreach ($items as $item)
        <option value="{{$item->id}}" {{isset($idSelect)&&$idSelect==$item->id?'selected':''}}>{{$item->nome}}</option>
        @endforeach
    </select>
</div>