@extends('admin/layouts/reportlayout')
@section('content')

<div class="container">
    
<div style="display:flex;justify-content:center">
    <p style="font-weight: bold;font-size:20px" >Genny Finished Stock Report (Qty in pcs) {{$finish[0]->date}}</p>
</div>

<div style="width:100%; border:1px solid black;display:flex">
    @for($f=0; $f < 10; $f++) 
    <div style="width: 10%;border:1px solid black">
        <div style="display: inline-block;width: 41px;text-align: center;font-weight:bold;">CNo</div>
        <div style="display: inline-block;width: 45px;text-align: center;font-weight:bold;">Qty</div>
</div>
@endfor
</div>
<div style="height: 1000px; border:1px solid black; display:flex;flex-direction:column;flex-wrap:wrap;align-content:flex-start" class="">

    @for($b=0; $b < count($finish); $b++)


        <span style="background-color: black; color: white;text-align: center;width:10%">
            {{$finish[$b]->itemname}}
        </span>

        @for($c=0; $c < count($finish[$b]->varient); $c++)
            <div style="width: 10%; border:1px solid black">
                <div style="display: inline-block;width: 41px;text-align: center;">{{$finish[$b]->varient[$c]['varient']}}</div>
                <div style="display: inline-block;width: 45px;text-align: center;">{{$finish[$b]->varient[$c]['qty']}}</div>
            </div>

            @endfor
            <div style="width: 10%; border:1px solid black">
                <div style="display: inline-block;width: 41px;text-align: center;font-weight:bold;">Total</div>
                <div style="display: inline-block;width: 45px;text-align: center;font-weight:bold;">{{$finish[$b]->total}}</div>
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