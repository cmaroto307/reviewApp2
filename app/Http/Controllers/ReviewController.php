<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller {
    
    public function __construct() {
        $this->middleware('auth', ['except' => ['index']]);
    }
    
    public function all(Request $request) {
        $searchreview = $request->searchreview;
        $filtertype = $request->filtertype;
        $filterstars = $request->filterstars;
        $orderby = $request->orderby;
        $items_per_page = $request->items_per_page;
        
        $last_reviews = Review::orderBy('created_at', 'desc')->get();
        $count_type_film = 0;
        $count_type_book = 0;
        $count_type_record = 0;
    	foreach($last_reviews as $review) {
    		if($review->tipo == 'film') {
    		    $count_type_film++;
    		}else if($review->tipo == 'book') {
    		    $count_type_book++;
    		}else if($review->tipo == 'record') {
    		    $count_type_record++;
    		}
    	}
    	
        $reviews = DB::table('review')
                    ->join('users', 'users.id', '=', 'review.iduser')
                    ->select('review.*', 'users.name as username');

        if($searchreview != '') {
            $reviews = $reviews->where('review.nombre', 'like', '%' . $searchreview . '%')
                                ->orWhere('review.created_at', 'like', '%' . $searchreview . '%')
                                ->orWhere('review.tipo', 'like', '%' . $searchreview . '%')
                                ->orWhere('users.name', 'like', '%' . $searchreview . '%');
        }

        if($filtertype != '') {
            if($filtertype == 't1') {
                $reviews = $reviews->where('review.tipo', '=', 'film');
            } else if($filtertype == 't2') {
                $reviews = $reviews->where('review.tipo', '=', 'book');
            } else if($filtertype == 't3') {
                $reviews = $reviews->where('review.tipo', '=', 'record');
            }
        }

        if($filterstars != '') {
            $min_stars = 0;
            if($filterstars == 's1') {
                $min_stars = 1;
            } else if($filterstars == 's2') {
                $min_stars = 2;
            } else if($filterstars == 's3') {
                $min_stars = 3;
            } else if($filterstars == 's4') {
                $min_stars = 4;
            }
            $reviews = $reviews->where('review.stars', '>=', $min_stars);
        }
        
        if($orderby != 0) {
            if($orderby == 'o1') {
                $reviews = $reviews->orderBy('stars', 'desc');
            } else if($orderby == 'o2') {
                $reviews = $reviews->orderBy('ncomments', 'desc');
            } else if($orderby == 'o3') {
                $reviews = $reviews->orderBy('nombre', 'asc');
            } else if($orderby == 'o4') {
                $reviews = $reviews->latest();
            }
        }
        
        $num_items_page = 3;
        if($items_per_page != '') {
            if($items_per_page == 'p1') {
                $num_items_page = 3;
            } else if($items_per_page == 'p2') {
                $num_items_page = 5;
            } else if($items_per_page == 'p3') {
                $num_items_page = 10;
            }
        }
        
        $reviews = $reviews->paginate($num_items_page)->withQueryString();
    	
        return view('review.all', [
            'reviews'           => $reviews,
            'last_reviews'      => $last_reviews,
            'count_type_film'   => $count_type_film,
            'count_type_book'   => $count_type_book,
            'count_type_record' => $count_type_record,
            'searchreview'      => $searchreview,
            'filtertype'        => $filtertype,
            'filterstars'       => $filterstars,
            'orderby'           => $orderby,
            'items_per_page'    => $items_per_page,
        ]);
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
                $review->ncomments = 0;
                $review->stars = 0;
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
