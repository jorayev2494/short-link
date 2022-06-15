<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    public $fillable = [
        'client_url',
        'short_url',
        'visited_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'client_url',
    ];

    /**
     * @var array $appends
     */
    protected $appends = [
        'full_short_url'
    ];

    /**
     * @return Attribute
     */
    public function fullShortUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => config('app.url') .'/api/' . $this->getRawOriginal('short_url') 
        );
    }
}
