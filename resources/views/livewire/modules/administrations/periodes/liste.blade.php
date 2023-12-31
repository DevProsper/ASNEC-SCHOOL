<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche par catégorie </h5>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par catégorie</label>
                        <select class="form-control" wire:model="categorieId">
                            <option value="">Toutes les catégorie </option>
                            @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Liste des periodes</h3>

                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddPeriode()"><i
                            class="fa fa-calendar-plus"></i> Nouvelle période</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:30%;">période</th>
                            <th style="width:20%;">Categorie</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periodes as $value)
                        <tr>
                            <td>{{ $value->nom }}</td>
                            <td>{{ $value->categorie->nom }}</td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditPeriode({{$value->id}})"> <i
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
                    {{ $periodes->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>