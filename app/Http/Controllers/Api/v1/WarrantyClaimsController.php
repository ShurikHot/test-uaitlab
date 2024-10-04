<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyClaimApiRequest;
use App\Models\ServiceWorks;
use App\Models\SpareParts;
use App\Models\TechnicalConclusion;
use App\Models\WarrantyClaim;
use App\Models\WarrantyClaimServiceWork;
use App\Models\WarrantyClaimSparepart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarrantyClaimsController extends Controller
{
    public function get(Request $request)
    {
        $query = WarrantyClaim::query();
        if ($request->has('date') && $request->filled('date')) {
            $value = $request->input('date');
            $query->whereDate('date', $value);
        }

        if ($request->has('datefrom') && $request->filled('datefrom')) {
            $value = $request->input('datefrom');
            $query->whereDate('date', '>=', $value);
        }

        if ($request->has('dateto')) {
            $value = $request->input('dateto');
            $value = $value ?: date('Y-m-d');
            $query->whereDate('date', '<=', $value);
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

        $warrantyClaims = $query->with(['technicalConclusions', 'serviceWorks', 'spareParts'])->get();

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

    public function store(StoreWarrantyClaimApiRequest $request, CodeNumberAction $codeNumberAction): JsonResponse
    {
        $data = $request->validated();

        try {
            $warrantyClaim = DB::transaction(function () use ($data, $codeNumberAction) {
                /*створення гарантійної заявки*/
                $warrantyClaimData = [
                    'code_1c' => $codeNumberAction->getCode(),
                    'number_1c' => $codeNumberAction->getNumber(),
                    'date' => $data['date'],
                    'date_of_claim' => $data['date_of_claim'],
                    'date_of_sale' => $data['date_of_sale'],
                    'factory_number' => $data['factory_number'],
                    'comment' => $data['comment'],
                    'point_of_sale' => $data['point_of_sale'],
                    'product_name' => $data['product_name'],
                    'details' => $data['details'],
                    'manager' => $data['manager'],
                    'autor' => $data['autor'],
                    'client_name' => $data['client_name'],
                    'sender_name' => $data['sender_name'],
                    'client_phone' => $data['client_phone'],
                    'sender_phone' => $data['sender_phone'],
                    'type_of_claim' => $data['type_of_claim'],
                    'receipt_number' => $data['receipt_number'],
                    'service_partner' => $data['service_partner'],
                    'service_contract' => $data['service_contract'],
                    'product_article' => $data['product_article'],
                    'photo_path' => $data['photo_path'],
                    'status' => $data['status'],
                    'spare_parts_sum' => 0,
                    'service_works_sum' => 0,
                ];
                $warrantyClaim = WarrantyClaim::query()->firstOrCreate(
                    ['code_1c' => $warrantyClaimData['code_1c'], 'number_1c' => $warrantyClaimData['number_1c']],
                    $warrantyClaimData
                );

                /*створення АТЕ*/
                $data['technical_conclusions']['code_1c'] = $codeNumberAction->getCode();
                $data['technical_conclusions']['number_1c'] = $codeNumberAction->getNumber();
                $data['technical_conclusions']['warranty_claims_code_1c'] = $warrantyClaim->code_1c;
                TechnicalConclusion::query()->firstOrCreate(
                    ['code_1c' => $data['technical_conclusions']['code_1c'], 'number_1c' => $data['technical_conclusions']['number_1c']],
                    $data['technical_conclusions']
                );

                /*створення записів про виконані сервісні роботи*/
                $sumWorks = 0;
                foreach ($data['service_works'] as $work) {
                    $workFromCatalog = ServiceWorks::query()->where('code_1c', $work['code_1c'])->first();
                    $work['code_1c'] = $codeNumberAction->getCode();
                    $work['warranty_claims_number_1c'] = $warrantyClaim->number_1c;
                    $work['product'] = $workFromCatalog->product;
                    $work['sum'] = $work['qty'] * $work['price'];
                    $sumWorks += $work['sum'];
                    WarrantyClaimServiceWork::query()->firstOrCreate(
                        ['code_1c' => $work['code_1c']],
                        $work
                    );
                }

                /*створення записів про використані запчастини*/
                $sumParts = 0;
                foreach ($data['spare_parts'] as $part) {
                    $partFromCatalog = SpareParts::query()->where('code_1c', $part['code_1c'])->first();
                    $part['code_1c'] = $codeNumberAction->getCode();
                    $part['warranty_claims_number_1c'] = $warrantyClaim->number_1c;
                    $part['articul'] = $partFromCatalog->articul;
                    $part['product'] = $partFromCatalog->product;
                    $part['sum'] = $part['qty'] * $part['price'] * (1 - $part['discount'] / 100);
                    $sumParts += $part['sum'];
                    WarrantyClaimSparepart::query()->firstOrCreate(
                        ['code_1c' => $part['code_1c']],
                        $part
                    );
                }

                $warrantyClaim->update([
                    'spare_parts_sum' => $sumParts,
                    'service_works_sum' => $sumWorks,
                ]);

                return $warrantyClaim->load(['technicalConclusions', 'serviceWorks', 'spareParts']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Warranty claim created successfully',
                'data' => $warrantyClaim,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create warranty claim',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
