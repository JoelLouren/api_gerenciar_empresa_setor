<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmpresaSetor;

class EmpresaSetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmpresaSetor::create([
            'empresa_id'              =>  1,
            'setor_id'              =>  1,
        ]);

        EmpresaSetor::create([
            'empresa_id'              =>  1,
            'setor_id'              =>  2,
        ]);

        EmpresaSetor::create([
            'empresa_id'              =>  2,
            'setor_id'              =>  3,
        ]);

        EmpresaSetor::create([
            'empresa_id'              =>  2,
            'setor_id'              =>  4,
        ]);
    }
}
