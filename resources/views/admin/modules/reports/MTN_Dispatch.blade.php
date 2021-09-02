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

<div style="width:100%; border:1px solid black;display:flex">
    @for($f=0; $f < 10; $f++) <div style="width: 10%;border:1px solid black">
        <div style="display: inline-block;width: 41px;text-align: center;font-weight:bold;">CNo</div>
        <div style="display: inline-block;width: 45px;text-align: center;font-weight:bold;">Qty</div>
</div>
@endfor
</div>
<div style="height: 1000px; border:1px solid black; display:flex;flex-direction:column;flex-wrap:wrap;align-content:flex-start" class="">

    @for($b=0; $b < count($dispatch[$a]->dispatch_detail); $b++)


        <span style="background-color: black; color: white;text-align: center;width:10%">
            {{$dispatch[$a]->dispatch_detail[$b]['items']}}
        </span>

        @for($c=0; $c < count($dispatch[$a]->dispatch_detail[$b]['qty_var']); $c++)
            <div style="width: 10%; border:1px solid black">
                <div style="display: inline-block;width: 41px;text-align: center;">{{$dispatch[$a]->dispatch_detail[$b]['qty_var'][$c]->varient}}</div>
                <div style="display: inline-block;width: 45px;text-align: center;">{{$dispatch[$a]->dispatch_detail[$b]['qty_var'][$c]->qty}}</div>
            </div>

            @endfor
            <div style="width: 10%; border:1px solid black">
                <div style="display: inline-block;width: 41px;text-align: center;font-weight:bold;">Total</div>
                <div style="display: inline-block;width: 45px;text-align: center;font-weight:bold;">{{$dispatch[$a]->dispatch_detail[$b]['total']}}</div>
            </div>

            @endfor


</div>
<p style="font-weight: bold;font-size:20px;margin-bottom:30px">Delivered By: </p>

<div style="height: 300px; width:100%;border:1px solid black;">
    @for($b=0; $b < count($dispatch[$a]->dispatch_detail); $b++)

        <div style="display: flex;flex-flow: wrap;align-items: flex-start;margin: 13px;line-height:0;margin-top:25px">
            <span style="width: 10vw; font-weight:bold">{{$dispatch[$a]->dispatch_detail[$b]['items']}}</span>
            <span>{{$dispatch[$a]->dispatch_detail[$b]['total']}}</span>
        </div>

        @endfor

</div>

@endfor


</section>
</div>

<script>
    function printfun() {
        window.print();
    }
</script>



@endsection