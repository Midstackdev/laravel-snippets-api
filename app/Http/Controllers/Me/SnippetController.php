<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Transformers\Snippets\SnippetTransformer;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * [index description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        return fractal()
            ->collection(
                $request->user()->snippets
            )
            ->transformWith(new SnippetTransformer())
            ->toArray();
    }
}
