<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatbot_conversations', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->comment('User session identifier');
            $table->text('user_message')->comment('User message');
            $table->text('bot_response')->nullable()->comment('Bot response');
            $table->string('intent')->nullable()->comment('Detected intent');
            $table->decimal('confidence_score', 5, 2)->nullable()->comment('Intent classification confidence');
            $table->enum('response_type', ['text', 'card', 'stats', 'list', 'quick_actions', 'suggestions'])->default('text');
            $table->boolean('was_helpful')->nullable()->comment('User feedback: null=no, true=helpful, false=not helpful');
            $table->enum('sentiment', ['positive', 'negative', 'neutral'])->default('neutral');
            $table->boolean('was_unanswered')->default(false)->comment('True if no matching intent found');
            $table->timestamps();

            $table->index(['session_id', 'created_at']);
            $table->index(['intent', 'created_at']);
            $table->index(['was_unanswered']);
            $table->foreign('intent')->references('name')->on('chatbot_intents')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_conversations');
    }
};
