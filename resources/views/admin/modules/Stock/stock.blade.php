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
                                    <h3 class="card-title">Stock</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertStock">
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
                                            <label for="">Fresh Stock</label>
                                            <input required type="text" name="FreshStock" id="FreshStock" class="form-control" placeholder="Fresh stock">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Damage Stock</label>
                                            <input required type="text" name="DamageStock" id="DamageStock" class="form-control" placeholder="Damage stock">
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
                                            <input required type="text" readonly id="Company" name="Company" class="form-control" value="{{$Companies}}">
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
                                        <th scope="col">Fresh Stock</th>
                                        <th scope="col">Damage Stock</th>
                                        <th scope="col">AccountHead</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{$stock->ItemName}}</td>
                                        <td>{{$stock->FreshStock}}</td>
                                        <td>{{$stock->DamageStock}}</td>
                                        <td>{{$stock->AccountHead}}</td>
                                        <td>{{$stock->Company}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$stock->id}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="stockDelete/{{$stock->id}}">Delete</a></td>
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
                                            <form onsubmit="event.preventDefault();check2();" id="updateformId" method="post" action="updateStock">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">

                                                <input type="hidden" value="" id="hidden_ItemName" >
                                                <input type="hidden" value="" id="hidden_FreshStock" >
                                                <input type="hidden" value="" id="hidden_DamageStock" >
                                                <input type="hidden" value="" id="hidden_AccountHead" >
                                                <input type="hidden" value="" id="hidden_Company" >
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
                                                                <label for="">Fresh Stock</label>
                                                                <input required type="text" name="modal_FreshStock" id="modal_FreshStock" class="form-control" placeholder="Fresh stock">
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="row">


                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Damage Stock</label>
                                                                <input required type="text" name="modal_DamageStock" id="modal_DamageStock" class="form-control" placeholder="Fresh stock">
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
        var FreshStock = document.getElementById('FreshStock').value;
        var DamageStock = document.getElementById('DamageStock').value;
        var AccountHeadValue = document.getElementById('AccountHeadValue').value;
        var Company = document.getElementById('Company').value;

        $.ajax({
            url: 'checkDuplicationOfStockData',
            type: 'get',
            data: {
                ItemName: ItemName,
                FreshStock: FreshStock,
                DamageStock: DamageStock,
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
      var FreshStock = document.getElementById('modal_FreshStock').value;
      var DamageStock = document.getElementById('modal_DamageStock').value;
      var AccountHead = document.getElementById('modal_AccountHead').value;
      var Company = document.getElementById('modal_Company').value;

      var hidden_ItemName = document.getElementById('hidden_ItemName').value;
      var hidden_FreshStock = document.getElementById('hidden_FreshStock').value;
      var hidden_DamageStock = document.getElementById('hidden_DamageStock').value;
      var hidden_AccountHeadValue = document.getElementById('hidden_AccountHead').value;
      var hidden_Company = document.getElementById('hidden_Company').value;
      if(hidden_ItemName!=ItemName || hidden_FreshStock!=FreshStock || hidden_DamageStock!=DamageStock ||
      hidden_AccountHeadValue!=AccountHeadValue|| hidden_Company!=Company){
          
          $.ajax({
              url: 'checkDuplicationOfStockData',
              type: 'get',
              data: {
                  ItemName: ItemName,
                  FreshStock: FreshStock,
                  DamageStock: DamageStock,
                  AccountHead: AccountHead,
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
            url: 'stockEdit',
            type: 'get',
            data: {
                id: id,
            },
            success: function(data) {
                // console.log(data)

                document.getElementById('hidden_ItemName').value = data.ItemName;
                document.getElementById('hidden_FreshStock').value = data.FreshStock;
                document.getElementById('hidden_DamageStock').value = data.DamageStock;
                document.getElementById('hidden_AccountHead').value = data.AccountHead;
                document.getElementById('hidden_Company').value = data.Company;


                document.getElementById('id').value = data.id;
                document.getElementById('modal_FreshStock').value = data.FreshStock;
                document.getElementById('modal_DamageStock').value = data.DamageStock;

                document.getElementById('modal_AccountHead').value = data.AccountHead;
                document.getElementById('modal_Company').value = data.Company;

                let userType = `<option selected readonly value="${data.ItemName}">${data.ItemName}</option>`;
                userType += '<option disabled readonly value="">Choose ItemName...</option>';
                $.ajax({
                    url: 'getItemNameOfStock',
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

                
            },
            error: function(req, status, error) {
                console.log(error)

            }

        });
        $('#exampleModal').modal('show');
    }
</script>
@endsection