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
                                <input disabled autocomplete="off" type="text" wire:model="editEmplois.nom"
                                    class="form-control @error('editEmplois.nom') is-invalid @enderror">

                                @error("editEmplois.nom")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Classe</label>
                                <select disabled class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($classes as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                                @error("editEmplois.classe_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <select disabled class="form-control" wire:model="editEmplois.anneesscolaire_id">
                                    <option value="">Toutes les années scolaires</option>
                                    @foreach($annees as $anneeScolaire)
                                    <option value="{{ $anneeScolaire->id }}" @if($anneeScolaire->id ===
                                        $anneeScolaireParDefaut) selected @endif>
                                        {{ $anneeScolaire->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                @error("editEmplois.anneesscolaire_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="heure">Heure :</label>
                                <input wire:model="editEmplois.heure" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej1">Lundi :</label>
                                <select wire:model="editEmplois.matierej1" id="matierej1"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej2">Mardi :</label>
                                <select wire:model="editEmplois.matierej2" id="matierej2"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej3">Mercredi :</label>
                                <select wire:model="editEmplois.matierej3" id="matierej3"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej4">Jeudi :</label>
                                <select wire:model="editEmplois.matierej4" id="matierej4"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej5">Vendredi :</label>
                                <select wire:model="editEmplois.matierej5" id="matierej5"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej6">Samedi :</label>
                                <select wire:model="editEmplois.matierej6" id="matierej6"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="matierej7">Dimanche :</label>
                                <select wire:model="editEmplois.matierej7" id="matierej7"
                                    class="form-control" wire:model="editEmplois.classe_id">
                                    <option value="">----- </option>
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