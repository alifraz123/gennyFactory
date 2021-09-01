@extends('admin/layouts/reportlayout')
@section('content')
<input type="hidden" id="hidden_debit">
<input type="hidden" id="hidden_credit">
<div class="container">
    <section style="margin-top: 40px;" class="content">

        <div style="display: flex;justify-content:space-between">
            @for($a=0; $a < count($dispatch); $a++) <div>
                BuiltyNo : {{$dispatch[$a]->builtyNo}}
        </div>
        <div>
            Chalan No : {{$dispatch[$a]->invoice}}
        </div>

</div>

<div style="display:flex;justify-content:center">
    <p>Dispatch Report of : {{$dispatch[$a]->supplier}} {{$dispatch[$a]->city}} {{$dispatch[$a]->date}}</p>
</div>

<table style="width: 10%;" class="table">
    <thead>
        <tr>

            <th scope="col">CNo</th>
            <th scope="col">Qty</th>

        </tr>

    </thead>
    <tbody>
        <div style="column-count: 4;">
        @for($b=0; $b < count($dispatch[$a]->dispatch_detail); $b++)

            <tr>
                <td style="text-align: center;background-color: black;color: white;" colspan="2">
                    {{$dispatch[$a]->dispatch_detail[$b]['items']}}
                </td>
            </tr>

            @for($c=0; $c < count($dispatch[$a]->dispatch_detail[$b]['qty_var']); $c++)
                <tr>
                    <td>{{$dispatch[$a]->dispatch_detail[$b]['qty_var'][$c]->varient}}</td>
                    <td>{{$dispatch[$a]->dispatch_detail[$b]['qty_var'][$c]->qty}}</td>
                </tr>

                @endfor

                <tr>
                    <td style="font-weight: bold;">
                        Total
                    </td>
                    <td style="font-weight: bold;">
                        {{$dispatch[$a]->dispatch_detail[$b]['total']}}
                    </td>
                </tr>
                @endfor
                </div>
    </tbody>
</table>

@endfor


</section>
</div>

<script>
    function printfun() {
        window.print();
    }
</script>



@endsection