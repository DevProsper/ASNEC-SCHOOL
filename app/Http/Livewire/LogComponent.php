<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Log;
use Livewire\Component;

class LogComponent extends Component
{
    public $currentPage = PAGELIST;
    public $logs;
    public $selectedPeriod = 'all'; // Par défaut, afficher toutes les logs
    public $periods = [
        'all' => 'Toutes',
        'today' => 'Aujourd\'hui',
        'this_week' => 'Cette semaine',
        'this_month' => 'Ce mois-ci',
        'this_year' => 'Cette année',
        'last_month' => 'Mois passé',
        // Add other predefined periods as needed
        'custom' => 'Personnalisée',
    ];

    public $created_at_1;
    public $created_at_2;

    public function render()
    {
        $query = Log::query();

        if ($this->selectedPeriod === 'custom') {
            $query->whereBetween('created_at', [$this->created_at_1, $this->created_at_2]);
        } else {
            $query->whereBetween('created_at', $this->getSelectedPeriodRange());
        }

        $this->logs = $query->orderBy('created_at', 'desc')->limit(100)->get();

        return view(
            'livewire.modules.logs.index'
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function getSelectedPeriodRange()
    {
        $now = Carbon::now();

        switch ($this->selectedPeriod) {
            case 'today':
                return [
                    $now->startOfDay()->toDateTimeString(),
                    $now->endOfDay()->toDateTimeString()
                ];
            case 'this_week':
                return [
                    $now->startOfWeek()->toDateTimeString(),
                    $now->endOfWeek()->toDateTimeString()
                ];
            case 'this_month':
                return [
                    $now->startOfMonth()->toDateTimeString(),
                    $now->endOfMonth()->toDateTimeString()
                ];
            case 'this_year':
                return [
                    $now->startOfYear()->toDateTimeString(),
                    $now->endOfYear()->toDateTimeString()
                ];
            case 'last_month':
                return [
                    $now->subMonth()->startOfMonth()->toDateTimeString(),
                    $now->subMonth()->endOfMonth()->toDateTimeString()
                ];
            default:
                return [Carbon::minValue(), Carbon::maxValue()];
        }
    }
}
