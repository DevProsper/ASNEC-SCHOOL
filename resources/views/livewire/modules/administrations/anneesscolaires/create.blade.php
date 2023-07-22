<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle année</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addScolaire()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Année scolaire</label>
                            <input autocomplete="off" type="text" wire:model="newScolaire.nom"
                                class="form-control @error('newScolaire.nom') is-invalid @enderror">

                            @error("newScolaire.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date début</label>
                            <input autocomplete="off" type="date" wire:model="newScolaire.dateDebut"
                                class="form-control @error('newScolaire.dateDebut') is-invalid @enderror">
                    
                            @error("newScolaire.dateDebut")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date fin</label>
                            <input autocomplete="off" type="date" wire:model="newScolaire.dateFin"
                                class="form-control @error('newScolaire.dateFin') is-invalid @enderror">
                    
                            @error("newScolaire.dateFin")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListScolaire()" class="btn btn-danger">Retouner à la liste des
                        années scolaires</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>