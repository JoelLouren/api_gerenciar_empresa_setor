<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') != 'production') {

            Empresa::create([
                'razao_social'              =>  'ConsulTI Industria e Comércio de sistemas LTDA.',
                'nome_fantasia'              =>  'ConsulTI',
                'cnpj'             =>  '00.000.000/0000-00',
            ]);

            Empresa::create([
                'razao_social'              =>  'Industria de embalagens PlastFort LTDA.',
                'nome_fantasia'              =>  'PlastFort Embalage',
                'cnpj'             =>  '11.111.111/1111-11',
            ]);

            Empresa::create([
                'razao_social'              =>  'Votorantim Cimentos LTDA.',
                'nome_fantasia'              =>  'VOTORANTIM Cimentos',
                'cnpj'             =>  '22.222.222/2222-22',
            ]);
        }
    }
}
