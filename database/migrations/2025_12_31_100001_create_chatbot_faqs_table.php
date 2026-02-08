<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatbot_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question')->comment('FAQ question');
            $table->text('answer')->comment('FAQ answer');
            $table->string('intent')->nullable()->comment('Associated intent');
            $table->string('keywords')->nullable()->comment('Comma-separated keywords for matching');
            $table->boolean('is_active')->default(true);
            $table->integer('view_count')->default(0)->comment('Number of times this FAQ was shown');
            $table->integer('helpful_count')->default(0)->comment('Number of times marked as helpful');
            $table->timestamps();

            $table->index(['intent', 'is_active']);
            $table->index(['is_active', 'view_count']);
            $table->foreign('intent')->references('name')->on('chatbot_intents')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_faqs');
    }
};
