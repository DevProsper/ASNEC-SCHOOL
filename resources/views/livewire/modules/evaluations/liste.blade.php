<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche avancée des élèves </h5>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par année scolaire</label>
                        <select class="form-control" wire:model="anneeScolaire">
                            <option value="">Toutes les années scolaires</option>
                            @foreach($anneesscolaires as $anneeScolaire)
                            <option value="{{ $anneeScolaire->id }}" @if($anneeScolaire->id === $anneeScolaireParDefaut)
                                selected @endif>
                                {{ $anneeScolaire->nom }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par classes</label>
                        <select class="form-control" wire:model="classe">
                            <option value="">Toutes les classes</option>
                            @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par sexe</label>
                        <select class="form-control" wire:model="sexe">
                            <option value="">Les deux</option>
                            <option value="H">Masculin</option>
                            <option value="F">Féminin</option>
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
                    <p>{{ $totalAdmissions }} élèves trouvé(e)s.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Liste des élèves en attente d'admission
                    à l'école</h3>
                <div class="card-tools d-flex align-items-center ">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Tel</th>
                            <th>Classe</th>
                            <th>Admission</th>
                            <th>Date admission</th>
                            <th>Statut</th>
                            <th>Année scolaire</th>
                            <th class="text-center">Paiement(s)</th>
                            <!-- Autres colonnes d'information des admissions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eleves as $admission)
                        <tr>
                            <td>
                                @if($admission->eleve->sexe == "F")
                                <img src="{{asset('assets/images/woman.png')}}" width="24" />
                                @else
                                <img src="{{asset('assets/images/man.png')}}" width="24" />
                                @endif
                            </td>
                            <td>{{ $admission->eleve->nom }} {{ $admission->eleve->prenom }}</td>
                            <td>{{ $admission->eleve->telephone }}</td>
                            <td>{{ $admission->classe->nom }}</td>
                            <td>{{ $admission->tarification->categorie->nom }}</td>
                            <td>{{ substr($admission->created_at, 0, 10) }}</td>
                            @if ($admission->statutAdmission == "Nouveau")
                            <td><span class="badge bg-info">Nouveau(lle)</span></td>
                            @else
                            <td><span class="badge bg-danger">Redoublant(e)</span></td>
                            @endif
                            <td>{{ $admission->anneesscolaire->nom }}</td>

                            <td class="text-center">
                                <button class="btn btn-primary" wire:click="goToEditEvaluation({{$admission->id}})">
                                    <i class="fa-solid fa-bolt">F</i>
                                </button>
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