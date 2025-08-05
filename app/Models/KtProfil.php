<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KtProfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kt_profils';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function profils()
    {
        return $this->hasMany(DataProfil::class, 'kt_profils_id');
    }
}