<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class ZonaIntegritas
 * @package App\Models
 *
 * @property string $judul
 * @property string $isi
 * @property string $link
 * @property integer $kt_zis
 * @property string $slug
 */
class ZonaIntegritas extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    public $table = 'zis';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'isi',
        'link',
        'kt_zis',
        'slug',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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

        static::updating(function ($model) {
            if ($model->isDirty('judul')) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    /**
     * Mendapatkan kunci rute untuk model.
     */
    public function getRouteKeyName()
    {
        return 'slug'; // Menggunakan 'slug' untuk route model binding
    }

    /**
     * Mendefinisikan relasi ke model KtZis.
     */
    public function ktZis()
    {
        // Asumsi 'kt_zis' adalah foreign key yang menghubungkan ke model KtZis
        return $this->belongsTo(KtZis::class, 'kt_zis');
    }
}