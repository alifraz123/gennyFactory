@extends('admin/layouts/reportlayout')
@section('content')

<style>
    .table td,
    .table th {
        padding: 0rem;
        vertical-align: top;
        border-top: 0;
    }
</style>
<div style="height: 1480px;">
    <div class="container" style="display:flex;justify-content:space-between;height:100px;align-items:center">
        <div>
            {{$purchase[0]->date}}
        </div>
        <div>
            <p style="font-weight: bold;font-size:20px"> Materials received from {{$purchase[0]->vender}} B/w ({{$purchase[0]->date}}) & ({{$purchase[1]->date}}) </p>
        </div>
        <div>

        </div>

    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-2">
                <p style="border-bottom: 1px solid black;width:40px">Type</p>
            </div>
            <div class="col-md-2">
                <p style="border-bottom: 1px solid black;width:40px">Qty</p>
            </div>
            <div class="col-md-2">
                <p style="border-bottom: 1px solid black;width:80px">Builty No</p>
            </div>
            <div class="col-md-2">
                <p style="border-bottom: 1px solid black;width:40px">Via</p>
            </div>
            <div class="col-md-2">
                <p style="border-bottom: 1px solid black;width:100px">Dispatch Date</p>
            </div>
            <div class="col-md-2">
                <p style="border-bottom: 1px solid black;width:100px">Recieve Date</p>
            </div>
        </div>
    </div>
    @for($a=0; $a < count($purchase); $a++) <div class="container">
        @for($b=0; $b < count($purchase[$a]->item_detail); $b++)
            <div style="border-bottom: 1px solid black;width:80px;font-weight:bold">{{$purchase[$a]->item_detail[$b]['itemname']}}</div>
            @for($c=0; $c < count($purchase[$a]->item_detail[$b]['varient']); $c++)
                <div class="row">
                    <div class="col-md-2">{{$purchase[$a]->item_detail[$b]['varient'][$c]['varient']}}</div>
                    <div class="col-md-2">{{$purchase[$a]->item_detail[$b]['varient'][$c]['qty']}}</div>
                    <div class="col-md-2">{{$purchase[$a]->item_detail[$b]['varient'][$c]['builtyNo']}}/{{$purchase[$a]->item_detail[$b]['varient'][$c]['carton_qty']}}</div>
                    <div class="col-md-2">{{$purchase[$a]->item_detail[$b]['varient'][$c]['via']}}</div>
                    <div class="col-md-2">{{$purchase[$a]->item_detail[$b]['varient'][$c]['DisDate']}}</div>
                    <div class="col-md-2">{{$purchase[$a]->item_detail[$b]['varient'][$c]['recieveDate']}}</div>
                </div>
                @endfor
                @endfor
</div>




@endfor
</div>
<div class="container" style="display:flex;justify-content:space-between;height:100px;align-items:center">
        <div>
            {{$purchase[0]->date}}
        </div>
        <div>
            <p style="font-weight: bold;font-size:20px"> Materials received from {{$purchase[0]->vender}} B/w ({{$purchase[0]->date}}) & ({{$purchase[1]->date}}) </p>
        </div>
        <div>

        </div>

    </div>
<div style="height: 1000px;padding:0; border:1px solid black; display:flex;flex-direction:column;flex-wrap:wrap;align-content:flex-start" class="container">
    <p>RECIEVED SUMMARY REPORT</p>
    @for($a=0; $a < count($purchase); $a++) @for($e=0; $e < count($purchase[$a]->item_total); $e++)


        <span style="background-color: black; color: white;text-align: center;width:20%">
            {{$purchase[$a]->item_total[$e]['itemname']}}
        </span>

        @for($f=0; $f < count($purchase[$a]->item_total[$e]['varient']); $f++)
            <div style="width: 20%; border:1px solid black">
                <div style="display: inline-block;width: 90px;text-align: center;">{{$purchase[$a]->item_total[$e]['varient'][$f]['varient']}}</div>
                <div style="display: inline-block;width: 90px;text-align: center;">{{$purchase[$a]->item_total[$e]['varient'][$f]['qty']}}</div>
            </div>

            @endfor
            <div style="width: 20%; border:1px solid black">
                <div style="display: inline-block;width: 90px;text-align: center;font-weight:bold;">Total</div>
                <div style="display: inline-block;width: 90px;text-align: center;font-weight:bold;">{{$purchase[$a]->item_total[$e]['total']}}</div>
            </div>

            @endfor


            @endfor
</div>
@endsection