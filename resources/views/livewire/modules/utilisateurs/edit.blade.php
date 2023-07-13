<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateUser()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input autocomplete="off" type="text" wire:model="editUser.name"
                                class="form-control @error('editUser.name') is-invalid @enderror">
                    
                            @error("editUser.name")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Adresse email</label>
                            <input disabled autocomplete="off" type="text" wire:model="editUser.email"
                                class="form-control @error('editUser.email') is-invalid @enderror">
                    
                            @error("editUser.email")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Mot de passe</label>
                            <input autocomplete="off" type="password" wire:model="editUser.password"
                                class="form-control @error('editUser.password') is-invalid @enderror">
                    
                            @error("editUser.password")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retouner à la liste des
                        utilisateurs</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>

<div class="col-md-12 mt-4">
    <div class="card card-primary">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Attributions modules</h3>
            <button class="btn bg-gradient-success" wire:click="updateModuleAndPermissions"><i class="fas fa-check"></i>
                Appliquer les modifications</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">
                @foreach($modulePermissions["modules"] as $module)
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title flex-grow-1">
                            <a data-parent="#accordion" href="#" aria-expanded="true">
                                {{$module["module_nom"]}}
                            </a>
                        </h4>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">

                            <input type="checkbox" class="custom-control-input"
                                wire:model.lazy="modulePermissions.modules.{{$loop->index}}.active" @if($module["active"])
                                checked @endif id="customSwitch{{$module['module_id']}}">
                            <label class="custom-control-label" for="customSwitch{{$module['module_id']}}"> {{
                                $module["active"]? "Activé" : "Desactivé" }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>