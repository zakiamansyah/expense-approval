<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproverRequest;
use App\Services\ApproverService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Expense Approval API",
 *     version="1.0.0",
 *     description="API documentation for the Expense Approval system"
 * )
 * @OA\Tag(name="Approvers", description="Approver management")
 */

class ApproverController extends Controller
{

    protected $approverService;
    public function __construct(ApproverService $approverService) {
        $this->approverService = $approverService;
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
    
/**
     * @OA\Post(
     *     path="/api/v1/approvers",
     *     tags={"Approvers"},
     *     summary="Create a new approver",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="John Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Approver created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Approver created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Approver")
     *         )
     *     )
     * )
     */
    public function store(ApproverRequest $request) {
        $approver = $this->approverService->createApprover($request->validated());
        return response()->json([
            'message' => 'Approver created successfully',
            'data' => $approver
        ], 201);
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
