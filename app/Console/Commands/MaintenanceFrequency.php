<?php

namespace App\Console\Commands;

use App\Models\Maintenance;
use App\Services\MaintenanceService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MaintenanceFrequency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:frequency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update the frequency of the maintenance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $MaintenanceService = MaintenanceService::getInstance();

        $maintenances = Maintenance::get();

        foreach ($maintenances as $maintenance) {
            // if ($MaintenanceService->canRun($maintenance->start_date, 5)) {
            if (!$maintenance->is_approved) {
                info('Creating new Maintenance');
                $start_date = $MaintenanceService->getFrequencyDate($maintenance->start_date, $maintenance->frequency);

                $new_maintenance = $maintenance->replicate();

                $new_maintenance->start_date = $start_date;
                $new_maintenance->end_date = Carbon::parse($start_date)->addDays(7)->format('Y-m-d');
                $new_maintenance->save();

                $maintenance->is_approved = true;
                $maintenance->save();
            }
            // }
        }
    }
}
