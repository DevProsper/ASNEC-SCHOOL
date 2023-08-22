<?php

namespace App\Traits;

use App\Models\Log;

trait Loggable
{
    public function InsertLog($user_id, $securite, $message)
    {
        Log::create([
            'user_id' => $user_id,
            'securite' => $securite,
            'message' => $message,
        ]);

        // Peut-être ajouter des messages de réussite ou de notification ici
    }

    function calculerMoyenne($donnees)
    {
        $somme = array_sum($donnees);
        $nombreElements = count($donnees);

        if ($nombreElements > 0) {
            $moyenne = $somme / $nombreElements;
            return $moyenne;
        } else {
            return 0; // Éviter une division par zéro si le tableau est vide
        }
    }
}
