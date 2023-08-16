<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche par par classe et année scolaire </h5>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par classe</label>
                        <select class="form-control" wire:model="selectedClasse">
                            <option value="">Toutes les classes </option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par année scolaire</label>
                        <select class="form-control" wire:model="anneeScolaire">
                            <option value="">Toutes les années scolaires</option>
                            @foreach($anneesscolaires as $anneeScolaire)
                            <option value="{{ $anneeScolaire->id }}" @if($anneeScolaire->id === $anneeScolaireParDefaut) selected @endif>
                                {{ $anneeScolaire->nom }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Emplois du temps</h3>

                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddEmploisDuTemps()"><i
                            class="fa fa-calendar-plus"></i>Nouvel emplois du temps</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 100%;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:10%;">Heure</th>
                            <th style="width:10%;">Lundi</th>
                            <th style="width:10%;">Mardi</th>
                            <th style="width:10%;">Mercredi</th>
                            <th style="width:10%;">Jeudi</th>
                            <th style="width:10%;">Vendredi</th>
                            <th style="width:10%;">Samedi</th>
                            <th style="width:10%;">Dimamnche</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emplois as $value)
                        <tr>
                            <td>{{$value->heure}}</td>
                            <td>{{isset($value->matierej1) ? $value->matiere1->nom : "----"}}</td>
                            <td>{{isset($value->matierej2) ? $value->matiere2->nom : "----"}}</td>
                            <td>{{isset($value->matierej3) ? $value->matiere3->nom : "----"}}</td>
                            <td>{{isset($value->matierej4) ? $value->matiere4->nom : "----"}}</td>
                            <td>{{isset($value->matierej5) ? $value->matiere5->nom : "----"}}</td>
                            <td>{{isset($value->matierej6) ? $value->matiere6->nom : "----"}}</td>
                            <td>{{isset($value->matierej7) ? $value->matiere7->nom : "----"}}</td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditEmplois({{$value->id}})"> <i class="far fa-edit"></i> </button>
                                <button class="btn btn-link" wire:click="confirmDelete('{{ $value->nom }}', {{$value->id}})">
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
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>