<div class="form-group {{$classe??'col-12'}}">
    @if (isset($label))
    <label for="{{$campo??''}}" class="form-label">{{$label}}</label>        
    @endif
    <input class="form-control {{$classe2??''}}" type="{{$type??'text'}}" name="{{$campo??''}}" id="{{$campoId??$campo}}" value="{{$valor??''}}" placeholder="{{$placeholder??''}}">
</div>