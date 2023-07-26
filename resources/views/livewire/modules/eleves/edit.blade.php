<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Mise à jour des informations</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateEleve()" method="POST">
                <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.nom"
                                        class="form-control @error('editEleve.nom') is-invalid @enderror">
                
                                    @error("editEleve.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.prenom"
                                        class="form-control @error('editEleve.prenom') is-invalid @enderror">
                
                                    @error("editEleve.prenom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sexe *</label>
                                <select class="form-control @error('editEleve.sexe') is-invalid @enderror" wire:model="editEleve.sexe">
                                    <option value="">---------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("editEleve.sexe")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 1</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.telephone1"
                                        class="form-control @error('editEleve.telephone1') is-invalid @enderror">
                
                                    @error("editEleve.telephone1")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Date de naissance *</label>
                                    <input autocomplete="off" type="texte" 
                                    wire:model="editEleve.dateNaissance"
                                        class="form-control @error('editEleve.dateNaissance') is-invalid @enderror">
                
                                    @error("editEleve.dateNaissance")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Lieu de naissance</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.lieuNaissance"
                                        class="form-control @error('editEleve.lieuNaissance') is-invalid @enderror">
                
                                    @error("editEleve.lieuNaissance")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="editEleve.email"
                                        class="form-control @error('editEleve.email') is-invalid @enderror">
                
                                    @error("editEleve.email")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Classes</label>
                                <select
                                    class="form-control @error('editEleve.classe_id') 
                                                                                                                                                                                is-invalid @enderror"
                                    name="editEleve.classe_id" wire:model="editEleve.classe_id">
                                    <option value="">---------</option>
                                    @foreach($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->tarification->prix }}</option>
                                    @endforeach
                                </select>
                                @error("editEleve.classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <select
                                    class="form-control @error('editEleve.anneesscolaire_id') 
                                                                                                                                                                                is-invalid @enderror"
                                    name="editEleve.anneesscolaire_id" wire:model="editEleve.anneesscolaire_id">
                                    <option value="">---------</option>
                                    @foreach($anneesscolaires as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("editEleve.anneesscolaire_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Description</label>
                                    <input autocomplete="off" type="texte" wire:model="editEleve.description"
                                        class="form-control @error('editEleve.description') is-invalid @enderror">
                
                                    @error("editEleve.description")
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
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>