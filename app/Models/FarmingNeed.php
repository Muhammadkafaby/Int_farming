<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmingNeed extends Model
{
    use HasFactory;
    protected $table = 'farming_needs';
    protected $primaryKey = 'id';
    protected $foreignKey = 'mitra_id';
    protected $fillable = [
        'item_type',
        'item_name',
        'description',
        'stock',
        'price',
        'photo',
        'sold',
        'discount',
        'rating',
        
    ];
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

}
