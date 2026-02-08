<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class JenisPelayanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pelayanan';


    protected $guarded = ['id'];

    public function pelayanan(): HasMany
    {
        return $this->hasMany(Pelayanan::class);
    }

}
