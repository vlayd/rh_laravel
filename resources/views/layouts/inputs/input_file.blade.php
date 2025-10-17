<div class="{{$classe??'col-12'}} mb-2">
    <div class="form-group">
        <label for="{{$campo??''}}">{{$label??''}}</label>
        <input name="{{$campo??''}}" id="{{$campoId??$campo}}" type="file" class="form-control">
        <div class="text-danger text-xs {{$campo??''}}_erro"></div>
    </div>
</div>