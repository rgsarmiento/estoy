@extends('layouts.app')

@section('title')
    Modificar Comprobante
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Modificar Comprobante</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('payrolls.index') }}">Comprobantes</a></div>
                <div class="breadcrumb-item">Modificar Comprobante</div>
            </div>
        </div>
        <div class="section-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show alert-has-icon p-4" role="alert">
                    <div class="alert-icon"><i class="fa fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Oh, no!</div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {!! Form::model($payroll, ['method' => 'PUT', 'route' => ['payrolls.update', $payroll->id]]) !!}
            @include('payrolls._form')
            {!! Form::close() !!}
        </div>
    </section>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            document.getElementById("div_deduction_value").style.display = "none";

            $('#select_tipo_deduccion').change(function() {

                var nodo = $(this).val()

                switch (nodo) {
                    case 'other_deductions':
                        document.getElementById("div_deduction_value").style.display = "block";
                        break;
                    case '':
                }
            });

            $('#add_deductions').click(function(e) {
                e.preventDefault();
                var nodo = document.getElementById("select_tipo_deduccion").value;
                var tipo = $('#select_tipo_deduccion option:selected').html();

                if (validar_campos(nodo) == false) {
                    return false
                }

                var deductions = JSON.parse(document.getElementById("deductions").value);

                switch (nodo) {
                    case 'other_deductions':
                        var n_other_deductions = deductions.deducciones.other_deductions.length;
                        var other_deductions = deductions.deducciones.other_deductions;

                        break;
                    case '':
                }

                var val_deduction = Number(document.getElementById("val_deduction").value);
                var val_deductions = Number(document.getElementById("deductions_total").value);

                switch (nodo) {
                    case 'other_deductions':
                        var n_other_deductions = deductions.deducciones.other_deductions.length;
                        var other_deductions = deductions.deducciones.other_deductions;
                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_other_deductions);
                        array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };


                        $("#tbl_deductions>tbody").append('<tr id="other_deductions-' + id + '"><td>' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'other_deductions'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        deductions.deducciones.other_deductions.push(array);

                        break;
                    case '':
                }

                {{-- calculos totales --}}
                val_deductions = (val_deductions + val_deduction);
                document.getElementById("deductions_total").value = val_deductions;
                document.getElementById("deductions").value = JSON.stringify(deductions);

                document.getElementById("tbl_deductions").tFoot.innerHTML =
                    '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-down" style="font-size:20px;color:#FF267B;"></i> $' +
                    parseFloat(val_deductions, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                    .toString() + '</th></tr>';

                ocultar_controles();
                recalcular_total();
            });

            $('#btn_recalcular').click(function(e) {
                recalcular_total();
            });

            function ocultar_controles() {

                $('#select_tipo_deduccion').val('');

                document.getElementById("div_deduction_value").style.display = "none";
                document.getElementById("val_deduction").value = "";
            }



        });

        function validar_campos(nodo) {
            switch (nodo) {
                case 'other_deductions':
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case '':
            }
        }


        function eliminar_deduccion(id, tipo, valor) {
            var val_deductions = Number(document.getElementById("deductions_total").value);
            var deductions = JSON.parse(document.getElementById("deductions").value);

            switch (tipo) {
                case 'other_deductions':

                    deductions.deducciones.other_deductions.forEach(function(currentValue, index, arr) {
                        if (deductions.deducciones.other_deductions[index].id == id) {
                            deductions.deducciones.other_deductions.splice(index, 1);
                        }
                    })

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);

                    var element = document.getElementById("other_deductions-" + id);
                    element.parentNode.removeChild(element);

                    document.getElementById("tbl_deductions").tFoot.innerHTML =
                        '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-down" style="font-size:20px;color:#FF267B;"></i> $' +
                        parseFloat(val_deductions, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                        .toString() + '</th></tr>';
                    break;
                case '':
            }
            recalcular_total();

        }

        function recalcular_total() {
            var total_devengado = 0;
            var total_deducido = document.getElementById("deductions_total").value;
            var dias = Number(document.getElementById("worked_days").value);
            var salario_mensual = Number(document.getElementById("salary").value);
            var aux_transporte_mensual = Number(document.getElementById("transportation_allowance_value").value);
            var tiene_aux_transporte_mensual = document.getElementById("transportation_allowance").value;

            var aux_transporte_diario = (aux_transporte_mensual / 30);
            var salario_diario = (salario_mensual / 30)

            var val_accrued = Number(document.getElementById("accrued_total").value);
            var accrued = JSON.parse(document.getElementById("accrued").value);

            accrued.devengados.salary.value = (salario_diario * dias)
            total_devengado = (salario_diario * dias);


            if (accrued.devengados.transportation_allowance.name == "Subsidio Transporte") {
                accrued.devengados.transportation_allowance = {};
                var aux_transporte1 = document.getElementById("aux_transporte1");
                aux_transporte1.parentNode.removeChild(aux_transporte1);
            }

            {{-- Eliminar y agregar fila de salario --}}
            var salario1 = document.getElementById("salario1");
            salario1.parentNode.removeChild(salario1);

            $("#tbl_accrued>tbody").append('<tr id="salario1"><td>Salario' +
                '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                parseFloat((salario_diario * dias), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                    "$1,").toString() + '</td>' +
                '<td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
            );

            if (tiene_aux_transporte_mensual == "SI") {
                var array = {
                    'value': (aux_transporte_diario * dias),
                    'name': "Subsidio Transporte"
                };
                total_devengado += (aux_transporte_diario * dias);
                Object.assign(accrued.devengados.transportation_allowance, array);

                $("#tbl_accrued>tbody").append('<tr id="aux_transporte1"><td>Subsidio Transporte' +
                    '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                    parseFloat((aux_transporte_diario * dias), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                        "$1,").toString() + '</td>' +
                    '<td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                );
            }

            document.getElementById("accrued_total").value = total_devengado;
            document.getElementById("accrued").value = JSON.stringify(accrued);

            document.getElementById("tbl_accrued").tFoot.innerHTML =
                '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i> $' +
                parseFloat(total_devengado, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString() + '</th></tr>';

            document.getElementById("payroll_total").value = (total_devengado - total_deducido)
            document.getElementById("payroll_total2").innerHTML = parseFloat((total_devengado - total_deducido), 10)
                .toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString()

        }
    </script>

@endsection
