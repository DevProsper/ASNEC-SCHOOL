<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateEnseignant()" method="POST">
                <div class="card-body">
                
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom *</label>
                            <input autocomplete="off" type="text" wire:model="editEnseignant.nom"
                                class="form-control @error('editEnseignant.nom') is-invalid @enderror">
                    
                            @error("editEnseignant.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Prenom *</label>
                            <input autocomplete="off" type="text" wire:model="editEnseignant.prenom"
                                class="form-control @error('editEnseignant.prenom') is-invalid @enderror">
                    
                            @error("editEnseignant.prenom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Teléphone 1 *</label>
                            <input autocomplete="off" type="text" wire:model="editEnseignant.telephone1"
                                class="form-control @error('editEnseignant.telephone1') is-invalid @enderror">
                    
                            @error("editEnseignant.telephone1")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Teléphone 2</label>
                            <input autocomplete="off" type="text" wire:model="editEnseignant.telephone2"
                                class="form-control @error('editEnseignant.telephone2') is-invalid @enderror">
                    
                            @error("editEnseignant.telephone2")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Email</label>
                            <input autocomplete="off" type="text" wire:model="editEnseignant.email"
                                class="form-control @error('editEnseignant.email') is-invalid @enderror">
                    
                            @error("editEnseignant.email")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date contrat</label>
                            <input autocomplete="off" type="texte" wire:model="editEnseignant.dateContrat"
                                class="form-control @error('editEnseignant.dateContrat') is-invalid @enderror">
                    
                            @error("editEnseignant.dateContrat")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Sexe *</label>
                        <select class="form-control @error('editEnseignant.sexe') 
                        is-invalid @enderror" wire:model="editEnseignant.sexe">
                            <option value="">---------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error("editEnseignant.sexe")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Type de contrat</label>
                        <select class="form-control @error('editEnseignant.typeContrat') is-invalid @enderror"
                            wire:model="editEnseignant.typeContrat">
                            <option value="">---------</option>
                            <option value="STAGE">En Stage</option>
                            <option value="CDD">CDD</option>
                            <option value="CDI">CDI</option>
                        </select>
                        @error("editEnseignant.typeContrat")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Durée</label>
                            <input autocomplete="off" type="text" wire:model="editEnseignant.duree"
                                class="form-control @error('editEnseignant.duree') is-invalid @enderror">
                    
                            @error("editEnseignant.duree")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Diplômes *</label>
                        <select
                            class="form-control @error('editEnseignant.diplome_id') 
                        is-invalid @enderror"
                                                                                                                                            is-invalid @enderror"
                            name="diplome_id" wire:model="editEnseignant.diplome_id">
                            <option value="">---------</option>
                            @foreach($diplomes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                            @endforeach
                        </select>
                        @error("diplome_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListEnseignant()" class="btn btn-danger">Retouner à la liste des
                        enseignants</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>