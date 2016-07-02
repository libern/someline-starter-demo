<?php

namespace Someline\Presenters;

use Someline\Transformers\PostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PostPresenter
 *
 * @package namespace Someline\Presenters;
 */
class PostPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PostTransformer();
    }
}
