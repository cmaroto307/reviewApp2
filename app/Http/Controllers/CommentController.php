<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    
    function __constructor() {
        $this->middleware('auth');
    }
    
    public function destroy(Comment $comment) {
        if(Auth::user()->isAdvanced() || Auth::user()->id == $comment->iduser) {
            try {
                $idreview = $comment->idreview;
                $comment->delete();
                $review = Review::where('id', $idreview)->first();
                $review->ncomments--;
                $stars = 0;
                foreach($review->comments as $comment) {
                    $stars += $comment->stars;
                }
                $stars = $stars/$review->ncomments;
                $review->stars = $stars;
                $review->save();
                return redirect('review/' . $idreview);
            }catch(\Exception $e) {
                return back() ->withErrors(['message' => 'An unexpected error occurred while deleting']);
            }
        }else {
            return back()->withErrors(['message' => 'You can not delete other people comments']);
        }
    }
    
    public function edit(Comment $comment) {
        if(Auth::user()->isAdvanced() || Auth::user()->id == $comment->iduser) {
            $stars = [
                '1',
                '2',
                '3',
                '4',
                '5'
            ];
            return view('comment.edit', ['comment' => $comment, 'stars' => $stars]);
        }else {
            return back()->withErrors(['message' => 'You can not edit other people comments']);
        }
    }
    
    public function store(Request $request) {
        if(Auth::user()->isAdvanced() || Auth::user()->isVerified()) {
            try {
                $comment = new Comment();
                $comment->iduser = Auth::user()->id;
                $comment->idreview = $request->idreview;
                $comment->text = $request->text;
                $comment->stars = $request->stars;
                $comment->save();
                
                $idreview = $comment->idreview;
                $review = Review::where('id', $idreview)->first();
                $review->ncomments++;
                $stars = 0;
                foreach($review->comments as $comment) {
                    $stars += $comment->stars;
                }
                $stars = $stars/$review->ncomments;
                $review->stars = $stars;
                $review->save();
                return redirect('review/' . $request->idreview);
            }catch(\Exception $e) {
                return back()->withErrors(['message' => 'An unexpected error occurred while creating']);
            }
        }else {
            return back()->withErrors(['message' => 'If you want to write a comment, you must verify your account']);
        }
    }
    
    public function update(Request $request, Comment $comment) {
        if(Auth::user()->isAdvanced() || Auth::user()->id == $comment->iduser) {
            try {
                $comment->text = $request->text;
                $comment->stars = $request->stars;
                $comment->update();
                
                $idreview = $comment->idreview;
                $review = Review::where('id', $idreview)->first();
                $stars = 0;
                foreach($review->comments as $comment) {
                    $stars += $comment->stars;
                }
                $stars = $stars/$review->ncomments;
                $review->stars = $stars;
                $review->save();
                return redirect('review/' . $comment->idreview);
            }catch(\Exception $e) {
                return back()->withErrors(['message' => 'An unexpected error occurred while updating']);
                }
        }else {
            return back()->withErrors(['message' => 'You can not edit other people comments']);
        }
    }
}
