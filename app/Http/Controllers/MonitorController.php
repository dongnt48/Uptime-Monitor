<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $query = auth()->user()->isAdmin()
            ? Monitor::query()
            : auth()->user()->monitors();

        $monitors = $query->with([
            'results' => function ($query) {
                $query->latest()->limit(1);
            }
        ])->latest()->get();

        return view('monitors.index', compact('monitors'));
    }

    public function create()
    {
        return view('monitors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'protocol' => 'required|in:http,https,tcp,ping',
            'port' => 'nullable|integer|min:1|max:65535',
            'expected_status_code' => 'required|integer',
            'timeout' => 'required|integer|min:100',
            'auth_type' => 'required|in:none,basic,bearer',
            'headers' => 'nullable|json',
            'body' => 'nullable|string',
        ]);

        if ($validated['headers']) {
            $validated['headers'] = json_decode($validated['headers'], true);
        }

        $monitor = auth()->user()->monitors()->create($validated);

        // Create a default check configuration
        $monitor->checks()->create([
            'check_type' => $validated['protocol'],
            'interval' => 60,
            'retry_count' => 3,
            'alert_threshold' => 1,
            'enabled' => true,
        ]);

        return redirect()->route('monitors.index')->with('success', 'Monitor and default check created successfully.');
    }
}
