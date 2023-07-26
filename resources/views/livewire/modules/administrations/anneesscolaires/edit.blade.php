<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateScolaire()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Année scolaire</label>
                            <input autocomplete="off" type="text" wire:model="editScolaire.nom"
                                class="form-control @error('editScolaire.nom') is-invalid @enderror">
                    
                            @error("editScolaire.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date début</label>
                            <input autocomplete="off" type="text" wire:model="editScolaire.dateDebut"
                                class="form-control @error('editScolaire.dateDebut') is-invalid @enderror">
                    
                            @error("editScolaire.dateDebut")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date fin</label>
                            <input autocomplete="off" type="text" wire:model="editScolaire.dateFin"
                                class="form-control @error('editScolaire.dateFin') is-invalid @enderror">
                    
                            @error("editScolaire.dateFin")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Par defaut *</label>
                        <select class="form-control @error('editScolaire.defaut') is-invalid @enderror" wire:model="editScolaire.defaut">
                            <option value="">---------</option>
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                        @error("editScolaire.defaut")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListScolaire()" class="btn btn-danger">Retouner à la liste des
                        années scolaires</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>