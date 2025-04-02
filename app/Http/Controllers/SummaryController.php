<?php

namespace App\Http\Controllers;

use App\Http\Requests\SummaryRequest;
use App\Services\SummaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class SummaryController extends Controller
{
    public function index(): View
    {
        return view('resume');
    }

    public function generate(SummaryRequest $request, SummaryService $summaryService): JsonResponse
    {
        $summary = $summaryService->generateSummary($request->input('text'));
        return response()->json(['summary' => $summary]);
    }
}
