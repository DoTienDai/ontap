@extends('dashboard')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
            <table class="table table-striped table-bordered">
                    <thead class="text-black">
                        <tr>
                            <th>ID</th>
                            <th>Favorite_Name</th>
                            <th>Favorite_description</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sothich as $favorite)
                    <tr>
                        <td>{{ $favorite->favorite_id }}</td>
                        <td>{{ $favorite->favorite_name }}</td>
                        <td>{{ $favorite->favorite_description }}</td>
                        
                    </tr>
                    
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection