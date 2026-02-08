<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table ='masyarakats';

    protected $fillable = [
        'nama',
        'no_hp',
        'nik',
        'email',
        'password',
    ];

    public function pelayanan(): HasMany
    {
        return $this->hasMany(Pelayanan::class);
    }
}
