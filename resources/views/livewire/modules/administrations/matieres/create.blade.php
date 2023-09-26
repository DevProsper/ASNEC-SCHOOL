<div class="row p-4 pt-5">
    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle matière</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addMatiere()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Matière <small>Niveau scolaire</small></label>
                            <input autocomplete="off" type="text" wire:model="newMatiere.nom"
                                class="form-control @error('newMatiere.nom') is-invalid @enderror">

                            @error("newMatiere.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom court</label>
                            <input autocomplete="off" type="text" wire:model="newMatiere.nomCourt"
                                class="form-control @error('newMatiere.nomCourt') is-invalid @enderror">
                    
                            @error("newMatiere.nomCourt")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Coefficient</label>
                            <input autocomplete="off" type="text" wire:model="newMatiere.coefficient"
                                class="form-control @error('newMatiere.coefficient') is-invalid @enderror">
                    
                            @error("newMatiere.coefficient")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListMatiere()" class="btn btn-danger">Retouner à la liste des
                        matières</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>