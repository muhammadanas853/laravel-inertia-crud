<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DocumentController extends Controller
{
    public function index()
    {
        return Inertia::render('Documents/Index', [
            // 'documents' => Document::latest()->get()
            'documents' => Document::withTrashed()->latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Documents/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        Document::create($data);

        return redirect()->route('documents.index')->with('success', 'Document created.');
    }

    public function edit(Document $document)
    {
        return Inertia::render('Documents/Edit', [
            'document' => $document,
        ]);
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            if ($document->attachment) {
                Storage::disk('public')->delete($document->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $document->update($data);

        return redirect()->route('documents.index')->with('success', 'Document updated.');
    }

    public function destroy(Document $document)
    {
        $document->delete(); // Soft delete
        return redirect()->back()->with('success', 'Document deleted.');
    }

    public function restore($id)
    {
        $document = Document::withTrashed()->findOrFail($id);
        $document->restore();

        return Redirect::back()->with('success', 'Document restored successfully!');
    }
}
