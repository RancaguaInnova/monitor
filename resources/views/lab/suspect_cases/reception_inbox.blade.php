@extends('layouts.app')

@section('title', 'Bandeja de recepción')

@section('content')

<h3 class="mb-3"><i class="fas fa-lungs-virus"></i> Bandeja de recepción</h3>
<form method="GET" action="{{ route('lab.suspect_cases.reception_inbox') }}">

<div class="row">
    <div class="col-3">
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Exámenes por recepcionar</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td>{{ $suspectCases->count() }} pendientes</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-3">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="ID examen" name="search" id="for_search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon">Buscar</button>
                </div>
            </div>

    </div>
    <div class="col-5">
        @if(Auth::user()->laboratory)
        <h3>Tu Laboratorio: {{ Auth::user()->laboratory->alias }}</h3>
        @else
        <h3 class="text-danger">Usuario no tiene laboratorio asignado</h3>
        @endif
    </div>
</div>
<div class="form-group row">
    <div class="col-3">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Filtrar por Nombre" id="texto">
            </div>
    </div>
    <div class="col-3">
        <select name="establishment_id" id="for_establishment_id" class="form-control">
            <option value=""> Seleccione Establecimiento</option>
            @foreach($establishments as $establishment)
                <option value="{{ $establishment->id }}" {{($establishment->id == $selectedEstablishment) ? 'selected' : '' }}>{{ $establishment->alias }}</option>
            @endforeach
        </select>
    </div>
</div>
</form>






<table class="table table-sm table-bordered table-responsive" id="tabla_casos">
    <thead>
        <tr>
            <th nowrap>° Monitor</th>
            <th></th>
            <th>Fecha muestra</th>
            <th>Establecimiento</th>
            <th>Nombre</th>
            <th>Identificador</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th class="alert-danger">PCR SARS-Cov2</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody id="tableCases">
        @foreach($suspectCases as $case)
        <tr class="row_{{$case->covid19}} {{ ($case->pscr_sars_cov_2 == 'positive')?'table-danger':''}}">
            <td class="text-center">{{ $case->id }}</td>
            <td>
                @if(Auth::user()->laboratory)
                    @can('SuspectCase: reception')
                        <form method="POST" class="form-inline" action="{{ route('lab.suspect_cases.reception', $case) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-primary" title="Recepcionar"><i class="fas fa-inbox"></i></button>
                        </form>
                    @endcan
                @endif
            </td>
            <td nowrap class="small">@date($case->sample_at)</td>
            <td>{{ ($case->establishment) ? $case->establishment->alias : '' }}</td>
            <td>
                @if($case->patient)
                <a class="link" href="{{ route('patients.edit', $case->patient) }}">
                    {{ $case->patient->fullName }}
                </a>
                @endif
            </td>
            <td class="text-center" nowrap>
                @if($case->patient)
                {{ $case->patient->identifier }}
                @endif
            </td>
            <td>{{ $case->age }}</td>
            <td>{{ strtoupper($case->gender[0]) }}</td>
            <td>{{ $case->covid19 }}</td>
            <td class="text-muted small">{{ $case->observation }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $suspectCases->appends(request()->query())->links() }}

@endsection

@section('custom_js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

});

function exportF(elem) {
    var table = document.getElementById("tabla_casos");
    var html = table.outerHTML;
    var html_no_links = html.replace(/<a[^>]*>|<\/a>/g, "");//remove if u want links in your table
    var url = 'data:application/vnd.ms-excel,' + escape(html_no_links); // Set your html table into url
    elem.setAttribute("href", url);
    elem.setAttribute("download", "casos_sospecha_laboratorio_hetg.xls"); // Choose the file name
    return false;
}
</script>

<script>

    $(document).ready(function () {
        $("#texto").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tableCases tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>


@endsection
