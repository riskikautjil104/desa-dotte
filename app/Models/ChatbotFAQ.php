<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotFAQ extends Model
{
    use HasFactory;

    protected $table = 'chatbot_faqs';

    protected $fillable = [
        'question',
        'answer',
        'intent',
        'keywords',
        'is_active',
        'view_count',
        'helpful_count',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'view_count' => 'integer',
        'helpful_count' => 'integer',
    ];

    /**
     * Get the intent associated with this FAQ
     */
    public function intent()
    {
        return $this->belongsTo(ChatbotIntent::class, 'intent', 'name');
    }

    /**
     * Get feedbacks for this FAQ
     */
    public function feedbacks()
    {
        return $this->hasMany(ChatbotFeedback::class, 'faq_id');
    }

    /**
     * Scope for active FAQs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for popular FAQs
     */
    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    /**
     * Increment view count
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    /**
     * Increment helpful count
     */
    public function incrementHelpfulCount()
    {
        $this->increment('helpful_count');
    }
}
