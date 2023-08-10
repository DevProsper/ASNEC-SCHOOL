<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Liste des élèves</h3>
                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddEleve()"><i
                            class="fa fa-user-plus"></i> Créer un nouveau</a>
                </div>
                <div class="card-tools d-flex align-items-center ">
                    <div class="input-group input-group-md" style="width: 300px;">
                        <input type="text" name="table_search" wire:model.debounce.700ms="search"
                            class="form-control float-right" placeholder="Recherche par nom ou prenom">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th style="width:5%;">Detail</th>
                            <th style="width:25%;">Nom complet</th>
                            <th style="width:10%;">Teléphone</th>
                            <th style="width:25%;">Titeur</th>
                            <th style="width:5%;">Téléphone</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eleves as $value)
                        <tr>
                            <td>
                                @if($value->sexe == "F")
                                <img src="{{asset('assets/images/woman.png')}}" width="24" />
                                @else
                                <img src="{{asset('assets/images/man.png')}}" width="24" />
                                @endif
                            </td>
                            <td><a href=""><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <td>{{ $value->nom }} {{ $value->prenom }}</td>
                            <td>{{ $value->telephone }} </td>
                            <td>{{ $value->nomTiteur }} {{ $value->prenomTiteur }} </td>
                            <td>{{ $value->telephoneTiteur }} </td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditEleve({{$value->id}})"> <i class="far fa-edit"></i>
                                </button>
                                @can("utilisateurs")
                                    <button class="btn btn-link" wire:click="confirmDelete('{{ $value->nom }}', {{$value->id}})">
                                        <i class="far fa-trash-alt"></i> </button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $eleves->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>