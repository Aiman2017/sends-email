@extends('users.app')
@section('content')
    <h1 class="mb-4">Send Message to Users</h1>
    @include('users.errors')
    <form method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="mb-3">
            <label for="userSelect" class="form-label">Select User</label>
            <select class="form-select" name="user_id[]" id="userSelect" multiple>
                <option value="">Choose a user...</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="messageTextarea" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="messageTextarea" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>

@endsection
