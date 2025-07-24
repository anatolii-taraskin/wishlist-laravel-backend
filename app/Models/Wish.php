<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wish
 *
 * @property int $id
 * @property int $wishlist_id
 * @property string $title
 * @property string|null $url
 * @property float|null $price
 * @property int $priority
 * @property bool $is_reserved
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Wishlist $wishlist
 */
class Wish extends Model
{
    use HasFactory;

    protected $fillable = [
        'wishlist_id',
        'title',
        'url',
        'price',
        'priority',
        'is_reserved',
        'notes',
    ];

    protected $casts = [
        'is_reserved' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
}
