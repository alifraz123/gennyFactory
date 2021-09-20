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
                <h4>Zone</h4>
            </div>
            <div class="card card-body">


                <form method="post" action="save_zone">
                    @csrf

                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Zone Name</label>
                                <input type="text" name="zone" required class="form-control" placeholder="Enter Zone Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button style="margin-top: 32px;" type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </div>


                </form>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Zone</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="update_zone">
                            @csrf
                            <input type="hidden" value="" id="zone_hidden_id" name="zone_hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Zone Name</label>
                                            <input type="text"  id="zone" name="zone" value="" required class="form-control" placeholder="Enter Item Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button style="margin-top: 32px;" type="submit" class="btn btn-primary">Update</button>

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

                                <th>Zone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($zones as $zone)
                            <tr>
                                <td> {{$zone->zoneName}}</td>

                                <td><button onclick="show_modal('{{$zone->zoneName}}')" class="btn btn-success">Edit</button> </td>
                                <td><a href='delete_zone/{{$zone->zoneName}}' class="btn btn-danger">Delete</a> </td>
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
    function show_modal(zone) {
        document.getElementById('zone_hidden_id').value = zone;
        document.getElementById('zone').value = zone;
        $('#exampleModal').modal('show');
    }
</script>



@endsection