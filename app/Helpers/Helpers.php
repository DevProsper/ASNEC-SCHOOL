<?php

use Illuminate\Support\Str;

define("PAGELIST", "liste");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");
define("PAGECREATEADMISSION", "create_admission");
define("PAGEEDITADMISSION", "edit_admission");
define("PAGECREATEFORM_ELEVE", "create_eleve");
define("PAGEREINSCRIPTION", "reinscription");
define("PAGEFRAISSCOLAIRE", "frais");
define("PAGEFRAIS_EDITION", "frais_scolaire_edit");
//PROC

function Money($amount)
{
    $formatter = new \NumberFormatter('fr_FR', \NumberFormatter::CURRENCY);
    $formattedAmount = $formatter->formatCurrency($amount, 'XAF'); // Remplacez 'EUR' par le code de la devise souhaitée

    return $formattedAmount;
}

define("DEFAULTPASSOWRD", "password");

function setMenuClass($route, $classe)
{
    $routeActuel = request()->route()->getName();

    if (contains($routeActuel, $route)) {
        return $classe;
    }
    return "";
}

function setMenuActive($route)
{
    $routeActuel = request()->route()->getName();

    if ($routeActuel === $route) {
        return "active";
    }
    return "";
}

function contains($container, $contenu)
{
    return Str::contains($container, $contenu);
}

function getModulesName()
{
    $modulesName = "";
    $i = 0;
    foreach (auth()->user()->modules as $module) {
        $modulesName .= $module->nom;

        //
        if ($i < sizeof(auth()->user()->modules) - 1) {
            $modulesName .= ",";
        }

        $i++;
    }

    return $modulesName;
}
