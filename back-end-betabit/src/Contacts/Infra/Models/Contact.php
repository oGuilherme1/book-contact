<?php

declare(strict_types=1);

namespace Src\Contacts\Infra\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Nome da tabela (se diferente do padrão 'contacts')
    protected $table = 'contacts';

    // Campos que podem ser atribuídos em massa
    protected $fillable = [
        'idUser',
        'name',
        'email',
        'phone',
        'imageURL',
    ];

    protected $casts = [
        'id' => 'integer',
        'idUser' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'imageURL' => 'string',
    ];

    public $timestamps = true;

}