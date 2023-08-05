<div class="row p-4 pt-5">
    <div class="col-12">

        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche avancée des élèves </h5>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Année scolaire</label>
                        <select
                            class="form-control @error('editEleve.anneesscolaire_id') 
                                                                                                                                                                                                                    is-invalid @enderror"
                            name="editEleve.anneesscolaire_id" wire:model="editEleve.anneesscolaire_id">
                            <option value="">---------</option>
                            @foreach($anneesscolaires as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("editEleve.anneesscolaire_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Classe</label>
                        <select
                            class="form-control @error('editEleve.anneesscolaire_id') 
                                                                                                                                                                                                                                                is-invalid @enderror"
                            name="editEleve.anneesscolaire_id" wire:model="editEleve.anneesscolaire_id">
                            <option value="">---------</option>
                            @foreach($classes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                        @error("editEleve.anneesscolaire_id")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Sexe *</label>
                        <select class="form-control @error('editEleve.sexe') is-invalid @enderror"
                            wire:model="editEleve.sexe">
                            <option value="">---------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error("editEleve.sexe")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nom ou numéro de téléphone</label>
                        <input type="text" name="table_search" wire:model.debounce.700ms="search"
                            class="form-control float-right" placeholder="Recherche par nom ou tel">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Liste des élèves</h3>
            <div class="card-tools d-flex align-items-center ">
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
                        <th style="width:15%;">Teléphone</th>
                        <th style="width:20%;">Titeur</th>
                        <th style="width:15%;">Téléphone</th>
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
                        <td>{{ $value->telephone1 }} </td>
                        <td>{{ $value->parent->nom }} {{ $value->parent->prenom }} </td>
                        <td>{{ $value->parent->telephone1 }} </td>
                        <td class="text-center">
                            <button class="btn btn-link" wire:click="goToEditEleve({{$value->id}})"> <i
                                    class="far fa-edit"></i>
                            </button>
                            <button class="btn btn-link"
                                wire:click="confirmDelete('{{ $value->nom }}', {{$value->id}})">
                                <i class="far fa-trash-alt"></i> </button>
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
</div>
<!-- /.card -->
</div>
</div>