<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wishlist
 *
 * @property int $id
 * @property int $user_id
 * @property string $public_token
 * @property string $title
 * @property string|null $description
 * @property bool $is_public
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wish[] $wishes
 */
class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'public_token',
        'title',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
}
