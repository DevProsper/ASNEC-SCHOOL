<style>
    .signature {
    font-family: cursive;
    font-size: 36px;
    font-weight: bold;
    letter-spacing: 5px;
    transform: rotate(-10deg);
    text-align: justify;
    }
</style>
<table border="0" cellpadding="0" cellspacing="0" width="651">
    
    <tbody>
        <tr height="19">
            <td colspan="4" height="19" style="text-align: center;" width="283">MINISTERE DE L&#39;ENSEIGNEMENT
                </td>
            <td width="37">&nbsp;</td>
            <td colspan="3" style="text-align: center;" width="251">REPUBLIQUE DU CONGO</td>
            <td width="80">&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="4" height="19" style="text-align: center;" width="283">PRESCOLAIRE, PRIMAIRE, SECONDAIRE</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;" width="251">Unit&eacute;*Travail*Progr&egrave;s</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="4" height="19" style="text-align: center;" width="283">ET DE L&#39;ALPHABETISATION</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;" width="251">********</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="4" height="19" style="text-align: center;" width="283">***************</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;" width="251">COMPLEXE SCOLAIRE PRIVE</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="4" height="57" rowspan="3" style="text-align: center;" width="283">DIRECTION DEPARTEMENTALE DE
                L&#39;ENSEIGNEMENT PRESCOLAIRE, PRIMAIRE, SECONDAIRE ET DE L&#39;ALPHABETISATION DE POINTE NOIRE</td>
            <td>&nbsp;</td>
            <td colspan="3" rowspan="2" style="text-align: center;">
                <strong><span style="font-size:28px;">KANI</span></strong>
            </td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td colspan="3" style="text-align: center;">Travail*Rigeur*R&eacute;ussite</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;" width="251">CRECHE-GARDERIE-MATERNELLE</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;" width="251">PRIMAIRE-COLLEGE</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;">Tel.: 05 799 42 42 / 06 675 32 16</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="3" style="text-align: center;">05 529 22 09</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td height="19">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">Qt. Matend&eacute; AV. Bruno TCHIKAYA N&deg; 366</td>
        </tr>
        <tr height="19">
            <td colspan="2" height="19"><strong>BULLETIN DE NOTES</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:center" colspan="3">Pointe Noire</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="4" height="19">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="5" height="19" rowspan="1">Ann&eacute;e scolaire : <b>{{$admission->annee_nom}}</b></td>
            <td colspan="3" rowspan="1">Classe : <b>{{$admission->classe_nom}}</b> </td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="5" height="19" rowspan="1">Nom(s) et prenom(s) : <b>{{$admission->eleve_nom}} {{$admission->eleve_prenom}}</b> </td>
            <td colspan="3" rowspan="1">Titeur : {{$admission->nomTiteur}} {{$admission->prenomTiteur}}</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="5" height="19" rowspan="1">Date et lieu de naissance : <b>{{substr($admission->dateNaissance, 0, 11)}}</b> à <b>{{$admission->lieuNaissance}}</b> </td>
            <td colspan="3" rowspan="1">Adresse : {{$admission->adresseTiteur}}</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="8" height="19" rowspan="1">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr height="19">
            <td colspan="6" height="19" rowspan="1"><strong>RELEVE DE NOTES DU MOIS DE {{strtoupper($admission->periode)}} </strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>



<table border="1" cellpadding="0" cellspacing="0" width="540">
    <tbody>
        <tr height="19">
            <td height="19" width="100"><strong>DISCIPLINES</strong></td>
            <td width="43"><strong>Comp.20</strong></td>
            <td width="37"><strong>Coef.</strong></td>
            <td width="37"><strong>Moy.Gen</strong></td>
            <td colspan="2" width="171"><strong>Appr&eacute;ciations</strong></td>
        </tr>
        @php
        $totalPrix = 0;
        $Coefficien = 0;
        @endphp
        @foreach ($evaluations as $evaluation)
            <tr height="19">
                <td>{{$evaluation['matiere_nom']}}</td>
                <td style="text-align: center" height="19">{{number_format($evaluation['noteDevoir1'], 2)}}</td>
                <td style="text-align: center">{{$evaluation['coefficient']}}</td>
                <td style="text-align: center">{{($evaluation['noteDevoir1']) * $evaluation['coefficient']}}</td>
                <td colspan="2">&nbsp;</td>
            </tr>
            @php
            $totalPrix += ($evaluation['noteDevoir1']) * $evaluation['coefficient'];
            $Coefficien += $evaluation['coefficient']
            @endphp
        @endforeach
        <tr height="19">
            <td height="19" width="80">Total</td>
            <td width="43"></td>
            <td style="text-align: center" width="37"><b>{{$Coefficien}}</b></td>
            <td style="text-align: center" width="37"><b>{{ $totalPrix }}</b></td>
            <td colspan="2" width="171"></td>
        </tr>
    </tbody>
</table>

<table border="1" cellpadding="0" cellspacing="0" width="476">
    <tbody>
        <tr height="19">
            <td height="19" width="80">Moyenne Gen &nbsp;</td>
            <td style="text-align: center" width="80">
                <b>@if ($Coefficien != 0)
                {{ number_format($totalPrix / $Coefficien, 2) }}
                @endif</b>
            </td>
            <td width="42">Rang</td>
            <td width="80">&nbsp;</td>
            <td width="45">Retard</td>
            <td width="43">&nbsp;</td>
            <td width="64">Abscence</td>
            <td width="42">&nbsp;</td>
        </tr>
    </tbody>
</table>
<p></p>
<table border="0" cellpadding="0" cellspacing="0" width="571">
    <tbody>
        <tr height="24">
            <td colspan="8" height="24" style="text-align: center;" width="571"><strong>SIGNATURES</strong></td>
        </tr>
        <tr height="19">
            <td height="19" style="text-align: center;"><strong>Parents</strong></td>
            <td colspan="3" style="text-align: center;"><strong>D&eacute;cision du conseil de classe</strong></td>
            <td colspan="2" style="text-align: center;"><strong>Chef d'&eacute;tablissement</strong></td>
            <td colspan="2" style="text-align: center;"><strong>Le Directeur</strong></td>
        </tr>
    </tbody>
</table>
<footer>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p style="text-align: center;">KANI</p>
</footer>