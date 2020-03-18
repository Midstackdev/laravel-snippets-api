<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Step extends Model
{
    protected $fillable = [
        'order',
        'body',
        'title',
        'uuid'
    ];

    /**
     * [getRouteKeyName description]
     * @return [type] [description]
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (Step $step) {
            $step->uuid = Str::uuid();
        });
    }

    /**
     * [afterOrder description]
     * @return [type] [description]
     */
    public function afterOrder()
    {
        $adjacent = self::where('order', '>', $this->order)
                    ->orderBy('order', 'asc')
                    ->first();

        if (!$adjacent) {
            return self::orderBy('order', 'desc')->first()->order + 1;
        }

        return ($this->order + $adjacent->order) / 2;
    }

    /**
     * [beforeOrder description]
     * @return [type] [description]
     */
    public function beforeOrder()
    {
        $adjacent = self::where('order', '<', $this->order)
                    ->orderBy('order', 'desc')
                    ->first();

        if (!$adjacent) {
            return self::orderBy('order', 'asc')->first()->order - 1;
        }

        return ($this->order + $adjacent->order) / 2;
    }

    /**
     * [snippet description]
     * @return [type] [description]
     */
    public function snippet()
    {
        return $this->belongsTo(Snippet::class);
    }
}
