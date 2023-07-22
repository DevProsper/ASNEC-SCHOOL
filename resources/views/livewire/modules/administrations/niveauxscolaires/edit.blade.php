<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateNvScolaire()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Niveau scolaire</label>
                            <input autocomplete="off" type="text" wire:model="editNvScolaire.nom"
                                class="form-control @error('editNvScolaire.nom') is-invalid @enderror">
                    
                            @error("editNvScolaire.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Odre</label>
                            <input autocomplete="off" type="number" wire:model="editNvScolaire.ordre"
                                class="form-control @error('editNvScolaire.ordre') is-invalid @enderror">
                    
                            @error("editNvScolaire.ordre")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListNvScolaire()" class="btn btn-danger">Retouner à la liste des
                        niveaux scolaires</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>