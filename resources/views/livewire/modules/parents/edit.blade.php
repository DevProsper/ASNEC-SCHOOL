<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Mise à jour des informations du parent</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateParent()" method="POST">
                <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="editParent.nom"
                                        class="form-control @error('editParent.nom') is-invalid @enderror">
                
                                    @error("editParent.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="editParent.prenom"
                                        class="form-control @error('editParent.prenom') is-invalid @enderror">
                
                                    @error("editParent.prenom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label>Sexe *</label>
                                <select class="form-control @error('editParent.sexe') is-invalid @enderror"
                                    wire:model="editParent.sexe">
                                    <option value="">---------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("editParent.sexe")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 1 *</label>
                                    <input autocomplete="off" type="text" wire:model="editParent.telephone1"
                                        class="form-control @error('editParent.telephone1') is-invalid @enderror">
                
                                    @error("editParent.telephone1")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 2</label>
                                    <input autocomplete="off" type="text" wire:model="editParent.telephone2"
                                        class="form-control @error('editParent.telephone2') is-invalid @enderror">
                
                                    @error("editParent.telephone2")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Relation *</label>
                                    <input autocomplete="off" type="text" wire:model="editParent.relation"
                                        class="form-control @error('editParent.relation') is-invalid @enderror">
                
                                    @error("editParent.relation")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="editParent.email"
                                        class="form-control @error('editParent.email') is-invalid @enderror">
                
                                    @error("editParent.email")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Profession</label>
                                    <input autocomplete="off" type="text" wire:model="editParent.profession"
                                        class="form-control @error('editParent.profession') is-invalid @enderror">
                
                                    @error("editParent.profession")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Adresse</label>
                                    <input autocomplete="off" type="texte" wire:model="editParent.adresse"
                                        class="form-control @error('editParent.adresse') is-invalid @enderror">
                
                                    @error("editParent.adresse")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" wire:click.prevent="goToListParent()" class="btn btn-danger">Retouner à la liste des
                        parents</button>
                
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>