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
                        <p>I use default values to avoid entry</p>
                        <form action="{{ route('user.store') }}" method="post" class="repeater"
                              enctype="multipart/form-data">
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
                                <div class="col-sm-2"><input type="hidden" name="parrent[0][1]" value="1" />
                                    <label for="Id" class="form-label">ID</label>
                                    <input type="number" class="form-control" required value="1" name="id[0][1]"
                                           id="parent_id_0" placeholder="Enter ID">
                                </div>
                                <div class="col-sm-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" required value="parent" name="name[0][1]"
                                           placeholder="Enter Name">
                                </div>
                                <div class="col-sm-2">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" required value="22" name="age[0][1]"
                                           placeholder="Enter Age">
                                </div>
                                <div class="col-sm-2">
                                    <label for="veteran" class="form-label">Veteran</label>
                                    <input type="text" class="form-control" required value="Yes" name="veteran[0][1]"
                                           placeholder="Enter Yes/No">
                                </div>
                                <div class="col-sm-2 buttons">
                                    <button type="submit" class="btn btn-default btn-primary">Save</button>
                                    <button type="button" class="btn btn-default btn-dark add-childs" id="1" data-id="1"
                                            data-parrent="1"
                                            onclick="addChildsOnClick(1)">Add Childrens
                                    </button>

                                </div>
                                <div class="child-html child-html-1" data-parent-id="1">

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
        var row = 1;

        function addChildsOnClick(parrent) {
            row++;
            $html = '<div class="row margin-wrap" data-id="' + row + '"  >' +
                '<div class="col-sm-2"> <input type="hidden" name="parrent[' + parrent + '][' + row + ']" value="'+parrent+'" /> '+
                '<label for="Id" class="form-label">ID</label>' +
                '<input type="text" class="form-control" required value="' + row + '" name="id[' + parrent + '][' + row + ']" placeholder="Enter ID">' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<label for="name" class="form-label">Name</label>' +
                '<input type="text" class="form-control" required value="' + row + '" name="name[' + parrent + '][' + row + ']" placeholder="Enter Name">' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<label for="age" class="form-label">Age</label>' +
                '<input type="text" class="form-control" required value="' + row + '" name="age[' + parrent + '][' + row + ']" placeholder="Enter Age">' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<label for="veteran" class="form-label">Veteran</label>' +
                '<input type="text" class="form-control" required value="No" name="veteran[' + parrent + '][' + row + ']" placeholder="Enter Yes/No">' +
                '</div>' +
                '<div class="col-sm-2 buttons">' +
                '<button type="submit" class="btn btn-default btn-primary">Save</button>' +
                '<button type="button" class="btn btn-default btn-dark add-childs" id="' + row + '" data-parrent="' + row + '"  onclick="addChildsOnClick( ' + parrent + row + ')">Add Childrens</button>' +
                '</div>' +
                '<div class="child-html child-html-' + parrent + row + '" data-parent-id="' + row + '"  data-col=""></div>'
            '</div>';
            // alert(parrent);
            $('.child-html-' + parrent).append($html);


        }

        $(document).ready(function () {
            $('#selectGrandParent').on('change', function () {
                var selectedValue = $(this).val();
                $('#parent_id').val(selectedValue);
            });
        });
    </script>


@endsection