<?php

namespace App\Console\Commands;

use App\Factura;
use Illuminate\Console\Command;

class MultarFacturas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facturas:multar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Multe as facturas nao pagas';

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

        $facturas = Factura::where('paga', false)->get();
        foreach ($facturas as $factura) {
            $factura->num_multa+=$factura->num_multa;
            $factura->save();
        }

    }
}
