@extends('admin/layouts/reportlayout')
@section('content')

<div class="container">

    <div style="display:flex;justify-content:center">
        <p style="font-weight: bold;font-size:20px">Annual PartyWise Sale Report Of {{$supplier}} Brand Genny {{$date}}</p>
    </div>

    <div style="width:100%; ;display:flex">
        @for($f=0; $f < 10; $f++) <div style="width: 10%;">
            <div style="display: inline-block;width: 41px;text-align: center;font-weight:bold;">CNo</div>
            <div style="display: inline-block;width: 45px;text-align: center;font-weight:bold;">Qty</div>
    </div>
    @endfor
</div>
<div style="height: 1000px; ; display:flex;flex-direction:column;flex-wrap:wrap;align-content:flex-start" class="">

    @for($b=0; $b < count($annualSaleReport); $b++) 
    <span style="background-color: black; color: white;text-align: center;width:10%">
        {{$annualSaleReport[$b]->ItemName}}
        </span>
        @for($d=0; $d < count($annualSaleReport[$b]->varients); $d++)

            <div style="width: 10%; ">
                <div style="display: inline-block;width: 41px;text-align: center;">{{$annualSaleReport[$b]->varients[$d]['varient']}}</div>
                <div style="display: inline-block;width: 45px;text-align: center;">{{$annualSaleReport[$b]->varients[$d]['qty']}}</div>
            </div>

            @endfor
            <div style="width: 10%; ">
                <div style="display: inline-block;width: 41px;text-align: center;font-weight:bold;">Total</div>
                <div style="display: inline-block;width: 45px;text-align: center;font-weight:bold;">{{$annualSaleReport[$b]->total}}</div>
            </div>

            @endfor

</div>

</section>
</div>

<script>
    function printfun() {
        window.print();
    }
</script>



@endsection