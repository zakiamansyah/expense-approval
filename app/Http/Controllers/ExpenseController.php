<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalRequest;
use App\Http\Requests\ExpenseRequest;
use App\Services\ExpenseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    protected $expenseService;

    public function __construct(ExpenseService $expenseService) {
        $this->expenseService = $expenseService;
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
     *     path="/api/v1/expense",
     *     tags={"Expenses"},
     *     summary="Tambah pengeluaran",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="amount", type="integer", example=1000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Expense created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="amount", type="integer", example=1000),
     *             @OA\Property(property="status", type="string", example="Pending")
     *         )
     *     )
     * )
     */
    public function store(ExpenseRequest $request): JsonResponse {
        $expense = $this->expenseService->createExpense($request->validated());
        return response()->json(['message' => 'Expense created', 'data' => $expense], 201);
    }

    /**
     * @OA\Patch(
     *     path="/api/v1/expense/{id}/approve",
     *     tags={"Expenses"},
     *     summary="Setujui pengeluaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="approver_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Expense approved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="status", type="string", example="Approved")
     *         )
     *     )
     * )
     */
    public function approve(ApprovalRequest $request, $id): JsonResponse {
        $approval = $this->expenseService->approveExpense($id, $request->validated());
        return response()->json(['message' => 'Expense approved', 'data' => $approval], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/expense/{id}",
     *     tags={"Expenses"},
     *     summary="Ambil pengeluaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Expense retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="amount", type="integer", example=1000),
     *             @OA\Property(property="status", type="string", example="Pending"),
     *             @OA\Property(
     *                 property="approval",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="approver", type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Ana")
     *                     ),
     *                     @OA\Property(property="status", type="object",
     *                         @OA\Property(property="id", type="integer", example=2),
     *                         @OA\Property(property="name", type="string", example="Approved")
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $expense = $this->expenseService->getExpense($id);
        return response()->json(['data' => $expense], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
