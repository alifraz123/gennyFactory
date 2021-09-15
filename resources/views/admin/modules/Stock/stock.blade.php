@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div id="show_insert_status">
        </div>

        <div class=" card card-body">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Add Stock</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Add Product Detail -->
                        <div style="line-height: 0;" class="card-body">

                            <div style="display: flex;">


                                <div style="width: 25%;margin-right:3px">

                                    <label>Company</label>
                                    <select name="company" onchange="getItemsOfSelectedCompany(this.value)" id="company" style="width: 100%;" required class="select2">
                                        <option selected disabled value="">choose...</option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->companyName}}">{{$company->companyName}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div style="width: 30%;margin-right:3px">
                                    <label>Item Name</label>
                                    <select name="itemname" id="itemname" style="width: 100%;" class="select2">
                                    </select>
                                </div>
                                <div style="width: 30%;margin-right:3px">
                                    <label>Varient</label>
                                    <input type="text" style="width: 100%;" name="varient" id="varient" placeholder="Material Name">

                                </div>


                                <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                            </div>
                            <div id="whereProductsShow">
                            </div>
                            <div style="margin-top: 1rem;" class="form-group">
                                <button onclick="stock()" class="btn btn-success">Sumbit</button>

                            </div>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                    <script>
                        function addRow() {

                            var company = document.getElementById('company').value;
                            var itemname = document.getElementById('itemname').value;
                            var varient = document.getElementById('varient').value;

                            var tr =
                                `<div>
                           
                                        <input style="width:25%"readonly type='text' name='company[]' value='${company}'>
                            <input style="width:30%" readonly type='text' name='itemname[]' value='${itemname}'>
                            <input style="width:30%" readonly type='text' name='varient[]' value='${varient}'>
                            <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                            </div>
                            `;
                            if (itemname != "" && company != "" && varient!="") {
                                document.getElementById('whereProductsShow').innerHTML += tr;
                                document.getElementById('varient').value = '';
                                // $("#company").val('').trigger('change');
                                // $("#itemname").val('').trigger('change');
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
                                <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="edit_stockdata">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-sm-5">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Varient</label>
                                                    <input type="text" name="Varient" id="Varient" required class="form-control" placeholder="Enter Varient">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Item Name</label>

                                                    <select name="itemname" id="ItemName" required class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Company</label>

                                                    <select name="company" id="Company" required class="form-control">

                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <button style="float:right; margin-right:32px; margin-top: -75px;" type="submit" class="btn btn-primary">Update</button>
                            </div>



                        </div>
                        <div class="card-footer">
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Varient</th>
                        <th>Item Name</th>
                        <th>Company</th>

                        <th>Finish</th>
                        <th>SemiFinish</th>
                        <th>Damage</th>

                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="companydata">
                    @foreach($stocks as $stock)
                    <tr>
                        <td> {{$stock->varient}}</td>
                        <td>{{$stock->itemname}}</td>
                        <td> {{$stock->company}}</td}>

                        <td> {{$stock->finish}}</td}>
                        <td> {{$stock->semiFinish}}</td}>
                        <td> {{$stock->damage}}</td}>



                        <td><button onclick="show_modal('{{$stock->id}}')" class="btn btn-success">Edit</button> </td>
                        <td><a href='delete_stockdata/{{$stock->id}}' class="btn btn-danger">Delete</a> </td>
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



    function show_modal(stock) {

        $.ajax({
            url: 'edit_stockdata/' + stock,
            type: 'get',
            data: {
                stock: stock
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data['data'][0].id;
                document.getElementById('Varient').value = data['data'][0].varient;


                let company = `<option selected readonly value="${data['data'][0].company}">${data['data'][0].company}</option>`;
                let ItemName = `<option selected readonly value="${data['data'][0].itemname}">${data['data'][0].itemname}</option>`;

                document.getElementById('Company').innerHTML = company;
                document.getElementById('ItemName').innerHTML = ItemName;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }



    function stock() {

        var company = document.getElementsByName('company[]');
        var itemname = document.getElementsByName('itemname[]');
        var varient = document.getElementsByName('varient[]');
        var obj = [];
        for (var i = 0; i < itemname.length; i++) {
            var company1 = company[i].value;
            var itemname1 = itemname[i].value;
            var varient1 = varient[i].value;
            var obje;
            obje = {
                company: "",
                itemname: "",
                varient: "",
            };
            obje.company = company1;
            obje.itemname = itemname1;
            obje.varient = varient1;

            obj.push(obje);
        }
        console.log(obj);


        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "insertStock",
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