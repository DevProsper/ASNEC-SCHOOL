<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> 
                    Liste des élèves en attente d'admission à l'école</h3>
                <div class="card-tools d-flex align-items-center ">
                    <div class="card-tools d-flex align-items-center ">
                    </div>
                </div>
                <div class="card-tools d-flex align-items-center ">
                    <div class="input-group input-group-md" style="width: 370px;">
                        <input type="text" name="table_search" wire:model.debounce.700ms="search"
                            class="form-control float-right" placeholder="Recherche par nom ou tel (Eleve ou titeur)">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th style="width:20%;">Nom complet</th>
                            <th style="width:10%;">Teléphone</th>
                            <th style="width:5%;">Statut</th>
                            <th style="width:20%;">Titeur</th>
                            <th style="width:5%;">Téléphone</th>
                            <th style="width:20%;" class="text-center">Inscription-Réinscription</th>
                            <th style="width:20%;" class="text-center">Date</th>
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
                            <td>{{ $value->nom }} {{ $value->prenom }}</td>
                            <td>{{ $value->telephone }}</td>
                            @if ($value->defaut == 1)
                            <td><span class="badge bg-info">Non Inscrit(e)</span></td>
                            @else
                            <td><span class="badge bg-warning">Déjà inscrit(e) - Ancien(e)</span></td>
                            @endif
                            <td>{{ $value->nomTiteur }} {{ $value->prenomTiteur }}</td>
                            <td>{{ $value->telephoneTiteur }}</td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToshowAdmission({{$value->id}})"> 
                                    <b>Inscription/Réinscription</b>
                                </button>
                            </td>
                            <td>{{ $value->created_at->diffForHumans() }}</td>
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
        <!-- /.card -->
    </div>
</div>