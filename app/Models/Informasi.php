<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Informasi
 * @package App\Models
 *
 * @property int $id
 * @property string|null $judul
 * @property string|null $isi
 * @property string|null $link
 * @property string $icon
 * @property string|null $slug
 */
class Informasi extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * @var string
     */
    public $table = 'informasis';

    /**
     * Atribut yang dapat diisi secara massal.
     * @var array
     */
    protected $fillable = [
        'judul',
        'isi',
        'link',
        'icon',
        'slug',
    ];

    /**
     * Boot the model to handle events.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Fungsi bantuan untuk membuat slug yang unik.
        $generateUniqueSlug = function ($model) {
            $slug = Str::slug($model->judul);
            $originalSlug = $slug;
            $counter = 1;

            // Periksa apakah slug sudah ada, dan abaikan ID model saat ini (untuk update)
            while (static::where('slug', $slug)->where('id', '!=', $model->id)->exists()) {
                $slug = "{$originalSlug}-{$counter}";
                $counter++;
            }

            $model->slug = $slug;
        };

        // Atur slug unik saat membuat model baru.
        static::creating(function ($model) use ($generateUniqueSlug) {
            if (empty($model->slug)) {
                $generateUniqueSlug($model);
            }
        });

        // Perbarui slug jika judul telah berubah.
        static::updating(function ($model) use ($generateUniqueSlug) {
            if ($model->isDirty('judul')) {
                $generateUniqueSlug($model);
            }
        });
    }
}
