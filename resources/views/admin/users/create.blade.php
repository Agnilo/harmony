@extends('layouts.web')

@section('content')
<div class="web-child-content">
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <!-- Other input fields as needed -->

    <button type="submit" class="btn btn-primary">Create User</button>
</form>
</div>
@endsection