<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Models\{Snippet, Step};
use App\Transformers\Snippets\StepTransformer;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * [update description]
     * @param  Snippet $snippet [description]
     * @param  Step    $step    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Snippet $snippet, Step $step, Request $request)
    {
        $this->authorize('update', $step);

        $step->update($request->only('title', 'body'));
    }

    /**
     * [destroy description]
     * @param  Snippet $snippet [description]
     * @param  Step    $step    [description]
     * @return [type]           [description]
     */
    public function destroy(Snippet $snippet, Step $step)
    {
        $this->authorize('destroy', $step);

        if($snippet->steps->count() === 1) {
            return response(null, 400);
        }
        $step->delete();
    }

    /**
     * [store description]
     * @param  Snippet $snippet [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Snippet $snippet, Request $request)
    {
        $this->authorize('storeStep', $snippet);

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
