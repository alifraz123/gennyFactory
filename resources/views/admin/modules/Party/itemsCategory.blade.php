@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="roles" class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Items Category</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check()" id="formId" method="post" action="insertItemsCategory">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Category Name</label>
                                            <input required id="CategoryName" type="text" name="CategoryName" class="form-control" placeholder="Company Name">
                                            <label id="categoryError"></label>
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
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->CategoryName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$category->CategoryName}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="itemsCategoryDelete/{{$category->CategoryName}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Items Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); updatecheck()" id="updateformId" method="post" action="updateItemsCategory">
                                                @csrf
                                                <input type="hidden" value="" id="modal_id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>Category Name</label>
                                                                <input required type="text" name="CategoryName" id="modal_CategoryName" required class="form-control">
                                                           <label id="updateCategoryError"></label>
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

document.getElementById('categoryError').style.display = 'none';
    function check() {
        var RoleValue = document.getElementById('CategoryName').value;
        if (RoleValue != '') {
            // console.log("first")
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: RoleValue,
                    type:'categoryCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('categoryError').style.display = 'block';
                        document.getElementById('categoryError').style.color = 'red';
                        document.getElementById('categoryError').innerText = RoleValue + " is already added please change value";
                    } else {

                        document.getElementById('formId').submit()
                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        }

    }


    document.getElementById('updateCategoryError').style.display = 'none';
    function updatecheck() {
        var RoleValue = document.getElementById('modal_CategoryName').value;
        var modal_id = document.getElementById('modal_id').value;
        
        if(modal_id!=RoleValue){
            if (RoleValue != '') {
                // console.log("first")
                $.ajax({
                    url: 'checkDuplication',
                    type: 'get',
                    data: {
                        value: RoleValue,
                        type:'categoryCheck'
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == "Duplicate") {
                            document.getElementById('updateCategoryError').style.display = 'block';
                            document.getElementById('updateCategoryError').style.color = 'red';
                            document.getElementById('updateCategoryError').innerText = RoleValue + " is already added please change value";
                        } else {
    
                            document.getElementById('updateformId').submit()
                        }
                    },
                    error: function(req, status, error) {
                        console.log(error)
                    }
                })
            } 
        }
        else{
            document.getElementById('updateformId').submit()
        }

    }


    function getValueForEdit(CategoryName) {

        $.ajax({
            url: 'itemsCategoryEdit',
            type: 'get',
            data: {
                CategoryName: CategoryName
            },
            success: function(data) {
                console.log(data)
                document.getElementById('modal_id').value = data.CategoryName;
                document.getElementById('modal_CategoryName').value = data.CategoryName;


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection