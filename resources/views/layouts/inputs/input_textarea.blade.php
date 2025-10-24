<div class="form-group {{$classe??'col-12'}}">
    @if (isset($label))
    <label for="{{$campo??''}}" class="form-label">{{$label}}</label>        
    @endif
    <textarea class="form-control {{$classe2??''}}"  name="{{$campo??''}}" id="{{$campoId??$campo}}" rows="{{$rows??'3'}}"></textarea>
</div>