<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateQuoteRequest;
use Illuminate\Support\Str;
use App\Quote;

class QuoteController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::all();

        return view('pages.index', [
            'quotes' => $quotes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateQuoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateQuoteRequest $request)
    {
        $data = $request->except('quote_description');
        $data += ['quote_id' => Str::random(9)];
        $data += ['quote_description' => str_replace(chr(34), chr(39), $request->quote_description)];
        Quote::create($data);

        return redirect()->route('orcamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quote = Quote::where('quote_id', $id)->first();
        return view('pages.show', ['quote' => $quote]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::where('quote_id', $id)->first();
        return view('pages.edit', ['quote' => $quote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Quote::where('quote_id', $id)->delete();
        $data += ['quote_id' => $id];
        $data += ['quote_description' => str_replace(chr(34), chr(39), $request->quote_description)];
        Quote::create($data);
        return redirect() -> route('orcamentos.index', ['messages' => "Orçamento de ID $id atualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quote::where('quote_id', $id)->delete();
        return redirect() -> route('orcamentos.index', ['messages' => "Orçamento de ID $id deletado"]);
    }
}
