<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i>
                    Créer un emploi du temps</h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateEmplois()">
                <div class="card-body">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom *</label>
                                <input disabled autocomplete="off" type="text" wire:model="editEvaluation.nom"
                                    class="form-control @error('editEvaluation.nom') is-invalid @enderror">

                                @error("editEvaluation.nom")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Classe</label>
                                <select disabled class="form-control" wire:model="editEvaluation.classe_id">
                                    <option value="">----- </option>
                                    @foreach($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("editEvaluation.classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <select disabled class="form-control" wire:model="editEvaluation.anneesscolaire_id">
                                    <option value="">Toutes les années scolaires</option>
                                    @foreach($annees as $anneeScolaire)
                                    <option value="{{ $anneeScolaire->id }}" @if($anneeScolaire->id ===
                                        $anneeScolaireParDefaut) selected @endif>
                                        {{ $anneeScolaire->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                @error("editEvaluation.anneesscolaire_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="heure">Heure :</label>
                                <input wire:model="editEvaluation.heure" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej1">Lundi :</label>
                                <select wire:model="editEvaluation.matierej1" id="matierej1"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej2">Mardi :</label>
                                <select wire:model="editEvaluation.matierej2" id="matierej2"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej3">Mercredi :</label>
                                <select wire:model="editEvaluation.matierej3" id="matierej3"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej4">Jeudi :</label>
                                <select wire:model="editEvaluation.matierej4" id="matierej4"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej5">Vendredi :</label>
                                <select wire:model="editEvaluation.matierej5" id="matierej5"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej6">Samedi :</label>
                                <select wire:model="editEvaluation.matierej6" id="matierej6"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej7">Dimanche :</label>
                                <select wire:model="editEvaluation.matierej7" id="matierej7"
                                    class="form-control">
                                    <option value="NULL">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
            </form>
            <br>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <button type="button" wire:click.prevent="goToListEmplois()" class="btn btn-danger">Retouner à la
                liste des
                emplois du temps</button>
        </div>
    </div>
</div>
</div>