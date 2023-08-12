<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
          <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche avancée des opérations </h5>
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par catégorie tarif</label>
                        <select class="form-control" wire:model="categorieTarificationFilter">
                            <option value="">Toutes les catégories</option>
                            @foreach ($categoriesTarification as $category)
                            <option value="{{ $category->id }}">{{ $category->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Filtrer par catégorie</label>
                        <select class="form-control" wire:model="statutFilter" id="statut">
                            <option value="">Toutes les opérations</option>
                            <option value="1">Soldées</option>
                            <option value="2">Acomptes</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Filtrer par mois</label>
                        <select class="form-control" wire:model="periodeFilter" id="periode">
                            <option value="">Tous</option>
                            @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}">{{ $periode->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Filtrer par classe</label>
                        <select class="form-control" wire:model="classeId" id="periode">
                            <option value="">Tous</option>
                            @foreach ($classes as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <p>Nombre total de caisses : {{ $operations->count() }}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Liste des élèves en attente d'admission à l'école</h3>
                <div class="card-tools d-flex align-items-center ">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th style="width:15%;">Eleve</th>
                        <th>Classe</th>
                        <th>Libelle</th>
                        <th style="width:5%;">Prix</th>
                        <th style="width:10%;">Scolaire</th>
                        <th>Période</th>
                        <th>Montant versé</th>
                        <th>Montant Restant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operations as $value)
                        <tr>
                            <td>
                                @if($value->eleve->sexe == "F")
                                <img src="{{asset('assets/images/woman.png')}}" width="24" />
                                @else
                                <img src="{{asset('assets/images/man.png')}}" width="24" />
                                @endif
                            </td>
                            <td>{{$value->eleve->nom}} {{$value->eleve->prenom}}</td>
                            <td>{{ $value->admission->classe->nom }}</td>
                            <td>{{$value->tarification->nom}}</td>
                            <td><b>{{Money($value->tarification->prix)}}</b></td>
                            <td>{{$value->anneesscolaire->nom}}</td>
                            @if ($value->periode_id)
                                <td>{{$value->periode->nom}}</td>
                            @else
                            <td>-----</td>
                            @endif
                            <td>{{Money($value->montantVerse)}}</td>
                            @if ($value->montantRestant)
                            <td><span class="badge bg-danger">{{(Money($value->montantRestant))}}</span></td>
                            @else
                            <td><span class="badge bg-primary">Soldé</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $operations->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>