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
                        <label for="">Info : <small>(nom,tele,tel parent)</small></label>
                        <input wire:model.debounce.700ms="eleveSearch" type="text" class="form-control">
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
                            <th style="">B</th>
                            <th style="width:30%;">Nom complet</th>
                            <th style="width:10%;">Classe</th>
                            <th style="width:10%;">Matiere</th>
                            <th style="width:10%;">Moy.Devoir</th>
                            <th style="width:20%;">Note. Comp</th>
                            <th style="width:20%;">Moy/20</th>
                            <th style="width:20%;">Coefficient</th>
                            <th style="width:10%;">Moy.Gen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalPrix = 0;
                        $Coefficien = 0;
                        @endphp
                        @foreach ($evaluations as $evaluation)
                        <tr> 
                            <td><a target="_blank" href="{{route('secondaire.evaluations.bulletin-secondaire.index', ['id_admission' => $evaluation->admission->id,'id_periode' => $evaluation->periode->id, 'eleve_id' => $evaluation->admission->eleve_id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <td>{{ $evaluation->admission->eleve->nom }} {{ $evaluation->admission->eleve->prenom }}</a></td>
                            <td>{{ $evaluation->admission->classe->nom }}</td>
                            <td>{{ $evaluation->matiere->nomCourt }}</td>
                            <td>{{ number_format($evaluation->moyenneDevoir, 2) }}</td>
                            <td>{{ $evaluation->noteExamen }}</td>
                            <td>{{ (number_format($evaluation->noteExamen, 2) + number_format($evaluation->moyenneDevoir, 2))/2 }}</td>
                            <td>{{ $evaluation->matiere->coefficient }}</td>
                            <td>{{ number_format($evaluation->matiere->coefficient, 2) * (number_format($evaluation->noteExamen, 2) + number_format($evaluation->moyenneDevoir, 2))/2}}</td>
                        </tr>
                        @php
                        $totalPrix += number_format($evaluation->matiere->coefficient, 2) * (number_format($evaluation->noteExamen, 2) +
                        number_format($evaluation->moyenneDevoir, 2))/2;
                        $Coefficien += intval($evaluation->matiere->coefficient)
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width:5%;"></th>
                            <th style="width:20%;">
                                @if ($Coefficien != 0)
                                Moyenne Gen : {{ number_format($totalPrix / $Coefficien, 2) }}
                                @endif
                            </th>
                            <th style="width:10%;"></th>
                            <th style="width:10%;"></th>
                            <th style="width:10%;"></th>
                            <th style="width:20%;"></th>
                            <th style="width:20%;">
                            </th>
                            <th style="width:20%;">{{ $Coefficien }}</th>
                            <th style="width:10%;">{{ $totalPrix }}</th>
                        </tr>
                    </tfoot>
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