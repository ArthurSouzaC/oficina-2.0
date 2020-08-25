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

        #container div {
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

        #container div button {
            margin-top: 1rem;
            border-radius: 3px;
            border: 2px solid var(--color-primary-darker);
            width: 6rem;
            height: 2rem;
        }

        #container table td {
            padding: 3px;
        }

        #container #controls {
            display: flex;
            flex-direction: row;
        }

        #container #controls button{
            font-size: 1rem;
            width: 2rem;
        }

        @media (min-width: 700px) {
            #container {
                padding-top: 140px;
                font-size: 1rem;
            }

            #container table {
                width: 90%;
            }

            #container div {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                flex-direction: row;
            }

            #container label {
                margin: auto 1rem;
            }

            #container div button {
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
    <div id="filters">   
        <div>
            <label for="quote_date_initial">Data inicial</label>
            <input id="quote_date_initial" name="quote_date_initial" type="date" value="">
        </div>
        
        <div>
            <label for="quote_date_final">Data final</label>
            <input id="quote_date_final" name="quote_date_final" type="date">
        </div>

        <div>
            <label for="client_name">Nome do cliente</label>
            <input id="client_name" name="client_name" type="text" value="">
        </div>

        <div>
            <label for="employee_name">Nome do vendedor</label>
            <input id="employee_name" name="employee_name" type="text" value="">
        </div>
        
        <button onclick="filter(false)">Filtrar</button>
    </div>
    
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
        </tbody>
    </table>
    <div id="controls">
        <button id="prev" onclick="controls.prev()">&laquo;</button>
        <button id="next" onclick="controls.next()">&raquo;</button>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        let currentDate = new Date();
        let year = currentDate.getFullYear();
        let month = currentDate.getMonth() + 1;
        let day = currentDate.getDate();
        
        if(parseInt(day) < 10) {
            day = `0${day}`;
        }

        if(parseInt(month) < 10) {
            month = `0${month}`;
        }

        const quote_date_initial_filter = document.getElementById('quote_date_initial');
        quote_date_initial_filter.value = `${year}-${month}-${day}`;

        const quote_date_final_filter = document.getElementById('quote_date_final');
        quote_date_final_filter.value = `${year+1}-${month}-${day}`;

        const client_name_filter = document.getElementById('client_name');
        const employee_name_filter = document.getElementById('employee_name');
        const table = document.getElementById('quotes_tbody');
        
        const quotes = <?php echo json_encode($quotes) ?>;
        
        const state = {
            pagesNum: Math.ceil(quotes.length / 10),
            pagesContent: [],
            currentPage: 1
        }
        
        const controls = {
            next: () => {
                if(state.currentPage == state.pagesNum){
                    return;
                } else {
                    state.currentPage++;
                    renderTable(state.currentPage);
                }
                
            },
            prev: () => {
                if(state.currentPage == 1) {
                    return;
                } else {
                    state.currentPage--;
                    renderTable(state.currentPage);
                }
            }
        }

        // Filter quotes according to the selected filter options
        function filter(first) {
            if(!first){
                let html = '';
                let quotesFiltered = quotes;
                
                quotesFiltered = quotes.filter(quote => {
                    
                    let initial_date = new Date(quote_date_initial_filter.value);
                    let final_date = new Date(quote_date_final_filter.value);
                    let date = new Date(quote.quote_date);
                    
                    if(initial_date <= date && date <= final_date){
                        return true;
                    } else {
                        return false;
                    }
                    
                })

                if(client_name_filter.value != '' && employee_name_filter.value == '') {
                    quotesFiltered = quotes.filter(quote => quote.client_name == client_name_filter.value);

                } else if(employee_name_filter.value != '' && client_name_filter.value == '') {
                    quotesFiltered = quotes.filter(quote => quote.employee_name == employee_name.value);

                } else if(client_name_filter.value != '' && employee_name_filter.value != '') {
                    quotesFiltered = quotes.filter(quote => quote.client_name == client_name_filter.value);
                    quotesFiltered = quotesFiltered.filter(quote => quote.employee_name == employee_name.value);

                }
                
                let rows = [];
                quotesFiltered.forEach(quote => {
                    html += '<tr>';
                    html += `<td>${quote.client_name}</td>`;
                    html += `<td>${quote.employee_name}</td>`;
                    html += `<td>${quote.quote_date.split('-')[2]}/${quote.quote_date.split('-')[1]}/${quote.quote_date.split('-')[0]}</td>`;
                    html += `<td style="background: var(--color-primary);color: white;font-weight: 700;"><a href="orcamentos/${quote.quote_id}">Ver</a></td>`;
                    html += '</tr>';

                    rows.push(html);
                    html = '';
                })

                quote_date_initial_filter.value = `${year}-${month}-${day}`;
                quote_date_final_filter.value = `${year+1}-${month}-${day}`;
                client_name_filter.value = '';
                employee_name_filter.value = '';

                state.pagesNum = Math.ceil(rows.length/10)
                state.pagesContent = rows;
            } else {
                bubbleSort(quotes)
                let html = ''
                var rows = [];
                quotes.forEach(quote => {
                    html += '<tr>';
                    html += `<td>${quote.client_name}</td>`;
                    html += `<td>${quote.employee_name}</td>`;
                    html += `<td>${quote.quote_date.split('-')[2]}/${quote.quote_date.split('-')[1]}/${quote.quote_date.split('-')[0]}</td>`;
                    html += `<td style="background: var(--color-primary);color: white;font-weight: 700;"><a href="orcamentos/${quote.quote_id}">Ver</a></td>`;
                    html += '</tr>';

                    rows.push(html);
                    html = '';
                })
                
                state.pagesContent = rows;
                renderTable(1)
            }
        }

        // Sort quotes by date
        function bubbleSort(a) {
            let swapp;
            let n = a.length-1;
            let x=a;
            do {
                swapp = false;
                for (let i=0; i < n; i++){
                    if (isMinorDate(x[i].quote_date,  x[i+1].quote_date)){
                       let temp = x[i];
                       x[i] = x[i+1];
                       x[i+1] = temp;
                       swapp = true;
                    }
                }
                n--;
            } while (swapp);
            return x; 
        }

        // Compare dates
        function isMinorDate(date1, date2) {
            date1 = new Date(date1);
            date2 = new Date(date2);

            if(date1 < date2) {
                return true;
            } else {
                return false;
            }
        }

        function renderTable (currentPage) {
            let items = '';
            for(let i = ((currentPage - 1) * 10); i < (10 * currentPage); i++) {
                if(state.pagesContent[i]){
                    items += state.pagesContent[i];
                }
            }
            table.innerHTML = items;
        }

        filter(true)

        // Toggle filter options
        let collapsed = true;
        const filters = document.getElementById('filters');
        filters.style.display = 'none';
        function toggleFilters() {
            if(collapsed){
                filters.style.display = 'flex';
                collapsed = false;
            } else {
                filters.style.display = 'none';
                collapsed = true;
            }
        }
    </script>
@endpush
