<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = Theme::query();
        if(request()->has('search')) {
            $search = request()->search;
            $query->where('name', 'like', "%$search%")
                        ->orWhere('background_color', 'like', "%$search%")
                        ->orWhere('text_color', 'like', "%$search%");
        }

        // $theme = Theme::all();
        $theme = $query->latest()->get();
        return view('theme.index', compact('theme'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('theme.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
           'name' => 'required|string|max:255',
           'background_color' => 'required|string|max:255',
           'text_color' => 'required|string|max:255'
        ]);
        Theme::create($request->all());
        return redirect()->route('theme.index')->with('success', 'Theme berhasil ditambah!');
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
    public function edit(Theme $theme)
    {
        //
        return view('theme.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        //
        $request->validate([
           'name' => 'required|string|max:255',
           'background_color' => 'required|string|max:255',
           'text_color' => 'required|string|max:255'
        ]);
        $theme->update($request->all());
        return redirect()->route('theme.index')->with('success', 'Theme berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        //
        $theme->delete();
        return redirect()->route('theme.index')->with('success', 'Theme berhasil dihapus!');
    }
}
