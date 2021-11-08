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

            ocultar_controles();

            $('#select_tipo_deduccion').change(function() {

                var nodo = $(this).val()

                switch (nodo) {
                    case 'other_deductions':
                        document.getElementById("div_deduction_value").style.display = "block";
                        break;
                    case '':
                }
            });


            $('#select_tipo_devengado').change(function() {
                var nodo = $(this).val()
                switch (nodo) {
                    case 'common_vacation':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                    case 'paid_vacation':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                    case 'maternity_leave':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                    case 'paid_leave':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                    case 'legal_strike':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                }
            });




            $('#add_accrued').click(function(e) {
                e.preventDefault();
                var nodo = document.getElementById("select_tipo_devengado").value;
                var tipo = $('#select_tipo_devengado option:selected').html();

                if (validar_campos(nodo) == false) {
                    return false
                }

                var accrued = JSON.parse(document.getElementById("accrued").value);

                var val_accrueds = Number(document.getElementById("accrued_total").value);

                switch (nodo) {
                    case 'other_concepts':
                        var n_other_concepts = accrued.devengados.other_concepts.length;

                        var val_accrued = Number(document.getElementById("val_accrued").value);
                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_other_concepts);
                        array = {
                            'id': id,
                            'value': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="other_concepts-' + id + '"><td>' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'other_accrueds'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.other_concepts.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'common_vacation':
                        var n_common_vacation = accrued.devengados.common_vacation.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_common_vacation);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="common_vacation-' + id + '"><td>' +
                            tipo + ' Fecha: (' + fechaInicio + ' / ' + fechaFin + ') Dias: ' +
                            cantidad +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'common_vacation'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.common_vacation.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;

                    case 'paid_vacation':
                        var n_paid_vacation = accrued.devengados.paid_vacation.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_paid_vacation);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="common_vacation-' + id + '"><td>' +
                            tipo + ' Fecha: (' + fechaInicio + ' / ' + fechaFin + ') Dias: ' +
                            cantidad +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'common_vacation'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.paid_vacation.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'maternity_leave':
                        var n_maternity_leave = accrued.devengados.maternity_leave.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_maternity_leave);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="maternity_leave-' + id + '"><td>' +
                            tipo + ' Fecha: (' + fechaInicio + ' / ' + fechaFin + ') Dias: ' +
                            cantidad +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'maternity_leave'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.maternity_leave.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'paid_leave':
                        var n_paid_leave = accrued.devengados.paid_leave.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_paid_leave);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="paid_leave-' + id + '"><td>' +
                            tipo + ' Fecha: (' + fechaInicio + ' / ' + fechaFin + ') Dias: ' +
                            cantidad +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'paid_leave'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.paid_leave.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'legal_strike':
                        var n_paid_vacation = accrued.devengados.legal_strike.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_legal_strike);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="legal_strike-' + id + '"><td>' +
                            tipo + ' Fecha: (' + fechaInicio + ' / ' + fechaFin + ') Dias: ' +
                            cantidad +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'legal_strike'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.legal_strike.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                }

                //nada desde aca he revisado

                document.getElementById("accrued_total").value = val_accrueds;
                document.getElementById("accrued").value = JSON.stringify(accrued);

                document.getElementById("tbl_accrueds").tFoot.innerHTML =
                    '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i> $' +
                    parseFloat(val_accrueds, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                    .toString() + '</th></tr>';

                ocultar_controles();
                recalcular_total();
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
                $('#select_tipo_devengado').val('');
                //devengados
                document.getElementById("div_rango_fecha_a").style.display = "none";
                document.getElementById("div_accrued_value").style.display = "none";
                document.getElementById("div_add_accrueds").style.display = "none";
                document.getElementById("div_quantity_a").style.display = "none";

                document.getElementById("start_date_a").value = "";
                document.getElementById("end_date_a").value = "";
                document.getElementById("quantity_a").value = "";
                document.getElementById("val_accrued").value = "";


                //deducciones
                document.getElementById("div_deduction_value").style.display = "none";
                document.getElementById("div_add_deductions").style.display = "none";
                document.getElementById("val_deduction").value = "";
            }

        });

        function validar_campos(nodo) {
            switch (nodo) {
                case 'other_deductions': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'common_vacation': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 && cantidad <= 0 && fechaInicio != "" && fechaFin != "") {
                        return false
                    }
                    break;
                case 'paid_vacation': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 && cantidad <= 0 && fechaInicio != "" && fechaFin != "") {
                        return false
                    }
                    break;
                case 'maternity_leave': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 && cantidad <= 0 && fechaInicio != "" && fechaFin != "") {
                        return false
                    }
                    break;
                case 'paid_leave': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 && cantidad <= 0 && fechaInicio != "" && fechaFin != "") {
                        return false
                    }
                    break;
                case 'legal_strike': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 && cantidad <= 0 && fechaInicio != "" && fechaFin != "") {
                        return false
                    }
                    break;
                case 'other_concepts': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 && cantidad <= 0 && fechaInicio != "" && fechaFin != "") {
                        return false
                    }
                    break;
            }
        }




        function eliminar_accrued(id, tipo, valor) {
            var val_accrueds = Number(document.getElementById("accrued_total").value);
            var accrued = JSON.parse(document.getElementById("accrued").value);

            switch (tipo) {
                case 'other_concepts':
                    accrued.devengados.other_concepts.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.other_concepts[index].id == id) {
                            accrued.devengados.other_concepts.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("other_concepts-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'common_vacation':
                    accrued.devengados.common_vacation.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.common_vacation[index].id == id) {
                            accrued.devengados.common_vacation.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("common_vacation-" + id);
                    element.parentNode.removeChild(element);

                    break;
                case 'paid_vacation':
                    accrued.devengados.paid_vacation.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.paid_vacation[index].id == id) {
                            accrued.devengados.paid_vacation.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("paid_vacation-" + id);
                    element.parentNode.removeChild(element);

                    break;
                case 'maternity_leave':
                    accrued.devengados.maternity_leave.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.maternity_leave[index].id == id) {
                            accrued.devengados.maternity_leave.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("maternity_leave-" + id);
                    element.parentNode.removeChild(element);

                    break;
                case 'paid_leave':
                    accrued.devengados.paid_leave.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.paid_leave[index].id == id) {
                            accrued.devengados.paid_leave.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("paid_leave-" + id);
                    element.parentNode.removeChild(element);

                    break;
                case 'legal_strike':
                    accrued.devengados.legal_strike.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.legal_strike[index].id == id) {
                            accrued.devengados.legal_strike.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("legal_strike-" + id);
                    element.parentNode.removeChild(element);

                    break;
            }

            document.getElementById("tbl_accrueds").tFoot.innerHTML =
                '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i> $' +
                parseFloat(val_accrueds, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString() + '</th></tr>';

            recalcular_total();

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
            var total_deducido = 0;
            var dias = Number(document.getElementById("worked_days").value);
            var salario_mensual = Number(document.getElementById("salary").value);
            var aux_transporte_mensual = Number(document.getElementById("transportation_allowance_value").value);
            var tiene_aux_transporte_mensual = document.getElementById("transportation_allowance").value;

            var aux_transporte_diario = (aux_transporte_mensual / 30);
            var salario_diario = (salario_mensual / 30)

            var para_deduccion_paraFiscales = 0; //Este total es para calcular la deduccion de pension y salud

            //////////////////// DEVENGADOS/////////////////////////
            var accrued = JSON.parse(document.getElementById("accrued").value);

            accrued.devengados.salary.value = (salario_diario * dias)
            total_devengado = (salario_diario * dias);

            para_deduccion_paraFiscales = (salario_diario * dias);

            var json_common_vacation = accrued.devengados.common_vacation
            var total_common_vacation = json_common_vacation.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            total_devengado += (total_common_vacation)

            para_deduccion_paraFiscales += (total_common_vacation)

            var json_paid_vacation = accrued.devengados.paid_vacation
            var total_paid_vacation = json_paid_vacation.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_paid_vacation)

            para_deduccion_paraFiscales += (total_paid_vacation)

            var json_maternity_leave = accrued.devengados.maternity_leave
            var total_maternity_leave = json_maternity_leave.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            total_devengado += (total_maternity_leave)

            var json_paid_leave = accrued.devengados.paid_leave
            var total_paid_leave = json_paid_leave.reduce((sum, value) => (typeof value.payment == "number" ? sum + value
                .payment : sum), 0);
            total_devengado += (total_paid_leave)

            var json_legal_strike = accrued.devengados.legal_strike
            var total_legal_strike = json_legal_strike.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_legal_strike)

            //var json_other_concepts = accrued.devengados.other_concepts
            //var total_other_concepts = json_other_concepts.reduce((sum, value) => (typeof value.payment == "number" ? sum + value.payment : sum), 0);
            //total_devengado += (total_other_concepts)

            if (accrued.devengados.transportation_allowance.name == "Subsidio Transporte") {
                accrued.devengados.transportation_allowance = {};
                var aux_transporte1 = document.getElementById("aux_transporte1");
                aux_transporte1.parentNode.removeChild(aux_transporte1);
            }

            //Eliminar y agregar fila de salario
            var salario1 = document.getElementById("salario1");
            salario1.parentNode.removeChild(salario1);

            $("#tbl_accrueds>tbody").append('<tr id="salario1"><td>Salario' +
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

                $("#tbl_accrueds>tbody").append('<tr id="aux_transporte1"><td>Subsidio Transporte' +
                    '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                    parseFloat((aux_transporte_diario * dias), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                        "$1,").toString() + '</td>' +
                    '<td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                );
            }

            document.getElementById("accrued_total").value = total_devengado;
            document.getElementById("accrued").value = JSON.stringify(accrued);

            document.getElementById("tbl_accrueds").tFoot.innerHTML =
                '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i> $' +
                parseFloat(total_devengado, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString() + '</th></tr>';

            ////////////////////////DEDUCIDOS///////////////////////////
            var deductions = JSON.parse(document.getElementById("deductions").value);

            var eps = deductions.deducciones.eps_type_law_deduction.name;
            var pension = deductions.deducciones.pension_type_law_deductions.name;
            var eps_percentage = 0;
            var pension_percentage = 0;
            var index_eps = eps.indexOf('% ');
            var index_pension = pension.indexOf('% ');
            var val_eps = 0;
            var val_pension = 0;

            if (index_eps !== -1) {
                var largo = eps.length
                eps_percentage = eps.substring((index_eps + 2), largo);
                val_eps = (para_deduccion_paraFiscales * eps_percentage) / 100;
                deductions.deducciones.eps_type_law_deduction.value = val_eps;

                //Eliminar y agregar fila de eps
                var eps1 = document.getElementById("eps1");
                eps1.parentNode.removeChild(eps1);

                total_deducido = val_eps;

                $("#tbl_deductions>tbody").append('<tr id="eps1"><td>' + deductions.deducciones.eps_type_law_deduction.name +
                    '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                    parseFloat(val_eps, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                        "$1,").toString() + '</td>' +
                    '<td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                );
            }

            if (index_pension !== -1) {
                var largo = pension.length
                pension_percentage = pension.substring((index_pension + 2), largo);
                val_pension = (para_deduccion_paraFiscales * pension_percentage) / 100;
                deductions.deducciones.pension_type_law_deductions.value = val_pension;

                //Eliminar y agregar fila de pension
                var pension1 = document.getElementById("pension1");
                pension1.parentNode.removeChild(pension1);

                total_deducido += val_pension;

                $("#tbl_deductions>tbody").append('<tr id="pension1"><td>' + deductions.deducciones.pension_type_law_deductions.name +
                    '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                    parseFloat(val_eps, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                        "$1,").toString() + '</td>' +
                    '<td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                );
            }


            var json_other_deductions = deductions.deducciones.other_deductions
            var total_other_deductions = json_other_deductions.reduce((sum, value) => (typeof value.value == "number" ?
                sum + value.value : sum), 0);
            total_deducido += (total_other_deductions)


            document.getElementById("deductions_total").value = total_deducido;
            document.getElementById("deductions").value = JSON.stringify(deductions);

            document.getElementById("tbl_deductions").tFoot.innerHTML =
                '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-down" style="font-size:20px;color:#FF267B;"></i> $' +
                parseFloat(total_deducido, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString() + '</th></tr>';

            document.getElementById("payroll_total").value = (total_devengado - total_deducido)
            document.getElementById("payroll_total2").innerHTML = parseFloat((total_devengado - total_deducido), 10)
                .toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString()

        }
    </script>

@endsection
