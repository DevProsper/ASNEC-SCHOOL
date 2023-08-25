<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche avancée des élèves </h5>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Année scolaire</label>
                        <select
                            class="form-control @error('editEleve.anneesscolaire_id') 
                                                                                                                                                                                                                                        is-invalid @enderror"
                            name="editEleve.anneesscolaire_id">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nom ou numéro de téléphone</label>
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="Recherche par nom ou tel">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Liste des tarifications</h3>

                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddTarification()"><i
                            class="fa fa-calendar-plus"></i> Nouvelle tarification</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:20%;">Nom</th>
                            <th style="width:10%;">Prix</th>
                            <th style="width:20%;">Année scolaire</th>
                            <th style="width:20%;">Catégorie</th>
                            <th style="width:5%;">Statut</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarifications as $value)
                        <tr>
                            <td>{{ $value->nom }} </td>
                            <td>{{ $value->prix }} FCFA</td>
                            <td>{{ $value->anneeScolaire->nom }} </td>
                            <td>{{ $value->categorie->nom }} </td>

                            @if ($value->statut == 1)
                                <td><span class="badge bg-info">Visible</span></td>
                                @else
                                <td><span class="badge bg-danger">Invisible</span></td>
                            @endif
                            
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditTarification({{$value->id}})"> <i
                                        class="far fa-edit"></i> </button>
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
                    {{ $tarifications->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>