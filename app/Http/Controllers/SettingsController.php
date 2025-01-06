<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index()
    {
        return view('users.settings', ['settings' => Setting::query()->where('user_id', Auth::user()->id)->first()]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'notification' => 'nullable|boolean',
            'user_id' => 'integer'
        ]);

        $notification = $request->has('notification') ? 1 : 0;

        Setting::query()->updateOrCreate(
            ['user_id' => $user->id],
            ['notification' => $notification]
        );

        toastr()->success('Notification changed successfully.');
        return redirect()->back();
    }
}
