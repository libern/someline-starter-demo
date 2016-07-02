<?php

namespace Someline\Api\Controllers;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;

use Someline\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Someline\Http\Requests\PostCreateRequest;
use Someline\Http\Requests\PostUpdateRequest;
use Someline\Repositories\Interfaces\PostRepository;
use Someline\Validators\PostValidator;


class PostsController extends BaseController
{

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @var PostValidator
     */
    protected $validator;


    public function __construct(PostRepository $repository, PostValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        $post = $this->repository->create($data);

        // A. return 201 created
//            return $this->response->created(null);

        // B. return data
        return $post;

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(PostUpdateRequest $request, $id)
    {

        $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $post = $this->repository->update($request->all(), $id);

        // throw exception if update failed
//        throw new UpdateResourceFailedException();

        // Updated, return 204 No Content
        return $this->response->noContent();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if ($deleted) {
            // Deleted, return 204 No Content
            return $this->response->noContent();
        } else {
            // Failed, throw exception
            throw new DeleteResourceFailedException();
        }
    }
}
