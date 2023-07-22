<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateClasse()" method="POST">
                <div class="card-body">
                
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Classe</label>
                            <input autocomplete="off" type="text" wire:model="editClasse.nom"
                                class="form-control @error('editClasse.nom') is-invalid @enderror">
                
                            @error("editClasse.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Capacité d'acceuil</label>
                            <input autocomplete="off" type="number" wire:model="editClasse.acceuil"
                                class="form-control @error('editClasse.acceuil') is-invalid @enderror">
                
                            @error("editClasse.acceuil")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Scolarité</label>
                        <select
                            class="form-control @error('tarification_id') 
                                                                                                                                        is-invalid @enderror"
                            name="tarification_id" wire:model="editClasse.tarification_id">
                            <option value="">---------</option>
                            @foreach($tarifications as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                            @endforeach
                        </select>
                        @error("tarification_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label>Niveau scolaire</label>
                        <select
                            class="form-control @error('niveauxscolaire_id') 
                                                                                                                                        is-invalid @enderror"
                            name="niveauxscolaire_id" wire:model="editClasse.niveauxscolaire_id">
                            <option value="">---------</option>
                            @foreach($niveauxScolaires as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("niveauxscolaire_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListClasse()" class="btn btn-danger">Retouner à la liste des
                        classes</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>