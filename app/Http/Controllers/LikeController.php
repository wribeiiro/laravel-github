<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => 'Post_id is required',
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $payloadLike = [
            'user_id' => Auth::user()->id,
            'post_id' => (int) $validator->validated()['post_id']
        ];

        $hasLikeByUser = Like::where($payloadLike)->first();

        if (empty($hasLikeByUser)) {
            $like = new Like($payloadLike);
            $like->save();

            return response()->json([
                'data' => Like::where(['post_id' => (int) $validator->validated()['post_id']])->count(),
                'status' => Response::HTTP_CREATED
            ]);
        }

        $hasLikeByUser->delete();

        return response()->json([
            'data' => Like::where(['post_id' => (int) $validator->validated()['post_id']])->count(),
            'status' => Response::HTTP_NO_CONTENT
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
