<?php

namespace App\Http\Controllers;

use App\Http\Requests\SummaryRequest;
use App\Services\SummaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SummaryController extends Controller
{
    public function index(): View
    {
        return view('resume');
    }

    public function generate(SummaryRequest $request, SummaryService $summaryService): JsonResponse
    {
        try {
            $summary = $summaryService->generateSummary($request->input('text'));
            return response()->json(['summary' => $summary]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);
        }
    }
}
