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
                            <h3 class="card-title">Edit Items Data</h3>
                        </div>

                        <form method="post" action="../edit_stockdata">
                            @csrf
                            <input type="hidden" value="{{$data[0]->id}}" name="id">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Varient</label>
                                            <input type="text" name="Varient" value="{{$data[0]->varient}}" required class="form-control" placeholder="Enter Varient">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Item Name</label>

                                            <select name="itemname" required class="form-control">
                                                <option value="{{$data[0]->itemname}}">{{$data[0]->itemname}}</option>
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
                                            <label>Company</label>

                                            <select disabled name="company" required class="form-control">
                                                <option value="{{$data[0]->company}}">{{$data[0]->company}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Finish Quantity</label>
                                            <input type="number" name="finish" value="{{$data[0]->finish}}" required class="form-control" placeholder="Enter Finish Items">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Semi Finish Quantity</label>
                                            <input type="number" name="semi_finish" value="{{$data[0]->semiFinish}}" required class="form-control" placeholder="Enter semi_finish items">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Damage Quantity</label>
                                            <input type="number" name="damage" value="{{$data[0]->damage}}" required class="form-control" placeholder="Enter Damage items">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button style="float:right; margin-right:80px; margin-top: -55px;" type="submit" class="btn btn-primary">Update</button>
                    </div>


                   
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