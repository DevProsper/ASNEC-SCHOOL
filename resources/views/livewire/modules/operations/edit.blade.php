<div class="row p-4 pt-5">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar-plus"></i>
                    Edite les notes l'élève</h3>
            </div>
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateNote()">
                <div class="card-body">
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
                                <input disabled autocomplete="off" type="text" wire:model="classeEleve"
                                    class="form-control @error('classeEleve') is-invalid @enderror">

                                @error("classeEleve")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <input disabled autocomplete="off" type="text" wire:model="annee_scolaire"
                                    class="form-control @error('annee_scolaire') is-invalid @enderror">

                                @error("annee_scolaire")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Devoir 1</label>
                                <input autocomplete="off" type="text" wire:model="editNote.noteDevoir1"
                                    class="form-control @error('editNote.noteDevoir1') is-invalid @enderror">

                                @error("editNote.noteDevoir1")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Devoir 2</label>
                                <input autocomplete="off" type="text" wire:model="editNote.noteDevoir2"
                                    class="form-control @error('editNote.noteDevoir2') is-invalid @enderror">

                                @error("editNote.noteDevoir2")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Devoir 3</label>
                                <input autocomplete="off" type="text" wire:model="editNote.noteDevoir3"
                                    class="form-control @error('editNote.noteDevoir3') is-invalid @enderror">

                                @error("editNote.noteDevoir3")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Examen</label>
                                <input autocomplete="off" type="text" wire:model="editNote.noteExamen"
                                    class="form-control @error('editNote.noteExamen') is-invalid @enderror">

                                @error("editNote.noteDevoir1")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="editNote.periode_id">periode:</label>
                                <select wire:model="editNote.periode_id" id="editNote.periode_id"
                                    class="form-control @error('nom') is-invalid @enderror">
                                    @foreach($periodes as $value)
                                    <option value="{{ $value->id}}">{{ $value->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
            </form>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="" class="btn btn-danger">Retouner à la
                liste des
                notes</a>
        </div>
    </div>
</div>
</div>