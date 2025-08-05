<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataProfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profils';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'foto',
        'isi',
        'slug',
        'kt_profils_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Auto generate slug dengan pengecekan unik
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $originalSlug = Str::slug($model->judul);
            $count = 1;
            
            while (static::where('slug', $originalSlug)->exists()) {
                $originalSlug = Str::slug($model->judul) . '-' . $count;
                $count++;
            }
            
            $model->slug = $originalSlug;
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul')) {
                $originalSlug = Str::slug($model->judul);
                $count = 1;
                
                while (static::where('slug', $originalSlug)
                       ->where('id', '!=', $model->id)
                       ->exists()) {
                    $originalSlug = Str::slug($model->judul) . '-' . $count;
                    $count++;
                }
                
                $model->slug = $originalSlug;
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(KtProfil::class, 'kt_profils_id');
    }
}