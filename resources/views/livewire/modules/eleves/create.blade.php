<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Informations de  l'élève</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Informations du titeur</h3>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addEleve()">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.nom"
                                        class="form-control @error('newEleve.nom') is-invalid @enderror">
                            
                                    @error("newEleve.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.prenom"
                                        class="form-control @error('newEleve.prenom') is-invalid @enderror">
                            
                                    @error("newEleve.prenom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sexe *</label>
                                <select class="form-control @error('newEleve.sexe') is-invalid @enderror" wire:model="newEleve.sexe">
                                    <option value="">---------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("newEleve.sexe")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 1</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.telephone1"
                                        class="form-control @error('newEleve.telephone1') is-invalid @enderror">
                            
                                    @error("newEleve.telephone1")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Date de naissance *</label>
                                    <input autocomplete="off" type="date" wire:model="newEleve.dateNaissance"
                                        class="form-control @error('newEleve.dateNaissance') 
                                        is-invalid @enderror" value="{{ date('Y-m-d') }}">
                            
                                    @error("newEleve.dateNaissance")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Lieu de naissance</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.lieuNaissance"
                                        class="form-control @error('newEleve.lieuNaissance') is-invalid @enderror">
                            
                                    @error("newEleve.lieuNaissance")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="newEleve.email"
                                        class="form-control @error('newEleve.email') is-invalid @enderror">
                            
                                    @error("newEleve.email")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Description</label>
                                    <input autocomplete="off" type="texte" wire:model="newEleve.description"
                                        class="form-control @error('newEleve.description') is-invalid @enderror">
                            
                                    @error("newEleve.description")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListEleve()" class="btn btn-danger">Retouner à la liste des
                        élèves</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>