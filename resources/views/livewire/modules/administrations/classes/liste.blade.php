<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche par niveau scolaire </h5>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par niveau scolaire</label>
                        <select class="form-control" wire:model="niveauScolaireId">
                            <option value="">Toutes les niveaux scolaires </option>
                            @foreach($niveauxScolaires as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Liste des classes</h3>

                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddClasse()"><i
                            class="fa fa-calendar-plus"></i> Nouvelle classe</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:5%;">Classe</th>
                            <th style="width:20%;">Niveau scolaire</th>
                            <th style="width:20%;">Groupe</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $value)
                        <tr>
                            <td>{{ $value->nom }}</td>
                            <td>{{ $value->niveauScolaire->nom }}</td>
                            <td>{{ $value->niveauScolaire->nom }}</td>
                            <td>{{ $value->groupeClasse->nom }}</td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditClasse({{$value->id}})"> <i
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
                    {{ $classes->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>