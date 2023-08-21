<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i> 
                    Créer un emploi du temps</h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="save()">
                <div class="card-body">
                    <div class="row">
                        <button class="btn btn-primary" wire:click.prevent="addRow">Ajouter une Ligne</button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom *</label>
                                <input autocomplete="off" type="text" wire:model="newEmplois.nom"
                                    class="form-control @error('newEmplois.nom') is-invalid @enderror">
                                
                                @error("newEmplois.nom")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Classe</label>
                                <select class="form-control @error('nom') 
                                is-invalid @enderror" wire:model="newEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("newEmplois.classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <select class="form-control" wire:model="anneesscolaire_id">
                                    <option value="">----- </option>
                                    @foreach($annees as $anneeScolaire)
                                    <option value="{{ $anneeScolaire->id }}" @if($anneeScolaire->id === $anneeScolaireParDefaut) selected @endif>
                                        {{ $anneeScolaire->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                @error("anneesscolaire_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    @foreach ($rows as $index => $row)
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="heure_{{ $index }}">Heure :</label>
                                <input wire:model="rows.{{ $index }}.heure" type="text" 
                                class="form-control @error('nom') is-invalid @enderror">
                            </div>
                            @error("rows.{{ $index }}.heure")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej1_{{ $index }}">Lundi :</label>
                                <select wire:model="rows.{{ $index }}.matierej1" id="matierej1_{{ $index }}" 
                                class="form-control @error('nom') is-invalid @enderror" 
                                >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej2_{{ $index }}">Mardi :</label>
                                <select wire:model="rows.{{ $index }}.matierej2" id="matierej2_{{ $index }}" class="form-control"
                                    >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej3_{{ $index }}">Mercredi :</label>
                                <select wire:model="rows.{{ $index }}.matierej3" id="matierej3_{{ $index }}" class="form-control"
                                    >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej4_{{ $index }}">Jeudi :</label>
                                <select wire:model="rows.{{ $index }}.matierej4" id="matierej4_{{ $index }}" class="form-control"
                                    >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej5_{{ $index }}">Vendredi :</label>
                                <select wire:model="rows.{{ $index }}.matierej5" id="matierej5_{{ $index }}" class="form-control"
                                    >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej6_{{ $index }}">Samedi :</label>
                                <select wire:model="rows.{{ $index }}.matierej6" id="matierej6_{{ $index }}" class="form-control"
                                    >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej7_{{ $index }}">Dimanche :</label>
                                <select wire:model="rows.{{ $index }}.matierej7" id="matierej7_{{ $index }}" class="form-control"
                                    >
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                <!-- /.card-body -->
                <div class="row">
                    <div class="container">
                        <div class="col-md-3">
                            <button class="btn btn-warning" wire:click.prevent="removeRow({{ $index }})">Supprimer</button>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
            <br>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <button type="button" wire:click.prevent="goToListEmplois()" class="btn btn-danger">Retouner à la
                liste des
                emplois du temps</button>
            </div>
        </div>
    </div>
</div>