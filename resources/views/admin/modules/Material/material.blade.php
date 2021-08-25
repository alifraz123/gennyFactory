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
        <div  class="container-fluid">
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

                                <td><a href='edit_materialdata/{{$material->material}}' class="btn btn-success">Edit</a> </td>
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





@endsection