<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $task = Task::latest()->get();
        return view('task.index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
        ]);

        Task::create($request->all());
        return redirect()->route('task.index')->with('success', 'Task berhasil ditambah!');
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
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('task.edit', compact('task'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $task = Task::findOrFail($id);

        // Atur nilai boolean dengan aman
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_done' => $request->has('is_done'), // akan true jika dicentang, false jika tidak
        ]);


        return redirect()->route('task.index')->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task berhasil dihapus!');
    }
}
