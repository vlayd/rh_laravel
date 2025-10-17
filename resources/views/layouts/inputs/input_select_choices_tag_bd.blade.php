<div class="form-group {{$classe??'col-12'}}">
    <label for="{{$campo??''}}" class="form-label">{{$label??'Anexos'}}</label>
    <select class="form-control" name="{{$campo??'anexos'}}[]" id="choices-tags-{{$numIdChoice??'1'}}" multiple>
        @foreach ($items as $item)
        @php
            $selected = '';
            if(!empty($idSelect) && in_array($item->id, json_decode($idSelect))) $selected = 'selected';
        @endphp
        <option value="{{$item->id}}" {{$selected}}>{{$item->nome}}</option>
        @endforeach
    </select>
</div>