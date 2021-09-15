@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div id="show_insert_status">
        </div>
        <div style="margin-top: 1rem;" class="container-fluid">

            <div class="col-md-12">

                <div class="card card-dark">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Add Stock Detail</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Add Product Detail -->
                    <div style="line-height: 0;" class="card-body">

                        <div style="display: flex;">
                            <div style="width: 30%;margin-right:3px">
                                <label>Date</label>
                                <input type="date" style="width: 100%;line-height:1" name="date" id="date">

                            </div>

                            <div style="width: 55%;margin-right:3px">

                                <label>Company</label>
                                <select name="company" onchange="getItemsOfSelectedCompany(this.value)" id="company" style="width: 100%;" required class="select2">
                                    <option selected disabled value="">Choose company...</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->companyName}}">{{$company->companyName}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div style="width: 65%;margin-right:3px">
                                <label>Item Name</label>
                                <select onchange="getVarientOfSelectedItem(this.value)" name="itemname" id="itemname" style="width: 100%;" class="select2">
                                <option selected disabled value="">Choose itemname...</option>    
                            </select>
                            </div>
                            <div style="width: 30%;margin-right:3px">
                                <label>Varient</label>

                                <select name="varient" style="width: 100%;" id="varient" style="width: 100%;" class="select2">
                                    <option selected disabled value="">Choose varient...</option>

                                </select>
                            </div>
                            <div style="width: 15%;margin-right:3px">
                                <label>S.Finish</label>
                                <input type="number" style="width: 100%;" name="semi_finish" id="semi_finish">

                            </div>
                            <div style="width: 15%;margin-right:3px">
                                <label>Finish</label>
                                <input type="number" style="width: 100%;" name="finish" id="finish">

                            </div>


                            <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                        </div>
                        <div id="whereProductsShow">
                        </div>
                        <div style="margin-top: 1rem;" class="form-group">
                            <button onclick="stock_detail()" class="btn btn-success">Sumbit</button>

                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                <script>
                    function addRow() {
                        var date = document.getElementById('date').value;
                        var company = document.getElementById('company').value;
                        var itemname = document.getElementById('itemname').value;
                        var varient = document.getElementById('varient').value;
                        var semi_finish = document.getElementById('semi_finish').value;
                        var finish = document.getElementById('finish').value;

                        var tr =
                            `<div >
                                <input style="width:16.2%"readonly type='text' name='date[]' value='${date}'>
                                        <input style="width:24%"readonly type='text' name='company[]' value='${company}'>
                            <input style="width:29%" readonly type='text' name='itemname[]' value='${itemname}'>
                            <input style="width:13%" readonly type='text' name='varient[]' value='${varient}'>
                            <input style="width:6.5%"readonly type='text' name='semi_finish[]' value='${semi_finish}'>
                            <input style="width:6.5%"readonly type='text' name='finish[]' value='${finish}'>
                            <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 3%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                            </div>
                            `;
                        if (date != "" && itemname != "" && company != "" && varient != "" && semi_finish != "" && finish != "") {
                            document.getElementById('whereProductsShow').innerHTML += tr;
                            document.getElementById('varient').value = '';
                            // $("#company").val('').trigger('change');
                            // $("#itemname").val('').trigger('change');
                            document.getElementById('semi_finish').value = '';
                            document.getElementById('finish').value = '';
                            document.getElementById('varient').focus();
                        }

                    };
                </script>

            </div>

            <!-- /.card-header -->


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Stock Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="edit_stockdata_detail">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" name="date" id="modal_date" required class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Company</label>

                                                <select name="company" id="Company" required class="form-control">

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Item Name</label>

                                                <select name="itemname" id="ItemName" required class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Varient</label>

                                                <select name="varient" id="modal_varient" required class="form-control">
                                                    <option selected disabled value="">Choose varient...</option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Finish Quantity</label>
                                                <input type="number" name="finish" value="" id="modal_finish" required class="form-control" placeholder="Enter Finish Items">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Semi Finish Quantity</label>
                                                <input type="number" name="semi_finish" id="modal_semi_finish" value="" required class="form-control" placeholder="Enter semi_finish items">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">

                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                        </div>



                    </div>
                    <div class="card-footer">
                    </div>
                    </form>
                </div>

            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Item Name</th>
                            <th>Finish</th>
                            <th>Semi Finish</th>

                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="companydata">
                        @foreach($stocks as $stock)
                        <tr>
                            <td> {{$stock->date}}</td>
                            <td> {{$stock->company}}</td}>
                            <td>{{$stock->itemname}}</td>
                            <td>{{$stock->finish}}</td>
                            <td>{{$stock->semiFinish}}</td>

                            <td><button onclick="show_modal('{{$stock->id}}')" class="btn btn-success">Edit</button> </td>
                            <td><a href='delete_stockdata_detail/{{$stock->id}}' class="btn btn-danger">Delete</a> </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
            <!-- /.card-body -->
        </div>

</div>

</div>
</div>
</section>
<script>
    function getItemsOfSelectedCompany(companyName) {
        var company = companyName;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getItemsOfSelectedCompany',
            type: 'post',
            data: {
                company: company,
                _token: token
            },
            success: function(data) {

                let output = '<option selected disabled value="">Choose item...</option>';
                data.forEach(el => {
                    output += `
                    <option value="${el.itemname}">${el.itemname}</option>
                    `;
                    document.getElementById('itemname').innerHTML = output;
                });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }

    function getVarientOfSelectedItem(itemname) {

        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getVarientOfSelectedItem',
            type: 'post',
            data: {
                itemname: itemname,
                _token: token
            },
            success: function(data) {
                // console.log(data);
                let output = '<option selected disabled value="">Choose varient...</option>';
                data.forEach(el => {
                    output += `
                    <option value="${el.varient}">${el.varient}</option>
                    `;
                    document.getElementById('varient').innerHTML = output;
                });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }



    function show_modal(stock) {

        $.ajax({
            url: 'edit_stockdata_detail/' + stock,
            type: 'get',
            data: {
                stock: stock
            },
            success: function(data) {

                document.getElementById('id').value = data['data'][0].id;
                document.getElementById('modal_date').value = data['data'][0].date;
                document.getElementById('modal_finish').value = data['data'][0].finish;
                document.getElementById('modal_semi_finish').value = data['data'][0].semiFinish;
                document.getElementById('date').innerHTML = data['data'][0].date;
                let company = `<option selected readonly value="${data['data'][0].company}">${data['data'][0].company}</option>`;
                let ItemName = `<option selected readonly value="${data['data'][0].itemname}">${data['data'][0].itemname}</option>`;
                let varient = `<option selected readonly value="${data['data'][0].varient}">${data['data'][0].varient}</option>`;

                document.getElementById('Company').innerHTML = company;
                document.getElementById('ItemName').innerHTML = ItemName;
                document.getElementById('modal_varient').innerHTML = varient;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    document.getElementById('date').value = today;


    function stock_detail() {
        var date = document.getElementsByName('date[]');
        var company = document.getElementsByName('company[]');
        var itemname = document.getElementsByName('itemname[]');
        var varient = document.getElementsByName('varient[]');
        var semi_finish = document.getElementsByName('semi_finish[]');
        var finish = document.getElementsByName('finish[]');
        var obj = [];
        for (var i = 0; i < itemname.length; i++) {
            var date1 = date[i].value;
            var company1 = company[i].value;
            var itemname1 = itemname[i].value;
            var varient1 = varient[i].value;
            var semi_finish1 = semi_finish[i].value;
            var finish1 = finish[i].value;
            var obje;
            obje = {
                date: "",
                company: "",
                itemname: "",
                varient: "",
                semi_finish: "",
                finish: "",
            };
            obje.date = date1;
            obje.company = company1;
            obje.itemname = itemname1;
            obje.varient = varient1;
            obje.semi_finish = semi_finish1;
            obje.finish = finish1;

            obj.push(obje);
        }
        console.log(obj);


        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "insertStock_detail",
            data: {

                obj: obj,
                _token: token
            },
            dataType: "text",
            success: function(data) {
                document.location.reload();
                if (data == "inserted") {
                    var output = `
        <div class="alert alert-success">
<button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
Inserted Successfuly
</div>    
        `;
                    document.getElementById('whereProductsShow').innerHTML = '';
                    document.getElementById('show_insert_status').innerHTML = output;
                    document.location.reload();
                } else {
                    var output = `
<div class="alert alert-danger">
<button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
Not Inserted
</div>   
        `;
                    document.getElementById('show_insert_status').innerHTML = output;
                }

            },
            error: function(req, status, error) {
                console.log(error);
                var output = `
        <div class="alert alert-danger">
<button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
Not Inserted
</div>
        `;
                document.getElementById('show_insert_status').innerHTML = output;
            }
        });

        $("#material_item_name").val('').trigger('change');
        $("#material_name").val('');
        $("#category").val('').trigger('change');


    }
</script>



@endsection