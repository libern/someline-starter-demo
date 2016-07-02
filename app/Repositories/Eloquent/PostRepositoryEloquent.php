<?php

namespace Someline\Repositories\Eloquent;

use Prettus\Repository\Criteria\RequestCriteria;
use Someline\Repositories\Interfaces\PostRepository;
use Someline\Models\Foundation\Post;
use Someline\Validators\PostValidator;

/**
 * Class PostRepositoryEloquent
 * @package namespace Someline\Repositories\Eloquent;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PostValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
