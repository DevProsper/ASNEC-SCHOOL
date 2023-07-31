<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle classe</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addSalle()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Salle</label>
                            <input autocomplete="off" type="text" wire:model="newSalle.nom"
                                class="form-control @error('newSalle.nom') is-invalid @enderror">

                            @error("newSalle.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Capacité d'acceuil</label>
                            <input autocomplete="off" type="number" wire:model="newSalle.acceuil"
                                class="form-control @error('newSalle.acceuil') is-invalid @enderror">
                    
                            @error("newSalle.acceuil")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Batiment</label>
                        <select
                            class="form-control @error('batiment_id') 
                                                                                                                        is-invalid @enderror"
                            name="batiment_id" wire:model="newSalle.batiment_id">
                            <option value="">---------</option>
                            @foreach($batiments as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                            @endforeach
                        </select>
                        @error("batiment_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListSalle()" class="btn btn-danger">Retouner à la liste des
                        salles</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>