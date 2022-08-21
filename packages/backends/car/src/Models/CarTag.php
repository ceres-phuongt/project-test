<?php
namespace Backend\Car\Models;

use Illuminate\Database\Eloquent\Model;

class CarTag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'car_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id',
        'tag_id',
    ];
}
