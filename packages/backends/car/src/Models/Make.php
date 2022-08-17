<?php
namespace Backend\Car\Models;

use Illuminate\Database\Eloquent\Model;
use Backend\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Make extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'makes';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * [cars description]
     * @return [type] [description]
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'make_id')->withDefault();
    }
}
