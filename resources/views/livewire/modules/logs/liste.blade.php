<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-search"></i> Recherche avancée des notes </h5>
                </div>
                <div class="col-md-6">
                    <form wire:submit.prevent="render" class="mb-3">
                        <div class="form-group">
                            <label for="period">Sélectionner une période :</label>
                            <select wire:model="selectedPeriod" id="period" class="form-control">
                                @foreach ($periods as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($selectedPeriod === 'custom')
                        <div class="form-group">
                            <label for="created_at_1">Date de début :</label>
                            <input type="datetime-local" wire:model="created_at_1" id="created_at_1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="created_at_2">Date de fin :</label>
                            <input type="datetime-local" wire:model="created_at_2" id="created_at_2" class="form-control">
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Appliquer</button>
                    </form>
                </div>
        
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-calendar-plus fa-2x">
                    </i> Historique des actions de l'utilisateur dans le système</h3>
                <div class="card-tools d-flex align-items-center ">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th style="width:5%;">Utilisateur</th>
                            <th style="width:5%;">Statut</th>
                            <th style="width:20%;">message</th>
                            <th style="width:20%;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $value)
                        <tr>
                            <td>{{ $value->user->name }}</td>
                            <td>{{ $value->securite }}</td>
                            <td>{{ $value->message }}</td>
                            <td>{{ $value->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
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