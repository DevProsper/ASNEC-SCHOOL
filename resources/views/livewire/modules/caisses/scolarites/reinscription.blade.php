<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user fa-2x"></i> Paiements des réinscriptions</h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateEleve()" method="POST">
                <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="newReinscription.nom"
                                        class="form-control @error('newReinscription.nom') is-invalid @enderror">
                    
                                    @error("newReinscription.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="newReinscription.prenom"
                                        class="form-control @error('newReinscription.prenom') is-invalid @enderror">
                            
                                    @error("newReinscription.prenom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Ancienne classe </label>
                                    <input disabled autocomplete="off" type="text" wire:model="newReinscription.nomTiteur"
                                        class="form-control @error('newReinscription.nomTiteur') is-invalid @enderror">
                    
                                    @error("newReinscription.nomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Sexe </label>
                                    <input disabled autocomplete="off" type="text" wire:model="newReinscription.prenomTiteur"
                                        class="form-control @error('newReinscription.prenomTiteur') is-invalid @enderror">
                    
                                    @error("newReinscription.prenomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categorie tarification</label>
                                <select
                                    class="form-control @error('categorieId') 
                                                                                                                                                                                                                                                is-invalid @enderror"
                                    name="categorieId" wire:model="categorieId">
                                    <option value="">---------</option>
                                    @foreach ($categoriestarifications as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("categorieId")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        @if ($_tarifications)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="classe">Frais </label>
                                <select
                                    class="form-control @error('_tarifications') 
                                                                                                                                                                                                                                                is-invalid @enderror"
                                    name="_tarifications" wire:model="newReinscription.tarification_id">
                                    @foreach ($_tarifications as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Niveau scolaire</label>
                                <select
                                    class="form-control @error('niveauId') 
                                                                                                                                                                                                is-invalid @enderror"
                                    name="niveauId" wire:model="niveauId">
                                    <option value="">---------</option>
                                    @foreach ($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                                    @endforeach
                                </select>
                                @error("niveauId")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($_classes)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="classe">Classe </label>
                                <select class="form-control @error('newReinscription.classe_id')                                                                                                                                              is-invalid @enderror"
                                    name="newReinscription.classe_id" wire:model="newReinscription.classe_id">
                                    @foreach ($_classes as $classe)
                                    <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Statut *</label>
                                <select class="form-control @error('newReinscription.statutAdmission') is-invalid @enderror"
                                    wire:model="newReinscription.statutAdmission">
                                    <option value="">---------</option>
                                    <option value="Nouveau">Nouveau</option>
                                    <option value="Redoublant">Redoublant</option>
                                </select>
                                @error("newReinscription.statutAdmission")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Montant verse</label>
                                    <input autocomplete="off" type="number" wire:model="montantVerse"
                                        class="form-control @error('montantVerse') is-invalid @enderror">
                        
                                    @error("montantVerse")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" wire:click.prevent="goToListScolarite()" class="btn btn-warning">Retouner à la liste des
                        élèves</button>
                
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>