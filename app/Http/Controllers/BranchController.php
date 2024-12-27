<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(10);
        return view('branch.index', compact('branches'));
    }

    public function create()
    {
        return view('branch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'branch_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/photos/branches'), $filename);
            $photoUrl = 'photos/branches/' . $filename;
        }

        Branch::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'photo' => $photoUrl,
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch created successfully');
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $branch = Branch::findOrFail($id);

        $photoUrl = $branch->photo;
        if ($request->hasFile('photo')) {
            if ($photoUrl && file_exists(public_path('storage/' . $photoUrl))) {
                unlink(public_path('storage/' . $photoUrl));
            }

            $file = $request->file('photo');
            $filename = 'branch_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/photos/branches'), $filename);
            $photoUrl = 'photos/branches/' . $filename;
        }

        $branch->update([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'photo' => $photoUrl,
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch updated successfully');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        if ($branch->photo) {
            Storage::delete('public/' . $branch->photo);
        }

        $branch->delete();

        return redirect()->route('branches.index')
            ->with('success', 'Branch deleted successfully');
    }
}
