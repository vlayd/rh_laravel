<div class="col-6 col-sm-4 col-md-3 mt-3 text-center">
  <div class="img-fluid">
  <label for="uploadImg">
    {{-- PATH_UPLOAD_USUARIO.$idUser.'/'.$servidor->foto --}}
    <img id="idFoto" src="{{asset($foto)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm min-height-200">
    <input class="form-control d-none" name="foto" onchange="changePhoto('idFoto', this)" type="file" id="uploadImg">
  </label>
  </div>
</div>
