<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyClaimRequest;
use App\Models\WarrantyClaim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarrantyClaimsController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $query = WarrantyClaim::query();
        if ($request->has('date') && $request->filled('date')) {
            $value = $request->input('date');
            $query->whereDate('date', $value);
        }

        if ($request->has('datefrom') && $request->filled('datefrom')) {
            $value = $request->input('datefrom');
            $query->whereDate('date', '>', $value);
        }

        if ($request->has('dateto')) {
            $value = $request->input('dateto');
            $value = $value ?: date('Y-m-d');
            $query->whereDate('date', '<', $value);
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
                'success' => true,
                'message' => 'Request successful but no data available',
                'data' => [],
            ], 204);
        }

        return response()->json([
            'success' => true,
            'count' => count($warrantyClaims),
            'data' => $warrantyClaims,
        ]);
    }

    public function store(StoreWarrantyClaimRequest $request, CodeNumberAction $codeNumberAction): JsonResponse
    {
        $data = $request->validated();
        $data['code_1c'] = $codeNumberAction->getCode();
        $data['number_1c'] = $codeNumberAction->getNumber();

        try {
            $warrantyClaim = WarrantyClaim::query()->firstOrCreate(
                ['code_1c' => $data['code_1c'], 'number_1c' => $data['number_1c']],
                $data
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create warranty claim',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Warranty claim created successfully',
            'data' => $warrantyClaim,
        ], 201);
    }
}
