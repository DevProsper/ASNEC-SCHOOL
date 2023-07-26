<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle classe</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addEnseignant()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom *</label>
                            <input autocomplete="off" type="text" wire:model="newEnseignant.nom"
                                class="form-control @error('newEnseignant.nom') is-invalid @enderror">

                            @error("newEnseignant.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Prenom *</label>
                            <input autocomplete="off" type="text" wire:model="newEnseignant.prenom"
                                class="form-control @error('newEnseignant.prenom') is-invalid @enderror">
                    
                            @error("newEnseignant.prenom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Teléphone 1 *</label>
                            <input autocomplete="off" type="text" wire:model="newEnseignant.telephone1"
                                class="form-control @error('newEnseignant.telephone1') is-invalid @enderror">
                    
                            @error("newEnseignant.telephone1")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Teléphone 2</label>
                            <input autocomplete="off" type="text" wire:model="newEnseignant.telephone2"
                                class="form-control @error('newEnseignant.telephone2') is-invalid @enderror">
                    
                            @error("newEnseignant.telephone2")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Email</label>
                            <input autocomplete="off" type="text" wire:model="newEnseignant.email"
                                class="form-control @error('newEnseignant.email') is-invalid @enderror">
                    
                            @error("newEnseignant.email")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date contrat</label>
                            <input autocomplete="off" type="date" wire:model="newEnseignant.dateContrat"
                                class="form-control @error('newEnseignant.dateContrat') is-invalid @enderror">
                    
                            @error("newEnseignant.dateContrat")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sexe *</label>
                        <select class="form-control @error('newEnseignant.sexe') is-invalid @enderror" wire:model="newEnseignant.sexe">
                            <option value="">---------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error("newEnseignant.sexe")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Type de contrat</label>
                        <select class="form-control @error('newEnseignant.typeContrat') is-invalid @enderror" wire:model="newEnseignant.typeContrat">
                            <option value="">---------</option>
                            <option value="STAGE">En Stage</option>
                            <option value="CDD">CDD</option>
                            <option value="CDI">CDI</option>
                        </select>
                        @error("newEnseignant.typeContrat")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Durée</label>
                            <input autocomplete="off" type="text" wire:model="newEnseignant.duree"
                                class="form-control @error('newEnseignant.duree') is-invalid @enderror">
                    
                            @error("newEnseignant.duree")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Diplômes *</label>
                        <select
                            class="form-control @error('diplome_id') 
                                                                                                                        is-invalid @enderror"
                            name="diplome_id" wire:model="newEnseignant.diplome_id">
                            <option value="">---------</option>
                            @foreach($diplomes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                            @endforeach
                        </select>
                        @error("diplome_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListEnseignant()" class="btn btn-danger">Retouner à la liste des
                        enseignants</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>