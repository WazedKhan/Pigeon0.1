<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Commnet;
use App\Models\Follow;
use App\Models\PostImage;
use App\Models\ReportCategory;
use App\Models\Share;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LikeNotification;
use App\Notifications\CommentNotification;

class   PostController extends Controller
{
    // Auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Post index view
    public function index()
    {
        $users = Follow::where('profile_id',Auth::user()->id)->pluck('user_id');
        if(empty($users->toArray()))
        {
            $users = 0;
        }
        $post = Post::whereIn('user_id',[$users])
                ->where('is_active',false)
                ->orwhere('user_id',Auth::user()->id)
                ->orwhere('type','public')
                ->latest()->get();
        $image = PostImage::all();
        return view('post.home', compact('post', 'image'));
    }

    // Post Create form
    public function create()
    {
        return view('post.create_post');
    }


    // Post Create Method
    public function store()
    {
        $output="None";
        if (request('caption')) {
            $hello = request()->caption;
            $hello = str_replace(' ', '_', $hello);
            $command = escapeshellcmd('python ' . getcwd() . '/python/main.py ' . $hello);
            $output = shell_exec($command);
        }
        $post = Post::create([
            'caption' => request('caption'),
            'type' => request('type'),
            'user_id' => Auth::id(),
            'emotion' => $output
        ]);

        if (request('image')) {
            foreach (request()->image as $value) {
                $images = $value->store('posts', 'public');
                PostImage::create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                    'image' => $images,
                ]);
            }
        }

        return redirect()->route('post.home')->with('post_created', 'Post Created Successfully!');
    }


    // Post Details View Method
    public function detailView($post_id)
    {
        $recat = ReportCategory::all();
        $post = Post::findOrFail($post_id);
        $report = Report::where('post_id', $post_id);
        $image = PostImage::where('post_id', $post_id)->get();
        $comments = Commnet::where('post_id', $post_id)->latest()->get();
        return view('post.detail', compact('post', 'comments', 'image', 'recat', 'report'));
    }

    // Post Update Form
    public function updateView($id)
    {
        $post = Post::find($id);
        $image = PostImage::where('post_id', $id)->get();
        return view('post.update', compact('post', 'image'));
    }

    // Post Update Method
    public function update($id)
    {
        $request = request()->except(['_token', '_method', 'image']);
        $post = Post::find($id);
        $post->update($request);

        if (request('image')) {
            foreach (request()->image as $value) {
                $images = $value->store('posts', 'public');
                PostImage::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'image' => $images,
                ]);
            }
        }

        return redirect()->route('post.detail', $post->id)
            ->with('post_updated', 'Post updated successfully');
    }

    // Post Delete Method
    public function delete($id)
    {
        $share = Share::where('post_id',$id)->get();
        if($share->isNotEmpty()){
            foreach ($share as $value) {
                Post::where('share_id',$value->id)->first()->delete();
            }
        };
        Post::find($id)->delete();
        return redirect()->route('post.home')
            ->with('post_deleted', 'Post Deleted successfully');
    }

    public function deleteImage($image_id)
    {
        PostImage::findOrFail($image_id)->delete();
        return redirect()->back();
    }


    // Post Like Method
    public function like($post_id)
    {
        $likes = Post::find($post_id);
        if ($likes->liked()->where('user_id', Auth::user()->id)->exists()) {
            $likes->liked()->detach(Auth::user()->id);
            return redirect()->back();
        } else {
            $likes->liked()->attach(Auth::user()->id);
            if (Auth::user()->id != $likes->user_id) {
                User::find($likes->user_id)->notify(new LikeNotification());
            }
            return redirect()->back();
        }
    }

    // Post Comment Method
    public function commnetCreateV($post_id)
    {
        $post = Post::find($post_id);
        return view('post.comment.view', compact('post'));
    }

    // Post Comment Create Method
    public function makeComment($post_id)
    {
        $userId = Post::find($post_id);
        Commnet::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,
            'comment' => request()->comment
        ]);
        if (Auth::user()->id != $userId->user_id) {
            User::find($userId->user_id)->notify(new CommentNotification());
        }
        return redirect()->route('post.detail', $post_id)->with('comment','Commented Successfully!');
    }

    // Delete commnet
    public function deleteComment($comment_id)
    {
        Commnet::find($comment_id)->delete();
        return redirect()->back();
    }

    // Comment Edit
    public function editComment($comment_id)
    {
        Commnet::find($comment_id)->update(['comment'=>request()->comment]);
        return redirect()->back();
    }

    // Post Liked People list shows Method
    public function viewLikes($post_id)
    {
        $ids = Like::where('post_id', $post_id)->get('user_id');
        $like_list = User::find($ids);
        return view('post.likes', compact('like_list'));
    }

    // Report Method
    public function makeReport($post_id)
    {
        $user_id = Auth::user()->id;
        $post = Post::findOrFail($post_id);

        $report = Report::where('reporter_id', $user_id)->where('post_id', $post_id)->exists();
        if ($post->user_id != $user_id && $report == false) {
            Report::create([
                'report_category_id' => request()->report_id,
                'post_id' => $post_id,
                'reporter_id' => $user_id
            ]);
            
            return redirect()->back()->with('report', 'Report Submited Successfully');
        }
        elseif($post->user_id == $user_id)
        {
            return redirect()->back()->with('own_post', "You Can't Report On Your Own Post");
        }
        else
        {
            return redirect()->back()->with('alreay_reported', "You Already Reported On This Post");
        }
    }

    // Share Methods
    public function sharePost($post_id)
    {
        
        $post = Post::Find($post_id);
        $share = Share::create(['post_id'=>$post_id]);

        $s_post = Post::create([
            'caption' => $post->caption,
            'type' => 'logged',
            'user_id' => Auth::user()->id,
            'emotion' => $post->emotion,
            'share_id'=>$share->id
        ]);
        if ($post->post_image->isNotEmpty()) {
            foreach ($post->post_image as $value) {
                PostImage::create([
                    'post_id' => $s_post->id,
                    'user_id' => $s_post->user_id,
                    'image' => $value->image,
                ]);
            }
        }

        return redirect()->back()->with('post_created', 'Post Created Successfully!');
    }
}
