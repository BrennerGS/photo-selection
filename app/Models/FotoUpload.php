<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoUpload extends Model
{
    use HasFactory;

    protected $table = 'foto_upload'; // Nome da tabela

    protected $fillable = [
        'cliente_id',
        'fotografo_id',
        'foto_caminho',
        'aprovacao',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function fotografo()
    {
        return $this->belongsTo(User::class, 'fotografo_id');
    }
}
