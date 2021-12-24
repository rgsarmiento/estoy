@extends('layouts.app')

@section('title')
    Nomina de Ajuste
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Nomina de Ajuste</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('documents.index') }}">Doc. Emitidos</a></div>
                <div class="breadcrumb-item">Nomina de Ajuste</div>
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

            {!! Form::model($document, ['method' => 'PUT', 'route' => ['documents.update', $document->id]]) !!}
            @include('documents._form')
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
                limpiar_controles();
                ocultar_controles();
                switch (nodo) {
                    case 'other_deductions':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'debt':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'withholding_at_source':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'afc':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'cooperative':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'tax_liens':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'supplementary_plan':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'education':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'refund':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                    case 'voluntary_pension':
                        document.getElementById("div_deduction_value").style.display = "block";
                        document.getElementById("div_add_deductions").style.display = "block";
                        break;
                }
            });


            $('#select_tipo_devengado').change(function() {

                var nodo = $(this).val()
                limpiar_controles();
                ocultar_controles();
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
                    case 'non_paid_leave':
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                    case 'legal_strike':
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        break;
                    case 'HEDs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'HENs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'HRNs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'HEDDFs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'HRDDFs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'HENDFs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'HRNDFs':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_h_a").style.display = "block";
                        document.getElementById("div_rango_fecha_h_a").style.display = "block";
                        break;
                    case 'work_disabilities':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        document.getElementById("div_rango_fecha_a").style.display = "block";
                        document.getElementById("div_type_incapacidad_a").style.display = "block";
                        break;
                    case 'service_bonus':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_quantity_a").style.display = "block";
                        break;
                    case 'severance':
                        document.getElementById("div_accrued_value").style.display = "block";
                        document.getElementById("div_add_accrueds").style.display = "block";
                        document.getElementById("div_accrued_intereses").style.display = "block";
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
                            'PAGO DE ' + tipo +
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
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' DESDE ' + fechaInicio +
                            ' HASTA ' + fechaFin +
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
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' DESDE ' + fechaInicio +
                            ' HASTA ' + fechaFin +
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
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' DESDE ' + fechaInicio +
                            ' HASTA ' + fechaFin +
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
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' DESDE ' + fechaInicio +
                            ' HASTA ' + fechaFin +
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
                    case 'non_paid_leave':
                        var n_non_paid_leave = accrued.devengados.non_paid_leave.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(0);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_non_paid_leave);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="non_paid_leave-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' DESDE ' + fechaInicio +
                            ' HASTA ' + fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'non_paid_leave'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.non_paid_leave.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'legal_strike':
                        var n_legal_strike = accrued.devengados.legal_strike.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(0);

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
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' DESDE ' + fechaInicio +
                            ' HASTA ' + fechaFin +
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
                    case 'HEDs': ///////////////////////////////////////////////////////////////
                        var n_element = accrued.devengados.HEDs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 1,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HEDs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HEDs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HEDs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'HENs':
                        var n_element = accrued.devengados.HENs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 2,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HENs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HENs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HENs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'HRNs':
                        var n_element = accrued.devengados.HRNs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 3,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HRNs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HRNs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HRNs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'HEDDFs':
                        var n_element = accrued.devengados.HEDDFs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 4,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HEDDFs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HEDDFs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HEDDFs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'HRDDFs':
                        var n_element = accrued.devengados.HRDDFs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 5,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HRDDFs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HRDDFs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HRDDFs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'HENDFs':
                        var n_element = accrued.devengados.HENDFs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 6,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HENDFs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HENDFs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HENDFs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'HRNDFs':
                        var n_element = accrued.devengados.HRNDFs.length;

                        var fechaInicio = document.getElementById("start_date_h_a").value;
                        var fechaFin = document.getElementById("end_date_h_a").value;
                        var cantidad = Number(document.getElementById("quantity_h_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_time': fechaInicio,
                            'end_time': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo,
                            'percentage': 7,
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="HRNDFs-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' ' + tipo + ' DESDE ' + fechaInicio + ' HASTA ' +
                            fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'HRNDFs'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.HRNDFs.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'work_disabilities':
                        var n_element = accrued.devengados.work_disabilities.length;

                        var fechaInicio = document.getElementById("start_date_a").value;
                        var fechaFin = document.getElementById("end_date_a").value;
                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);
                        var val_tipo_incapacidad = document.getElementById("type_incapacidad_a").value;
                        var tipo_incapacidad = $('#type_incapacidad_a option:selected').html();

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'start_date': fechaInicio,
                            'end_date': fechaFin,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo + ' ' + tipo_incapacidad,
                            'type': val_tipo_incapacidad
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="work_disabilities-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo + ' ' + tipo_incapacidad +
                            ' DESDE ' + fechaInicio + ' HASTA ' + fechaFin +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'work_disabilities'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.work_disabilities.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'service_bonus':
                        var n_element = accrued.devengados.service_bonus.length;

                        var cantidad = Number(document.getElementById("quantity_a").value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'quantity': cantidad,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="service_bonus-' + id + '"><td>' +
                            'PAGO DE ' + cantidad + ' DIA(S) DE ' + tipo +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(val_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'service_bonus'," + val_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );

                        accrued.devengados.service_bonus.push(array);
                        val_accrueds = (val_accrueds + val_accrued);
                        break;
                    case 'severance':

                        var n_element = accrued.devengados.severance.length;

                        var intereses = Number(document.getElementById("val_accrued_value_intereses")
                        .value);
                        var porcentaje = Number(document.getElementById("val_accrued_pocentaje_intereses")
                            .value);
                        var val_accrued = Number(document.getElementById("val_accrued").value);
                        var total_accrued = (val_accrued + intereses);

                        var id = (Math.floor(Math.random() * (999 - 100 + 1) + 100) + n_element);
                        array = {
                            'id': id,
                            'percentage': porcentaje,
                            'interest_payment': intereses,
                            'payment': val_accrued,
                            'name': tipo
                        };

                        $("#tbl_accrueds>tbody").append('<tr id="severance-' + id + '"><td>' +
                            'PAGO DE ' + tipo + ' ' + parseFloat(val_accrued, 10).toFixed(2).replace(
                                /(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + ' Y PAGO DE INTERESES A UNA TASA DE ' + porcentaje +
                            '% ' + parseFloat(intereses, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() +
                            '</td><td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i> $' +
                            parseFloat(total_accrued, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_accrued(' + id +
                            ",'severance'," + total_accrued +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        accrued.devengados.severance.push(array);
                        val_accrueds = (val_accrueds + total_accrued);
                        break;
                }


                document.getElementById("accrued_total").value = val_accrueds;
                document.getElementById("accrued").value = JSON.stringify(accrued);

                document.getElementById("tbl_accrueds").tFoot.innerHTML =
                    '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i> $' +
                    parseFloat(val_accrueds, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                    .toString() + '</th></tr>';

                ocultar_controles();
                recalcular_total();
                $('#select_tipo_deduccion').val('');
                $('#select_tipo_devengado').val('');

                var tbl = document.getElementById("tbl_accrueds");
                tbl.scrollIntoView();
            });





            $('#add_deductions').click(function(e) {
                e.preventDefault();
                var nodo = document.getElementById("select_tipo_deduccion").value;
                var tipo = $('#select_tipo_deduccion option:selected').html();

                if (validar_campos(nodo) == false) {
                    return false
                }

                var deductions = JSON.parse(document.getElementById("deductions").value);
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


                        $("#tbl_deductions>tbody").append('<tr id="other_deductions-' + id +
                            '"><td>DESCUENTO POR ' +
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
                    case 'debt':
                        var id = 3;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.debt, array);

                        var debt = document.getElementById("debt-3");
                        if (debt) {
                            debt.parentNode.removeChild(debt);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="debt-' + id + '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'debt'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'voluntary_pension':
                        var id = 4;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.voluntary_pension, array);

                        var voluntary_pension = document.getElementById("voluntary_pension-4");
                        if (voluntary_pension) {
                            voluntary_pension.parentNode.removeChild(voluntary_pension);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="voluntary_pension-' + id +
                            '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'voluntary_pension'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'withholding_at_source':
                        var id = 9;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.withholding_at_source, array);

                        var withholding_at_source = document.getElementById("withholding_at_source-9");
                        if (withholding_at_source) {
                            withholding_at_source.parentNode.removeChild(withholding_at_source);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="withholding_at_source-' + id +
                            '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'withholding_at_source'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'afc':
                        var id = 1;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.afc, array);

                        var afc = document.getElementById("afc-1");
                        if (afc) {
                            afc.parentNode.removeChild(afc);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="afc-' + id + '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'afc'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'cooperative':
                        var id = 7;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.cooperative, array);

                        var cooperative = document.getElementById("cooperative-7");
                        if (cooperative) {
                            cooperative.parentNode.removeChild(cooperative);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="cooperative-' + id +
                            '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'cooperative'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'tax_liens':
                        var id = 2;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.tax_liens, array);

                        var tax_liens = document.getElementById("tax_liens-2");
                        if (tax_liens) {
                            tax_liens.parentNode.removeChild(tax_liens);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="tax_liens-' + id +
                            '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'tax_liens'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'supplementary_plan':
                        var id = 5;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.supplementary_plan, array);

                        var supplementary_plan = document.getElementById("supplementary_plan-5");
                        if (supplementary_plan) {
                            supplementary_plan.parentNode.removeChild(supplementary_plan);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="supplementary_plan-' + id +
                            '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'supplementary_plan'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'education':
                        var id = 6;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.education, array);

                        var education = document.getElementById("education-6");
                        if (education) {
                            education.parentNode.removeChild(education);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="education-' + id +
                            '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'education'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;
                    case 'refund':
                        var id = 8;
                        var array = {
                            'id': id,
                            'value': val_deduction,
                            'name': tipo
                        };

                        Object.assign(deductions.deducciones.refund, array);

                        var refund = document.getElementById("refund-8");
                        if (refund) {
                            refund.parentNode.removeChild(refund);
                        }

                        $("#tbl_deductions>tbody").append('<tr id="refund-' + id + '"><td>DESCUENTO POR ' +
                            tipo +
                            '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                            parseFloat(val_deduction, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                                "$1,").toString() + '</td>' +
                            '<td><a href="javascript:eliminar_deduccion(' + id +
                            ",'refund'," + val_deduction +
                            ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                        );
                        break;

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
                $('#select_tipo_deduccion').val('');
                $('#select_tipo_devengado').val('');
            });

            $('#btn_recalcular').click(function(e) {
                recalcular_total();
            });

            function ocultar_controles() {

                //devengados
                document.getElementById("div_rango_fecha_a").style.display = "none";
                document.getElementById("div_accrued_value").style.display = "none";
                document.getElementById("div_add_accrueds").style.display = "none";
                document.getElementById("div_quantity_a").style.display = "none";

                document.getElementById("div_quantity_h_a").style.display = "none";
                document.getElementById("div_rango_fecha_h_a").style.display = "none";

                document.getElementById("div_type_incapacidad_a").style.display = "none";

                document.getElementById("div_accrued_intereses").style.display = "none";



                //deducciones
                document.getElementById("div_deduction_value").style.display = "none";
                document.getElementById("div_add_deductions").style.display = "none";

                limpiar_controles();
            }

            function limpiar_controles() {
                //devengados
                document.getElementById("start_date_a").value = "";
                document.getElementById("end_date_a").value = "";
                document.getElementById("quantity_a").value = "";
                document.getElementById("val_accrued").value = "";

                document.getElementById("start_date_h_a").value = "";
                document.getElementById("end_date_h_a").value = "";
                document.getElementById("quantity_h_a").value = "";

                document.getElementById("val_accrued_pocentaje_intereses").value = "";
                document.getElementById("val_accrued_value_intereses").value = "";

                //deducciones
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
                case 'voluntary_pension': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'withholding_at_source': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'afc': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'cooperative': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'tax_liens': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'supplementary_plan': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'education': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'refund': //deducido
                    var val_deduction = Number(document.getElementById("val_deduction").value);
                    if (val_deduction <= 0) {
                        return false
                    }
                    break;
                case 'debt': //deducido
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
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'paid_vacation': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'maternity_leave': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'paid_leave': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'non_paid_leave': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    if (cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'legal_strike': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    if (cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'other_concepts': //devengado
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HEDs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HENs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HRNs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HEDDFs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HRDDFs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HENDFs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'HRNDFs':
                    var fechaInicio = document.getElementById("start_date_h_a").value;
                    var fechaFin = document.getElementById("end_date_h_a").value;
                    var cantidad = Number(document.getElementById("quantity_h_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin.length == 0) {
                        return false
                    }
                    break;
                case 'work_disabilities':
                    var val_tipo_incapacidad = document.getElementById("type_incapacidad_a").value;
                    var fechaInicio = document.getElementById("start_date_a").value;
                    var fechaFin = document.getElementById("end_date_a").value;
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (val_tipo_incapacidad <= 0 || valor <= 0 || cantidad <= 0 || fechaInicio.length == 0 || fechaFin
                        .length == 0) {
                        return false
                    }
                    break;
                case 'service_bonus':
                    var cantidad = Number(document.getElementById("quantity_a").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || cantidad <= 0) {
                        return false
                    }
                    break;
                case 'severance':
                    var porcentaje = Number(document.getElementById("val_accrued_pocentaje_intereses").value);
                    var intereses = Number(document.getElementById("val_accrued_value_intereses").value);
                    var valor = Number(document.getElementById("val_accrued").value);
                    if (valor <= 0 || intereses <= 0 || porcentaje <= 0) {
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
                case 'non_paid_leave':
                    accrued.devengados.non_paid_leave.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.non_paid_leave[index].id == id) {
                            accrued.devengados.non_paid_leave.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("non_paid_leave-" + id);
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
                case 'HEDs':
                    accrued.devengados.HEDs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HEDs[index].id == id) {
                            accrued.devengados.HEDs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HEDs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'HENs':
                    accrued.devengados.HENs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HENs[index].id == id) {
                            accrued.devengados.HENs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HENs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'HRNs':
                    accrued.devengados.HRNs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HRNs[index].id == id) {
                            accrued.devengados.HRNs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HRNs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'HEDDFs':
                    accrued.devengados.HEDDFs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HEDDFs[index].id == id) {
                            accrued.devengados.HEDDFs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HEDDFs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'HRDDFs':
                    accrued.devengados.HRDDFs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HRDDFs[index].id == id) {
                            accrued.devengados.HRDDFs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HRDDFs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'HENDFs':
                    accrued.devengados.HENDFs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HENDFs[index].id == id) {
                            accrued.devengados.HENDFs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HENDFs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'HRNDFs':
                    accrued.devengados.HRNDFs.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.HRNDFs[index].id == id) {
                            accrued.devengados.HRNDFs.splice(index, 1);
                        }
                    })
                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("HRNDFs-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'work_disabilities':
                    accrued.devengados.work_disabilities.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.work_disabilities[index].id == id) {
                            accrued.devengados.work_disabilities.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("work_disabilities-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'service_bonus':
                    accrued.devengados.service_bonus.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.service_bonus[index].id == id) {
                            accrued.devengados.service_bonus.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("service_bonus-" + id);
                    element.parentNode.removeChild(element);
                    break;
                case 'severance':
                    accrued.devengados.severance.forEach(function(currentValue, index, arr) {
                        if (accrued.devengados.severance[index].id == id) {
                            accrued.devengados.severance.splice(index, 1);
                        }
                    })

                    val_accrueds = (val_accrueds - valor);
                    document.getElementById("accrued_total").value = val_accrueds;
                    document.getElementById("accrued").value = JSON.stringify(accrued);

                    var element = document.getElementById("severance-" + id);
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
                case 'eps_type_law_deduction':
                    deductions.deducciones.eps_type_law_deduction = {};
                    var element = document.getElementById("eps_type_law_deduction-" + id);
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'pension_type_law_deductions':
                    deductions.deducciones.pension_type_law_deductions = {};
                    var element = document.getElementById("pension_type_law_deductions-" + id);
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
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

                    {{-- document.getElementById("tbl_deductions").tFoot.innerHTML =
                        '<tr align="center"><th>TOTAL</th><th colspan="2"><i class="fa fa-sort-down" style="font-size:20px;color:#FF267B;"></i> $' +
                        parseFloat(val_deductions, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                        .toString() + '</th></tr>'; --}}
                    break;
                case 'debt':
                    deductions.deducciones.debt = {};
                    var element = document.getElementById("debt-3");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'voluntary_pension':
                    deductions.deducciones.voluntary_pension = {};
                    var element = document.getElementById("voluntary_pension-4");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'withholding_at_source':
                    deductions.deducciones.withholding_at_source = {};
                    var element = document.getElementById("withholding_at_source-9");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'afc':
                    deductions.deducciones.afc = {};
                    var element = document.getElementById("afc-1");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'cooperative':
                    deductions.deducciones.cooperative = {};
                    var element = document.getElementById("cooperative-7");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'tax_liens':
                    deductions.deducciones.tax_liens = {};
                    var element = document.getElementById("tax_liens-2");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'supplementary_plan':
                    deductions.deducciones.supplementary_plan = {};
                    var element = document.getElementById("supplementary_plan-5");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'education':
                    deductions.deducciones.education = {};
                    var element = document.getElementById("education-6");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;
                case 'refund':
                    deductions.deducciones.refund = {};
                    var element = document.getElementById("refund-8");
                    element.parentNode.removeChild(element);

                    val_deductions = (val_deductions - valor);
                    document.getElementById("deductions_total").value = val_deductions;
                    document.getElementById("deductions").value = JSON.stringify(deductions);
                    break;

            }
            recalcular_total();
        }



        function recalcular_total() {
            var total_devengado = 0;
            var total_deducido = 0;
            var tipo_empleado = Number(document.getElementById("type_worker_id").value);
            var dias = Number(document.getElementById("worked_days").value);
            var salario_mensual = Number(document.getElementById("salary").value);
            var aux_transporte_mensual = Number(document.getElementById("transportation_allowance_value").value);
            var tiene_aux_transporte_mensual = document.getElementById("transportation_allowance").value;

            var aux_transporte_diario = (aux_transporte_mensual / 30);
            var salario_diario = (salario_mensual / 30)

            var base_eps_concepts_parafiscal = 0;
            var base_pension_concepts_parafiscal = 0; //Este total es para calcular la deduccion de pension y salud
            var concepts_parafiscal = JSON.parse(document.getElementById("concepts_parafiscal").value);
            //////////////////// DEVENGADOS/////////////////////////
            var accrued = JSON.parse(document.getElementById("accrued").value);
            ///////////Salario/////////////
            accrued.devengados.salary.value = (salario_diario * dias)
            total_devengado = (salario_diario * dias);

            if (tipo_empleado == 27) {
                if (concepts_parafiscal.concepts.salary.eps == 1) {
                    if (dias >= 1 && dias <= 7) {
                        base_eps_concepts_parafiscal = (salario_mensual / 4);
                    }
                    if (dias >= 8 && dias <= 14) {
                        base_eps_concepts_parafiscal = (salario_mensual / 2);
                    }
                    if (dias >= 15 && dias <= 21) {
                        base_eps_concepts_parafiscal = salario_mensual - (salario_mensual / 4);
                    }
                    if (dias > 21) {
                        base_eps_concepts_parafiscal = salario_mensual;
                    }
                }
                if (concepts_parafiscal.concepts.salary.pension == 1) {
                    if (dias >= 1 && dias <= 7) {
                        base_pension_concepts_parafiscal = (salario_mensual / 4);
                    }
                    if (dias >= 8 && dias <= 14) {
                        base_pension_concepts_parafiscal = (salario_mensual / 2);
                    }
                    if (dias >= 15 && dias <= 21) {
                        base_pension_concepts_parafiscal = salario_mensual - (salario_mensual / 4);
                    }
                    if (dias > 21) {
                        base_pension_concepts_parafiscal = salario_mensual;
                    }
                }
            } else {
                base_eps_concepts_parafiscal = (salario_diario * dias);
                base_pension_concepts_parafiscal = (salario_diario * dias);
            }
            ////////////Vacaciones Comunes/////////////
            var json_common_vacation = accrued.devengados.common_vacation
            var total_common_vacation = json_common_vacation.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            total_devengado += (total_common_vacation)

            if (concepts_parafiscal.concepts.common_vacation.eps == 1) {
                base_eps_concepts_parafiscal += (total_common_vacation)
            }
            if (concepts_parafiscal.concepts.common_vacation.pension == 1) {
                base_pension_concepts_parafiscal += (total_common_vacation)
            }
            ////////////Vacaciones Compensadas/////////////
            var json_paid_vacation = accrued.devengados.paid_vacation
            var total_paid_vacation = json_paid_vacation.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_paid_vacation)

            if (concepts_parafiscal.concepts.paid_vacation.eps == 1) {
                base_eps_concepts_parafiscal += (total_paid_vacation)
            }
            if (concepts_parafiscal.concepts.paid_vacation.pension == 1) {
                base_pension_concepts_parafiscal += (total_paid_vacation)
            }
            ///////////Licencia de Materinidad//////////
            var json_maternity_leave = accrued.devengados.maternity_leave
            var total_maternity_leave = json_maternity_leave.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            total_devengado += (total_maternity_leave)

            if (concepts_parafiscal.concepts.maternity_leave.eps == 1) {
                base_eps_concepts_parafiscal += (total_maternity_leave)
            }
            if (concepts_parafiscal.concepts.maternity_leave.pension == 1) {
                base_pension_concepts_parafiscal += (total_maternity_leave)
            }
            //////////Licencia Remunerada///////////
            var json_paid_leave = accrued.devengados.paid_leave
            var total_paid_leave = json_paid_leave.reduce((sum, value) => (typeof value.payment == "number" ? sum + value
                .payment : sum), 0);
            total_devengado += (total_paid_leave)

            if (concepts_parafiscal.concepts.paid_leave.eps == 1) {
                base_eps_concepts_parafiscal += (total_paid_leave)
            }
            if (concepts_parafiscal.concepts.paid_leave.pension == 1) {
                base_pension_concepts_parafiscal += (total_paid_leave)
            }
            //////////Licencia no Remunerada///////////
            //estas no tienen un valor para sumar o restar

            ///////////Huelgas Legales//////////
            var json_legal_strike = accrued.devengados.legal_strike
            var total_legal_strike = json_legal_strike.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_legal_strike)

            if (concepts_parafiscal.concepts.legal_strike.eps == 1) {
                base_eps_concepts_parafiscal += (total_legal_strike)
            }
            if (concepts_parafiscal.concepts.legal_strike.pension == 1) {
                base_pension_concepts_parafiscal += (total_legal_strike)
            }

            //Horas extras
            //////////HEDs//////////////
            var json_HEDs = accrued.devengados.HEDs
            var total_HEDs = json_HEDs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HEDs)

            if (concepts_parafiscal.concepts.HEDs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HEDs)
            }
            if (concepts_parafiscal.concepts.HEDs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HEDs)
            }

            var json_HENs = accrued.devengados.HENs
            var total_HENs = json_HENs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HENs)

            if (concepts_parafiscal.concepts.HENs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HENs)
            }
            if (concepts_parafiscal.concepts.HENs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HENs)
            }

            var json_HRNs = accrued.devengados.HRNs
            var total_HRNs = json_HRNs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HRNs)

            if (concepts_parafiscal.concepts.HRNs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HRNs)
            }
            if (concepts_parafiscal.concepts.HRNs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HRNs)
            }

            var json_HEDDFs = accrued.devengados.HEDDFs
            var total_HEDDFs = json_HEDDFs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HEDDFs)

            if (concepts_parafiscal.concepts.HEDDFs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HEDDFs)
            }
            if (concepts_parafiscal.concepts.HEDDFs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HEDDFs)
            }

            var json_HRDDFs = accrued.devengados.HRDDFs
            var total_HRDDFs = json_HRDDFs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HRDDFs)

            if (concepts_parafiscal.concepts.HRDDFs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HRDDFs)
            }
            if (concepts_parafiscal.concepts.HRDDFs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HRDDFs)
            }

            var json_HENDFs = accrued.devengados.HENDFs
            var total_HENDFs = json_HENDFs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HENDFs)

            if (concepts_parafiscal.concepts.HENDFs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HENDFs)
            }
            if (concepts_parafiscal.concepts.HENDFs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HENDFs)
            }

            var json_HRNDFs = accrued.devengados.HRNDFs
            var total_HRNDFs = json_HRNDFs.reduce((sum, value) => (typeof value.payment == "number" ? sum +
                value.payment : sum), 0);
            total_devengado += (total_HRNDFs)

            if (concepts_parafiscal.concepts.HRNDFs.eps == 1) {
                base_eps_concepts_parafiscal += (total_HRNDFs)
            }
            if (concepts_parafiscal.concepts.HRNDFs.pension == 1) {
                base_pension_concepts_parafiscal += (total_HRNDFs)
            }
            //////Incapacidad////////
            var json_work_disabilities = accrued.devengados.work_disabilities
            var total_work_disabilities = json_work_disabilities.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            total_devengado += (total_work_disabilities)

            if (concepts_parafiscal.concepts.work_disabilities.eps == 1) {
                base_eps_concepts_parafiscal += (total_work_disabilities)
            }
            if (concepts_parafiscal.concepts.work_disabilities.pension == 1) {
                base_pension_concepts_parafiscal += (total_work_disabilities)
            }
            //////Primas////////
            var json_service_bonus = accrued.devengados.service_bonus
            var total_service_bonus = json_service_bonus.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            total_devengado += (total_service_bonus)

            if (concepts_parafiscal.concepts.service_bonus.eps == 1) {
                base_eps_concepts_parafiscal += (total_service_bonus)
            }
            if (concepts_parafiscal.concepts.service_bonus.pension == 1) {
                base_pension_concepts_parafiscal += (total_service_bonus)
            }
            //////Cesantias////////
            var json_severance = accrued.devengados.severance
            var cesantias_value = json_severance.reduce((sum, value) => (typeof value.payment == "number" ?
                sum + value.payment : sum), 0);
            var intereses_cesantias_value = json_severance.reduce((sum, value) => (typeof value.interest_payment == "number" ?
                sum + value.interest_payment : sum), 0);
            
            var total_severance = (cesantias_value + intereses_cesantias_value)
            total_devengado += (total_severance)

            if (concepts_parafiscal.concepts.severance.eps == 1) {
                base_eps_concepts_parafiscal += (total_severance)
            }
            if (concepts_parafiscal.concepts.severance.pension == 1) {
                base_pension_concepts_parafiscal += (total_severance)
            }


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

                if (concepts_parafiscal.concepts.transportation_allowance.eps == 1) {
                    base_eps_concepts_parafiscal += (aux_transporte_diario * dias)
                }
                if (concepts_parafiscal.concepts.transportation_allowance.pension == 1) {
                    base_pension_concepts_parafiscal += (aux_transporte_diario * dias)
                }

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
            var eps_percentage = 0;
            var val_eps = 0;

            if (eps) {
                var index_eps = eps.indexOf('% ');

                if (index_eps !== -1) {
                    var largo = eps.length
                    eps_percentage = eps.substring((index_eps + 2), largo);
                    val_eps = (base_eps_concepts_parafiscal * eps_percentage) / 100;
                    deductions.deducciones.eps_type_law_deduction.value = val_eps;
                    id = deductions.deducciones.eps_type_law_deduction.id

                    //Eliminar y agregar fila de eps
                    var eps_type_law_deduction = document.getElementById('eps_type_law_deduction-' + id);
                    eps_type_law_deduction.parentNode.removeChild(eps_type_law_deduction);

                    total_deducido = val_eps;
                    var strnode = "'Na'";

                    $("#tbl_deductions>tbody").append('<tr id="eps_type_law_deduction-' + id +
                        '"><td>DEDUCCION CORRESPONDIENTE A ' + deductions.deducciones
                        .eps_type_law_deduction
                        .name +
                        '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                        parseFloat(val_eps, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                            "$1,").toString() + '</td>' +
                        '<td><a href="javascript:eliminar_deduccion(' + id + ',' + strnode + ',' + val_eps +
                        ')" class="btn btn-icon disabled btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                    );
                }
            }


            var pension = deductions.deducciones.pension_type_law_deductions.name;
            var pension_percentage = 0;
            var val_pension = 0;

            if (pension) {
                var index_pension = pension.indexOf('% ');

                if (index_pension !== -1) {
                    var largo = pension.length
                    pension_percentage = pension.substring((index_pension + 2), largo);
                    val_pension = (base_pension_concepts_parafiscal * pension_percentage) / 100;
                    deductions.deducciones.pension_type_law_deductions.value = val_pension;
                    id = deductions.deducciones.pension_type_law_deductions.id
                    //Eliminar y agregar fila de pension
                    var pension_type_law_deductions = document.getElementById('pension_type_law_deductions-' + id);
                    pension_type_law_deductions.parentNode.removeChild(pension_type_law_deductions);

                    total_deducido += val_pension;
                    var strnode = "'Na'";

                    $("#tbl_deductions>tbody").append('<tr id="pension_type_law_deductions-' + id +
                        '"><td>DEDUCCION CORRESPONDIENTE A ' + deductions
                        .deducciones
                        .pension_type_law_deductions.name +
                        '</td><td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i> $' +
                        parseFloat(val_pension, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                            "$1,").toString() + '</td>' +
                        '<td><a href="javascript:eliminar_deduccion(' + id + ',' + strnode + ',' + val_pension +
                        ')" class="btn btn-icon disabled btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                    );
                }
            }

            var json_other_deductions = deductions.deducciones.other_deductions
            var total_other_deductions = json_other_deductions.reduce((sum, value) => (typeof value.value == "number" ?
                sum + value.value : sum), 0);
            total_deducido += (total_other_deductions)

            if (deductions.deducciones.debt.value > 0) {
                var total_debt = deductions.deducciones.debt.value;
                total_deducido += total_debt;
            }

            if (deductions.deducciones.voluntary_pension.value > 0) {
                var total_voluntary_pension = deductions.deducciones.voluntary_pension.value;
                total_deducido += total_voluntary_pension;
            }

            if (deductions.deducciones.withholding_at_source.value > 0) {
                var total_withholding_at_source = deductions.deducciones.withholding_at_source.value;
                total_deducido += total_withholding_at_source;
            }

            if (deductions.deducciones.afc.value > 0) {
                var total_afc = deductions.deducciones.afc.value;
                total_deducido += total_afc;
            }

            if (deductions.deducciones.cooperative.value > 0) {
                var total_cooperative = deductions.deducciones.cooperative.value;
                total_deducido += total_cooperative;
            }

            if (deductions.deducciones.tax_liens.value > 0) {
                var total_tax_liens = deductions.deducciones.tax_liens.value;
                total_deducido += total_tax_liens;
            }

            if (deductions.deducciones.supplementary_plan.value > 0) {
                var total_supplementary_plan = deductions.deducciones.supplementary_plan.value;
                total_deducido += total_supplementary_plan;
            }

            if (deductions.deducciones.education.value > 0) {
                var total_education = deductions.deducciones.education.value;
                total_deducido += total_education;
            }

            if (deductions.deducciones.refund.value > 0) {
                var total_refund = deductions.deducciones.refund.value;
                total_deducido += total_refund;
            }


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

        $("#quantity_h_a").keyup(function() {
            recalcular_horas_extras();
        });

        function recalcular_horas_extras() {
            var nodo = document.getElementById("select_tipo_devengado").value;

            var cantidad = Number(document.getElementById("quantity_h_a").value);
            var salario_mensual = Number(document.getElementById("salary").value);
            var horaOrdinaria = (salario_mensual / 240);
            var hora = 0.00;
            switch (nodo) {
                case 'HEDs':
                    var porcentaje = 0.25;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
                case 'HENs':
                    var porcentaje = 0.75;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
                case 'HRNs':
                    var porcentaje = 0.35;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
                case 'HEDDFs':
                    var porcentaje = 1;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
                case 'HRDDFs':
                    var porcentaje = 0.75;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
                case 'HENDFs':
                    var porcentaje = 1.5;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
                case 'HRNDFs':
                    var porcentaje = 1.1;
                    var recargo = (horaOrdinaria * porcentaje);
                    hora = (horaOrdinaria + recargo) * cantidad;
                    break;
            }
            document.getElementById("val_accrued").value = parseFloat(hora, 10).toFixed(2);
        }

        $("#quantity_a").keyup(function() {
            calcular_vacaciones();
        });

        function calcular_vacaciones(){     
            
            var nodo = document.getElementById("select_tipo_devengado").value;
            
            var salario_mensual = Number(document.getElementById("salary").value);
            var cantidad = Number(document.getElementById("quantity_a").value);
            var valor = (salario_mensual*cantidad) / 720;            

            switch (nodo) {
                case 'paid_vacation':
                document.getElementById("val_accrued").value = parseFloat(valor, 10).toFixed(2);
                break;
                case 'common_vacation':
                document.getElementById("val_accrued").value = parseFloat(valor, 10).toFixed(2);
                break;
            }
        }
    </script>

@endsection
