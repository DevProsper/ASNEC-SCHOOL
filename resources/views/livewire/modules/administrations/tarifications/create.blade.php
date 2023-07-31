<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle tarification</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addTarification()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Libelle *</label>
                            <input autocomplete="off" type="texte" wire:model="newTarification.nom"
                                class="form-control @error('newTarification.nom') is-invalid @enderror">
                    
                            @error("newTarification.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Prix *</label>
                            <input autocomplete="off" type="number" wire:model="newTarification.prix"
                                class="form-control @error('newTarification.prix') is-invalid @enderror">
                    
                            @error("newTarification.prix")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catégorie *</label>
                        <select
                            class="form-control @error('categoriestarification_id') 
                                                                                                                                            is-invalid @enderror"
                            name="categoriestarification_id" wire:model="newTarification.categoriestarification_id">
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
                            name="anneesscolaire_id" wire:model="newTarification.anneesscolaire_id">
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
                            name="classe_id" wire:model="newTarification.classe_id">
                            <option value="">---------</option>
                            @foreach($classes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("classe_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListTarification()" class="btn btn-danger">Retouner à la liste des
                        tarifications</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>