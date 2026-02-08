<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotFeedback extends Model
{
    use HasFactory;

    protected $table = 'chatbot_feedbacks';

    protected $fillable = [
        'conversation_id',
        'faq_id',
        'is_helpful',
        'user_comment',
        'sentiment',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_helpful' => 'boolean',
    ];

    /**
     * Get the conversation associated with this feedback
     */
    public function conversation()
    {
        return $this->belongsTo(ChatbotConversation::class, 'conversation_id');
    }

    /**
     * Get the FAQ associated with this feedback
     */
    public function faq()
    {
        return $this->belongsTo(ChatbotFAQ::class, 'faq_id');
    }

    /**
     * Scope for helpful feedbacks
     */
    public function scopeHelpful($query)
    {
        return $query->where('is_helpful', true);
    }

    /**
     * Scope for not helpful feedbacks
     */
    public function scopeNotHelpful($query)
    {
        return $query->where('is_helpful', false);
    }

    /**
     * Scope for specific sentiment
     */
    public function scopeWithSentiment($query, $sentiment)
    {
        return $query->where('sentiment', $sentiment);
    }
}
