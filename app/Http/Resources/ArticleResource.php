<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       /*  return parent::toArray($request); */
       return [
           'id' => $this->id,
           
        'title' => $this->title,

        'body' => $this->body,
       ];
    }

    public function with($request)
    {
        return [
            'version' => '3.0.1',

            'Author_url' => url('hagioswilson@gmail.com'),
        ];
    }
}
