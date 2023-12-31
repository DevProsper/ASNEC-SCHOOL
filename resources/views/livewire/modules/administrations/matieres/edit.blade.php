<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateMatiere()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Matière</label>
                            <input autocomplete="off" type="text" wire:model="editMatiere.nom"
                                class="form-control @error('editMatiere.nom') is-invalid @enderror">
                    
                            @error("editMatiere.nom")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom court</label>
                            <input autocomplete="off" type="text" wire:model="editMatiere.nomCourt"
                                class="form-control @error('editMatiere.nomCourt') is-invalid @enderror">
                    
                            @error("editMatiere.nomCourt")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Coefficient</label>
                            <input autocomplete="off" type="text" wire:model="editMatiere.coefficient"
                                class="form-control @error('editMatiere.coefficient') is-invalid @enderror">
                    
                            @error("editMatiere.coefficient")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListMatiere()" class="btn btn-danger">Retouner à la liste des
                        matières</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>

<div class="col-md-12 mt-4">
    <div class="card card-primary">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Attributions aux classes</h3>
            <button class="btn bg-gradient-success" wire:click="updateMatieresAndClasses"><i class="fas fa-check"></i>
                Appliquer les modifications</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">
                @foreach($assignClasses["classes"] as $classe)
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title flex-grow-1">
                            <a data-parent="#accordion" href="#" aria-expanded="true">
                                {{$classe["classe_nom"]}}
                            </a>
                        </h4>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
        
                            <input type="checkbox" class="custom-control-input"
                                wire:model.lazy="assignClasses.classes.{{$loop->index}}.active" @if($classe["active"]) checked
                                @endif id="customSwitch{{$classe['classe_id']}}">
                            <label class="custom-control-label" for="customSwitch{{$classe['classe_id']}}"> {{
                                $classe["active"]? "Activé" : "Desactivé" }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>