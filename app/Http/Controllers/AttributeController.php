<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AttributeResource::collection(Attribute::all());
    }

    /**
     * @param  int  $id
     * @return AttributeResource
     */
    public function show(int $id): AttributeResource
    {
        return new AttributeResource(Attribute::findOrFail($id));
    }

    /**
     * @param  AttributeRequest  $request
     * @return AttributeResource
     */
    public function store(AttributeRequest $request)
    {
        $attribute = Attribute::create($request->validated());

        return new AttributeResource($attribute);
    }

    /**
     * @param  AttributeRequest  $request
     * @param  int  $id
     * @return AttributeResource
     */
    public function update(AttributeRequest $request, int $id): AttributeResource
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->validated());

        return new AttributeResource($attribute);
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            return response()->json([
                'success' => false,
                'message' => 'Attribute not found.',
            ], 404);
        }

        if ($attribute->attributeValues()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete attribute. It is linked to existing projects.',
            ], 400);
        }

        $attribute->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attribute deleted successfully.',
        ], 200);
    }

}
