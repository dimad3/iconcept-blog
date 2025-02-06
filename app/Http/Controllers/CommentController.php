<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\SaveCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCommentRequest $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
