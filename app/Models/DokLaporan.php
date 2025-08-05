<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class DokLaporan
 * @package App\Models
 *
 * @property int $id
 * @property string|null $judul
 * @property string|null $isi
 * @property string|null $foto
 * @property string|null $slug
 * @property int $kt_laporans_id
 *
 * @property KtLaporan $ktLaporan
 */
class DokLaporan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'dok_laporans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'judul',
        'isi',
        'foto',
        'slug',
        'kt_laporans_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'judul' => 'string',
        'isi' => 'string',
        'foto' => 'string',
        'slug' => 'string',
        'kt_laporans_id' => 'integer',
    ];

    /**
     * Boot the model to handle events.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Membuat slug secara otomatis saat membuat data baru
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });

        // Memperbarui slug jika judul berubah
        static::updating(function ($model) {
            if ($model->isDirty('judul')) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model KtLaporan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ktLaporan()
    {
        return $this->belongsTo(\App\Models\KtLaporan::class, 'kt_laporans_id');
    }
}
