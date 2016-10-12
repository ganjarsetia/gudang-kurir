<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
/**
 * Class order
 * @package App\Models
 * @version October 11, 2016, 8:41 am UTC
 */
class order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'destination',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'destination' => 'string',
        'user_id' => 'integer',
        'status' => 'string'
    ];

    public $hidden = [
        'created_at',
        'updated_at'
    ];

    public $append = [
        'picked'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'destination' => 'required',
        'status' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getPickedAttribute()
    {
        $user = 'None';
        if ($this->user_id != auth()->user()->id) {
            $user = User::find($this->user_id)->name;
        }

        return $user;
    }

    
}
