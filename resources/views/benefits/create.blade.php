@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h1>Privalumai</h1>

    <form action="{{ route('benefits.store') }}" method="POST">
        @csrf
        <input type="text" name="benefit_name" placeholder="Benefit Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="picture" placeholder="Picture URL">
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <button type="submit">Create Benefit</button>
    </form>
</div>
@endsection