<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Informations du parent</h3>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addParent()">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="newParent.nom"
                                        class="form-control @error('newParent.nom') is-invalid @enderror">
                            
                                    @error("newParent.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="newParent.prenom"
                                        class="form-control @error('newParent.prenom') is-invalid @enderror">
                            
                                    @error("newParent.prenom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Sexe *</label>
                                <select class="form-control @error('newParent.sexe') is-invalid @enderror" wire:model="newParent.sexe">
                                    <option value="">---------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("newParent.sexe")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 1 *</label>
                                    <input autocomplete="off" type="text" wire:model="newParent.telephone1"
                                        class="form-control @error('newParent.telephone1') is-invalid @enderror">
                            
                                    @error("newParent.telephone1")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 2</label>
                                    <input autocomplete="off" type="text" wire:model="newParent.telephone2"
                                        class="form-control @error('newParent.telephone2') is-invalid @enderror">
                            
                                    @error("newParent.telephone2")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Relation *</label>
                                    <input autocomplete="off" type="text" wire:model="newParent.relation"
                                        class="form-control @error('newParent.relation') is-invalid @enderror">
                            
                                    @error("newParent.relation")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="newParent.email"
                                        class="form-control @error('newParent.email') is-invalid @enderror">
                            
                                    @error("newParent.email")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Profession</label>
                                    <input autocomplete="off" type="text" wire:model="newParent.profession"
                                        class="form-control @error('newParent.profession') is-invalid @enderror">
                            
                                    @error("newParent.profession")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Adresse</label>
                                    <input autocomplete="off" type="texte" wire:model="newParent.adresse"
                                        class="form-control @error('newParent.adresse') is-invalid @enderror">
                            
                                    @error("newParent.adresse")
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
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>