<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotConversation extends Model
{
    use HasFactory;

    protected $table = 'chatbot_conversations';

    protected $fillable = [
        'session_id',
        'user_message',
        'bot_response',
        'intent',
        'confidence_score',
        'response_type',
        'was_helpful',
        'sentiment',
        'was_unanswered',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'confidence_score' => 'decimal:2',
        'was_helpful' => 'boolean',
        'was_unanswered' => 'boolean',
    ];

    /**
     * Get the intent associated with this conversation
     */
    public function intentModel()
    {
        return $this->belongsTo(ChatbotIntent::class, 'intent', 'name');
    }

    /**
     * Scope for unanswered conversations
     */
    public function scopeUnanswered($query)
    {
        return $query->where('was_unanswered', true);
    }

    /**
     * Scope for specific session
     */
    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    /**
     * Scope for recent conversations
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Get popular queries (most asked)
     */
    public static function getPopularQueries($limit = 10)
    {
        return static::select('user_message', \DB::raw('COUNT(*) as count'))
            ->where('was_unanswered', false)
            ->groupBy('user_message')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get sentiment distribution
     */
    public static function getSentimentStats()
    {
        return static::select('sentiment', \DB::raw('COUNT(*) as count'))
            ->groupBy('sentiment')
            ->pluck('count', 'sentiment')
            ->toArray();
    }

    /**
     * Get unanswered count
     */
    public static function getUnansweredCount()
    {
        return static::where('was_unanswered', true)->count();
    }
}
