<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user fa-2x"></i> 
                    "Inscriptions et Réinscriptions : Procédez au Paiement"
                </h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="addAdmission()" method="POST">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom complet :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="newAdmission.nom"
                                        class="form-control @error('newAdmission.nom') is-invalid @enderror">

                                    @error("newAdmission.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Sexe :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="newAdmission.nom"
                                        class="form-control @error('newAdmission.nom') is-invalid @enderror">

                                    @error("newAdmission.nom")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom titeur </label>
                                    <input disabled autocomplete="off" type="text" wire:model="newAdmission.nomTiteur"
                                        class="form-control @error('newAdmission.nomTiteur') is-invalid @enderror">

                                    @error("newAdmission.nomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Tel </label>
                                    <input disabled autocomplete="off" type="text" wire:model="newAdmission.prenomTiteur"
                                        class="form-control @error('newAdmission.prenomTiteur') is-invalid @enderror">

                                    @error("newAdmission.prenomTiteur")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-2">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="classe">Frais </label>
                                <select
                                    class="form-control @error('tarification_id') 
                                                                                                                                                                                                                                                is-invalid @enderror"
                                    name="tarification_id" wire:model="newAdmission.tarification_id">
                                    <option value="">---------</option>
                                    @foreach ($tarifications as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                                    @endforeach
                                </select>
                                @error("tarification_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                <select
                                    class="form-control @error('newAdmission.classe_id')                                                                                                                                              is-invalid @enderror"
                                    name="newAdmission.classe_id" wire:model="newAdmission.classe_id">
                                    <option value="">---------</option>
                                    @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                                    @endforeach
                                </select>
                                @error("classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Statut *</label>
                                <select class="form-control @error('newAdmission.statutAdmission') is-invalid @enderror"
                                    wire:model="newAdmission.statutAdmission">
                                    <option value="">---------</option>
                                    <option value="Nouveau">Nouveau</option>
                                    <option value="Redoublant">Redoublant</option>
                                </select>
                                @error("newAdmission.statutAdmission")
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
                    <button type="button" wire:click.prevent="goToListCaisse()" class="btn btn-danger">Retouner à la
                        liste des
                        élèves</button>

                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>