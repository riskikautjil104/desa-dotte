<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatbot_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id')->nullable()->comment('Related conversation');
            $table->unsignedBigInteger('faq_id')->nullable()->comment('Related FAQ');
            $table->boolean('is_helpful')->comment('User feedback: true=helpful, false=not helpful');
            $table->text('user_comment')->nullable()->comment('Optional user comment');
            $table->enum('sentiment', ['positive', 'negative', 'neutral'])->default('neutral');
            $table->timestamps();

            $table->index(['conversation_id']);
            $table->index(['faq_id']);
            $table->foreign('conversation_id')->references('id')->on('chatbot_conversations')->onDelete('cascade');
            $table->foreign('faq_id')->references('id')->on('chatbot_faqs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_feedbacks');
    }
};
