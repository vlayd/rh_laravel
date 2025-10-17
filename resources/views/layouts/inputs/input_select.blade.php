<div class="form-group {{$classe??'col-12'}}">
    @if (isset($label))
    <label for="{{$campo??''}}" class="form-label">{{$label}}</label>        
    @endif
    <select class="form-control" name="{{$campo??''}}" id="{{$campo??''}}" data-trigger>
        @if (!isset($firstDefault))
        <option value="0">Escolha...</option>
        @endif
        @foreach ($items as $key => $item)
        <option value="{{$key}}" {{isset($idSelect)&&$idSelect==$key?'selected':''}}>{{$item}}</option>
        @endforeach
    </select>
</div>