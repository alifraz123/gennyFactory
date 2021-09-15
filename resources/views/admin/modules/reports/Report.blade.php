@extends('admin/layouts/mainlayout')
@section('content')
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
                        </div>
                    </div>
                </div>


                <div class="accordion" id="accordionExample">
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Supplier Name :</label>
                                                <select name="supplier_name" id="supplier_name" required class="form-control select2 select2bs4">
                                                    <option disabled selected value="">Choose value...</option>
                                                    @foreach($sup_ven as $supplier)
                                                    <option value="{{$supplier->name}}"> {{$supplier->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items:center;margin-top:14px" class="col-md-2">
                                            <input onclick="getPartyReport()" class="btn btn-primary" value="MTN CTN DETAIL" type="button">
                                        </div>
                                        <div style="display: flex; align-items:center;margin-top:14px" class="col-md-2">
                                            <input onclick="getPartyDetailedReport()" class="btn btn-primary" value="MTN DISPATCH" type="button">
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
                                    DISPATCH REPORT
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
                                                    <option value="{{$vender->name}}"> {{$vender->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div style="display:flex;align-items:center; margin-top: 14px;" class="col-md-2">
                                            <input onclick="getPurchaseReport()" class="btn btn-primary" value="purchase" type="button">
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

    function getPartyReport() {
        var supplier_name = document.getElementById('supplier_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        window.open("MTN_CTN_Dispatch?supplier_name=" + supplier_name + "&startDate=" + startDate + "&endDate=" + endDate, '_blank');
    }

    function getPartyDetailedReport() {
        var supplier_name = document.getElementById('supplier_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        window.open("MTN_Dispatch?supplier_name=" + supplier_name + "&startDate=" + startDate + "&endDate=" + endDate, '_blank');
    }

    function getPurchaseReport() {
        var vender_name = document.getElementById('vender_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
      
        window.open("getPurchaseReport?vender_name=" + vender_name + "&startDate=" + startDate + "&endDate=" + endDate, '_blank');
    }
</script>

</div>

@endsection