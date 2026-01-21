<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 1. GET /api/tasks (Melihat semua tugas)
    public function index()
    {
        // Ambil semua data task, urutkan dari yang terbaru
        $tasks = Task::latest()->get();

        return response()->json([
            'message' => 'List of all tasks',
            'data' => $tasks
        ], 200);
    }

    // 2. POST /api/tasks (Membuat tugas baru)
    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'category_id' => 'nullable|exists:categories,id',
            // Kita hardcode user_id = 1 dulu karena belum bikin Login
            // Nanti kita ganti jadi auth()->id()
        ]);

        // Simpan ke database
        // PENTING: Tambahkan 'user_id' manual sementara
        $task = Task::create(array_merge($validated, ['user_id' => 1]));

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    // 3. GET /api/tasks/{id} (Melihat detail 1 tugas spesifik)
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['data' => $task], 200);
    }

    // 4. PUT /api/tasks/{id} (Update tugas)
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Validasi input (boleh diisi sebagian saja / nullable)
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task
        ], 200);
    }

    // 5. DELETE /api/tasks/{id} (Hapus tugas)
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
