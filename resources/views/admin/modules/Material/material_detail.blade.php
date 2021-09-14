@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid">

            <div class=" card card-body">

                <div class="col-md-12">

                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Add Material Names</h3>
                                </div>

                            </div>


                        </div>

                        <!-- Add Product Detail -->
                        <div style="line-height: 0;" class="card-body">

                            <div style="display: flex;">

                                <div style="width: 15%;margin-right:3px">
                                    <label>Date</label>
                                    <input type="date" style="width: 100%;line-height:1" name="date" id="date">

                                </div>
                                <div style="width: 25%;margin-right:3px">

                                    <label>Category</label>
                                    <select name="category" onchange="getMaterialItemNamesOfSelectedCategory(this.value)" id="category" style="width: 100%;" required class="select2">
                                        <option readonly selected value="">Choose category...</option>
                                        <option value="Raw Material">Raw Material</option>
                                        <option value="Packing Material">Packing Material</option>
                                        <option value="Stickers">Stickers</option>

                                    </select>
                                </div>
                                <div style="width: 30%;margin-right:3px">
                                    <label>Item Name</label>
                                    <select type="text" style="width: 100%;" onchange="getMaterialNamesOfSelectedItem(this.value)" class="select2" name="material_item_name" id="material_item_name">
                                    </select>
                                </div>
                                <div style="width: 30%;margin-right:3px">
                                    <label>Material Name</label>
                                    
                                    <select type="text" style="width: 100%;"  class="select2" name="material_name" id="material_name">
                                    </select>
                                </div>
                                <div style="width: 10%;margin-right:3px">
                                    <label>Used</label>
                                    <input type="number" style="width: 100%;" name="used" id="used" placeholder="Used">

                                </div>
                                <div style="width: 10%;margin-right:3px">
                                    <label>Rejected</label>
                                    <input type="number" style="width: 100%;" name="rejected" id="rejected" placeholder="Rejected">

                                </div>


                                <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                            </div>
                            <div id="whereProductsShow">
                            </div>
                            <div style="margin-top: 1rem;" class="form-group">
                                <button onclick="material_used_detail()" class="btn btn-success">Sumbit</button>

                            </div>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                    <script>
                        function addRow() {
                            var date = document.getElementById('date').value;
                            var material_item_name = document.getElementById('material_item_name').value;
                            var category = document.getElementById('category').value;
                            var material_name = document.getElementById('material_name').value;
                            var used = document.getElementById('used').value;
                            var rejected = document.getElementById('rejected').value;

                            var tr =
                                `<div>
                                <input style="width:15%"readonly type='text' name='date[]' value='${date}'>
            <input style="width:18.8%"readonly type='text' name='category[]' value='${category}'>
<input style="width:22.7%" readonly type='text' name='material_item_name[]' value='${material_item_name}'>
<input style="width:22.5%" readonly type='text' name='material_name[]' value='${material_name}'>
<input style="width:7.5%" readonly type='text' name='used[]' value='${used}'>
<input style="width:7.6%" readonly type='text' name='rejected[]' value='${rejected}'>
<button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 4%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
</div>
`;
                            if (material_item_name != "" && category != "") {
                                document.getElementById('whereProductsShow').innerHTML += tr;
                                document.getElementById('material_item_name').value = '';
                                document.getElementById('material_name').value = '';
                                $("#category").val('').trigger('change');
                                document.getElementById('category').focus();
                            }

                        };
                    </script>

                </div>

            </div>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Material Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="edit_materialdata_detail">
                                @csrf
                                <input type="hidden" value="" id="id" name="modal_id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" name="modal_date" id="modal_date" value="" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Category</label>

                                                <select name="modal_category" id="modal_category" onchange="getMaterialOfSelectedCategory(this.value)" required class="form-control">
                                                    <option selected disabled value="">choose...</option>
                                                    <option value="Raw Material">Raw Material</option>
                                                    <option value="Packing Material">Packing Material</option>
                                                    <option value="Stickers">Stickers</option>

                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <select name="modal_itemname" onchange="getMaterialOfSelectedItem(this.value)" id="modal_itemname" required class="form-control">

                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Material Name</label>
                                                <input type="text" name="modal_material" id="modal_material" value="" required class="form-control" placeholder="Enter Party Code">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Used</label>
                                                <input type="text" name="modal_used" id="modal_used" required class="form-control" placeholder="Used Material Qty">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Rejected</label>
                                                <input type="text" name="modal_rejected" id="modal_rejected" required class="form-control" placeholder="Rejected Material Qty">
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
                                <th>Date</th>
                                <th>Itemname</th>
                                <th>Category</th>
                                <th>Material</th>

                                <th>Used</th>


                                <th>Rejected</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($materials as $material)
                            <tr>
                                <td> {{$material->date}}</td>
                                <td>{{$material->itemname}}</td>
                                <td> {{$material->category}}</td>
                                <td> {{$material->material}}</td>



                                <td> {{$material->used}}</td>


                                <td> {{$material->rejected}}</td>


                                <td><button onclick="show_modal('{{$material->id}}')" class="btn btn-success">Edit</button> </td>
                                <td><a href='delete_materialdata/{{$material->id}}' class="btn btn-danger">Delete</a> </td>

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
    todatDate();

    function getMaterialItemNamesOfSelectedCategory(category) {
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getMaterialItemNamesOfSelectedCategory',
            type: 'post',
            data: {
                category: category,
                _token: token
            },
            success: function(data) {

                let output = `<option selected readonly value="">Choose name...</option>`;
                data.forEach(el => {

                    output += `
                    <option value="${el.material_item_name}">${el.material_item_name}</option>
                    `;

                    document.getElementById('material_item_name').innerHTML = output;

                });

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }

    function getMaterialNamesOfSelectedItem(itemName) {

        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getMaterialNamesOfSelectedItem',
            type: 'post',
            data: {
                itemName: itemName,
                _token: token
            },
            success: function(data) {
                if (data) {
                    console.log("material data is :" + data)
                    let output2 = '<option selected readonly value="">Choose varient...</option>';
                    data.forEach(el => {
                        output2 += `
                    <option value="${el.material}">${el.material}</option>
                    `;
                        document.getElementById('material_name').innerHTML = output2;
                    });
                }

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }

    function show_modal(material) {


        $.ajax({
            url: 'edit_materialdata_detail/' + material,
            type: 'get',
            data: {
                material: material
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data['data'][0].id;
                document.getElementById('modal_date').value = data['data'][0].date;
                document.getElementById('modal_category').value = data['data'][0].category;
                document.getElementById('modal_material').value = data['data'][0].material;

                document.getElementById('modal_used').value = data['data'][0].used;
                document.getElementById('modal_rejected').value = data['data'][0].rejected;
                let output = `<option selected readonly value="${data['data'][0].itemname}">${data['data'][0].itemname}</option>`;

                data['items'].forEach(el => {
                    output += `
                    <option value="${el.itemname}">${el.itemname}</option>
                    `;

                    document.getElementById('modal_itemname').innerHTML = output;

                });

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }


    function material_used_detail() {
        var date = document.getElementsByName('date[]');
        var material_item_name = document.getElementsByName('material_item_name[]');
        var category = document.getElementsByName('category[]');
        var material_name = document.getElementsByName('material_name[]');
        var used = document.getElementsByName('used[]');
        var rejected = document.getElementsByName('rejected[]');
        var obj = [];
        for (var i = 0; i < material_item_name.length; i++) {
            var date1 = date[i].value;
            
            var material_item_name1 = material_item_name[i].value;
            var category1 = category[i].value;
            var material_name1 = material_name[i].value;

            var used1 = used[i].value;
            
            var rejected1 = rejected[i].value;
            
            var obje;
            obje = {
                date: "",
                category: "",
                material_item_name: "",
                material_name: "",
                used: "",
                rejected: "",
                
            };
            obje.date = date1;
            obje.category = category1;
            obje.material_item_name = material_item_name1;
            obje.material_name = material_name1;
            obje.used = used1;
            obje.rejected = rejected1;
            obj.push(obje);
        }
        // console.log(obj);


        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "insertMaterialUsedDetail",
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

    
    var day;

    function todatDate() {
        var now = new Date();
        day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        document.getElementById('date').value = today;

    }
</script>



@endsection