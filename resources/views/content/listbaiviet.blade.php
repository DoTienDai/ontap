@extends('dashboard')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
            <table class="table table-striped table-bordered">
                    <thead class="text-black">
                        <tr>
                            <th>ID</th>
                            <th>Post_Name</th>
                            <th>Post_description</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($baiviet as $post)
                    <tr>
                        <td>{{ $post->post_id }}</td>
                        <td>{{ $post->post_name }}</td>
                        <td>{{ $post->post_description }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection