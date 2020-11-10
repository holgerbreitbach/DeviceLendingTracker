<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'forename', 'street', 'code', 'location', 'school', 'number', 'note', 'phone', 'email'
    ];

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }

}
