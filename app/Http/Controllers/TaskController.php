<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 1. GET /api/tasks (Melihat semua tugas)
    public function index(Request $request)
    {
        // 1. Siapkan Query dasar (User hanya lihat tugas miliknya & load kategori)
        $query = Task::with('category')->where('user_id', $request->user()->id);

        // 2. Fitur Filter Status (Contoh: ?status=pending)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // 3. Fitur Filter Kategori (Contoh: ?category_id=2)
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. Fitur Pencarian Judul (Contoh: ?search=belajar)
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 5. Eksekusi Query (Ambil data)
        $tasks = $query->latest()->get();

        return response()->json([
            'message' => 'Tasks retrieved successfully',
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
        ]);

        // Simpan ke database
        // PENTING: Tambahkan 'user_id' manual sementara
        $task = Task::create(array_merge($validated, [
            'user_id' => $request->user()->id
        ]));

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    // 3. GET /api/tasks/{id} (Melihat detail 1 tugas spesifik)
    public function show($id)
    {
        $task = Task::with('category')->find($id);

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
