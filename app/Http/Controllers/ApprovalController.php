<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalRequest;
use App\Services\ApprovalService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    protected $approvalService;

    public function __construct(ApprovalService $approvalService) {
        $this->approvalService = $approvalService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $approval = $this->approvalService->approveExpense($request->validated());
    //     return response()->json(['message' => 'Expense approved', 'data' => $approval], 201);
    // }

    public function store(ApprovalRequest $request): JsonResponse {
        $approval = $this->approvalService->createApproval($request->validated());
        return response()->json(['message' => 'Approval created successfully', 'data' => $approval], 201);
    }

    public function approve(ApprovalRequest $request): JsonResponse {
        try {
            $approval = $this->approvalService->approveExpense($request->validated());
            return response()->json(['message' => 'Approval processed successfully', 'data' => $approval], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
