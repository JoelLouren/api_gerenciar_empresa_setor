<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setor;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') != 'production') {

            Setor::create([
                'descricao'              =>  'Recursos humanos (RH)',
            ]);

            Setor::create([
                'descricao'              =>  'Financeiro',
            ]);

            Setor::create([
                'descricao'              =>  'Contábil',
            ]);

            Setor::create([
                'descricao'              =>  'Comercial',
            ]);

            Setor::create([
                'descricao'              =>  'Marketing',
            ]);

            Setor::create([
                'descricao'              =>  'Jurídico',
            ]);

            Setor::create([
                'descricao'              =>  'Produção',
            ]);

            Setor::create([
                'descricao'              =>  'Logística',
            ]);

            Setor::create([
                'descricao'              =>  'Tecnologia da informação',
            ]);

            Setor::create([
                'descricao'              =>  'Suporte',
            ]);

            Setor::create([
                'descricao'              =>  'Suprimentos',
            ]);

            Setor::create([
                'descricao'              =>  'Redes sociais',
            ]);

            Setor::create([
                'descricao'              =>  'Eventos',
            ]);

            Setor::create([
                'descricao'              =>  'Diretoria',
            ]);

            Setor::create([
                'descricao'              =>  'Limpeza',
            ]);
        }
    }
}
