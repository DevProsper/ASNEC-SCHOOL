<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x"></i> Liste des tarifications</h3>

                <div class="card-tools d-flex align-items-center ">
                    <a class="btn btn-success text-white mr-4 d-block" wire:click.prevent="goToAddTarification()"><i
                            class="fa fa-calendar-plus"></i> Nouvelle tarification</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:25%;">Libelle</th>
                            <th style="width:20%;">Prix</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarifications as $value)
                        <tr>
                            <td>{{ $value->nom }}</td>
                            <td>{{ $value->prix }} FCFA</td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditTarification({{$value->id}})"> <i
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
                    {{ $tarifications->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>