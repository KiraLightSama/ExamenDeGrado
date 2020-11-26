<!-- Modal -->
<div class="modal fade" id="exampleModalCenter-{{$menu->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Informacion nutricional - {{$menu->nombre}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 text-center"><img src="{{ asset('foods/'.$menu->imagen) }}" alt="" width="150"></div>
                    <div class="col-6">
                        <div class="py-2">
                            <p class="text-primary font-weight-bold">Carbohidratos - ({{ $menu->carbohidratos }} Kcal.)</p>
                        </div>
                        <div class="py-2">
                            <p class="text-success font-weight-bold">Proteinas - ({{ $menu->proteinas }} Kcal.)</p>
                        </div>
                        <div class="py-2">
                            <p class="text-danger font-weight-bold">Grasas - ({{ $menu->grasas }} Kcal.)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-12">
                        <p class="text-dark font-italic text-justify">{{$menu->informacion}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>