<?php

namespace App\Http\Controllers;

use App\Filters\ProjectFilters;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{

    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->query('filters', []);

        $projects = (new ProjectFilters())->apply(Project::query(), $filters)->with(
            ['users', 'attributes', 'timesheets']
        )->get();

        return ProjectResource::collection($projects)->additional([
            'success' => true,
            'message' => count($projects)
                ? 'Projects retrieved successfully'
                : 'No matching projects found.',
        ]);
    }

    /**
     * @param  int  $id
     * @return ProjectResource
     */
    public function show(int $id): ProjectResource
    {
        $project = Project::with(['users', 'attributes'])->findOrFail($id);

        return new ProjectResource($project);
    }

    /**
     * @param  ProjectRequest  $request
     * @return ProjectResource
     */
    public function store(ProjectRequest $request): ProjectResource
    {
        $project = Project::create($request->validated());

        if ($request->has('user_ids')) {
            $project->users()->sync($request->input('user_ids'));
        }

        $attributes = $request->input('attributes', []);
        if (!empty($attributes)) {
            foreach ($attributes as $attr) {
                AttributeValue::create([
                    'attribute_id' => $attr['attribute_id'],
                    'project_id' => $project->id,
                    'value' => $attr['value'],
                ]);
            }
        }

        return new ProjectResource($project->load('attributes'));
    }

    /**
     * @param  ProjectRequest  $request
     * @param  int  $id
     * @return ProjectResource
     */
    public function update(ProjectRequest $request, int $id): ProjectResource
    {
        $project = Project::findOrFail($id);
        $project->update($request->validated());

        if ($request->has('user_ids')) {
            $project->users()->sync($request->input('user_ids'));
        }

        $attributes = $request->input('attributes', []);
        if (!empty($attributes)) {
            foreach ($attributes as $attr) {
                AttributeValue::updateOrCreate([
                    'attribute_id' => $attr['attribute_id'],
                    'project_id' => $project->id,
                    'value' => $attr['value'],
                ]);
            }
        }

        return new ProjectResource($project->load('attributes'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.',
        ], 200);
    }
}
