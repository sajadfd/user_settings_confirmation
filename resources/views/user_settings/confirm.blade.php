@extends('layouts.app')

@section('content')
    <div class="modal-body">
        <p>Please confirm your change to {{ $setting->name }}:</p>
        <form action="{{ route('user_settings.confirm', $setting) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="confirmation_code">Confirmation Code</label>
                <input type="text" name="confirmation_code" id="confirmation_code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
    </div>
@endsection
