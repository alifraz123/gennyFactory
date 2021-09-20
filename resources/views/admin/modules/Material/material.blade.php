@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div id="show_insert_status">

        </div>
        <div class="container-fluid">
                <div  class="container-fluid">
                    <div class="row">
                        <h4>Material</h4>
                    </div>

                    <div class="row">
                        <!-- left column -->
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
                                            <select type="text" style="width: 100%;" class="select2" name="material_item_name" id="material_item_name">
                                            </select>
                                        </div>
                                        <div style="width: 30%;margin-right:3px">
                                            <label>Material Name</label>
                                            <input type="text" style="width: 100%;"  name="material_name" id="material_name" placeholder="Material Name">

                                        </div>


                                        <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                                    </div>
                                    <div id="whereProductsShow">
                                    </div>
                                    <div style="margin-top: 1rem;" class="form-group">
                                        <button onclick="material_name()" class="btn btn-success">Sumbit</button>

                                    </div>
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                            <script>
                                function addRow() {

                                    var material_item_name = document.getElementById('material_item_name').value;
                                    var category = document.getElementById('category').value;
                                    var material_name = document.getElementById('material_name').value;

                                    var tr =
                                        `<div>
                           
                                        <input style="width:25%"readonly type='text' name='category[]' value='${category}'>
                            <input style="width:30%" readonly type='text' name='material_item_name[]' value='${material_item_name}'>
                            <input style="width:30%" readonly type='text' name='material_name[]' value='${material_name}'>
                            <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
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
                </div>
            


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Material</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="edit_materialdata">
                                @csrf
                                <input type="hidden" value="" id="id" name="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Material Name</label>
                                                <input type="text" name="material_name" id="material_name" value="" required class="form-control" placeholder="Enter Party Code">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <select name="item" id="item" required class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="Category" id="Category" required class="form-control">

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
                                <th>Material</th>
                                <th>ItemName</th>
                                <th>Category</th>

                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($materials as $material)
                            <tr>
                                <td> {{$material->material}}</td>
                                <td>{{$material->item}}</td>
                                <td> {{$material->category}}</td>

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


    function material_name() {

        var material_item_name = document.getElementsByName('material_item_name[]');
        var category = document.getElementsByName('category[]');
        var material_name = document.getElementsByName('material_name[]');
        var obj = [];
        for (var i = 0; i < material_item_name.length; i++) {
            var material_item_name1 = material_item_name[i].value;
            var category1 = category[i].value;
            var material_name1 = material_name[i].value;
            var obje;
            obje = {
                material_item_name: "",
                category: "",
                material_name: "",
            };
            obje.material_item_name = material_item_name1;
            obje.material_name = material_name1;
            obje.category = category1;

            obj.push(obje);
        }
        console.log(obj);


        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "insertMaterialNames",
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


    function show_modal(id) {

        $.ajax({
            url: 'edit_materialdata/' + id,
            type: 'get',
            data: {
                id: id
            },
            success: function(data) {

                document.getElementById('id').value = data['data'][0].material;
                document.getElementById('material_name').value = data['data'][0].material;
                document.getElementById('item').value = data['data'][0].item;
                let output = `<option selected readonly value="${data['data'][0].item}">${data['data'][0].item}</option>`;
                let category = `<option selected readonly value="${data['data'][0].category}">${data['data'][0].category}</option>`;
                data['items'].forEach(el => {
                    output += `
                    <option value="${el.material_item_name}">${el.material_item_name}</option>
                    `;

                    document.getElementById('item').innerHTML = output;

                });

                category += `
                   
                    <option value="Raw Material">Raw Material</option>
                    <option value="Packing Material">Packing Material</option>
                    <option value="Stickers">Stickers</option>
                    `;

                document.getElementById('Category').innerHTML = category;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>



@endsection