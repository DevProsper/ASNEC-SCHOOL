<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition d'un trimestre</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateTrimestre()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input autocomplete="off" type="text" wire:model="editTrimestre.nom"
                                class="form-control @error('editTrimestre.nom') is-invalid @enderror">
                    
                            @error("editTrimestre.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListTrimestre()" class="btn btn-danger">Retouner à la liste des
                        trimestres</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>