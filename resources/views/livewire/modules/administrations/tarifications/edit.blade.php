<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateTarification()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Libelle *</label>
                            <input autocomplete="off" type="texte" wire:model="editTarification.nom"
                                class="form-control @error('editTarification.nom') is-invalid @enderror">
                    
                            @error("editTarification.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Prix</label>
                            <input autocomplete="off" type="number" wire:model="editTarification.prix"
                                class="form-control @error('editTarification.prix') is-invalid @enderror">
                    
                            @error("editTarification.prix")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catégorie *</label>
                        <select
                            class="form-control @error('categoriestarification_id') 
                                                                                                                                                                is-invalid @enderror"
                            name="categoriestarification_id" wire:model="editTarification.categoriestarification_id">
                            <option value="">---------</option>
                            @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("categoriestarification_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Année scolaire *</label>
                        <select
                            class="form-control @error('anneesscolaire_id') 
                                                                                                                                                                is-invalid @enderror"
                            name="anneesscolaire_id" wire:model="editTarification.anneesscolaire_id">
                            <option value="">---------</option>
                            @foreach($anneesscolaires as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("anneesscolaire_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Classe</label>
                        <select
                            class="form-control @error('classe_id') 
                                                                                                                                                                is-invalid @enderror"
                            name="classe_id" wire:model="editTarification.classe_id">
                            <option value="">---------</option>
                            @foreach($classes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("classe_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Statut *</label>
                        <select class="form-control @error('statut') is-invalid @enderror" wire:model="editTarification.statut">
                            <option value="">---------</option>
                            <option value="1">Visible</option>
                            <option value="0">Invisible</option>
                        </select>
                        @error("statut")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListTarification()" class="btn btn-danger">Retouner à la liste des
                        tarifications</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>