<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setor';

    protected $fillable = [];

    protected $primaryKey = "id";

    public function empresaSetor()
    {
        return $this->hasMany(EmpresaSetor::class, 'setor_id');
    }
}
