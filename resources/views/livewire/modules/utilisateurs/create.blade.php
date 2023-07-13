<div class="row p-4 pt-5">
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouvel
                    utilisateur</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addUser()">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input autocomplete="off" type="text" wire:model="newUser.name"
                                class="form-control @error('newUser.name') is-invalid @enderror">

                            @error("newUser.name")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Adresse email</label>
                            <input autocomplete="off" type="text" wire:model="newUser.email" class="form-control @error('newUser.email') is-invalid @enderror">
                    
                            @error("newUser.email")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Mot de passe</label>
                            <input autocomplete="off" type="password" wire:model="newUser.password" class="form-control @error('newUser.password') is-invalid @enderror">
                    
                            @error("newUser.password")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" wire:click.prevent="goToListUser()" class="btn btn-danger">Retouner à la liste
                            des
                            utilisateurs</button>

                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>