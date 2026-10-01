<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'source' => ['nullable', 'string', 'max:40'],
            'name' => ['nullable', 'string', 'max:160'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:80'],
            'business' => ['nullable', 'string', 'max:160'],
            'country' => ['nullable', 'string', 'max:160'],
            'inquiry' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        Inquiry::query()->create([
            'source' => $data['source'] ?? 'contact',
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'business' => $data['business'] ?? null,
            'country' => $data['country'] ?? null,
            'inquiry' => $data['inquiry'] ?? null,
            'message' => $data['message'] ?? null,
        ]);

        return back()->with('sent', true);
    }
}
