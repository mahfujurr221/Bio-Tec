<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateSalesTargets extends Command
{
    protected $signature = 'sales-targets:update';
    protected $description = 'Update processed column in sales_targets table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDate = Carbon::now();
        $update=DB::table('sales_targets')
            ->where('processed', 0)
            ->where('twelve_month_date', '<', $currentDate)
            ->update(['processed' => 1]);
        if($update){
            session()->flash('success', 'Sales Target Year Processed');
        }
    }
}