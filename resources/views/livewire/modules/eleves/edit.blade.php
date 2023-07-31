<div class="row p-4 pt-5">
    <div class="col-md-12">
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
                        <div class="col-md-6">
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
                                    <label>Teléphone</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.telephone"
                                        class="form-control @error('editEleve.telephone') is-invalid @enderror">
                    
                                    @error("editEleve.telephone")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Date de naissance *</label>
                                    <input autocomplete="off" type="texte" wire:model="editEleve.dateNaissance" class="form-control @error('editEleve.dateNaissance') 
                                                            is-invalid @enderror" value="{{ date('Y-m-d') }}">
                    
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
                                    <label>Adresse</label>
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
                                <label>Classe *</label>
                                <select
                                    class="form-control @error('classe_id') 
                                                                                                                                                                                is-invalid @enderror"
                                    name="classe_id" wire:model="editEleve.classe_id">
                                    <option value="">---------</option>
                                    @foreach($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Description</label>
                                    <textarea type="texte" wire:model="editEleve.description"
                                        class="form-control @error('editEleve.description') is-invalid @enderror" name="" id="" cols="5"
                                        rows="5">
                    
                                                        </textarea>
                                    @error("editEleve.description")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.nomTiteur"
                                        class="form-control @error('editEleve.nomTiteur') is-invalid @enderror">
                    
                                    @error("editEleve.nomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.prenomTiteur"
                                        class="form-control @error('editEleve.prenomTiteur') is-invalid @enderror">
                    
                                    @error("editEleve.prenomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone *</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.telephoneTiteur"
                                        class="form-control @error('editEleve.telephoneTiteur') is-invalid @enderror">
                    
                                    @error("editEleve.telephoneTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="editEleve.emailTiteur"
                                        class="form-control @error('editEleve.emailTiteur') is-invalid @enderror">
                    
                                    @error("editEleve.emailTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Profession</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.professionTiteur"
                                        class="form-control @error('editEleve.professionTiteur') is-invalid @enderror">
                    
                                    @error("editEleve.professionTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Adresse</label>
                                    <input autocomplete="off" type="text" wire:model="editEleve.adresseTiteur"
                                        class="form-control @error('editEleve.adresseTiteur') is-invalid @enderror">
                    
                                    @error("editEleve.adresseTiteur")
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