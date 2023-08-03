<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><i class="fa fa-user-plus"></i> Informations de  l'élève</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="card-title"><i class="fa fa-user-plus"></i> Informations du titeur</h3>
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
                                    <label>Teléphone</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.telephone"
                                        class="form-control @error('newEleve.telephone') is-invalid @enderror">
                            
                                    @error("newEleve.telephone")
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
                                    <label>Adresse</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.Adresse"
                                        class="form-control @error('newEleve.Adresse') is-invalid @enderror">
                            
                                    @error("newEleve.Adresse")
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

                            <div class="form-group">
                                <label>Classe *</label>
                                <select
                                    class="form-control @error('classe_id') 
                                                                                                                                                                                is-invalid @enderror"
                                    name="classe_id" wire:model="newEleve.classe_id">
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
                                    <textarea type="texte" wire:model="newEleve.description"
                                        class="form-control @error('newEleve.description') is-invalid @enderror" name="" id="" cols="5" rows="5">

                                    </textarea>    
                                    @error("newEleve.description")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.nomTiteur"
                                        class="form-control @error('newEleve.nomTiteur') is-invalid @enderror">
                            
                                    @error("newEleve.nomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.prenomTiteur"
                                        class="form-control @error('newEleve.prenomTiteur') is-invalid @enderror">
                            
                                    @error("newEleve.prenomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone *</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.telephoneTiteur"
                                        class="form-control @error('newEleve.telephoneTiteur') is-invalid @enderror">
                            
                                    @error("newEleve.telephoneTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="newEleve.emailTiteur"
                                        class="form-control @error('newEleve.emailTiteur') is-invalid @enderror">
                            
                                    @error("newEleve.emailTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Profession</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.professionTiteur"
                                        class="form-control @error('newEleve.professionTiteur') is-invalid @enderror">
                            
                                    @error("newEleve.professionTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Adresse</label>
                                    <input autocomplete="off" type="text" wire:model="newEleve.adresseTiteur"
                                        class="form-control @error('newEleve.adresseTiteur') is-invalid @enderror">
                            
                                    @error("newEleve.adresseTiteur")
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