<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateTarification()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Libelle</label>
                            <input autocomplete="off" type="text" wire:model="editTarification.nom"
                                class="form-control @error('editTarification.nom') is-invalid @enderror">
                    
                            @error("editTarification.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Prix</label>
                            <input autocomplete="off" type="number" wire:model="editTarification.prix"
                                class="form-control @error('editTarification.prix') is-invalid @enderror">
                    
                            @error("editTarification.prix")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListTarification()" class="btn btn-danger">Retouner à la liste des
                        tarifications</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>