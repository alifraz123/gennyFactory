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
        <div style="margin-top: 1rem;" class="container-fluid">
            <div style="margin-top: 1rem;" class="container-fluid">
                <div class="row">
                    <h3 style="text-align: center;">Stock</h4>
                </div>
                <div class="card card-primary">
                    <form method="post" action="save_stockdata">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Company</label>

                                        <select onchange="getItemsOfSelectedCompany(this.value)" name="company" required class="form-control">
                                            <option selected disabled value="">choose...</option>
                                            @foreach($companies as $company)
                                            <option value="{{$company->companyName}}">{{$company->companyName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Item Name</label>

                                        <select name="itemname" id="itemname" required class="form-control">
                                            <option selected disabled value="">Choose item...</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                <div class="form-group">
                                        <label>Varient</label>
                                        <input type="text" name="Varient" required class="form-control" placeholder="Enter Varient">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            

                        </div>
                        <button style="float:right; margin-right:80px; margin-top: -55px;" type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="card-footer">
                </div>
                </form>
                <!-- /.card-header -->


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog mw-100 w-50" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="edit_stockdata">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-sm-5">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Varient</label>
                                                    <input type="text" name="Varient" id="Varient" required class="form-control" placeholder="Enter Varient">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Item Name</label>

                                                    <select name="itemname" id="ItemName" required class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Company</label>

                                                    <select name="company" id="Company" required class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        

                                    </div>
                                    <button style="float:right; margin-right:32px; margin-top: -75px;" type="submit" class="btn btn-primary">Update</button>
                            </div>



                        </div>
                        <div class="card-footer">
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Varient</th>
                        <th>Item Name</th>
                        <th>Company</th>

                        <th>Finish</th>
                        <th>SemiFinish</th>
                        <th>Damage</th>
                       
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="companydata">
                    @foreach($stocks as $stock)
                    <tr>
                        <td> {{$stock->varient}}</td>
                        <td>{{$stock->itemname}}</td>
                        <td> {{$stock->company}}</td}>

                        <td> {{$stock->finish}}</td}>
                        <td> {{$stock->semiFinish}}</td}>
                        <td> {{$stock->damage}}</td}>
                      
                        
                       
                        <td><button onclick="show_modal('{{$stock->id}}')" class="btn btn-success">Edit</button> </td>
                        <td><a href='delete_stockdata/{{$stock->id}}' class="btn btn-danger">Delete</a> </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
        <!-- /.card-body -->
</div>

</div>

</div>
</div>
</section>
<script>
    function getItemsOfSelectedCompany(companyName) {
        var company = companyName;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getItemsOfSelectedCompany',
            type: 'post',
            data: {
                company: company,
                _token: token
            },
            success: function(data) {

                let output = '<option selected disabled value="">Choose item...</option>';
                data.forEach(el => {
                    output += `
                    <option value="${el.itemname}">${el.itemname}</option>
                    `;
                    document.getElementById('itemname').innerHTML = output;
                });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }



    function show_modal(stock) {

        $.ajax({
            url: 'edit_stockdata/' + stock,
            type: 'get',
            data: {
                stock: stock
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data['data'][0].id;
                document.getElementById('Varient').value = data['data'][0].varient;
                
              
                let company = `<option selected readonly value="${data['data'][0].company}">${data['data'][0].company}</option>`;
                let ItemName = `<option selected readonly value="${data['data'][0].itemname}">${data['data'][0].itemname}</option>`;

                document.getElementById('Company').innerHTML = company;
                document.getElementById('ItemName').innerHTML = ItemName;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>



@endsection