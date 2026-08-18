<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use App\Models\Category;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RequestModel::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->get();
        $categories = Category::all();

        return view('requests.index', compact('requests', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('requests.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        RequestModel::create($validated);

        return redirect()->route('requests.index')->with('success', 'Solicitud creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestModel $request)
    {
        $categories = Category::all();
        return view('requests.edit', compact('request', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $httpRequest, RequestModel $request)
    {
        $validated = $httpRequest->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $request->update($validated);

        return redirect()->route('requests.index')->with('success', 'Solicitud actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestModel $request)
    {
        $request->delete();

        return redirect()->route('requests.index')->with('success', 'Solicitud eliminada correctamente.');
    }
}