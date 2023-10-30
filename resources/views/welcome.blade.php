<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome | TestApp</title>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    h1{
        text-align: center;
    }
    th, td{
        padding: 10px;
        border: 1px solid black;
    }
    #usersTable{
        margin-right: auto;
        margin-left: auto;
    }
    .pfp{
        width: 100px;
        height: 100px;
    }
    .error{
        color: red; 
        font-size: 18px; 
        font-style:italic
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="text-center">
        {{-- <a href="{{ url('/register') }}" class="btn btn-primary">Create a New User</a> --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
            Create a New User
          </button>
    </div>
    
    <br><br>
    @if(Session::has('delete_success'))
    <div class="alert alert-success"><em> {!! session('delete_success') !!}</em></div>
    @endif
    @if(Session::has('delete_fail'))
    <div class="alert alert-danger"><em> {!! session('delete_fail') !!}</em></div>
    @endif
    @if(Session::has('new_user'))
    <div class="alert alert-success"><em> {!! session('new_user') !!}</em></div>
    @endif

    <table class="table table-bordered data-table" id="data-table">
        <thead>
            <tr>
                <th>Profile Picture</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>City</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    {{-- <div id="usersTable">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
            <div class="main bg-light border p-4 table-responsive">
            <table class="table" id="users_table">
            <thead>
                <th>Profile Picture</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>City</th>
                <th>Actions</th>
            </thead>
            @foreach($users as $key => $user)
            <tr>
                <td><img class="pfp" src="{{ asset('storage/'.$user->profile_path) }}"></td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->country}}</td>
                <td>{{$user->phone_no}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->city}}</td>
                <td>
                    <button onclick="editUser(event,this,'{{ route('edituser',['id'=>$user->id]) }}',{{$user}})" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_user">
                        Edit
                    </button>
                    <button onclick="deleteUser(event, this, '{{ route('deleteuser', ['id'=>$user->id]) }}')" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </table>
                </div>
            </div>
    </div> --}}
    <script>
        $(function(){
            setTimeout(function(){
                $('.alert-success').fadeOut();
            }, 3000);
        });
    </script>

{{-- Register a New User Modal --}}
<div class="modal" tabindex="-1" id="registerModal">
    <div class="modal-dialog">
      <div class="modal-content">
        {{-- <form id="create_user_form" action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf --}}
        <form action="javascript:void(0)" id="create_user_form">
            <div class="modal-header">
            <h5 class="modal-title">Register a New User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="profile_picture"><b>Profile picture</b></label>
                    <input type="file" name="profile_picture">
                    <br>
                    <span class="error" id="profile_picture_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="first_name"><b>First Name</b></label>
                    <input type="text" placeholder="Enter your First Name" name="first_name" >
                    <br>
                    <span class="error" id="first_name_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="last_name"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter your Last Name" name="last_name" >
                    <br>
                    <span class="error" id="last_name_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter your Email" name="email" >
                    <br>
                    <span class="error" id="email_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" >
                    <br>
                    <span class="error" id="password_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="country"><b>Country</b></label>
                    <select name="country" >
                        @foreach (Helper::getCountries() as $country )
                        <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <br>
                    <span class="error" id="country_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="phone_no"><b>Phone Number</b></label>
                    <input type="text" placeholder="Enter your Phone Number" name="phone_no" class="phone_no">
                    <br>
                    <span class="error" id="phone_no_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="address"><b>Address</b></label>
                    <input type="text" placeholder="Enter your Address" name="address">
                    <br>
                    <span class="error" id="address_register"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="city"><b>City</b></label>
                    <input type="text" placeholder="Enter your City" name="city">
                    <br>
                    <span class="error" id="city_register"></span>
                </div>       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Register User</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  {{-- Edit an Existing User Modal --}}
  <div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="update_form">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update a User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <img src="" class="pfp" id="profile_picture_edit" alt="profile-picture">
                <div class="form-group mb-3">
                    <label for="profile_picture"><b>Profile picture</b></label>
                    <input type="file" name="profile_picture" id="profile_picture_input" placeholder="" onchange="previewFile()" >
                    <br>
                    <span class="error" id="profile_picture_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="first_name"><b>First Name</b></label>
                    <input type="text" placeholder="Enter your First Name" name="first_name" id="first_name_input"  >
                    <br>
                    <span class="error" id="first_name_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="last_name"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter your Last Name" name="last_name" id="last_name_input"  >
                    <br>
                    <span class="error" id="last_name_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter your Email" name="email" id="email_input"  >
                    <br>
                    <span class="error" id="email_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="country"><b>Country</b></label>
                    <select name="country" id="country_input"  >
                        @foreach (Helper::getCountries() as $country )
                        <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <br>
                    <span class="error" id="country_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="phone_no"><b>Phone Number</b></label>
                    <input type="text" placeholder="Enter your Phone Number" name="phone_no" id="phone_no_input"  class="phone_no">
                    <br>
                    <span class="error" id="phone_no_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="address"><b>Address</b></label>
                    <input type="text" placeholder="Enter your Address" name="address" id="address_input" >
                    <br>
                    <span class="error" id="address_edit"></span>
                </div>
        
                <div class="form-group mb-3">
                    <label for="city"><b>City</b></label>
                    <input type="text" placeholder="Enter your City" name="city" id="city_input" >
                    <br>
                    <span class="error" id="city_edit"></span>
                </div>       
            </div>
    
            <div class="modal-footer">
                <button type="button" id="close_editing_btn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="update_record_btn" class="btn btn-primary">Update Record</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/jquery.inputmask.min.js"></script>
  <script>

    // DATA TABLE
    let table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get-all-users') }}",
        columns: [
            {data: 'profile_path', name: 'profile_picture',
             render: function(data) {
                    return '<img class="pfp" src="{{ asset("storage") }}/' + data + '">';
                }
            },
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'country', name: 'country'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'address', name: 'address'},
            {data: 'city', name: 'city'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Hide errors on Writing something, Selecting and option, and on File Selection
    $('input').on('keyup change', function() {
        let input_name = $(this).attr('name');
        $("#" + input_name + "_register").text("");
    });

    // Hide errors on Writing something, Selecting and option, and on File Selection
    $('input').on('keyup change', function() {
        let input_name = $(this).attr('name');
        $("#" + input_name + "_edit").text("");
    });

    // Masking phone number
    $('.phone_no').inputmask('(9999)-999-9999');

    // Setting CSRF Token for POST Requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Creating User using AJAX
    $('#create_user_form').submit(function(e){
        let formData = new FormData($(this)[0]);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{ url('users/create') }}",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                if(response.status){
                    $("#registerModal").modal('hide');
                    $('#create_user_form').trigger("reset");
                    alert(response.message);
                    table.ajax.reload(null, false);
                }
                else{
                    if($.isEmptyObject(response.data)){
                        alert(response.message);
                    }
                    else{
                        let errors = response.data;
                        $.each(errors, function(key, value ){
                            $("#"+key+"_register").text(value);
                        });
                    }
                }
            },
        });
    });

   // Editing User using AJAX
    function editUser(event, obj, route, user){
        // $('#profile_picture_input').val(user['profile_path']);
        // user['profile_path'])
        $('#profile_picture_edit').attr('src', "{{ asset('storage/') }}/" + user['profile_path']);
        $('#first_name_input').val(user['first_name']);
        $('#last_name_input').val(user['last_name']);
        $('#email_input').val(user['email']);
        $('#country_input').val(user['country']);
        $('#phone_no_input').val(user['phone_no']);
        $('#address_input').val(user['address']);
        $('#city_input').val(user['city']);

        $('#update_form').submit(function (e){
            let formData = new FormData($(this)[0]);
            e.preventDefault();
            $.ajax({
                data: formData,
                url: route,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response){
                    if(response.status){
                        $('#update_form').trigger("reset");
                        $('#edit_user').modal('hide');
                        alert(response.message);
                        table.ajax.reload(null, false);
                    }
                    else{
                        let errors = response.data;
                        $.each(errors, function(key, value ){
                            $("#"+key+"_edit").text(value);
                        });
                    }
                    
                }
            })
        });

        $('#close_editing_btn').on('click', function(e){
            $('.error').text("");
        });

        // if ($(e.target).hasClass('modal')) {
        //     $('.error').text("");
        //     $('.modal').modal('hide');
        // }
    }
    function previewFile() {
        const fileInput = document.getElementById('profile_picture_input');
        const preview = document.getElementById('profile_picture_edit');
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
        }
    }

    // Deleting a user using AJAX
    function deleteUser(event, obj, route){
        let confirmationDialog = confirm('Are you sure?');
        if(confirmationDialog){
            $.ajax({
                type: 'delete',
                url: route,
                success: function(response){
                    if(response.status){
                        alert(response.message);
                        table.ajax.reload(null, false);
                    }
                    else{
                        alert(response.message);
                    }
                }
            });
        }
    }

  </script>
</body>
</html>