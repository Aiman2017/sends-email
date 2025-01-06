@extends('users.app')
@section('content')
<div class="container mt-5">
    <form action="{{ route('settings.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Email Notifications</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" name="notification" type="checkbox" @checked($settings->notification ?? false) value="1" id="notification1">
                            <label class="form-check-label" for="notification1">
                                Enable Email notifications
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Preferences</button>
            </div>
        </div>
    </form>

</div>

@endsection
