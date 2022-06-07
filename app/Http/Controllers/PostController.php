<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // $response = [
        //     'success' => true,
        //     'data' => PostResource::collection($posts),
        //     'message' => ''
        // ];

        // return response()->json($response, 200);

        return $this->successResponse(PostResource::collection($posts), 'Post Succefully Retrieved');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            // $response = [
            //     'success' => true,
            //     'message' => $validator->errors()
            // ];

            // return response()->json($response, 403);

            return $this->errorResponse('Validation Error', $validator->errors());
        }

        $post = Post::create($input);

        // $response = [
        //     'success' => true,
        //     'data' => new PostResource($post),
        //     'message' => 'Post Succefully Created'
        // ];

        // return response()->json($response, 200);

        return $this->successResponse(new PostResource($post), 'Post Succefully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            // $response = [
            //     'success' => true,
            //     'message' => "Post Not Found"
            // ];
            // return response()->json($response, 403);

            return $this->errorResponse('Post Not Found');
        }

        // $response = [
        //     'success' => true,
        //     'data' => new PostResource($post),
        //     'message' => 'Post Succefully Retrieved'
        // ];

        // return response()->json($response, 200);

        return $this->successResponse(new PostResource($post), 'Post Succefully Retrieved');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            // $response = [
            //     'success' => true,
            //     'message' => $validator->errors()
            // ];

            // return response()->json($response, 403);

            return $this->errorResponse('Validation Error', $validator->errors());
        }

        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->save();

        // $response = [
        //     'success' => true,
        //     'data' => new PostResource($post),
        //     'message' => 'Post Succefully Updated'
        // ];

        // return response()->json($response, 200);

        return $this->successResponse(new PostResource($post), 'Post Succefully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // $response = [
        //     'success' => true,
        //     'message' => 'Post Succefully Deleted'
        // ];
        // return response()->json($response, 200);

        return $this->successResponse([], 'Post Succefully Deleted');
    }
}
