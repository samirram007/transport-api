<?php

namespace App\Http\Resources\Document;

use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class DocumentResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'userId' => $this->user_id,
            'documentType' => $this->document_type,
            'path' => env('APP_URL') . '/storage/' . $this->path,
            'mimeType' => $this->mime_type,
            'size' => $this->size,
            'originalName' => $this->original_name,
            'documents' => $this->document_type==='folder'? new DocumentCollection($this->whenLoaded('documents')):null,
            'folders' =>$this->document_type!=='folder'? new DocumentCollection($this->whenLoaded('folders')):null,

        ];

    }
}
