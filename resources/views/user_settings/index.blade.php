<!-- index.blade.php -->
@extends('layout')

@section('content')
    <div class="container">
        <h1>User Settings</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $setting->name ??""}}</td>
                        <td>{{ $setting->value ??""}}</td>
                        <td><a href="{{ route('user_settings.edit', $setting) }}">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
