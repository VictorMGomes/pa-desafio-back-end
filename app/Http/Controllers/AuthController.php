<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

/**
 * @OA\Info(
 *             title="API Documentation",
 *             version="1.0",
 *             description="Project API Documentation"
 * )
 *
 * @OA\Server(url="http://localhost")
 */

class AuthController extends Controller
{
    /**
     * Get Users
     * @OA\Get (
     *     path="/api/user",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Aderson Felix"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="email",
     *                         example="example@domain.com"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        /**
         * Register a User
         * @OA\Post (
         *     path="/api/register",
         *     tags={"Authentication"},
         *     @OA\Parameter(
         *         in="path",
         *         name="id",
         *         required=true,
         *         @OA\Schema(type="string")
         *     ),
         *     @OA\Response(
         *         response=201,
         *         description="OK",
         *         @OA\JsonContent(
         *              @OA\Property(property="id", type="number", example=1),
         *              @OA\Property(property="nombres", type="string", example="Aderson Felix"),
         *              @OA\Property(property="apellidos", type="string", example="Jara Lazaro"),
         *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
         *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
         *         )
         *     ),
         *      @OA\Response(
         *          response=400,
         *          description="BAD REQUEST",
         *          @OA\JsonContent(
         *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\User] #id"),
         *          )
         *      )
         * )
         */

        $validateData = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email", "string", "unique:users"],
            "password" => ["required", "string", "min:6"]
        ]);

        $user = User::create($validateData);
        $data = $user->createToken("auth_token")->plainTextToken;
        return [
            "token" => $data
        ];
    }
}
