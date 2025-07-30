<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        echo "admin page";
        $alumni = Alumni::latest()->paginate(10);
        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prefix' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'home_address' => 'nullable|string',
            'office_address' => 'nullable|string',
            'job_desc' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('alumni', 'public');
        }

        Alumni::create($data);
        return redirect()->route('alumni.index')->with('success', 'Alumni added successfully.');
    }

    public function edit(Alumni $alumni)
    {
        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $data = $request->validate([
            'prefix' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'home_address' => 'nullable|string',
            'office_address' => 'nullable|string',
            'job_desc' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($alumni->photo && Storage::disk('public')->exists($alumni->photo)) {
                Storage::disk('public')->delete($alumni->photo);
            }
            $data['photo'] = $request->file('photo')->store('alumni', 'public');
        }

        $alumni->update($data);
        return redirect()->route('alumni.index')->with('success', 'Alumni updated successfully.');
    }

    public function destroy(Alumni $alumni)
    {
        if ($alumni->photo && Storage::disk('public')->exists($alumni->photo)) {
            Storage::disk('public')->delete($alumni->photo);
        }

        $alumni->delete();
        return redirect()->route('alumni.index')->with('success', 'Alumni deleted.');
    }
}
