<?php

namespace App\Exceptions;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class PostException extends Exception
{
    private $post = null;

    private string $nameMethod = '';

    public function __construct(string $message = "", int $code = 0, Post $post = null, $nameMethod = '', Throwable $previous = null)
    {
        $this->post = $post;
        $this->nameMethod = $nameMethod;
        parent::__construct($message, $code, $previous);
    }

    public function report(): void
    {
        Log::channel('post')->info("post not " . $this->nameMethod, [$this->post]);
    }

    public function render(Request $request): Response
    {
        return response([
            'message' => $this->message
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function checkIfExists($post, $nameMethod)
    {
        if(!$post->wasRecentlyCreated) {
            throw new self('already exists', 422, $post, $nameMethod);
        }
    }
}
