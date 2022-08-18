<?php
namespace Backend\Car\Models;

use Illuminate\Database\Eloquent\Model;
use Backend\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'price' => 0,
        'status' => 'pending',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'model',
        'make_id',
        'engine_size_id',
        'registration',
        'price',
        'image',
        'user_id',
        'status',
    ];

    /**
     * @return BelongsTo
     * @deprecated
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return BelongsTo
     * @deprecated
     */
    public function engineSize(): BelongsTo
    {
        return $this->belongsTo(EngineSize::class, 'engine_size_id')->withDefault();
    }

    /**
     * @return BelongsTo
     * @deprecated
     */
    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class, 'make_id')->withDefault();
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'car_tags');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Car $car) {
            $car->tags()->detach();
        });
    }
}