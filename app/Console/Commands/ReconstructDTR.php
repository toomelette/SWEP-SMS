<?php

namespace App\Console\Commands;

use App\Swep\Services\DTRService;
use Illuminate\Console\Command;

class ReconstructDTR extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dtr:reconstruct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    protected $dtr_service;
    public function handle(DTRService $dtr_service)
    {
        $dtr_service->reconstruct();
    }
}
