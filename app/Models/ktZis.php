<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ktZis extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'kt_zis';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
    ];

    /**
     * Mendefinisikan relasi "satu ke banyak" dengan model Zis.
     * Satu kategori (ktZis) bisa memiliki banyak data ZIS.
     */
    public function zis()
    {
        return $this->hasMany(Zis::class, 'kt_zis_id');
    }
}