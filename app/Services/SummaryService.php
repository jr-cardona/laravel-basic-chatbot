<?php

namespace App\Services;

use App\Exceptions\SummaryGenerationException;
use OpenAI\Laravel\Facades\OpenAI;

class SummaryService
{
    public function generateSummary(string $text): string
    {
        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Summarize long texts.'],
                    ['role' => 'user', 'content' => $text]
                ],
            ]);

            return $response->choices[0]->message->content;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
