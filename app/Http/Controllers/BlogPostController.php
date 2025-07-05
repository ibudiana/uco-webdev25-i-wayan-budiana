<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (Auth::check() && Auth::user()->hasVerifiedEmail() && Auth::user()->hasRole('admin')) {
            $posts = BlogPost::query()
                ->with('author')
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('admin.blog.index', compact('posts'));
        }

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $posts = BlogPost::query()
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%')
                ->latest()
                ->paginate(9)->withQueryString();

            $otherPosts = $posts;
            $featuredPost = null;
        } else {
            // Ambil postingan terbaru untuk featured post
            // $featuredPost = BlogPost::latest()->first();

            // Featured post dengan comments terbanyak
            $featuredPost = BlogPost::withCount('comments')->orderBy('comments_count', 'desc')->first();


            $otherPostsQuery = BlogPost::latest();
            if ($featuredPost) {
                $otherPostsQuery->where('id', '!=', $featuredPost->id);
            }
        }

        // Ambil postingan lain selain featured post
        $otherPosts = $otherPostsQuery->paginate(6);

        // Ambil 4 postingan terbaru untuk sidebar
        $recentPosts = BlogPost::inRandomOrder()->take(5)->get();

        return view('blog.index', [
            'featuredPost' => $featuredPost,
            'posts' => $otherPosts,
            'recentPosts' => $recentPosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->can('manage-blog-posts')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('manage-blog-posts')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new BlogPost([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);

        $post->save();

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();

        // Ambil 4 postingan terbaru untuk sidebar
        $recentPosts = BlogPost::latest()->take(4)->get();

        return view('blog.show', compact('post', 'recentPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        if (!Auth::user()->can('manage-blog-posts')) {
            abort(403, 'Unauthorized action.');
        }

        $blogPost = BlogPost::where('slug', $slug)->firstOrFail();

        // Return the edit view with the blog post data
        return view('admin.blog.edit', ['post' => $blogPost]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::user()->can('manage-blog-posts')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blogPost = BlogPost::findOrFail($id);

        $blogPost->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        if (!Auth::user()->can('manage-blog-posts')) {
            abort(403, 'Unauthorized action.');
        }

        $blogPost = BlogPost::where('slug', $slug)->firstOrFail();
        $blogPost->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
