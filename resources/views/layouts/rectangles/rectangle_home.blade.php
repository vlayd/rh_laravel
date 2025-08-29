<a href="#collapse{{$idCollapse}}" class="col-lg-3 col-md-6 col-12" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{$idCollapse}}">
    <div class="card border-1 bg-{{$color}} shadow-lg">
        <div class="card-body p-3 position-relative shadow-lg">
            <div class="row">
                <div class="col">
                    <div class="numbers text-center">
                        <p class="fs-1 mb-0 font-weight-bold text-white">
                            <span class="mes_atual retangulo_home">{{$valueAtual}}</span>
                            <span class="mes_anterior d-none retangulo_home">{{$valueAnterior}}</span>
                            <span class="mes_proximo d-none retangulo_home">{{$valueProximo}}</span>
                        </p>
                        <div class="font-weight-bolder mb-0 h5 text-white">
                            {{$title}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
