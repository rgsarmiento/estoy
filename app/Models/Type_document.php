<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'cufe_algorithm',
        'prefix',
    ];

    public function document_payrolls()
    {
        return $this->hasMany(Document_payroll::class);
    }
}
