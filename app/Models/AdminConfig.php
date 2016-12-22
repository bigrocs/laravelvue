<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class AdminConfig
 * @package App\Models
 */
class AdminConfig extends Model
{

    public $table = 'admin_configs';

    public $fillable = [
        'title',
        'name',
        'value',
        'group',
        'type',
        'icon',
        'property',
        'options',
        'tip',
        'sort',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'name' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'name' => 'required|string',
        'value' => 'required|string'
    ];

}
