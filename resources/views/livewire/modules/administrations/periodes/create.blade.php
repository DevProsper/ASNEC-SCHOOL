<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> Ajoute d'une nouvelle péiode</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addPeriode()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Période *</label>
                            <input autocomplete="off" type="text" wire:model="newPeriode.nom"
                                class="form-control @error('newPeriode.nom') is-invalid @enderror">

                            @error("newPeriode.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Categorie *</label>
                        <select
                            class="form-control @error('categorieperiode_id') 
                                                                                                                        is-invalid @enderror"
                            name="categorieperiode_id" wire:model="newPeriode.categorieperiode_id">
                            <option value="">---------</option>
                            @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("categorieperiode_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListPeriode()" class="btn btn-danger">Retouner à la liste des
                        périodes</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>