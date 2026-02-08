<?php

use App\Http\Controllers\ChatbotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Chatbot Routes
|--------------------------------------------------------------------------
*/
Route::prefix('chatbot')->group(function () {
    // Main chatbot response endpoint
    Route::post('/respond', [ChatbotController::class, 'respond']);

    // Feedback submission
    Route::post('/feedback', [ChatbotController::class, 'submitFeedback']);

    // Conversation history
    Route::get('/history', [ChatbotController::class, 'getConversationHistory']);

    // Popular queries
    Route::get('/popular', [ChatbotController::class, 'getPopularQueries']);

    // Analytics (for admin dashboard)
    Route::get('/analytics', [ChatbotController::class, 'getAnalytics']);
});
