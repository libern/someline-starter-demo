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
     * Transform the Post entity
     * @param Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'post_id' => (int)$model->post_id,

            /* place your other model properties here */
            'title' => $model->title,
            'body' => $model->body,
            'is_recommended' => (boolean)$model->is_recommended,

            'created_at' => (string)$model->created_at,
            'updated_at' => (string)$model->updated_at
        ];
    }
}
