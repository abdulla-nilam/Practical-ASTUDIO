<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Models\Timesheet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TimesheetController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return TimesheetResource::collection(Timesheet::with(['user', 'project'])->get());
    }

    /**
     * @param  int  $id
     * @return TimesheetResource
     */
    public function show(int $id): TimesheetResource
    {
        $timesheet = Timesheet::with(['user', 'project'])->findOrFail($id);

        return new TimesheetResource($timesheet);
    }

    /**
     * @param  TimesheetRequest  $request
     * @return TimesheetResource
     */
    public function store(TimesheetRequest $request): TimesheetResource
    {
        $timesheet = Timesheet::create($request->validated());

        return new TimesheetResource($timesheet);
    }

    /**
     * @param  TimesheetRequest  $request
     * @param  int  $id
     * @return TimesheetResource
     */
    public function update(TimesheetRequest $request, int $id): TimesheetResource
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update($request->validated());

        return new TimesheetResource($timesheet);
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $timesheet = Timesheet::find($id);

        if (!$timesheet) {
            return response()->json([
                'success' => false,
                'message' => 'Timesheet not found.',
            ], 404);
        }

        $timesheet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Timesheet deleted successfully.',
        ], 200);
    }

}
