@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="zones" class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Items Rate</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertItemRate">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">ItemName</label>
                                            <select required class="form-control select2 select2bs4" name="ItemName" id="ItemName">
                                                <option selected disabled>Select Item Name...</option>
                                                @foreach($Items as $item)
                                                <option value="{{$item->ItemName}}">{{$item->ItemName}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Party Type</label>
                                            <select required class="form-control select2 select2bs4" name="PartyType" id="PartyType">
                                                <option selected disabled>Select Party Type...</option>
                                                @foreach($PartyTypes as $PartyType)
                                                <option value="{{$PartyType->partyType}}">{{$PartyType->partyType}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Rate</label>
                                            <input required type="text" name="Rate" id="Rate" class="form-control" placeholder="Item Rate">
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">AccountHead</label>
                                            <input required type="text" id="AccountHeadValue" name="AccountHead" readonly class="form-control" value="{{$AccountHead}}">
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Company Name</label>
                                            <input required type="text" readonly id="Company" name="CompanyName" class="form-control" value="{{$Companies}}">
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" style="margin-top: 32px;" class="btn btn-success" value="Save">

                                    </div>

                                </div>

                            </form>

                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Party Type</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">AccountHead</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Rates as $Rate)
                                    <tr>
                                        <td>{{$Rate->ItemName}}</td>
                                        <td>{{$Rate->PartyType}}</td>
                                        <td>{{$Rate->Rate}}</td>
                                        <td>{{$Rate->AccountHead}}</td>
                                        <td>{{$Rate->Company}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$Rate->id}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="itemRateDelete/{{$Rate->id}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit ItemNames</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateItemRate">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">

                                                <input type="hidden" value="" id="hidden_ItemName" name="id">
                                                <input type="hidden" value="" id="hidden_PartyType" name="id">
                                                <input type="hidden" value="" id="hidden_Rate" name="id">
                                                <input type="hidden" value="" id="hidden_AccountHead" name="id">
                                                <input type="hidden" value="" id="hidden_Company" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">ItemName</label>
                                                                <select required class="form-control select2 select2bs4" name="modal_ItemName" id="modal_ItemName">

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Party Type</label>
                                                                <select required class="form-control select2 select2bs4" name="modal_PartyType" id="modal_PartyType">

                                                                </select>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="row">


                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Rate</label>
                                                                <input required type="text" id="modal_Rate" name="modal_Rate" class="form-control">
                                                            </div>

                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">AccountHead</label>
                                                                <input required type="text" id="modal_AccountHead" name="modal_AccountHead" readonly class="form-control">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Company Name</label>
                                                                <input id="modal_Company" required type="text" readonly name="modal_Company" class="form-control">
                                                            </div>

                                                        </div>

                                                        <div class="col-md-2">
                                                            <input style=" margin-top: 32px;" value="Update" type="submit" class="btn btn-primary">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-footer">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>


<script>
    function check() {
        var ItemName = document.getElementById('ItemName').value;
        var PartyType = document.getElementById('PartyType').value;
        var Rate = document.getElementById('Rate').value;
        var AccountHeadValue = document.getElementById('AccountHeadValue').value;
        var Company = document.getElementById('Company').value;

        $.ajax({
            url: 'checkDuplicationOfItemRateData',
            type: 'get',
            data: {
                ItemName: ItemName,
                PartyType: PartyType,
                Rate: Rate,
                AccountHead: AccountHeadValue,
                Company: Company
            },
            success: function(data) {
                if (data == "Exist") {
                    alert("This is data is already exist please change values")
                } else {
                    document.getElementById('formId').submit()
                }
            }
        })

    }


    function check2() {
      
        var ItemName = document.getElementById('modal_ItemName').value;
        var PartyType = document.getElementById('modal_PartyType').value;
        var Rate = document.getElementById('modal_Rate').value;
        var AccountHeadValue = document.getElementById('modal_AccountHead').value;
        var Company = document.getElementById('modal_Company').value;

        var hidden_ItemName = document.getElementById('hidden_ItemName').value;
        var hidden_PartyType = document.getElementById('hidden_PartyType').value;
        var hidden_Rate = document.getElementById('hidden_Rate').value;
        var hidden_AccountHeadValue = document.getElementById('hidden_AccountHead').value;
        var hidden_Company = document.getElementById('hidden_Company').value;
        if(hidden_ItemName!=ItemName || hidden_PartyType!=PartyType || hidden_Rate!=Rate ||
         hidden_AccountHeadValue!=AccountHeadValue
        || hidden_Company!=Company
        ){
            
            $.ajax({
                url: 'checkDuplicationOfItemRateData',
                type: 'get',
                data: {
                    ItemName: ItemName,
                    PartyType: PartyType,
                    Rate: Rate,
                    AccountHead: AccountHeadValue,
                    Company: Company
                },
                success: function(data) {
                    if (data == "Exist") {
                        alert("This is data is already exist please change values")
                    } else {
                        document.getElementById('updateformId').submit()
                    }
                }
            })

        }
        else{
            document.getElementById('updateformId').submit()
        }

    }

    function getValueForEdit(id) {

        $.ajax({
            url: 'itemRateEdit',
            type: 'get',
            data: {
                id: id,
            },
            success: function(data) {
                // console.log(data)

                document.getElementById('hidden_ItemName').value = data.ItemName;
                document.getElementById('hidden_PartyType').value = data.PartyType;
                document.getElementById('hidden_Rate').value = data.Rate;
                document.getElementById('hidden_AccountHead').value = data.AccountHead;
                document.getElementById('hidden_Company').value = data.Company;
                

                document.getElementById('id').value = data.id;
                document.getElementById('modal_Rate').value = data.Rate;

                document.getElementById('modal_AccountHead').value = data.AccountHead;
                document.getElementById('modal_Company').value = data.Company;

                let userType = `<option selected readonly value="${data.ItemName}">${data.ItemName}</option>`;
                userType += '<option disabled readonly value="">Choose ItemName...</option>';
                $.ajax({
                    url: 'getItemNameOfItemRate',
                    type: 'get',
                    success: function(data) {
                        console.log(data)
                        data.forEach(el => {
                            userType += `
                    <option value="${el.ItemName}">${el.ItemName}</option>`;
                            document.getElementById('modal_ItemName').innerHTML = userType;
                        });
                    }
                })

                let userType2 = `<option selected readonly value="${data.PartyType}">${data.PartyType}</option>`;
                userType2 += '<option disabled readonly value="">Choose PartyType...</option>';
                $.ajax({
                    url: 'getPartyTypeOfItemRate',
                    type: 'get',
                    success: function(data) {
                        console.log(data)
                        data.forEach(el => {
                            userType2 += `
                    <option value="${el.partyType}">${el.partyType}</option>`;
                            document.getElementById('modal_PartyType').innerHTML = userType2;
                        });
                    }
                })




            },
            error: function(req, status, error) {
                console.log(error)

            }

        });
        $('#exampleModal').modal('show');
    }
</script>
@endsection