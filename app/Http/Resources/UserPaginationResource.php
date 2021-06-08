<?php

namespace App\Http\Resources;

use App\Traits\Pagination;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPaginationResource extends ResourceCollection
{
    use Pagination;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private $pagination;

    public function __construct($resource)
    {

        $this->pagination = $this->paginate($resource);
        $resource = $resource->getCollection();
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'success'=> true,
            'data'  =>  UserResource::collection($this->collection),
            'pagination'    => $this->pagination
        ];
    }
}
