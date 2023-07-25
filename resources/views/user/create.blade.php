@extends('layouts.main')
@section('content')
<style>
    .col-sm-2.buttons {
        margin-top: 32px;
    }
    .child-html {
        margin-left: 3%;
    }
</style>
<div class="content">
    @include('layouts.admin_nav')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Basic Form</h6>
                    <form action="{{ route('user.store') }}" method="post" class="repeater" enctype="multipart/form-data">
                        @csrf
                        <div class="row margin-wrap">
                            <div class="col-sm-2">
                                <select class="form-select" name="grand_parent" id="selectGrandParent">
                                    <option value="0" disabled selected style="display:none">Select Grandpa</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row margin-wrap">
                            <div class="col-sm-2">
                                <label for="Id" class="form-label">ID</label>
                                <input type="text" class="form-control" required value="1" name="id[]" id="parent_id_0" placeholder="Enter ID">
                                <input type="text" name="parent_id[]" id="parent_id">
                            </div>
                            <div class="col-sm-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" required value="" name="name[]" placeholder="Enter Name">
                            </div>
                            <div class="col-sm-2">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" class="form-control" required name="age[]" placeholder="Enter Age">
                            </div>
                            <div class="col-sm-2">
                                <label for="veteran" class="form-label">Veteran</label>
                                <input type="text" class="form-control" required name="veteran[]" placeholder="Enter Yes/No">
                            </div>
                            <div class="col-sm-2 buttons">
                                <button type="submit" class="btn btn-default btn-primary">Save</button>
                                <button type="button" class="btn btn-default btn-dark add-childs" id="1" data-id="1" onclick="addChildsOnClick(this)">Add Childrens</button>

                            </div>
                            <div class="child-html child-html-12" data-parent-id="1">
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
 
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        var index_count=0;
function addChildsOnClick(button) 
    {
        var buttonDataId = $(button).attr("data-id");
    //   alert(buttonDataId);
        var num = Number(buttonDataId) + 1;
        var Id = $(button).attr("id");
        var index = Id - 1;
        var parentId = 'parent_id_'+ Number(index);
// alert(parentId);
        // alert($("#"+parentId).val());
        // alert($("#parent_id").val());

        // if($("#" + parentId).val().trim() === '' && $("#parent_id").val().trim() === '')
        // {
        //     alert('please fill data first');
        //     return false;
        // }
        
        $.ajax({
            url: "/add/childs/html",
            type: "get",
            data: {
                id: Id,
               
                parentDataId: num,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                alert(response.id+'-id')
                alert(num+'-num');
                var className = 'child-html-' + response.id+response.data_id;
                $(button).attr("data-id", num);
                alert(className+'-class_name')
                $('.' + className).append(response.html);
                index_count++;

            }
        });
    }    
    $(document).ready(function() 
    {
        $('#selectGrandParent').on('change', function() 
        {
            var selectedValue = $(this).val();
            $('#parent_id').val(selectedValue);
        });
    });
</script>


@endsection
