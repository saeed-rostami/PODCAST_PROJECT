<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "categories";

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class);
    }
}
