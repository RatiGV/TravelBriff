<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourOrder extends Model
{
    protected $table = 'tour_orders';

    protected $fillable = [
        'product_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'persons',
        'arrival_date',
        'return_date',
        'pickup_location',
        'return_location',
        'status',
    ];

    protected $casts = [
        'arrival_date' => 'date',
        'return_date' => 'date',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'product_id');
    }
}
