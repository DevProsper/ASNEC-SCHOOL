<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle tarification</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addTarification()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Libelle</label>
                            <input autocomplete="off" type="text" wire:model="newTarification.nom"
                                class="form-control @error('newTarification.nom') is-invalid @enderror">

                            @error("newTarification.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Prix</label>
                            <input autocomplete="off" type="number" wire:model="newTarification.prix"
                                class="form-control @error('newTarification.prix') is-invalid @enderror">
                    
                            @error("newTarification.prix")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListTarification()" class="btn btn-danger">Retouner à la liste des
                        tarifications</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>