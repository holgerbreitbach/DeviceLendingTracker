<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lendingDate', 'org_id_1', 'returnDate', 'org_id_2', 'note', 'teacher_id', 'device_id'
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function device()
    {
        return $this->hasOne(Device::class);
    }

    public function org1()
    {
        return $this->hasOne(Org::class);
    }

    public function org2()
    {
        return $this->hasOne(Org::class);
    }
}
