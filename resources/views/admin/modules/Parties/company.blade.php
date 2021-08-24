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
            <div class="row">
                <a style="margin-bottom: 20px;" href="enterPartyData"> <button class="btn btn-primary">Insert Party</button> </a>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Parties Data Show Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Party Code</th>
                                <th>Party Name</th>
                                <th>CNIC</th>
                                <th>NTN</th>
                                <th>Sales Tax</th>

                                <th>Address</th>
                                <th>City</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($parties as $party)
                            <tr>
                                <td> {{$party->PartyCode}}</td>
                                <td>{{$party->PartyName}}</td>
                                <td> {{$party->CNIC}}</td>
                                <td>{{$party->NTN}}</td>
                                <td> {{$party->SalesTex}}</td>

                                <td> {{$party->Adress}}</td>
                                <td>{{$party->City}}</td>
                                <td><a href='edit_partydata/{{$party->PartyCode}}' class="btn btn-success">Edit</a> </td>
                                <td><a href='delete_partydata/{{$party->PartyCode}}' class="btn btn-danger">Delete</a> </td>

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