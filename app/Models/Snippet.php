<?php

namespace App\Models;

use App\Transformers\Snippets\SnippetTransformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Snippet extends Model
{
    use Searchable;

    protected $fillable = [
        'uuid',
        'title',
        'is_public'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function (Snippet $snippet) {
            $snippet->steps()->create([
                'order' => 1
            ]);
        });

        static::creating(function (Snippet $snippet) {
            $snippet->uuid = Str::uuid();
        });
    }

    public function steps()
    {
        return $this->hasMany(Step::class)
                    ->orderBy('order', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPublic()
    {
        return $this->is_public;
    }

    public function scopePublic(Builder $builder)
    {
        return $builder->where('is_public', 1);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function toSearchableArray()
    {
        return fractal()
            ->item($this)
            ->transformWith(new SnippetTransformer())
            ->parseIncludes([
                'author',
                'steps'
            ])
            ->toArray();
    }
}
