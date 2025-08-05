<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Layanan
 * @package App\Models
 *
 * @property string $judul
 * @property string $subjek1
 * @property string $isi1
 * @property string $subjek2
 * @property string $isi2
 * @property string $subjek3
 * @property string $isi3
 * @property string $subjek4
 * @property string $isi4
 * @property string $subjek5
 * @property string $isi5
 * @property string $subjek6
 * @property string $isi6
 * @property string $foto
 * @property string $slug
 */
class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    public $table = 'layanans';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'subjek1', 'isi1',
        'subjek2', 'isi2',
        'subjek3', 'isi3',
        'subjek4', 'isi4',
        'subjek5', 'isi5',
        'subjek6', 'isi6',
        'foto',
        'slug'
    ];
    
    /**
     * Secara otomatis membuat slug dari judul saat data baru dibuat.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }
}