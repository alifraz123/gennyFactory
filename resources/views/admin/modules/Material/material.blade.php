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
                <h4>Material</h4>
            </div>
            <div class=" card card-body">
                <form method="post" action="save_materialdata">
                    @csrf

                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Material Name</label>
                                <input type="text" name="material_name" value="" required class="form-control" placeholder="Enter material name">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Item Name</label>

                                <select name="item" required class="form-control">
                                    <option selected disabled value="">choose...</option>
                                    @foreach($items as $item)
                                    <option value="{{$item->itemname}}">{{$item->itemname}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Category</label>

                                <select name="Category" required class="form-control">
                                    <option selected disabled value="">choose...</option>
                                    <option value="Raw Material">Raw Material</option>
                                    <option value="Packing Material">Packing Material</option>
                                    <option value="Stickers">Stickers</option>

                                </select>
                            </div>
                        </div>

                    </div>


                    <button style="float:right; margin-right:32rem; margin-top: -55px;" type="submit" class="btn btn-primary">Submit</button>


                </form>
            </div>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
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

                                    </div>

                                    <button style="float:right; margin-right:80px; margin-top: -55px;" type="submit" class="btn btn-primary">Update</button>
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
                                <th>Item</th>
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

                                <td><button onclick="show_modal('{{$material->material}}')" class="btn btn-success">Edit</button> </td>
                                <td><a href='delete_materialdata/{{$material->material}}' class="btn btn-danger">Delete</a> </td>

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
    function show_modal(material) {

        $.ajax({
            url: 'edit_materialdata/' + material,
            type: 'get',
            data: {
                material: material
            },
            success: function(data) {

                document.getElementById('id').value = data['data'][0].material;
                document.getElementById('material_name').value = data['data'][0].material;
                document.getElementById('item').value = data['data'][0].item;
                let output = `<option selected readonly value="${data['data'][0].item}">${data['data'][0].item}</option>`;
                let category = `<option selected readonly value="${data['data'][0].category}">${data['data'][0].category}</option>`;
                data['items'].forEach(el => {
                    output += `
                    <option value="${el.itemname}">${el.itemname}</option>
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