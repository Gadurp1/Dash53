<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeficienciesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deficiencies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the deficiencies table with the proper status.';

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
     public function handle()
     {
        DB::table('dash_new.deficiencies d')
            ->join('tdata.subclients s', 'd.subclient_id', '=', 's.account_name')
            ->where('d.client_id', 's.client_id')
            ->where('tin','!=', null)
            ->where('tin','!=', '')
            ->where('client','!=', null)
            ->where('client','!=', '')
            ->update(['d.visible' => 2]);
     $this->info('The happy birthday messages were sent successfully!');

     }
}
