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

     /**
     *  Filter the quotes according to the request
     *  
     *  @param Illuminate\Http\Request
     *  @return array
     */
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

     /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index() {
        return $this->orderBy('quote_date', 'desc')->paginate(10);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param array
     * @return void
     */
    public function updateQuote($data) {
        $this->create($data);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function deleteQuote($id) {
        $this->where('quote_id', $id)->delete();
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function getQuote($id) {
        return $this->where('quote_id', $id)->first();
    }
}
