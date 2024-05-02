@extends('dashboard')

@section('content')
    <main class="login-form">
        <style>
        .table.table-bordered {
          border-color: #000;
          }
 
      .table.table-striped tbody tr:nth-child(even) {
       background-color: #f9f9f9;
         }
         .h3{
            text-align: center;
         }
</style>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table table-bordered table-striped" >
               <h3 class="h3" >Danh sach User</h3>
                    <thead>
                    
                        <tr>
                            
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>So thich</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->email }}</th>
                                <th>{{ $user->mssv }}</th>
                                <th>
                                    <a href="{{ route('user.readUser', ['id' => $user->id]) }}">View</a> |
                                    <a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Edit</a> |
                                    <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}">Delete</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                  
                  
            </div>
          {{ $users->links('pagination::bootstrap-5')  }}
        </div>
        
    </main>
@endsection