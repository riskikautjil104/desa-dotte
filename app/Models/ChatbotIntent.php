<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotIntent extends Model
{
    use HasFactory;

    protected $table = 'chatbot_intents';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'response_template',
        'response_type',
        'quick_actions',
        'suggested_questions',
        'priority',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'quick_actions' => 'array',
        'suggested_questions' => 'array',
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    /**
     * Get FAQs associated with this intent
     */
    public function faqs()
    {
        return $this->hasMany(ChatbotFAQ::class, 'intent', 'name');
    }

    /**
     * Get conversations associated with this intent
     */
    public function conversations()
    {
        return $this->hasMany(ChatbotConversation::class, 'intent');
    }

    /**
     * Scope for active intents
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered by priority
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('priority', 'desc');
    }
}
