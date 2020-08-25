<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'client_name', 
        'employee_name', 
        'quote_date', 
        'quote_time', 
        'quote_id', 
        'quote_description', 
        'quoted_value'
    ];
}
