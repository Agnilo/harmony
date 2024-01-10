@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h1>Privalumai</h1>

    <form action="{{ route('benefits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="benefit_name" placeholder="Benefit Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <div class="form-group">
            <label for="picture">Select Picture:</label>
            <input type="file" name="picture" class="form-control-file" id="picture">
        </div>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <button type="submit">Create Benefit</button>
    </form>
</div>
@endsection