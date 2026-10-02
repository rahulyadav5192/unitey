<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:160'],
            'source' => ['nullable', 'string', 'max:40'],
        ]);

        Subscriber::query()->firstOrCreate(
            ['email' => strtolower($data['email'])],
            ['source' => $data['source'] ?? 'news'],
        );

        return back()->with('sent', 'newsletter');
    }
}
