<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Pengumuman
 * @package App\Models
 *
 * @property string $judul
 * @property string $isi
 * @property string $slug
 */
class Pengumuman extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel di database.
     *
     * @var string
     */
    public $table = 'pengumumans';

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
     * Buat slug secara otomatis sebelum menyimpan ke database.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = (string) Str::of($model->judul)->slug('-');
        });

        static::updating(function ($model) {
            $model->slug = (string) Str::of($model->judul)->slug('-');
        });
    }
}