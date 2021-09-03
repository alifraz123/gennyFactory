@extends('admin/layouts/mainlayout')
@section('content')
<div class="content-wrapper">
    <div class="container">
        <section id="section" class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>Reports</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
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
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label>Date From :</label>
                                    <input type="date" name="startDate" id="startDate"  class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date To :</label>
                                    <input type="date" name="endDate" id="endDate" required class="form-control" >
                                </div>
                            </div>
                           
                            <div>

                            </div>
                            <div class="col-md-2">
                                <div style="margin-top: 32px;" class="form-group">


                                    <!-- <button  class="btn btn-info">Open Invoices</button> -->
                                </div>

                            </div>
                            <!-- /.col-->
                        </div>
                        <div class="row">
                            <div style="margin-right: 30px;" class="col-md-2">
                                <input onclick="getPartyReport()" class="btn btn-primary" value="MTN CTN DETAIL" type="button">
                            </div>
                            <div  class="col-md-2">
                                <input onclick="getPartyDetailedReport()" class="btn btn-primary" value="MTN DISPATCH" type="button">
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
var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
$('#startDate').val(today);
$('#endDate').val(today);
    
    function getPartyReport() {
        var supplier_name = document.getElementById('supplier_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        window.open("MTN_CTN_Dispatch?supplier_name="+supplier_name+"&startDate="+startDate+"&endDate="+endDate, '_blank'); 
    }
    function getPartyDetailedReport() {
        var supplier_name = document.getElementById('supplier_name').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        window.open("MTN_Dispatch?supplier_name="+supplier_name+"&startDate="+startDate+"&endDate="+endDate, '_blank'); 
    }
   
</script>

</div>

@endsection