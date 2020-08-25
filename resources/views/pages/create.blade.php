@extends('main')

@push('title')
    Oficina 2.0 | Registrar orçamento
@endpush

@push('extra-css')
    <style>
        #container {
            width: 100%;
            margin-top: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #container form {
            display: flex;
            flex-direction: column;
        }

        #container form input {
            height: 2rem;   
            border-radius: 5px;
            border: 1px solid var(--color-primary-darker);
        }

        #container form label {
            margin-top: 1rem;
            margin-bottom: 0.2rem;
            color: var(--color-primary);
        }

        #container form fieldset {
            border: 1px solid var(--color-primary-darker);
            display: flex;
            flex-direction: column;
            color: var(--color-primary);
            padding-left: 1rem;
            margin-top: 1rem;
        }

        #container form fieldset input {
            color: var(--color-primary);
            padding: 2px;
            margin: 1rem auto;
        }

        #container form button {
            margin: 2rem auto;
            width: 40%;
            height: 3rem;
            
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;

            border: 1px solid gray;
            background: var(--color-primary);

            color: white;
            font-weight: 700;
            border-radius: 5px;

            transition: 0.2s;
        }

        #container form button:hover {
            color: var(--color-primary);
            background: white;
            box-shadow: 2px 2px var(--color-primary-darker);
        }
        
        #container ul {
            width: 100%;
            list-style: none;
        }

        #container li {
            margin-top: 10px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #container form input::-webkit-outer-spin-button,
        #container form input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #container form input[type=number] {
            -moz-appearance: textfield;
        }

        @media (min-width: 700px) {
            #container form {
                width: 60%;
            }

            #container form fieldset {
               display: inline;
               align-items: center;
            }

            #container form button {
                font-size: 1.2rem;
            }

            #container ul {
                width: 60%;
            }
        }
    </style>
@endpush

@section('content')
    @include('components.header')
    <div id="container">
        @if ($errors->any())
            <ul>
            @foreach ($errors->all() as $error)
                <li>
                    @include('components.alert', ['alert' => $error])
                </li>
            @endforeach
            </ul>
        @endif
        <form action="/orcamentos" method="post">       
            @csrf
            <label for="client_name">Nome completo do cliente</label>
            <input type="text" name="client_name" id="client_name-field" value="{{old('client_name')}}" required>

            <label for="employee_name">Nome completo do vendedor</label>
            <input type="text" name="employee_name" id="employee_name-field" value="{{old('employee_name')}}" required>

            <fieldset>
                <legend>Data e hora</legend>
                <input type="date" name="quote_date" id="quote_date-field" value="{{old('quote_date')}}" required>
                <input type="time" name="quote_time" id="quote_time-field" value="{{old('quote_time')}}" required>
            </fieldset>

            <label for="quote_description">Descrição do orçamento</label>
            <textarea name="quote_description" id="quote_description-field" cols="30" rows="10" style="resize: none;" required>{{old('quote_description')}}</textarea>

            <label for="quoted_value">Valor orçado</label>
            <span>R$ <input type="number" step="any" name="quoted_value" id="quoted_value-field" value="{{old('quoted_value')}}" required></span>

            <button type="submit">Cadastrar</button>
        </form>  
    </div>
@endsection