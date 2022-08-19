<?php
namespace Backend\Car\Models;

use Illuminate\Database\Eloquent\Model;
use Backend\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Car extends Model
{
    use Searchable;
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
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'cars_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

         $array['engine_size_name'] = $this->engineSize->name;
         $array['make_name'] = $this->make->email;

        return $array;
    }

    protected function makeAllSearchableUsing($query)
    {
//        return $query->with('make');
    }

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->id;
    }

    /**
     * Get the key name used to index the model.
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'id';
    }

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
