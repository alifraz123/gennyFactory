@extends('admin/layouts/reportlayout')
@section('content')



<div class="container" style="display:flex;justify-content:space-between;height:100px;align-items:center">
    <div>
        {{$rawMaterial[0]->date}}
    </div>
    <div>
        <p style="font-weight: bold;font-size:20px">Packing Material DSR ({{$rawMaterial[0]->date}}) </p>
    </div>
    <div>

    </div>

</div>


<div class="container-fluid" style="width:100%;display:flex">
    @for($a=0;$a < 2; $a++) <div style="width: 50%;">
        <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">CNo</div>
        <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">OP/BAL</div>

        <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">RCVD</div>
        <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">TOTAL</div>

        <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">USED</div>
        <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">CL/BAL</div>
        <div style="display: inline-block;width: 12%;text-align: center;font-weight:bold;">REJ</div>


</div>
@endfor
</div>
<div style=" display:flex;flex-direction:column;flex-wrap:wrap;align-content:flex-start" class="container-fluid">

    @for($b=0; $b < count($rawMaterial); $b++) <span style="background-color: black; color: white;text-align: center;width:20%;margin-bottom:15px">
        {{$rawMaterial[$b]->itemname}}
        </span>

        <div class="container-fluid" style="width:100%;display:flex;padding-left:0;padding-right:0">

            <div style="width: 50%;border:1px solid black">
                <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">CNo</div>
                <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">OP/BAL</div>

                <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">RCVD</div>
                <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">TOTAL</div>

                <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">USED</div>
                <div style="display: inline-block;width: 14%;text-align: center;font-weight:bold;">CL/BAL</div>
                <div style="display: inline-block;width: 12%;text-align: center;font-weight:bold;">REJ</div>


            </div>

        </div>

        @for($c=0; $c < count($rawMaterial[$b]->varient_data); $c++)
            <div style="width: 50%; border:1px solid black">
                <div style="display: inline-block;width: 14%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['material']}}</div>
                <div style="display: inline-block;width: 14%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['ob']}}</div>

                <div style="display: inline-block;width: 14%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['recieved']}}</div>
                <div style="display: inline-block;width: 14%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['total']}}</div>

                <div style="display: inline-block;width: 14%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['used']}}</div>
                <div style="display: inline-block;width: 14%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['cb']}}</div>

                <div style="display: inline-block;width: 12%;text-align: center;">{{$rawMaterial[$b]->varient_data[$c]['rejected']}}</div>

            </div>

            @endfor


            @endfor


</div>



@endsection