<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ReformasiBirokrasi
 * @package App\Models
 *
 * @property string $judul
 * @property string|null $isi
 * @property string|null $link
 */
class ReformasiBirokrasi extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'reformasi_birokrasis';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'isi',
        'link',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
