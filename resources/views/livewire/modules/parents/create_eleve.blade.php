<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Créer un élève - {{$nomTiteur}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addEleve()" method="POST">
                <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom *</label>
                                    <input autocomplete="off" type="text" wire:model="nom"
                                        class="form-control @error('nom') is-invalid @enderror">
                    
                                    @error("nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom *</label>
                                    <input autocomplete="off" type="text" wire:model="prenom"
                                        class="form-control @error('prenom') is-invalid @enderror">
                    
                                    @error("prenom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sexe *</label>
                                <select class="form-control @error('sexe') is-invalid @enderror" wire:model="sexe">
                                    <option value="">---------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("sexe")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Teléphone 1</label>
                                    <input autocomplete="off" type="text" wire:model="telephone1"
                                        class="form-control @error('telephone1') is-invalid @enderror">
                    
                                    @error("telephone1")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Date de naissance *</label>
                                    <input autocomplete="off" type="date" wire:model="dateNaissance" class="form-control @error('dateNaissance') 
                                                            is-invalid @enderror" value="{{ date('Y-m-d') }}">
                    
                                    @error("dateNaissance")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Lieu de naissance</label>
                                    <input autocomplete="off" type="text" wire:model="lieuNaissance"
                                        class="form-control @error('lieuNaissance') is-invalid @enderror">
                    
                                    @error("lieuNaissance")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Email</label>
                                    <input autocomplete="off" type="email" wire:model="email"
                                        class="form-control @error('email') is-invalid @enderror">
                    
                                    @error("email")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Année scolaire</label>
                                <select
                                    class="form-control @error('anneesscolaire_id') 
                                                                                                                                                    is-invalid @enderror"
                                    name="anneesscolaire_id" wire:model="anneesscolaire_id">
                                    <option value="">---------</option>
                                    @foreach($anneesscolaires as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("anneesscolaire_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Description</label>
                                    <textarea autocomplete="off" type="texte" wire:model="description"
                                        class="form-control @error('description') is-invalid @enderror" cols="5" rows="5"></textarea>
                    
                                    @error("description")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Classes</label>
                                <select
                                    class="form-control @error('classe_id') 
                                                                                                                                                                                                            is-invalid @enderror"
                                    name="classe_id" wire:model="classe_id">
                                    <option value="">---------</option>
                                    @foreach($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->tarification->prix }}</option>
                                    @endforeach
                                </select>
                                @error("classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Statut admission *</label>
                                <select class="form-control @error('statutAdmission') is-invalid @enderror" wire:model="statutAdmission">
                                    <option value="">---------</option>
                                    <option value="1">Inscription</option>
                                    <option value="2">Réinscription</option>
                                </select>
                                @error("statutAdmission")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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