<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes
use Illuminate\Support\Str;

/**
 * Class Agenda
 * @package App\Models
 *
 * @property string $judul
 * @property string $isi
 * @property string $slug
 */
class Agenda extends Model
{
    use HasFactory, SoftDeletes; // Gunakan SoftDeletes

    /**
     * Nama tabel di database.
     *
     * @var string
     */
    public $table = 'agendas';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    public $fillable = [
        'judul',
        'isi',
        'slug',
    ];

    /**
     * Atribut yang akan di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'judul' => 'string',
        'isi' => 'string',
        'slug' => 'string'
    ];

    /**
     * Boot method untuk model.
     * Secara otomatis membuat slug saat model dibuat.
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