<?php

namespace App\Console\Commands;

use App;
use Illuminate\Console\Command;

class TimeForLeitura extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leituras:do';

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
        $clientes = App\Cliente::where('activo', 1)->get();
        if (count($clientes) > 0) {
            $agua = App\Agua::all()->first();
            $leitura = App\Leitura::all()->max('numero_leitura');
            if (is_null($leitura)) {
                $numero_leitura = 1;
            }
            $numero_leitura = $leitura + 1;
            foreach ($clientes as $cliente) {
                $casa = $cliente->casa;
                $leitura = new App\Leitura();
                $leitura->casa()->associate($casa);
                $leitura->agua()->associate($agua);
                $leitura->numero_leitura = $numero_leitura;
                $leitura->save();

            }
        }

    }
}
