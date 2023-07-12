<?php
use Illuminate\Support\Str;

define("PAGELIST", "liste");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");

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
