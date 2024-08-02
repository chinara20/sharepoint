<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
   public function index(){
        $documents = Document::all();
        return view('pages.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('pages.documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'src' => 'required',
            'type' => 'required',
        ]);
    
        $documents = new Document;
        $documents->name = $request->name;
        $documents->type = $request->type;
    
        if ($request->hasFile('src')) {
            $file = $request->file('src');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');
            $documents['src'] = $filePath;
        }
    
        $documents->save();
    
        return redirect()->route('documents.index')->with('success', 'Document created successfully');
    }
    

    public function show($id)
    {
        $documents = Document::findOrFail($id);
        return view('pages.documents.show', compact('documents'));
    }

    public function edit($id)
    {
    $documents = Document::findOrFail($id);
    return view('pages.documents.edit', compact('documents'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:1000',
        'type' => 'required',
    ]);

    $documents = Document::findOrFail($id);
    $documents->name = $request->name;
    $documents->type = $request->type;

    if ($request->hasFile('src')) {
        $file = $request->file('src');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');
        $documents->src = $filePath;
    }

    $documents->save();

    return redirect()->route('documents.index')->with('success', 'Document updated successfully');
    }


    public function destroy( $id)
    {
        $document = Document::find($id);

        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document deleted successfullly');
    }
} 
