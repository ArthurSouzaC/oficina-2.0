@extends('main')

@push('title')
    Oficina 2.0 | Home
@endpush

@push('extra-css')
    <style>
        #container {
            width: 100%;
            height: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #container span{
            grid-area: brand;
            color: var(--color-primary-darker);
            font-family: 'Orbitron';
            font-weight: 700;
            font-size: 2.5rem;
        }

        #container a {
            width: 75%;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 2rem;

            border: 1px solid gray;
            background: var(--color-primary);

            color: white;
            font-weight: 700;
            border-radius: 5px;

            transition: 0.2s;
        }

        #container a:hover {
            color: var(--color-primary);
            background: white;
            box-shadow: 2px 2px var(--color-primary-darker);
        }

        @media (min-width: 700px) {
            #container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
                grid-template-areas: 
                    "icon index"
                    "brand create";
            }

            #container img {
                grid-area: icon;
                align-self: flex-end;
                justify-self: center;
            }

            #container span {
                grid-area: brand;
                align-self: flex-start;
                justify-self: center;

            }

            #container a {
                width: 50%;
            }

            #index {
                grid-area: index;
                align-self: flex-end;
                justify-self: flex-start;
            }

            #create {
                grid-area: create;
                align-self: flex-start;
                justify-self: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <div id="container">
        <img id="brand" src="icons8-gear-96.png">
        <span>Oficina 2.0</span>
        <a href="/orcamentos" id="index">Ver lista de orçamentos</a>
        <a href="/orcamentos/create" id="create">Cadastrar novo orçamento</a>
    </div>
@endsection

@push('scripts')
    <script>
        var deg = 0;
        setInterval(() => {
            document.getElementById('brand').style.transform = `rotate(${deg}deg)`
            deg += 6;
        }, 60);
    </script>
@endpush