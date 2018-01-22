<?php

namespace App\Console;

use App\Console\Commands\MultarFacturas;
use App\Console\Commands\TimeForLeitura;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TimeForLeitura::class,
        MultarFacturas::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('leituras:do')->monthlyOn(20);
       /* $facturas = FacturaOperacoes::all();*/
        /*if(count($facturas)>0){*/
            /*$last_day_factura = $facturas->first()->ultimo_dia;*/
            $schedule->command('factura:multar')->monthlyOn(11);
        /*}*/
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
