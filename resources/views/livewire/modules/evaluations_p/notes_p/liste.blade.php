<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche avancée des notes </h5>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Filtrer par année</label>
                        <select class="form-control" wire:model="anneeScolaireId">
                            <option value="">Toutes</option>
                            @foreach($anneesscolaires as $anneeScolaire)
                            <option value="{{ $anneeScolaire->id }}" @if($anneeScolaire->id === $anneeScolaireParDefaut)
                                selected @endif>
                                {{ $anneeScolaire->nom }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Filtrer par classes</label>
                        <select class="form-control" wire:model="classeId">
                            <option value="">Toutes</option>
                            @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par période</label>
                        <select class="form-control" wire:model="periodeId">
                            <option value="">Toutes les périodes</option>
                            @foreach($periodes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filtrer par matière</label>
                        <select class="form-control" wire:model="matiereId">
                            <option value="">Toutes</option>
                            @foreach($matieres as $value)
                            <option value="{{ $value->id }}">{{ $value->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Info : <small>(nom,tele,tel parent)</small></label>
                        <input wire:model.debounce.700ms="eleveSearch" type="text"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="container">
                <div class="col-md-6">
                    
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
                            <th>Nom de l'élève</th>
                            <th>Classe</th>
                            <th>Matiere</th>
                            <th>Période</th>
                            <th>Composition</th>
                            <th>Année scolaire</th>
                            <th class="text-center">Action</th>
                            <!-- Autres colonnes d'information des admissions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->admission->eleve->nom }} {{ $evaluation->admission->eleve->prenom }}</td>
                            <td>{{ $evaluation->admission->classe->nom }}</td>
                            <td>{{ $evaluation->matiere->nom }}</td>
                            <td>{{ $evaluation->periode->nom }}</td>
                            <td>{{ $evaluation->noteDevoir1 }}</td>
                            <td>{{ $evaluation->admission->anneesscolaire->nom }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary" wire:click="goToEditNote({{$evaluation->id}})">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button class="btn btn-link" wire:click="confirmDelete('{{ $evaluation->matiere->nomCourt }}', {{$evaluation->id}})">
                                    <i class="far fa-trash-alt"></i>
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