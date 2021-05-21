<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'currencies';

    /**
     * Not mass-assingable attributes
     * 
     */
    protected $guarded = [];
}
