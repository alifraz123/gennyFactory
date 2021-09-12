@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">

        @if(session('status'))
        <div class="alert alert-success">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            {{session('status')}}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            {{session('failed')}}
        </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <h4>Material Detail</h4>
            </div>
            <div class=" card card-body">
                <form method="post" action="save_materialdata_detail">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Category</label>

                                <select name="category" id="category" onchange="getMaterialOfSelectedCategory(this.value)" required class="form-control">
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

                                <select name="itemname" id="itemname" required class="form-control">
                                    <option selected disabled value="">choose...</option>
                                    @foreach($items as $item)
                                    <option value="{{$item->itemname}}">{{$item->itemname}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Material Name</label>

                                <select name="material" onchange="getOpeningBalance()" id="material" required class="form-control">
                                    <option selected disabled value="">choose...</option>


                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Used</label>
                                <input type="text" name="used" id="used" value="" required class="form-control" placeholder="Used Material Qty">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Rejected</label>
                                <input type="text" name="rejected" id="rejected" required class="form-control" placeholder="rejected Material Qty">
                            </div>
                        </div>
                    </div>
                    <div class="row">


                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </div>


                    </div>


                </form>
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
                                                <select name="modal_itemname" id="modal_itemname" required class="form-control">

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

                                                <button  type="submit" class="btn btn-primary">Update</button>
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

    function getMaterialOfSelectedCategory(category) {
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getMaterialOfSelectedCategory',
            type: 'post',
            data: {
                category: category,
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
                        document.getElementById('material').innerHTML = output2;
                    });
                }

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

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