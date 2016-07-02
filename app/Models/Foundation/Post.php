<?php

namespace Someline\Models\Foundation;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Someline\Models\BaseModel;

class Post extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'title', 'body', 'is_recommended',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
