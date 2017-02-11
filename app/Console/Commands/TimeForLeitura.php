<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;

class TimeForLeitura extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leitura:do';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cria uma lista dos clientes cujo sera feita a leitura nas suas respectivas casas';

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
        $agua = App\Agua::all()->first();
        $cliente = App\Cliente::where('activo', 1)->get();
        $leitura = App\Leitura::all()->max('numero_leitura');
        $numero_leitura = $leitura + 1;
        foreach ($cliente as $clt) {
            foreach ($clt->casa as $casa) {
                $leitura = new App\Leitura();
                $leitura->casa()->associate($casa);
                $leitura->agua()->associate($agua);
                $leitura->numero_leitura = $numero_leitura;
                $leitura->save();

            }
        }

    }
}
