<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'identification_number',
        'dv',
        'type_environment_id',
        'type_document_identification_id',
        'name',
        'address',
        'phone',
        'municipality_id',
        'email',
        'type_organization_id',
        'type_regime_id',
        'type_liability_id',
        'api_token'
    ];

    
    public function type_document_identification()
    {
        return $this->belongsTo(Type_document_identification::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function type_organization()
    {
        return $this->belongsTo(Type_organization::class);
    }

    public function type_regime()
    {
        return $this->belongsTo(Type_regime::class);
    }

    public function type_liability()
    {
        return $this->belongsTo(Type_liability::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }
}
