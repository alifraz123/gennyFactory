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
                <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Invoice</th>
      <th scope="col">Date</th>
      <th scope="col">PartyName</th>
      <th scope="col">Total</th>
      <th scope="col">F.Total</th>
      <th scope="col">Credit</th>
      <th scope="col">Debit</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($saleInvoices as $saleInvoice)
    <tr>
      <td>{{$saleInvoice->invoice}}</td>
      <td>{{$saleInvoice->Date}}</td>
      <td>{{$saleInvoice->PartyName}}</td>
      <td>{{$saleInvoice->Total}}</td>
      <td>{{$saleInvoice->FinalTotal}}</td>
      <td>{{empty($saleInvoice->Credit) ? 0 : $saleInvoice->Credit }}</td>
      <td>{{$saleInvoice->Debit}}</td>
      <td><button class="btn btn-danger"><a style="color: white;" href="edit_invoice/{{$saleInvoice->invoice}}">Edit</a></button></td>
    </tr>
    @endforeach
   
  </tbody>
</table>
{{$saleInvoices->links()}}
<style>
  .w-5{
    display: none;
  }
</style>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection