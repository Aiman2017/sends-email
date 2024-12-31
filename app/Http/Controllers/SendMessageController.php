<?php

namespace App\Http\Controllers;

use App\Mail\SendMessageMail;
use App\Models\SendMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMessageController extends Controller
{
    public function index()
    {
        $this->authorize('access', auth()->user());
        return view('users.send-message', [
            'users' => User::query()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'user_id' => 'required|array',
            'user_id.*' => 'integer|exists:users,id'
        ]);

        $message = SendMessage::query()->create([
            'message' => $request->message
        ]);

        $message->users()->attach($request->user_id);

        $users = User::query()->whereIn('id', $request->user_id)
            ->whereHas('setting', function ($query) {
                $query->where('notification', '=', true);
            })
            ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->queue(new SendMessageMail($message->message));
        }

        toastr()->success('Сообщение было успешно отправлено!');

        return redirect()->back();
    }

}
