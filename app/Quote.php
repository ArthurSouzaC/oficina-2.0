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

    public function search($filters = null) {
        $results = $this->where(function($query) use($filters){
            
            if($filters["quote_date_initial"]) {
                $query->where('quote_date', '>=', $filters["quote_date_initial"]);
            }

            if($filters["quote_date_final"]) {
                $query->where('quote_date', '<=', $filters["quote_date_final"]);
            }

            if($filters["client_name"]) {
                $query->where('client_name', '=', $filters["client_name"]);
            }

            if($filters["employee_name"]) {
                $query->where('employee_name', '=', $filters["employee_name"]);
            }

        })
        ->orderBy('quote_date', 'desc')
        ->paginate();

        return $results;
    }
}
