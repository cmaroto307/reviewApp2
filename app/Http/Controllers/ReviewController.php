<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller {
    
    public function __construct() {
        $this->middleware('auth', ['except' => ['index']]);
    }
    
    public function books() {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.books', ['reviews' => $reviews]);
    }
    
    public function create() {
        if(Auth::user()->isAdvanced()) {
            $types = [
                'film'   => 'Film',
                'book'   => 'Book',
                'record' => 'Record',
            ];
            return view('review.create', ['types' => $types]);
        }else {
            return back()->withErrors(['message' => 'You need to be an advanced user to create a post']);
        }
    }
    
    public function destroy(Review $review) {
        if(Auth::user()->isAdmin() || Auth::user()->id  == $review->iduser) {
            try {
                foreach($review->comments as $comment) {
                    Comment::where('id', $comment->id)->delete();
                }
                foreach($review->images as $img) {
                    Storage::disk('local')->delete('public/images/' . $img->name);
                    Image::where('id', $img->id)->delete();
                }
                $type = $review->tipo;
                $review->delete();
                return redirect('reviews/' . $type);
            }catch(\Exception $e) {
                return back() ->withErrors(['message' => 'An unexpected error occurred while deleting']);
            }
        }else {
            return back()->withErrors(['message' => 'You can not delete other people posts']);
        }
    }
    
    public function edit(Review $review) {
        if(Auth::user()->isAdmin() || Auth::user()->id  == $review->iduser) {
            $types = [
                'film'   => 'Film',
                'book'   => 'Book',
                'record' => 'Record',
            ];
            return view('review.edit', ['review' => $review, 'types' => $types]);
        }else {
            return back()->withErrors(['message' => 'You can not edit other people posts']);
        }
    }
    
    public function films() {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.films', ['reviews' => $reviews]);
    }
    
    public function index() {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.index', ['reviews' => $reviews]);
    }
    
    public function records() {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.records', ['reviews' => $reviews]);
    }
    
    public function show(Review $review) {
        $stars_review = [
            '1',
            '2',
            '3',
            '4',
            '5'
        ];
        return view('review.show', ['review' => $review, 'stars_review' => $stars_review]);
    }
    
    public function store(Request $request) {
        if(Auth::user()->isAdvanced()) {
            try {
                $review = new Review();
                $review->nombre = $request->nombre;
                $review->tipo = $request->tipo;
                $review->review = $request->review;
                if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                    $file = $request->file('thumbnail');
                    $path = $file->getRealPath();
                    $thumbnail = file_get_contents($path);
                    $review->thumbnail = base64_encode($thumbnail);
                }
                $review->iduser = Auth::user()->id;
                $review->save();
                if($request->images){
                    $img = new Image();
                    $img->storeImg($request->images, $review->id);
                }
                return redirect('reviews/' . $review->tipo);
            }catch(\Exception $e) {
                return back() ->withErrors(['message' => 'An unexpected error occurred while creating']);
            }
        }else {
            return back()->withErrors(['message' => 'You need to be an advanced user to create a post']);
        }
    }
    
    public function update(Request $request, Review $review) {
        if(Auth::user()->isAdmin() || Auth::user()->id  == $review->iduser){
            try {
                $review->nombre = $request->nombre;
                $review->tipo = $request->tipo;
                $review->review = $request->review;
                if($request->thumbnail && $request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                    $file = $request->file('thumbnail');
                    $path = $file->getRealPath();
                    $thumbnail = file_get_contents($path);
                    $review->thumbnail = base64_encode($thumbnail);
                }
                $review->update();
                if($request->images){
                    foreach($review->images as $img) {
                        Storage::disk('local')->delete('public/images/' . $img->name);
                        Image::where('id', $img->id)->delete();
                    }
                    $img = new Image();
                    $img->storeImg($request->images, $review->id);
                }
                return redirect('review/' . $review->id);
            }catch(\Exception $e) {
                return back()->withErrors(['message' => 'An unexpected error occurred while updating']);
            }
        }else {
            return back()->withErrors(['message' => 'You can not edit other people posts']);
        }
    }
}
