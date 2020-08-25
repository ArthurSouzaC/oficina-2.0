@extends('main')

@push('title')
    Oficina 2.0 | Ver orçamento
@endpush

@push('extra-css')
    <style>
        #container {
            width: 80%;
            margin: auto;
            padding-top: 150px;
            font-size: 0.8rem;
        }
        
        #container span {
            word-wrap: break-word;
        }

        .title {
            font-weight: 700;
        }

        #container button {
            font: 1rem 'Montserrat';
            background: transparent;
            border: none;
            height: 3rem;
            margin-top: 1rem;
            color: #ff0000;
            transition: 0.2s;
        }

        #container button:hover {
            background: #ff0000;
            color: white;
            box-shadow: 2px 2px black;
        }

        #container a {
            font-size: 1rem;
            text-decoration: underline;
            color: var(--color-primary);
        }

        @media (min-width: 700px) {
            #container {
                font-size: 1rem;
            }

        }
        
    </style>
@endpush

@section('content')
    @include('components.header')
    <div id="container">
        <span class="title">ID do orçamento: </span>
        <span>{{$quote->quote_id}}</span>
        <br><br>
        <span class="title">Nome do cliente: </span>
        <span>{{$quote->client_name}}</span>
        <br><br>
        <span class="title">Nome do vendedor: </span>
        <span>{{$quote->employee_name}}</span>
        <br><br>
        <span class="title">Data e hora: </span>
        <span>
            {{explode('-', $quote->quote_date)[2]}}/{{explode('-', $quote->quote_date)[1]}}/{{explode('-', $quote->quote_date)[0]}} &nbsp;às&nbsp;
            {{$quote->quote_time}}
        </span>
        <br><br>
        <span class="title">Descrição do orçamento: </span>
        <span>{{$quote->quote_description}}</span>
        <br><br>
        <span class="title">Valor orçado: </span>
        <span>R$ {{$quote->quoted_value}}</span>
        <br><br>
        <a href="/orcamentos">Voltar</a><br>
        <a href="/orcamentos/{{$quote->quote_id}}/edit">Editar</a>
        <form action="/orcamentos/{{$quote->quote_id}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Deletar orçamento</button>
        </form>
    </div>
@endsection