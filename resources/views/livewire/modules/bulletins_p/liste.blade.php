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
                            <th style="width:20%;">Nom complet</th>
                            <th style="width:10%;">Classe</th>
                            <th style="width:10%;">Matiere</th>
                            <th style="width:10%;">Compo.</th>
                            <th style="width:10%;">Coefficient</th>
                            <th style="width:10%;">Moy./10</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $MoyGen = 0;
                        $totalCompo = 0;
                        $Coefficien = 0;
                        @endphp
                        @foreach ($evaluations as $evaluation)
                        <tr>
                            <td>
                                <a target="_blank"
                                    href="{{route('evaluations.primaire.bulletin-primaire.index', ['id_admission' => $evaluation->admission->id,'id_periode' => $evaluation->periode->id, 'eleve_id' => $evaluation->admission->eleve_id])}}"><i
                                        class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <td>{{ $evaluation->admission->eleve->nom }} {{ $evaluation->admission->eleve->prenom }}</td>
                            <td>{{ $evaluation->admission->classe->nom }}</td>
                            <td>{{ $evaluation->matiere->nom }}</td>
                            <td>{{ number_format($evaluation->noteDevoir1, 2) }}</td>
                            <td>{{ $evaluation->matiere->coefficient }}</td>
                            <td>{{ $evaluation->matiere->coefficient * number_format($evaluation->noteDevoir1, 2) }}</td>
                        </tr>
                        @php
                        $MoyGen += $evaluation->matiere->coefficient * number_format($evaluation->noteDevoir1, 2);
                        $Coefficien += $evaluation->matiere->coefficient;
                        $totalCompo += number_format($evaluation->noteDevoir1, 2);
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width:5%;"></th>
                            <th style="width:20%;">
                                @if ($Coefficien != 0)
                                Moyenne genérale : {{ $MoyGen / $Coefficien}}
                                @endif
                            </th>
                            <th style="width:10%;"></th>
                            <th style="width:10%;"></th>
                            <th style="width:10%;">{{ $totalCompo }}</th>
                            <th style="width:10%;">{{ $Coefficien }}</th>
                            <th style="width:10%;">{{ $MoyGen }}</th>
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