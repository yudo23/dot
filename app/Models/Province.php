<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Province extends Model
{
    use HasFactory;
    protected $table = "provinces";
    protected $fillable = [
        'id',
        'province_id',
        'name',
    ];

    public function cities()
    {
        return $this->hasMany(City::class,"province_id");
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
