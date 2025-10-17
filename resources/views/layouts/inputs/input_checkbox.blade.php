<div class="form-group {{$classe??'col-12'}}">
    <div class="form-check {{ $classe ?? 'col-12' }}">
        <input class="form-check-input" type="checkbox" name="{{ $campo ?? '' }}{{ $colchete ?? '' }}" value="{{$valor ?? ''}}" id="{{ $idCheck ?? '' }}"  {{$checked??''}}>
        <label class="custom-control-label" for="{{ $idCheck ?? '' }}">{{ $label ?? '' }}</label>
    </div>
</div>
