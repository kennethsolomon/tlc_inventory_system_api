<?php

namespace App\Console\Commands;

use App\Models\LendProperty;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckOverDueProperty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'property:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if property is overdue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $properties = LendProperty::get();

        foreach ($properties as $property) {
            if (!Carbon::now()->startOfDay()->gte($property->return_date)) {
                info($property->property_code);
                info('Property is overdue');
                $property->is_overdue = true;
                $property->save();
            }
        }
    }
}
