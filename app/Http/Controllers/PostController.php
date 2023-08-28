<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professions = Profession::all();
        return view('posts.create',compact('professions'));
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
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'profession_id' => 'required',
                'publication' => 'nullable|sometimes',
                'duration' => 'required',
                'message' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $input = $request->all();

            if ($image = $request->file('image')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;
            }
            Post::create($input);

            return redirect()->route('post.show')
                ->with('success', 'Post created successfully.');
        } catch (\Throwable $th) {
            // Return an error response if any exception occurs
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $posts = Post::all();
        return view('admin.postsList',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $professions = Profession::all();
        $posts = Post::findOrFail($id);
        return view('posts.edit',compact('posts','professions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'profession_id' => 'required',
                'publication' => 'nullable|sometimes',
                'duration' => 'required',
                'message' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
            ]);

            $input = $request->all();
            $post->update($input);
            // dd($user);
            // $user ->save();
            // dd($input);

            return redirect()->route('post.show')
                ->with('success', 'Post Updated Successfully');
        } catch (\Throwable $th) {
            $params = ['status' => false, 'message' => $th->getMessage()];
            return response()->json(['params' => $params]);
        }
    }   


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('post.show')->with('success', 'User deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }
}
