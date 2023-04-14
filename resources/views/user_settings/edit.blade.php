<!-- edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User Setting: {{ $setting->name }}</h1>
        <form action="{{ route('user_settings.update', $setting) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="value">Value</label>
                <input type="text" name="value" id="value" class="form-control" value="{{ $setting->value }}" required>
            </div>
            <div class="form-group">
                <label for="confirmation-method">Confirmation Method</label>
                <select name="confirmation_method" id="confirmation-method" class="form-control" required>
                    @foreach ($confirmationMethod as $method)
                        <option value="{{ $method }}"
                            {{ $method == $user->selected_confirmation_method ? 'selected' : '' }}>{{ ucfirst($method) }}
                        </option>
                    @endforeach
                </select>
