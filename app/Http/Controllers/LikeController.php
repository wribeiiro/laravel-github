<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Validations\LikeStoreValidation;
use App\Services\LikeService;

class LikeController extends Controller
{
    public function __construct(
        private LikeService $likeService
    ) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = LikeStoreValidation::formValidate($request->all());

        if (is_string($validator) && !empty($validator)) {
            return response()->json([
                'data' => $validator,
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $hasLikeByUser = $this->likeService->findFirst($validator);

        try {
            if (empty($hasLikeByUser)) {
                $this->likeService->save($validator);

                return response()->json([
                    'data' => $this->likeService->countLikesByPost($validator['post_id']),
                    'status' => Response::HTTP_CREATED
                ]);
            }

            $hasLikeByUser->delete();

            return response()->json([
                'data' => $this->likeService->countLikesByPost($validator['post_id']),
                'status' => Response::HTTP_NO_CONTENT
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'data' => 'Deu ruim chama o amir',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
