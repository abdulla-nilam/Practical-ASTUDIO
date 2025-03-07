<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeValueRequest;
use App\Http\Resources\AttributeValueResource;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeValueController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AttributeValueResource::collection(AttributeValue::all());
    }

    /**
     * @param  int  $id
     * @return AttributeValueResource|JsonResponse
     */
    public function show(int $id)
    {
        $attributeValue = AttributeValue::find($id);

        if (!$attributeValue) {
            return response()->json([
                'success' => false,
                'message' => 'Attribute Value not found.'
            ], 404);
        }

        return new AttributeValueResource($attributeValue);
    }


    /**
     * @param  AttributeValueRequest  $request
     * @return AttributeValueResource
     */
    public function store(AttributeValueRequest $request): AttributeValueResource
    {
        $attributeValue = AttributeValue::create($request->validated());
        return new AttributeValueResource($attributeValue);
    }

    /**
     * @param  AttributeValueRequest  $request
     * @param  int  $id
     * @return AttributeValueResource
     */
    public function update(AttributeValueRequest $request, int $id): AttributeValueResource
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->update($request->validated());
        return new AttributeValueResource($attributeValue);
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $attributeValue = AttributeValue::find($id);

        if (!$attributeValue) {
            return response()->json([
                'success' => false,
                'message' => 'Attribute value not found.'
            ], 404);
        }

        $attributeValue->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attribute value deleted successfully.'
        ], 200);
    }
}
