<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'tb_exchange_rate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coin',
        'value'
    ];

    /**
     * Timestamp columns
     * @var bool
     */
    public $timestamps = true;

}
