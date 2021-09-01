@extends('admin/layouts/reportlayout')
@section('content')
<style>
table {
  
  margin-bottom: 1rem;
  border-collapse: separate;
  width: 100%;
}

td {
  
  text-align: left;
  padding-bottom: 0px;
}
p{
    line-height: 0.3;
}

</style>
<div class="container">
    <section style="margin-top: 40px;" class="content">
        <div style="font-size: 13px;" class="row">

            @for($a=0; $a < count($dispatch); $a++)
             @for($b=0; $b < count($dispatch[$a]->dispatch_detail); $b++)

                <div class="col-md-3">
                    <p> Carton No. : {{$dispatch[$a]->dispatch_detail[$b]['cno']}} </p>
                    <p>{{$dispatch[$a]->supplier}}</p>
                    <p>Date : {{$dispatch[$a]->date}}</p>
                    <p>Packed by : ___________</p>
                    @for($e=0; $e < count($dispatch[$a]->dispatch_detail[$b]['ItemName']);$e++)

                        <p>{{$dispatch[$a]->dispatch_detail[$b]['ItemName'][$e]['items']}} </p>
                        <table style="width:100%; line-height:1.2" class="">
                            <thead>
                                <tr>
                                    <th style="border-bottom:1px solid black" scope="col">CNo</th>
                                    <th style="border-bottom:1px solid black" scope="col">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($f=0; $f < count($dispatch[$a]->dispatch_detail[$b]['ItemName'][$e]['qty_var']);$f++)
                                    <tr >
                                        <td>
                                            {{$dispatch[$a]->dispatch_detail[$b]['ItemName'][$e]['qty_var'][$f]->varient}} 
                                        </td>
                                        <td>
                                            {{$dispatch[$a]->dispatch_detail[$b]['ItemName'][$e]['qty_var'][$f]->qty}} 

                                        </td>
                                    </tr>
                                    @endfor
                                    <th style="border-bottom:1px solid black;border-top:1px solid black">Total:</th>
                                    <th style="border-bottom:1px solid black;border-top:1px solid black">{{$dispatch[$a]->dispatch_detail[$b]['ItemName'][$e]['total']}}</th>
                            </tbody>
                        </table>

                        @endfor

                </div>

                @endfor

                @endfor

        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function printfun() {
        window.print();
    }
</script>



@endsection