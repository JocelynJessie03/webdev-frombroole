<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'required_tier' => 'required|in:Bronze,Silver,Gold',
            'points_reward' => 'required|integer|min:0',
            'task_type' => 'required|in:general,product_specific',
            'min_purchases_required' => 'nullable|integer|min:1',
            'order_count' => 'nullable|integer|min:1',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'integer|exists:products,id',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'required_tier' => $request->required_tier,
            'task_type' => $request->task_type,
            'points_reward' => $request->points_reward,
            'min_purchases_required' => $request->min_purchases_required ?? 1,
            'order_count' => $request->order_count ?? 1,
            'is_active' => true,
        ]);

        // If product-specific, attach products
        if ($request->task_type === 'product_specific' && $request->product_ids) {
            $task->products()->sync($request->product_ids);
        }

        $taskType = $request->task_type === 'general' ? 'General' : 'Product-Specific';
        return back()->with('success', "✓ {$taskType} Task successfully created for " . $request->required_tier . ' Tier!');
    }

    public function destroy(Task $task)
    {
        $task->products()->detach();
        $task->delete();
        return back()->with('success', 'Task successfully removed.');
    }
}