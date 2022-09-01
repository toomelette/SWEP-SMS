<?php

namespace App\Console\Commands;

use App\Models\CronLogs;
use App\Models\SuSettings;
use App\Swep\Services\DTRService;
use Illuminate\Console\Command;

class UploadDtrs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dtr:upload';

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
     * @return int
     */
    protected $dtrService;
    public function handle(DTRService $DTRService)
    {
       $su = SuSettings::query()->where('setting','=','mother_server')->first();
       if(!empty($su)){
           if($su->int_value != 1){
                $DTRService->upload();
                CronLogs::insert([
                    'log' => 'Command upload success.',
                    'type' => 9,
                ]);
           }else{
               CronLogs::insert([
                   'log' => 'Command upload success but it is the mother server.',
                   'type' => -9,
               ]);
           }
       }
    }
}
