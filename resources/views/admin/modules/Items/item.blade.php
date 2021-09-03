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
                <h4>Items</h4>
            </div>
            <div class="card card-body">


                <form method="post" action="save_itemsdata">
                    @csrf

                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" name="ItemName" required class="form-control" placeholder="Enter Item Name">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Company</label>

                                <select name="Company" require class="form-control" >
                                    <option disabled selected value="">Choose company</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->companyName}}">{{$company->companyName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button style="float:right; margin-right:80px; margin-top: -54px;" type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>

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
                                            <select name="Company" id="Company" require class="form-control" >
                                    
                                </select>
                                        </div>
                                    </div>
                                </div>
                               
                                <button style="float:right; margin-right:15px; margin-top: -55px;" type="submit" class="btn btn-primary">Update</button>
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
    function show_modal(item) {

        $.ajax({
            url: 'edit_itemsdata/'+item,
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