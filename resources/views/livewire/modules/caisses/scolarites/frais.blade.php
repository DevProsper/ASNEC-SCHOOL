<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user fa-2x"></i> Paiements des frais scolaire
                </h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="addFraisScolaire()" method="POST">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Nom(s) :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="showNomEleve"
                                        class="form-control @error('showNomEleve') is-invalid @enderror">

                                    @error("showNomEleve")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Prenom(s) :</label>
                                    <input disabled autocomplete="off" type="text" wire:model="showPrenomEleve"
                                        class="form-control @error('showPrenomEleve') is-invalid @enderror">

                                    @error("showPrenomEleve")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Classe </label>
                                    <input disabled autocomplete="off" type="text"
                                        wire:model="showClasse"
                                        class="form-control @error('showClasse') is-invalid @enderror">

                                    @error("showClasse")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Statut </label>
                                    @if ($showStatutEleve =="Nouveau")
                                        <p><span class="badge bg-info">Nouveau(lle)</span></p>
                                    @else
                                    <p><span class="badge bg-danger">Redoublant(e)</span></p>
                                    @endif
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
                                    @foreach ($categorieTarifFraisScolaire as $value)
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
                                <label for="classe">Frais </label>
                                <select wire:model="tarification_id"
                                    class="form-control @error('tarification_id')                                                                                                                                                                                    is-invalid @enderror"
                                    name="_tarifications">
                                    <option value="">---------</option>
                                    @foreach ($_tarifications as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Périodes</label>
                                <select
                                    class="form-control @error('periode_id')                                                                                                                                                                                   is-invalid @enderror"
                                    name="periode_id" wire:model="periode_id">
                                    <option value="">---------</option>
                                    @foreach ($periodes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("periode_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label>Montant verse</label>
                                    <input autocomplete="off" type="number" wire:model="fraisVerse"
                                        class="form-control @error('fraisVerse') is-invalid @enderror">
                        
                                    @error("fraisVerse")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" wire:click.prevent="goToListScolarite()" class="btn btn-danger">Retouner à la
                        liste des
                        élèves</button>

                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>