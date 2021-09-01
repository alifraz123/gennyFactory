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
                                        <label>Varient</label>
                                        <input type="text" name="Varient" required class="form-control" placeholder="Enter Varient">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Item Name</label>

                                        <select name="itemname" id="itemname" required class="form-control">
                                            <option selected disabled value="">Choose item...</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Finish Quantity</label>
                                        <input type="number" name="finish" required class="form-control" placeholder="Enter Finish Items">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Semi Finish Quantity</label>
                                        <input type="number" name="semi_finish" required class="form-control" placeholder="Enter semi_finish items">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Damage Quantity</label>
                                        <input type="number" name="damage" required class="form-control" placeholder="Enter Damage items">
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
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Varient</th>
                                <th>Item Name</th>
                                <th>Company</th>
                                <th>Semi Finish</th>
                                <th>Finish</th>
                                <th>Damaged</th>
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
                                <td>{{$stock->semiFinish}}</td>
                                <td>{{$stock->finish}}</td>
                                <td>{{$stock->damage}}</td>
                                <td><a href='edit_stockdata/{{$stock->id}}' class="btn btn-success">Edit</a> </td>
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
</script>


@endsection