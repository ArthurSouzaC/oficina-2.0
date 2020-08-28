@extends('main')

@push('title')
    Oficina 2.0 | Listagem de orçamentos
@endpush

@push('extra-css')
    <style>
        #container {
            width: 100%;
            padding-top: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        #container table {
            width: 100%;
            border: 2px solid var(--color-primary-darker);
            margin-top: 3rem;
        }

        #container table td,
        #container table th {
            border: 1px solid var(--color-primary);
            padding: 3px;
        }

        #container form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #container div div {
            padding-top: 1rem;
        }

        #container button {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 1rem;
            background: var(--color-primary);
            border: 2px solid var(--color-primary-darker);
            width: 10rem;
            height: 2rem;
            color: white;
        }

        #container form button {
            margin-top: 1rem;
            border-radius: 3px;
            border: 2px solid var(--color-primary-darker);
            width: 6rem;
            height: 2rem;
        }

        #container table td {
            padding: 3px;
        }

        #container #controls nav ul{
            display: flex;
            flex-direction: row;
            list-style-type: none;
        }

        #container #controls nav li{
            margin: 10px 0 10px 10px;
        }

        @media (min-width: 700px) {
            #container {
                padding-top: 140px;
                font-size: 1rem;
            }

            #container table {
                width: 90%;
            }

            #container form {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                flex-direction: row;
            }

            #container label {
                margin: auto 1rem;
            }

            #container form button {
                margin-left: 1rem;
            }
        }
    </style>
@endpush

@section('content')
@include('components.header')
<div id="container">
    <button onclick="toggleFilters()">
        Mostrar filtros
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-funnel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
        </svg>
    </button>
    <form action="/orcamentos/search" method="post" id="filters">
        @csrf
        <div>
            <label for="quote_date_initial">Data inicial</label>
            <input name="quote_date_initial" type="date" value="">
        </div>
        
        <div>
            <label for="quote_date_final">Data final</label>
            <input name="quote_date_final" type="date">
        </div>

        <div>
            <label for="client_name">Nome do cliente</label>
            <input name="client_name" type="text" value="">
        </div>

        <div>
            <label for="employee_name">Nome do vendedor</label>
            <input name="employee_name" type="text" value="">
        </div>
        
        <button>Filtrar</button>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="quotes_tbody">
            @foreach ($quotes as $quote)
                <tr>
                    <td>{{$quote->client_name}}</td>
                    <td>{{$quote->employee_name}}</td>
                    <td>{{explode('-', $quote->quote_date)[2]}}/{{explode('-', $quote->quote_date)[1]}}/{{explode('-', $quote->quote_date)[0]}}</td>
                    <td style="background: var(--color-primary);color: white;font-weight: 700;"><a href="orcamentos/{{$quote->quote_id}}">Ver</a></td>
                </tr>
            @endforeach 
        </tbody>
    </table>
    <div id="controls">
        {{$quotes->links()}}
    </div>
</div>
@endsection

@push('scripts')
@endpush
