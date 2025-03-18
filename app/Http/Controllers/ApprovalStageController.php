<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalStageRequest;
use App\Services\ApprovalStageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApprovalStageController extends Controller
{
    protected $approvalStageService;

    public function __construct(ApprovalStageService $approvalStageService) {
        $this->approvalStageService = $approvalStageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/v1/approval-stages",
     *     tags={"Approval Stages"},
     *     summary="Tambah tahap approval",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="approver_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Approval stage created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="approver_id", type="integer", example=1)
     *         )
     *     )
     * )
     */
    public function store(ApprovalStageRequest $request): JsonResponse {
        $stage = $this->approvalStageService->createApprovalStage($request->validated());
        return response()->json(['message' => 'Approval stage created', 'data' => $stage], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/v1/approval-stages/{id}",
     *     tags={"Approval Stages"},
     *     summary="Ubah tahap approval",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="approver_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Approval stage updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="approver_id", type="integer", example=2)
     *         )
     *     )
     * )
     */
    public function update(ApprovalStageRequest $request, $id): JsonResponse {
        $stage = $this->approvalStageService->updateApprovalStage($id, $request->validated());
        return response()->json(['message' => 'Approval stage updated', 'data' => $stage], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
