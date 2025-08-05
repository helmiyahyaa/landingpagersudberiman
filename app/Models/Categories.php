<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'link',
        'nama',
        'isi',
        'status',
        'foto',
        'parent_menu',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the parent Categories for this Categories.
     * Mendapatkan kategori induk dari kategori ini.
     */
    public function parent()
    {
        // Relasi ke model itu sendiri (self-referencing)
        // 'parent_menu' adalah foreign key yang merujuk ke 'id' di tabel yang sama.
        return $this->belongsTo(Categories::class, 'parent_menu');
    }

    /**
     * Get the child categories for this Categories.
     * Mendapatkan semua sub-kategori dari kategori ini.
     */
    public function children()
    {
        // Relasi one-to-many ke model itu sendiri
        return $this->hasMany(Categories::class, 'parent_menu');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeMainMenu($query)
    {
        return $query->where('parent_menu', 0);
    }
}