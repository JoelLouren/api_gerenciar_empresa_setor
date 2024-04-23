<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';

    protected $fillable = [];

    protected $primaryKey = "id";

    public function empresaSetor()
    {
        return $this->hasMany(EmpresaSetor::class, 'empresa_id');
    }
}
