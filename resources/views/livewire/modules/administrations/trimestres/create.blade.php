<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'un nouveau trimestre</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addTrimestre()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Trimestre</label>
                            <input autocomplete="off" type="text" wire:model="newTrimestre.nom"
                                class="form-control @error('newTrimestre.nom') is-invalid @enderror">

                            @error("newTrimestre.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListTrimestre()" class="btn btn-danger">Retouner à la liste des
                        trimestres</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>