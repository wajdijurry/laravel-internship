<?php


namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController
{
    /**
     * @var PostRepository
     */
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * create a post
     */
    public function create(Request $request)
    {
        try {
            $post = $this->repository->create(
                $request->get('body'),
                $request->get('user_id')
            );
        } catch (\Throwable $exception) {
            exit('post not created');
        }

        return response()->json($post->toArray());
    }

    /**
     *Edit post
     */
    public function edit(Request $request, $id)
    {
        try {
            $post = $this->repository->editPost($id, $request->get('body'));
        } catch (\Throwable $exception) {
            exit ('post was not updated');
        }

        return response()->json($post->toArray());
    }


    /**
     * delete a post
     */
    public function delete($id)
    {
        try {
            $this->repository->deletePost($id);
        } catch (\Throwable $exception) {
            exit ('post was not deleted');
        }

        return response(null, 204);
    }

    public function like($id, Request $request)
    {
        try {
            $data = $this->repository->markLike($id, $request->get('user_id'));
            return response($data, 204);
        } catch (\Throwable $exception){
            exit('like not marked');
        }
    }

    /**
     * listing Posts
     */
    public function listing(Request $request)
    {
       $posts= $this->repository->listingPosts($request->get('user_id'));

        if (empty($posts)) {
            return \response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
    /**
     * getPost
     */

    public function get($id)
    {
        try {
            $post = $this->repository->get($id);
        } catch (\Exception $exception) {
            exit('post not found');
        }

        return response()->json($post->toArray());
    }
}
