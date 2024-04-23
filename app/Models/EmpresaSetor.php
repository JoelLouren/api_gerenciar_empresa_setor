<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaSetor extends Model
{
    use HasFactory;

    protected $table = 'empresa_setor';

    protected $fillable = ['empresa_id', 'setor_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id', 'id');
    }
}
