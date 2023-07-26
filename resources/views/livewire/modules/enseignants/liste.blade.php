<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Liste des enseignants</h3>
                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddEnseignant()"><i
                        class="fa fa-calendar-plus"></i> Créer un nouveau</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:25%;">Genre</th>
                            <th style="width:25%;">Nom complet</th>
                            <th style="width:20%;">Teléphone</th>
                            <th style="width:20%;">Diplôme</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enseignants as $value)
                        <tr>
                            <td>
                                @if($value->sexe == "F")
                                <img src="{{asset('assets/images/woman.png')}}" width="24" />
                                @else
                                <img src="{{asset('assets/images/man.png')}}" width="24" />
                                @endif
                            </td>
                            <td>{{ $value->nom }} {{ $value->prenom }}</td>
                            <td>{{ $value->telephone1 }} </td>
                            <td>{{ $value->diplome->nom }} </td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditEnseignant({{$value->id}})"> <i
                                        class="far fa-edit"></i> </button>
                                <button class="btn btn-link"
                                    wire:click="confirmDelete('{{ $value->nom }}', {{$value->id}})">
                                    <i class="far fa-trash-alt"></i> </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $enseignants->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>