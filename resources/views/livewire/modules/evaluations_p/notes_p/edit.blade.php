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
                                <input disabled autocomplete="off" type="text" wire:model="nomEleve"
                                    class="form-control @error('nomEleve') is-invalid @enderror">

                                @error("nomEleve")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Classe</label>
                                <input disabled autocomplete="off" type="text" wire:model="classEleve"
                                    class="form-control @error('classEleve') is-invalid @enderror">

                                @error("classEleve")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Année scolaire</label>
                                <input disabled autocomplete="off" type="text" wire:model="AnneeScolaire"
                                    class="form-control @error('AnneeScolaire') is-invalid @enderror">

                                @error("AnneeScolaire")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Matiere</label>
                                <input disabled autocomplete="off" type="text" wire:model="MatiereD"
                                    class="form-control @error('AnneeScolaire') is-invalid @enderror">
                        
                                @error("AnneeScolaire")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Composition</label>
                                <input autocomplete="off" type="text" wire:model="editNote.noteDevoir1"
                                    class="form-control @error('editNote.noteDevoir1') is-invalid @enderror">
                    
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
            <a href="{{route('evaluations.notes_p.index')}}" class="btn btn-danger">Retouner à la
                liste des
                notes</a>
        </div>
    </div>
</div>
</div>