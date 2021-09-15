@extends('admin/layouts/reportlayout')
@section('content')

<style>
    .table td, .table th {
    padding: 0rem;
    vertical-align: top;
    border-top: 0;
    }
</style>
<div class="container" style="display:flex;justify-content:space-between;height:100px;align-items:center">
    <div>
        4/1/2021
    </div>
    <div>
        <p style="font-weight: bold;font-size:20px"> Materials received from Waseem Sb B/w 1/4/2021 & 4/6/2021 </p>
    </div>
    <div>

    </div>

</div>

<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Qty</th>
                <th scope="col">Builty No</th>
                <th scope="col">Via</th>
                <th scope="col">Dispatch Date</th>
                <th scope="col">Recieve Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            
        </tbody>
    </table>

</div>

@endsection