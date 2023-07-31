<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle classe</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addClasse()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Classe *</label>
                            <input autocomplete="off" type="text" wire:model="newClasse.nom"
                                class="form-control @error('newClasse.nom') is-invalid @enderror">

                            @error("newClasse.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Groupe *</label>
                        <select
                            class="form-control @error('groupe_classe_id') 
                                                                                                                                            is-invalid @enderror"
                            name="groupe_classe_id" wire:model="newClasse.groupe_classe_id">
                            <option value="">---------</option>
                            @foreach($groupes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("groupe_classe_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Niveau scolaire *</label>
                        <select
                            class="form-control @error('niveauxscolaires_id') 
                                                                                                                        is-invalid @enderror"
                            name="niveauxscolaires_id" wire:model="newClasse.niveauxscolaires_id">
                            <option value="">---------</option>
                            @foreach($niveauxScolaires as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("niveauxscolaires_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListClasse()" class="btn btn-danger">Retouner à la liste des
                        classes</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>