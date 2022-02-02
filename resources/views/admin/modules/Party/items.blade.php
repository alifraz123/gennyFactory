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
                                    <h3 class="card-title">Items</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertItems">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Item Name</label>
                                            <input required onfocusout="checkItemNameDuplication(this.value)" id="ItemName" type="text" name="ItemName" class="form-control" placeholder="Item Name">
                                            <label id="itemError"></label>
                                        </div>

                                    </div>

                                    <div class="col-md-5">
                                    <div class="form-group">
                                            <label for="">Rate</label>
                                            <input required class="form-control" name="Rate" id="Rate" placeholder="Item Rate"  >
                                        </div>
                                    </div>

                                    

                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Item Category</label>
                                            <select required class="form-control select2 select2bs4" name="CategoryName" id="CategoryName">
                                            <option selected disabled>Select category...</option>    
                                            @foreach($categories as $category)
                                                <option value="{{$category->CategoryName}}">{{$category->CategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                            <label for="">Company Name</label>
                                            <input required class="form-control" readonly value="{{$sesstionCompanyName}}" name="CompanyName" id="CompanyName">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                <div class="col-md-2">
                                        <input type="submit" style="margin-bottom: 32px;" class="btn btn-success" value="Save">

                                    </div>

                                </div>
                            </form>

                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Item Rate</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->ItemName}}</td>
                                        <td>{{$item->Rate}}</td>
                                        <td>{{$item->CompanyName}}</td>
                                        <td>{{$item->CategoryName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$item->ItemName}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="itemsDelete/{{$item->ItemName}}">Delete</a></td>
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
                                            <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateItems">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Item Name</label>
                                                                <input required onfocusout="updateCheckItemNameDuplication(this.value)" type="text" id="modal_ItemName" name="ItemName" class="form-control" placeholder="Item Name">
                                                                    <label id="updateItemError"></label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Company Name</label>
                                                                <input class="form-control" readonly value="{{$sesstionCompanyName}}" name="CompanyName" id="modal_CompanyName">
                                            
                                                            </div>

                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        

                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Category Name</label>
                                                                <select class="form-control select2 select2bs4" name="CategoryName" id="modal_CategoryName">

                                                                </select>
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

document.getElementById('itemError').style.display = 'none';
    function checkItemNameDuplication(ItemName) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: ItemName,
                type: 'ItemNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('itemError').style.display = 'block';
                    document.getElementById('itemError').style.color = 'red';
                    document.getElementById('itemError').innerText = ItemName + " is already added please change value";
                    document.getElementById('ItemName').value = '';
                    document.getElementById('ItemName').focus();
                } else {
                    document.getElementById('itemError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }
    function check(){
        var ItemName = document.getElementById('ItemName').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: ItemName,
                type: 'ItemNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('itemError').style.display = 'block';
                    document.getElementById('itemError').style.color = 'red';
                    document.getElementById('itemError').innerText = ItemName + " is already added please change value";
                    document.getElementById('ItemName').value = '';
                    document.getElementById('ItemName').focus();
                } else {
                    document.getElementById('itemError').style.display = 'none';
                    if(ItemName!=''){
                        document.getElementById('formId').submit()

                    }

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    document.getElementById('updateItemError').style.display = 'none';
    function updateCheckItemNameDuplication(ItemName) {
        var id = document.getElementById('id').value;
        var modal_ItemName = document.getElementById('modal_ItemName').value;
        if(id!=modal_ItemName){
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: ItemName,
                    type: 'ItemNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('updateItemError').style.display = 'block';
                        document.getElementById('updateItemError').style.color = 'red';
                        document.getElementById('updateItemError').innerText = ItemName + " is already added please change value";
                        document.getElementById('modal_ItemName').value = '';
                        document.getElementById('modal_ItemName').focus();
                    } else {
                        document.getElementById('updateItemError').style.display = 'none';
    
                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
    }

    function check2(){
       
        var id = document.getElementById('id').value;
        var modal_ItemName = document.getElementById('modal_ItemName').value;
        if(id!=modal_ItemName){
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: Itemodal_ItemNameName,
                    type: 'ItemNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('updateItemError').style.display = 'block';
                        document.getElementById('updateItemError').style.color = 'red';
                        document.getElementById('updateItemError').innerText = modal_ItemName + " is already added please change value";
                        document.getElementById('modal_ItemName').value = '';
                        document.getElementById('modal_ItemName').focus();
                    } else {
                        document.getElementById('updateItemError').style.display = 'none';
                        if(ItemName!=''){
                            document.getElementById('updateformId').submit()

                        }
    
                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
        else{
            if(ItemName!=''){
                            document.getElementById('updateformId').submit()

                        }
        }

    }


    function getValueForEdit(itemName) {

        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getCompanyNameForEdit',
            type: 'post',
            data: {
                itemName: itemName,
                _token: token
            },
            success: function(data) {
                // console.log(data)
                let userType = `<option selected readonly value="${data.itemsCompanyName.CompanyName}">${data.itemsCompanyName.CompanyName}</option>`;
                userType += '<option disabled readonly value="">Choose userType...</option>';
                data.companies.forEach(el => {
                    userType += `
                    <option value="${el.CompanyName}">${el.CompanyName}</option>
                    `;
                    document.getElementById('modal_CompanyName').innerHTML = userType;
                });

                let userType2 = `<option selected readonly value="${data.itemsCompanyName.CategoryName}">${data.itemsCompanyName.CategoryName}</option>`;
                userType2 += '<option disabled readonly value="">Choose category...</option>';
                data.categories.forEach(el => {
                    userType2 += `
                    <option value="${el.CategoryName}">${el.CategoryName}</option>
                    `;
                    document.getElementById('modal_CategoryName').innerHTML = userType2;
                });


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })


        $.ajax({
            url: 'itemsEdit',
            type: 'get',
            data: {
                itemName: itemName
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data.ItemName;
                document.getElementById('modal_ItemName').value = data.ItemName;
                
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection