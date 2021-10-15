@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1>Sales Invoice Edit</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div style="padding:20px" class="card card-outline card-info">
          <table id="example1" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Invoice</th>
                <th scope="col">Date</th>
                <th scope="col">PartyName</th>
                <th scope="col">Company</th>
                <th scope="col">AccountHead</th>
                <th scope="col">Total</th>
                <th scope="col">UserName</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($saleInvoices as $saleInvoice)
              <tr>
                <td>{{$saleInvoice->Invoice}}</td>
                <td>{{$saleInvoice->Date}}</td>
                <td>{{$saleInvoice->PartyName}}</td>
                <td>{{$saleInvoice->CompanyName}}</td>
                <td>{{$saleInvoice->AccountHead}}</td>
                <td>{{$saleInvoice->FinalTotal}}</td>
                <td>{{$saleInvoice->Username}}</td>
                
               
                <td>
                  <button class="btn btn-success">
                    <a style="color: white;" href="edit_invoice/{{$saleInvoice->Invoice}}">Edit</a>
                  </button>
                </td>
              
                <td>
                  <button class="btn btn-danger">
                    <a style="color: white;" href="delete_dispatch?startDate={{$saleInvoice->Date}}&endDate={{$saleInvoice->Date}}&PartyName={{$saleInvoice->PartyName}}&Invoice={{$saleInvoice->Invoice}}">Delete</a>
                  </button>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        
         
        </div>
      </div>
    </div>
  </section>
</div>

@endsection