@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1>Return Invoice Edit</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div style="padding:20px" class="card card-outline card-info">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Invoice</th>
                <th scope="col">Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Company</th>
                <th scope="col">Zone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($saleInvoices as $saleInvoice)
              <tr>
                <td>{{$saleInvoice->invoice}}</td>
                <td>{{$saleInvoice->date}}</td>
                <td>{{$saleInvoice->supplier}}</td>
                <td>{{$saleInvoice->company}}</td>
               
              
                <td>
                  <button class="btn btn-success">
                    <a style="color: white;" href="edit_Returninvoice/{{$saleInvoice->invoice}}">Edit</a>
                  </button>
                </td>
              
                <td>
                  <button class="btn btn-danger">
                    <a style="color: white;" href="delete_return_invoice?startDate={{$saleInvoice->startDate}}&endDate={{$saleInvoice->endDate}}&partyName={{$saleInvoice->partyName}}&invoice={{$saleInvoice->invoice}}">Delete</a>
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