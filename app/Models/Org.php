<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'number', 'street', 'code', 'location', 'phone', 'email', 'note'
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function lending1()
    {
        return $this->belongsTo(Lending::class);
    }

    public function lending2()
    {
        return $this->belongsTo(Lending::class);
    }
}
