<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Models\{Snippet, Step};
use App\Transformers\Snippets\StepTransformer;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function update(Snippet $snippet, Step $step, Request $request)
    {
        $step->update($request->only('title', 'body'));
    }

    public function destroy(Snippet $snippet, Step $step)
    {
        if($snippet->steps->count() === 1) {
            return response(null, 400);
        }
        $step->delete();
    }

    public function store(Snippet $snippet, Request $request)
    {
        $step = $snippet->steps()->create(array_merge(
            $request->only('title', 'body'), [
                'order' => $this->getorder($request)
            ]
        ));

        return fractal()
                ->item($step)
                ->transformWith(new StepTransformer())
                ->toArray();
    }

    /**
     * @param  Request
     * @return [type]
     */
    protected function getOrder(Request $request)
    {
        return Step::where('uuid', $request->before)
                ->orWhere('uuid', $request->after)
                ->first()
                ->{($request->before ? 'before' : 'after') . 'Order'}();
    }
}
