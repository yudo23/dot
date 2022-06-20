<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class City extends Model
{
    use HasFactory;
    protected $table = "cities";
    protected $fillable = [
        'id',
        'province_id',
        'city_id',
        'name',
    ];

    public function province()
    {
        return $this->BelongsTo(Province::class,"province_id","province_id");
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
