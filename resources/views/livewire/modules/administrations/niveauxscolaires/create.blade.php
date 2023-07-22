<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'un niveau scolaire</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addNvScolaire()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Niveau scolaire</label>
                            <input autocomplete="off" type="text" wire:model="newNvScolaire.nom"
                                class="form-control @error('newNvScolaire.nom') is-invalid @enderror">

                            @error("newNvScolaire.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Odre</label>
                            <input autocomplete="off" type="number" wire:model="newNvScolaire.ordre"
                                class="form-control @error('newNvScolaire.ordre') is-invalid @enderror">
                    
                            @error("newNvScolaire.ordre")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListNvScolaire()" class="btn btn-danger">Retouner à la liste des
                        niveaux scolaires</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>