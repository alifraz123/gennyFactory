@extends('admin/layouts/mainlayout')
@section('content')
<div class="content-wrapper">


    <section class="content">
        <div id="show_insert_status">

        </div>
        <div style="margin-top: 1rem;" class="container-fluid">

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Add Material ItemNames</h3>
                                </div>

                            </div>


                        </div>

                        <!-- Add Product Detail -->
                        <div style="line-height: 0;" class="card-body">

                            <div style="display: flex;">

                                <div style="width: 30%;margin-right:3px">
                                    <label>Item Name</label>
                                    <input type="text" style="width: 100%;" name="material_item_name" id="material_item_name" placeholder="Material ItemName">
                                </div>
                                <div style="width: 25%;margin-right:3px">

                                    <label>Category</label>
                                    <select name="category" id="category" style="width: 100%;" required class="select2">
                                        <option readonly selected value="">Choose category...</option>
                                        <option value="Raw Material">Raw Material</option>
                                        <option value="Packing Material">Packing Material</option>
                                        <option value="Stickers">Stickers</option>

                                    </select>
                                </div>


                                <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                            </div>
                            <div id="whereProductsShow">
                            </div>
                            <div style="margin-top: 1rem;" class="form-group">
                                <button onclick="material_item_name()" class="btn btn-success">Sumbit</button>

                            </div>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                    <script>
                        function addRow() {

                            var material_item_name = document.getElementById('material_item_name').value;
                            var category = document.getElementById('category').value;


                            var tr =
                                `<div>
                                       
                                        <input style="width:30%" readonly type='text' name='material_item_name[]' value='${material_item_name}'>
                                        <input style="width:25%"readonly type='text' name='category[]' value='${category}'>
                                       
                                        <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                                        </div>
                                        `;
                            if (material_item_name != "" && category != "" ) {
                                document.getElementById('whereProductsShow').innerHTML += tr;
                                document.getElementById('material_item_name').value = '';
                                $("#category").val('').trigger('change');
                                document.getElementById('material_item_name').focus();
                            }

                        };
                    </script>

                </div>
            </div>
        </div>

</div>

<script>
    function material_item_name() {

        var material_item_name = document.getElementsByName('material_item_name[]');
        var category = document.getElementsByName('category[]');
       
        var obj = [];
        for (var i = 0; i < material_item_name.length; i++) {
            var material_item_name1 = material_item_name[i].value;
            var category1 = category[i].value;
           
            var obje;
            obje = {
                material_item_name: "",
                category: "",
               
            };
            obje.material_item_name = material_item_name1;
            obje.category = category1;
           
            obj.push(obje);
        }
        // console.log(obj);


        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "insertMaterialItemNames",
            data: {

                obj: obj,
                _token: token
            },
            dataType: "text",
            success: function(data) {

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
</script>

@endsection