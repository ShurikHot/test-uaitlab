<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\DateFormatAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyClaimRequest;
use App\Models\WarrantyClaim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarrantyClaimsController extends Controller
{
    public function get(Request $request, DateFormatAction $dateFormatAction): JsonResponse
    {
        $query = WarrantyClaim::query();

        if ($request->has('date') && $request->filled('date')) {
            $value = $dateFormatAction($request->input('date'), 'd.m.Y');
            $query->where('date', $value);
        }

        if ($request->has('datefrom') && $request->filled('datefrom')) {
            $value = $dateFormatAction($request->input('datefrom'), 'd.m.Y');
            $query->where('date', '>', $value);
        }

        if ($request->has('dateto')) {
            $value = $dateFormatAction($request->input('dateto'), 'd.m.Y');
            $value = $value ?: date('Y-m-d');
            $query->where('date', '<', $value);
        }

        if ($request->has('status') && $request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('code_1c') && $request->filled('code_1c')) {
            if (is_array($request->input('code_1c'))) {
                $query->whereIn('code_1c', $request->input('code_1c'));
            } else {
                $query->where('code_1c', $request->input('code_1c'));
            }
        }

        $warrantyClaims = $query->with(['serviceWorks', 'spareParts', 'technicalConclusions'])->get();

        if ($warrantyClaims->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No data found for the given request',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $warrantyClaims,
        ]);
    }

    public function store(StoreWarrantyClaimRequest $request): JsonResponse
    {
        $data = $request->validated();
        $warrantyClaim = WarrantyClaim::query()->create($data);

        return response()->json([
            'success' => true,
            'data' => $warrantyClaim,
        ]);
    }
}
