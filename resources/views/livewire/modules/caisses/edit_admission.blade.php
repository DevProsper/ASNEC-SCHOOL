<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user fa-2x"></i> Paiements de l'inscription ou la réinscription</h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateEleve()" method="POST">
                <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-6">

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom complet :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="editCaisse.nom"
                                        class="form-control @error('editCaisse.nom') is-invalid @enderror">
                                    @error("editCaisse.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Sexe :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="editCaisse.nom"
                                        class="form-control @error('editCaisse.nom') is-invalid @enderror">
                            
                                    @error("editCaisse.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom titeur </label>
                                    <input disabled autocomplete="off" type="text" wire:model="editCaisse.nomTiteur"
                                        class="form-control @error('editCaisse.nomTiteur') is-invalid @enderror">
                    
                                    @error("editCaisse.nomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Tel </label>
                                    <input disabled autocomplete="off" type="text" wire:model="editCaisse.prenomTiteur"
                                        class="form-control @error('editCaisse.prenomTiteur') is-invalid @enderror">
                    
                                    @error("editCaisse.prenomTiteur")
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
                        
                        @if ($tarifications)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="classe">Frais </label>
                                <select
                                    class="form-control @error('tarifications') 
                                                                                                                                                                                                                                                is-invalid @enderror"
                                    name="tarifications" wire:model="newCaisse.tarification_id">
                                    @foreach ($tarifications as $value)
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

                        @if ($classes)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="classe">Classe </label>
                                <select class="form-control @error('newCaisse.classe_id')                                                                                                                                              is-invalid @enderror"
                                    name="newCaisse.classe_id" wire:model="newCaisse.classe_id">
                                    @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Statut *</label>
                                <select class="form-control @error('newCaisse.statutAdmission') is-invalid @enderror"
                                    wire:model="newCaisse.statutAdmission">
                                    <option value="">---------</option>
                                    <option value="Nouveau">Nouveau(lle)</option>
                                    <option value="Redoublant">Redoublant(e)</option>
                                </select>
                                @error("newCaisse.statutAdmission")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" wire:click.prevent="goToListCaisse()" class="btn btn-danger">Retouner à la liste des
                        élèves</button>
                
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>