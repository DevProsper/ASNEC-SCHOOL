<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="callout callout-info">
            
        </div>

        <div class="row">
            <div class="container">
                <div class="col-md-6">
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Liste des élèves en attente d'admission
                    à l'école</h3>
                <div class="card-tools d-flex align-items-center ">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%;">Matiere</th>
                            <th style="width:10%;">Moy.Devoir</th>
                            <th style="width:20%;">Note. Comp</th>
                            <th style="width:20%;">Moy/20</th>
                            <th style="width:20%;">Coefficient</th>
                            <th style="width:20%;">Moyen.Gen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalPrix = 0;
                        $Coefficien = 0;
                        @endphp
                        @foreach ($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->matiere->nomCourt }}</td>
                            <td>{{ number_format($evaluation->moyenne, 2) }}</td>
                            <td>{{ $evaluation->noteExamen }}</td>
                            <td>{{ ($evaluation->noteExamen + number_format($evaluation->moyenne, 2))/2 }}</td>
                            <td>{{ $evaluation->matiere->coefficient }}</td>
                            <td>{{ $evaluation->matiere->coefficient * ($evaluation->noteExamen + number_format($evaluation->moyenne, 2))/2}}</td>
                        </tr>
                        @php
                        $totalPrix += $evaluation->matiere->coefficient * ($evaluation->noteExamen + number_format($evaluation->moyenne, 2))/2;
                        $Coefficien += $evaluation->matiere->coefficient
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width:10%;"></th>
                            <th style="width:10%;"></th>
                            <th style="width:20%;"></th>
                            <th style="width:20%;">{{ $totalPrix / $Coefficien }}</th>
                            <th style="width:20%;">{{ $Coefficien }}</th>
                            <th style="width:20%;">{{ $totalPrix }}</th>
                        </tr>
                    </tfoot>
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