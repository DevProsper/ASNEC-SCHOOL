<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateSalle()" method="POST">
                <div class="card-body">
                
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Salle</label>
                            <input autocomplete="off" type="text" wire:model="editSalle.nom"
                                class="form-control @error('editSalle.nom') is-invalid @enderror">
                
                            @error("editSalle.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Batiment</label>
                        <select
                            class="form-control @error('batiment_id') 
                                                                                                                                        is-invalid @enderror"
                            name="batiment_id" wire:model="editSalle.batiment_id">
                            <option value="">---------</option>
                            @foreach($batiments as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }} - {{ $value->prix }}</option>
                            @endforeach
                        </select>
                        @error("batiment_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListSalle()" class="btn btn-danger">Retouner à la liste des
                        salles</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>