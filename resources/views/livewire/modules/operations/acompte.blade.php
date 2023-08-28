<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user fa-2x"></i> Paiements des réinscriptions</h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateAcompteOperation()" method="POST">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="nomComplet"
                                        class="form-control @error('nomComplet') is-invalid @enderror">

                                    @error("nomComplet")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Classe :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="classeEleve"
                                        class="form-control @error('classeEleve') is-invalid @enderror">

                                    @error("classeEleve")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Classe </label>
                                    <input disabled autocomplete="off" type="text" wire:model="annee_scolaire"
                                        class="form-control @error('annee_scolaire') is-invalid @enderror">

                                    @error("annee_scolaire")
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
                                <select disabled
                                    class="form-control @error('categorieId') 
                                                                                                                                                                                                                                                is-invalid @enderror"
                                    name="categorieId" wire:model="categorieId">
                                    @foreach ($categories as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("categorieId")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($_tarifications)
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Frais d'inscription</label>
                                <select disabled
                                    class="form-control @error('tarification_id') 
                                                                                                                                                                                                                                                                            is-invalid @enderror"
                                    name="tarification_id" wire:model="tarification_id">
                                    @foreach ($_tarifications as $value)
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
                                <label>Classe</label>
                                <select disabled
                                    class="form-control @error('classe_id') 
                                                                                                                                                                                                                                                                                                        is-invalid @enderror"
                                    name="classe_id" wire:model="classe_id">
                                    @foreach ($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} </option>
                                    @endforeach
                                </select>
                                @error("classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Statut *</label>
                                <select disabled class="form-control @error('statutAdmission') is-invalid @enderror"
                                    wire:model="statutAdmission">
                                    <option value="Nouveau">Nouveau</option>
                                    <option value="Redoublant">Redoublant</option>
                                </select>
                                @error("statutAdmission")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Premier versement </label>
                                    <input disabled autocomplete="off" type="number" 
                                    wire:model="montantVerse"
                                        class="form-control @error('montantVerse') is-invalid @enderror">

                                    @error("montantVerse")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label class="badge bg-danger">
                                            Montant à verser
                                    </label>
                                    <input disabled autocomplete="off" type="number" wire:model="montantRestantACouvri"
                                        class="form-control @error('montantRestantACouvri') is-invalid @enderror">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Reste</label>
                                    <input autocomplete="off" type="number" wire:model="montantVerse2"
                                        class="form-control @error('montantVerse2') is-invalid @enderror">
                        
                                    @error("montantVerse2")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="" class="btn btn-warning">Retouner à la liste des
                        élèves</a>

                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>