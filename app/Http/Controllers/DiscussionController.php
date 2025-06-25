<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'material_id' => 'required|exists:materials,id',
        ]);

        $discussion = Discussion::create([
            'content' => $validated['content'],
            'material_id' => $validated['material_id'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment posted successfully!');
    }

    public function destroy(Discussion $discussion)
    {
        if ($discussion->user_id !== auth()->id() && !auth()->user()->isLecturer()) {
            abort(403);
        }

        $discussion->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

    public function myDiscussions()
    {
        $discussions = auth()->user()->discussions()
            ->with(['material.course', 'material.user'])
            ->latest()
            ->paginate(10);
            
        return view('discussions.my', compact('discussions'));
    }
} 