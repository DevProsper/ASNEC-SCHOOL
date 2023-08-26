<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i>
                    Attribuer les notes</h3>
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
                                <label>Nom</label>
                                <input disabled autocomplete="off" type="text" wire:model="nomComplet"
                                    class="form-control @error('nomComplet') is-invalid @enderror">

                                @error("nomComplet")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Classe</label>
                                <input disabled autocomplete="off" type="text" wire:model="classe"
                                    class="form-control @error('classe') is-invalid @enderror">

                                @error("classe")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Statut admission</label>
                                <input disabled autocomplete="off" type="text" wire:model="statut"
                                    class="form-control @error('statut') is-invalid @enderror">

                                @error("statut")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    @foreach ($rows as $index => $row)
                    <div class="row">

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="noteDevoir1_{{ $index }}">Note :</label>
                                <input wire:model="rows.{{ $index }}.noteDevoir1" type="text"
                                    class="form-control @error('nom') is-invalid @enderror">
                            </div>
                            @error("rows.{{ $index }}.noteDevoir1")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="matiere_id_{{ $index }}">Matiere :</label>
                                <select required wire:model="rows.{{ $index }}.matiere_id" id="matiere_id_{{ $index }}"
                                    class="form-control @error('nom') is-invalid @enderror">
                                    <option value="">----- </option>
                                    @foreach($matieres as $value)
                                    <option value="{{ $value['id']}}">{{ $value['nom'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="periode_id_{{ $index }}">periode :</label>
                                <select required wire:model="rows.{{ $index }}.periode_id" id="periode_id_{{ $index }}"
                                    class="form-control @error('nom') is-invalid @enderror">
                                    <option value="">----- </option>
                                    @foreach($periodes as $value)
                                    <option value="{{ $value->id}}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="row">
                        <div class="container">
                            <div class="col-md-3">
                                <button class="btn btn-warning"
                                    wire:click.prevent="removeRow({{ $index }})">Supprimer</button>
                            </div>
                        </div>
                    </div>
            </form>
            @endforeach
            <br>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <button type="button" wire:click.prevent="goToListEvaluation()" class="btn btn-danger">Retouner à la
                liste des
                élèves</button>
        </div>
    </div>
</div>
</div>