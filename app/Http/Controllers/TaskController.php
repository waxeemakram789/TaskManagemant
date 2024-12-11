<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('due_date_from') && $request->has('due_date_to')) {
            $query->whereBetween('due_date', [$request->due_date_from, $request->due_date_to]);
        }

        $tasks = $query->with('category')->paginate(10);

        return response()->json(['message'=> 'Tasks fetched successfully.','data' => $tasks], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = $request->all();
        if (!empty($input['due_date'])) {
            $input['due_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['due_date'])->format('Y-m-d');
        }
        $validator = Validator::make($input, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed.',
            ], 422);
        }

        $validated = $validator->validated();

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'due_date' => $validated['due_date'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Task created successfully.', 'data' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('category')->findOrFail($id);
        return response()->json(['message' => 'Task fetched successfully.', 'data' => $task], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        
        $input = $request->all();
        if (!empty($input['due_date'])) {
            $input['due_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['due_date'])->format('Y-m-d');
        }
        $validator = Validator::make($input, [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:pending,in-progress,completed',
            'due_date' => 'sometimes|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed.',
            ], 422);
        }

        $task->update($input);

        return response()->json(['message' => 'Task updated successfully.', 'data' => $task], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
       
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }
}
