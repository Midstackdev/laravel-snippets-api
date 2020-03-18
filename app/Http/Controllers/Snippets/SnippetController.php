<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Models\Snippet;
use App\Transformers\Snippets\SnippetTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SnippetController extends Controller
{

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware(['auth:api'])->only('strore');
    }

    /**
     * [show description]
     * @param  Snippet $snippet [description]
     * @return [type]           [description]
     */
    public function show(Snippet $snippet)
    {
        $this->authorize('show', $snippet);

        return fractal()
                ->item($snippet)
                ->transformWith(new SnippetTransformer())
                ->parseIncludes([
                    'author',
                    'user'
                ])
                ->toArray();
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $snippet = $request->user()->snippets()->create();

        return fractal()
                ->item($snippet)
                ->transformWith(new SnippetTransformer())
                ->toArray();
    }

    /**
     * [update description]
     * @param  Snippet $snippet [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Snippet $snippet, Request $request)
    {
        $this->authorize('update', $snippet);

        $this->validate($request, [
            'title' => 'nullable',
            'is_public' => 'nullable|boolean'
        ]);
        
        $snippet->update($request->only('title', 'is_public'));
    }
}
