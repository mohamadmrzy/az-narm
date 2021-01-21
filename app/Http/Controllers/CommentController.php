<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->get('on_post');
        $input['body'] = $request->get('body');
        $slug = $request->input('slug');
        Comment::create( $input );

        return redirect($slug)->with('message', 'Comment published');
    }
}
