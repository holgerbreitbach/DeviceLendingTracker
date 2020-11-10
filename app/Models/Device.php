<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'serial', 'type', 'note', 'reset', 'defect', 'org_id'
    ];

    public function org()
    {
        return $this->belongsTo(Orgs::class);
    }

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }


}
