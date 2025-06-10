<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Task::query();
        if($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
        }

        $task = $query->latest()->get();
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
        $request->validate([
            'title' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->is_done = $request->has('is_done');

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachments'), $filename);
            $task->attachment = $filename;
        }

        $task->save();

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
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048',
        ]);

        $task = Task::findOrFail($id);

        // Atur nilai boolean dengan aman
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_done' => $request->has('is_done'), // akan true jika dicentang, false jika tidak
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachments'), $filename);
            $task->attachment = $filename;
        }
        $task->save();


        return redirect()->route('task.index')->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task berhasil dihapus!');
    }

    public function toggle($id)
    {
        $task = Task::findOrFail($id);
        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Status Task berhasil diubah!');
    }
}
