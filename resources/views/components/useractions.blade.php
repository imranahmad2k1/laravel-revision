<button onclick="deleteUser(event, this, '{{ route('deleteuser', ['id'=>$user->id]) }}')" class="btn btn-danger">Delete</button>
<button onclick="editUser(event,this,'{{ route('edituser',['id'=>$user->id]) }}',{{$user}})" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_user">
