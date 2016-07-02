<?php

namespace Someline\Transformers;

use League\Fractal\TransformerAbstract;
use Someline\Models\Foundation\Post;

/**
 * Class PostTransformer
 * @package namespace Someline\Transformers;
 */
class PostTransformer extends BaseTransformer
{

    /**
     * Transform the \Post entity
     * @param \Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
