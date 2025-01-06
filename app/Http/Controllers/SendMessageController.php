<?php

namespace App\Http\Controllers;

use App\Mail\SendMessageMail;
use App\Models\SendMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        ], [
            'user_id.required' => 'Please choose the user\'s name.',
        ]);

        DB::beginTransaction();
        try {
            $message = SendMessage::query()->create([
                'message' => $request->message
            ]);

            $message->users()->attach($request->user_id);

            $users = User::query()->whereIn('id', $request->user_id)
                ->get();

            foreach ($users as $user) {

                if ($this->shouldSendNotification($user)) {
                    Mail::to($user->email)->queue(new SendMessageMail($message->message));
                }
            }
            DB::commit();
            toastr()->success('Сообщение было успешно отправлено!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка при отправке сообщения: ' . $e->getMessage());
            toastr()->error('Произошла ошибка при отправке сообщения.');
            return redirect()->back();
        }
    }

    protected function shouldSendNotification(User $user): bool
    {
        return $user->setting && $user->setting->notification;
    }
}
