@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div id="show_insert_status">

        </div>

        <div class="container-fluid">

            <div class="card card-body">
                <div class="card card-dark">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Add Items</h3>
                            </div>

                        </div>
                    </div>
                </div>



                <div style="line-height: 0;" class="card-body">

                    <div style="display: flex;">

                        <div style="width: 30%;margin-right:3px">
                            <label>Item Name</label>
                            <input type="text" style="width: 100%;" name="ItemName" id="ItemName" placeholder="Material ItemName">
                        </div>
                        <div style="width: 25%;margin-right:3px">

                            <label>Company</label>
                            <select name="Company" id="Company" style="width: 100%;" required class="select2">
                                <option disabled selected value="">Choose company</option>
                                @foreach($companies as $company)
                                <option value="{{$company->companyName}}">{{$company->companyName}}</option>
                                @endforeach
                            </select>
                        </div>


                        <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                    </div>
                    <div id="whereProductsShow">
                    </div>
                    <div style="margin-top: 1rem;" class="form-group">
                        <button onclick="item_name()" class="btn btn-success">Sumbit</button>

                    </div>
                </div>

            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

            <script>
                function addRow() {

                    var ItemName = document.getElementById('ItemName').value;
                    var Company = document.getElementById('Company').value;


                    var tr =
                        `<div>
                                       
                                        <input style="width:30%" readonly type='text' name='ItemName[]' value='${ItemName}'>
                                        <input style="width:25%"readonly type='text' name='Company[]' value='${Company}'>
                                       
                                        <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                                        </div>
                                        `;
                    if (ItemName != "" && Company != "") {
                        document.getElementById('whereProductsShow').innerHTML += tr;
                        document.getElementById('ItemName').value = '';
                        $("#Company").val('').trigger('change');
                        document.getElementById('ItemName').focus();
                    }

                };
            </script>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="edit_itemsdata">
                                @csrf
                                <input type="hidden" value="" id="id" name="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <input type="text" name="ItemName" id="itemName" value="" required class="form-control" placeholder="Enter Item Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <select name="Company" id="Company" require class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button style=" margin-top: 32px;" type="submit" class="btn btn-primary">Update</button>

                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card card-primary">

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Company</th>

                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($items as $item)
                            <tr>
                                <td> {{$item->itemname}}</td>
                                <td>{{$item->company}}</td>

                                <td><button onclick="show_modal('{{$item->itemname}}')" class="btn btn-success">Edit</button> </td>
                                <td><a href='delete_itemsdata/{{$item->itemname}}' class="btn btn-danger">Delete</a> </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
                <!-- /.card-body -->
            </div>



        </div>
</div>
</section>

<script>
    function item_name() {

        var ItemName = document.getElementsByName('ItemName[]');
        var Company = document.getElementsByName('Company[]');

        var obj = [];
        for (var i = 0; i < ItemName.length; i++) {
            var ItemName1 = ItemName[i].value;
            var Company1 = Company[i].value;

            var obje;
            obje = {
                ItemName: "",
                Company: "",

            };
            obje.ItemName = ItemName1;
            obje.Company = Company1;

            obj.push(obje);
        }
        // console.log(obj);


        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "insertItemNames",
            data: {

                obj: obj,
                _token: token
            },
            dataType: "text",
            success: function(data) {
                alert(data);
                if (data == "inserted") {
                    var output = `
                        <div class="alert alert-success">
    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
    Inserted Successfuly
</div>    
                        `;
                    document.getElementById('show_insert_status').innerHTML = output;
                    document.getElementById('whereProductsShow').innerHTML = '';

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

        $("#category").val('').trigger('change');


    }



    function show_modal(item) {

        $.ajax({
            url: 'edit_itemsdata/' + item,
            type: 'get',
            data: {
                item: item
            },
            success: function(data) {

                document.getElementById('id').value = data['data'][0].itemname;
                document.getElementById('itemName').value = data['data'][0].itemname;
                document.getElementById('Company').value = data['data'][0].company;
                let company = `<option selected readonly value="${data['data'][0].company}">${data['data'][0].company}</option>`;

                data['companies'].forEach(el => {
                    company += `
                    <option value="${el.companyName}">${el.companyName}</option>
                    `;

                    document.getElementById('Company').innerHTML = company;

                });

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>


@endsection