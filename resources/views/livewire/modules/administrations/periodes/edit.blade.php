<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition d'une classe</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updatePeriode()" method="POST">
                <div class="card-body">
                
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Période *</label>
                            <input autocomplete="off" type="text" wire:model="editPeriode.nom"
                                class="form-control @error('editPeriode.nom') is-invalid @enderror">
                
                            @error("editPeriode.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Categorie *</label>
                        <select
                            class="form-control @error('categorieperiode_id') 
                                                                                                                                        is-invalid @enderror"
                            name="categorieperiode_id" wire:model="editPeriode.categorieperiode_id">
                            <option value="">---------</option>
                            @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("categorieperiode_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListPeriode()" class="btn btn-danger">Retouner à la liste des
                        périodes</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>