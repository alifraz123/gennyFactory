@extends('admin/layouts/mainlayout')
@section('content')
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<div class="content-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-sm-6">

                <h3>Reports</h3>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div style="padding:20px" class="card card-outline card-info">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date From :</label>
                                    <input type="date" name="startDate" id="startDate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date To :</label>
                                    <input type="date" name="endDate" id="endDate" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="yearly" value="yearly">
                                            <label class="form-check-label" for="yearly">
                                                Yearly Report
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="monthly" value="monthly">
                                            <label class="form-check-label" for="monthly">
                                                Monthly Report
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" onclick="focusOnCustomeDate()" name="exampleRadios" id="custome" value="custome">
                                            <label class="form-check-label" for="custome">
                                                Custome Date Report
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select name="company" id="company" class="form-control select2 select2bs4">
                                        <option disabled selected value="">Choose company...</option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->companyName}}"> {{$company->companyName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion card-body" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    DISPATCH REPORT
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <input onclick="dispatch_supplier_wise_radiobtn()" class="form-check-input" type="radio" name="supplierWiseOrAllSupplier" id="supplier_wise" value="supplier_wise">
                                                        <label class="form-check-label" for="supplier_wise">
                                                            Supplier Wise
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <input onclick="dispatch_all_supplier_wise_radiobtn()" class="form-check-input" type="radio" name="supplierWiseOrAllSupplier" id="all_supplier" value="all_supplier">
                                                        <label class="form-check-label" for="all_supplier">
                                                            All Supplier
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="dispatch_supplier_name" class="col-md-4">
                                            <div class="form-group">
                                                <label>Supplier Name :</label>
                                                <select name="supplier_name" id="supplier_name" required class="form-control select2 select2bs4">
                                                    <option disabled selected value="">Choose value...</option>
                                                    @foreach($sup_ven as $supplier)
                                                    <option value="{{$supplier->supplier}}"> {{$supplier->supplier}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="dispatch_dispatch_detail_btn" style="margin-top:32px" class="col-md-2">
                                            <input onclick="getSupplierWiseDispatchReport()" class="btn btn-primary" value="DISPATCH" type="button">
                                        </div>
                                        <div id="dispatch_dispatch_btn" style="margin-top:32px" class="col-md-2">
                                            <input onclick="getSupplierWiseDispatchDetailedReport()" class="btn btn-primary" value="DISPATCH DETAIL" type="button">
                                        </div>

                                        <div id="dispatch_all_dispatch_detail_btn" style="margin-top:8px" class="col-md-2">
                                            <input onclick="getCompleteAllSupplierDispatchReport()" class="btn btn-primary" value="Complete Report" type="button">
                                        </div>
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    PURCHASE VENDER WISE REPORT
                                </button>
                            </h2>
                        </div>

                        <div id="collapseTwo" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Vender Name :</label>
                                                <select id="vender_name" required class="form-control select2 select2bs4">
                                                    <option disabled selected value="">Choose value...</option>
                                                    @foreach($venders as $vender)
                                                    <option value="{{$vender->vender}}"> {{$vender->vender}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div style=" margin-top: 32px;" class="col-md-2">
                                            <input onclick="getPurchaseReport()" class="btn btn-primary" value="purchase" type="button">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                                    MATERIAL REPORT
                                </button>
                            </h2>
                        </div>

                        <div id="collapseThree" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                                    <div style="display: flex;" class="">

                                        <div style="margin-right:10px; margin-top: 14px;">
                                            <input onclick="getRawMaterialReport()" class="btn btn-primary" value="RAW MATERIAL" type="button">
                                        </div>
                                        <div style="margin-right:10px; margin-top: 14px;">
                                            <input onclick="getPackingMaterialReport()" class="btn btn-primary" value="PACKING MATERIAL" type="button">
                                        </div>
                                        <div style="margin-right:10px; margin-top: 14px;">
                                            <input onclick="getStickerReport()" class="btn btn-primary" value="STICKER" type="button">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapseTwo">
                                    DAILY STOCK REPORT
                                </button>
                            </h2>
                        </div>

                        <div id="collapsefour" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                                    <div style="display: flex;">

                                        <div style="margin-right:10px; margin-top: 14px;">
                                            <input onclick="getDailyFinishedStockReport()" class="btn btn-primary" value="FINISHED STOCK" type="button">
                                        </div>

                                        <div style="margin-right:10px; margin-top: 14px;">
                                            <input onclick="getDailySemiFinishedStockReport()" class="btn btn-primary" value="SEMI FINISHED STOCK" type="button">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="true" aria-controls="collapseTwo">
                                    STOCK RETURN REPORT
                                </button>
                            </h2>
                        </div>

                        <div id="collapsefive" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                                    <div class="row">

                                        <div style=" margin-top: 32px;" class="col-md-2">
                                            <input onclick="getPurchaseReport()" class="btn btn-primary" value="RETURN REPORT" type="button">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseTwo">
                                    DAILY PRODUCTION REPORT
                                </button>
                            </h2>
                        </div>

                        <div id="collapseSeven" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                                    <div class="row">

                                        <div style=" margin-top: 32px;" class="col-md-2">
                                            <input onclick="getPurchaseReport()" class="btn btn-primary" value="DAILY PRODUCTION REPORT" type="button">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>


            </div>
        </div>
        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


</div>
</div>
</div>

</div>

<script>
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#startDate').val(today);
    $('#endDate').val(today);

    function getSupplierWiseDispatchReport() {
        var supplier_name = document.getElementById('supplier_name').value;
        if (supplier_name == "") {
            document.getElementById('supplier_name').focus();
        } else {
            window.open("Dispatch?supplier_name=" + supplier_name +"&"+getStartAndEndingDates(), '_blank');
        }
    }

    function getSupplierWiseDispatchDetailedReport() {
       
        var supplier_name = document.getElementById('supplier_name').value;
        if (supplier_name == "") {
            document.getElementById('supplier_name').focus();
        } else {
         
                window.open("DispatchDetail?supplier_name=" + supplier_name +"&"+ getStartAndEndingDates(), '_blank');

        }
    }

    function getCompleteAllSupplierDispatchReport() {
        window.open("getAnnualPartyWiseReport?"+ getStartAndEndingDates(), '_blank');
    }
    

    function getPurchaseReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        window.open("getPurchaseReport?vender_name=" + vender_name + "&startDate=" + startDate + "&endDate=" + endDate, '_blank');
    }

    function getRawMaterialReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        window.open("getRawMaterialReport?startDate=" + startDate, '_blank');
    }

    function getPackingMaterialReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        window.open("getPackingMaterialReport?startDate=" + startDate, '_blank');
    }

    function getStickerReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        window.open("getStickerReport?startDate=" + startDate, '_blank');
    }

    function getDailyFinishedStockReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        window.open("getDailyFinishedStockReport?startDate=" + startDate, '_blank');
    }

    function getDailySemiFinishedStockReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        window.open("getDailySemiFinishedStockReport?startDate=" + startDate, '_blank');
    }

    function getStartAndEndingDates() {
        var company = document.getElementById('company').value;
        var startDate = '';
        var endDate = '';
        if (document.getElementById('yearly').checked) {
            var now = new Date();
            var year = now.getFullYear();
            startDate = year + '-01-01';
            endDate = year + '-12-31';
        } else if (document.getElementById('monthly').checked) {
            var day = 0;
            var now = new Date();
            var year = now.getFullYear();
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            if (month == 01 || month == 03 || month == 05 || month == 07 || month == 08 || month == 10 || month == 12) {
                day = 31;
            } else if (month == 04 || month == 06 || month == 09 || month == 11) {
                day = 30;
            } else if (month == 02) {
                var now = new Date();
                var year = now.getFullYear();
                var isLeap = new Date(year, 1, 29).getMonth() == 1;
                if (isLeap) {
                    day = 29;
                } else {
                    day = 28;
                }
            }
            startDate = year + "-" + month + '-01';
            endDate = year + "-" + month + "-" + day;
        } else if (document.getElementById('custome').checked) {
            document.getElementById('startDate').focus();
            startDate = document.getElementById('startDate').value;
            endDate = document.getElementById('endDate').value;
        } else {
            startDate = document.getElementById('startDate').value;
            endDate = document.getElementById('endDate').value;
        }

        if (document.getElementById('company').value == '') {
            alert("Please select company name also");
            document.getElementById('company').focus();
        } else {
            return "startDate=" + startDate + "&endDate=" + endDate + "&company=" + company;
        }
    }

    function focusOnCustomeDate() {
        document.getElementById('startDate').focus();
    }

    dispatch_supplier_wise('none');
    dispatch_all_supplier('none')

    function dispatch_supplier_wise(supplier_wise_display_value) {
        document.getElementById('dispatch_supplier_name').style.display = supplier_wise_display_value;
        document.getElementById('dispatch_dispatch_detail_btn').style.display = supplier_wise_display_value;
        document.getElementById('dispatch_dispatch_btn').style.display = supplier_wise_display_value;
    }

    function dispatch_all_supplier(all_supplier_display_value) {
        document.getElementById('dispatch_all_dispatch_detail_btn').style.display = all_supplier_display_value;
        document.getElementById('dispatch_all_dispatch_btn').style.display = all_supplier_display_value;
    }

    function dispatch_supplier_wise_radiobtn() {
        dispatch_supplier_wise('block');
        dispatch_all_supplier('none');
    }

    function dispatch_all_supplier_wise_radiobtn() {
        dispatch_all_supplier('block');
        dispatch_supplier_wise('none')
    }
</script>

</div>

@endsection