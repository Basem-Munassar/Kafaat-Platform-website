<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Project;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow updating if the project belongs to the user, or user is admin
        $project = Project::find($this->route('id')); // Route parameter
        if (!$project) return false;

        $user = auth()->user();
        $role = $user->role ?? $user->account_type;

        if (in_array($role, ['admin', 'super admin'])) {
            return true;
        }

        return $project->user_id === $user->id;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'required|string|max:255',
            'link' => 'required|url',
        ];
    }
}
