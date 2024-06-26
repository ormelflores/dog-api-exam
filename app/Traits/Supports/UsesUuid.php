<?php

namespace App\Traits\Supports;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait UsesUuid
{
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (! $model->getKey())
            {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Interact with the model's type.
     */
    public function modelType(): Attribute
    {
        return Attribute::make(
            get: fn () => self::class,
        );
    }

    /**
     * Interact with the model's morph class.
     */
    public function modelMorphClass(): Attribute
    {
        return Attribute::make(
            get: fn () => self::getMorphClass(),
        );
    }
}
