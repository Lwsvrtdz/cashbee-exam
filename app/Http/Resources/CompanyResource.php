<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];

        // Check if "include_departments" query parameter is present in the request
        if ($request->has('include_departments')) {
            $response['departments'] = $this->departments;
        }

        // Check if "include_users" query parameter is present in the request
        if ($request->has('include_users')) {
            $response['users'] = $this->users;
        }

        // Check if "include_employees" query parameter is present in the request
        if ($request->has('include_employees')) {
            $response['employees'] = $this->employees;
        }

        return $response;
    }
}
