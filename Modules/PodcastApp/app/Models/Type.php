<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\TypeFactory;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "types";

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected static function newFactory(): TypeFactory
    {
        //return TypeFactory::new();
    }
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function channels(): HasManyThrough
    {
        return $this->hasManyThrough(
            Channel::class,
            Category::class,
            'type_id',
            'category_id',

        );
    }
}
