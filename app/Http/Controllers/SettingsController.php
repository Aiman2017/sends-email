<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index()
    {
        return view('users.settings', ['settings' => Setting::query()->first()]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'notification' => 'boolean',
            'user_id' => 'integer'
        ]);

        Setting::query()->updateOrCreate(['user_id' => $user->id],$request->only('notification', $user->id));

        toastr()->success('Notification changed successfully.');
        return redirect()->back();
    }
}
