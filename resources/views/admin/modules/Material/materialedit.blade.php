@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div style="margin-top: 1rem;" class="container-fluid">

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Material Data</h3>
                        </div>


                        <form method="post" action="../edit_materialdata">
                            @csrf
                            <input type="hidden" value="{{$data[0]->material}}" name="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Material Name</label>
                                            <input type="text" name="material_name" value="{{$data[0]->material}}" required class="form-control" placeholder="Enter Party Code">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <select name="item" required class="form-control">
                                                <option selected  value="{{$data[0]->item}}">{{$data[0]->item}}</option>
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
                                                <option selected value="{{$data[0]->category}}">{{$data[0]->category}}</option>
                                                <option value="Raw Material">Raw Material</option>
                                                <option value="Packing Material">Packing Material</option>
                                                <option value="Stickers">Stickers</option>

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
</div>
</section>
@endsection