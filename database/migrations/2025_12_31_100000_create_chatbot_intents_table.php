<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatbot_intents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Intent identifier (e.g., greeting, informasi_desa)');
            $table->string('display_name')->comment('Human readable name');
            $table->text('description')->nullable()->comment('Description of the intent');
            $table->text('response_template')->nullable()->comment('Default response template');
            $table->enum('response_type', ['text', 'card', 'stats', 'list', 'quick_actions', 'suggestions'])->default('text');
            $table->json('quick_actions')->nullable()->comment('Array of quick action buttons');
            $table->json('suggested_questions')->nullable()->comment('Array of suggested questions');
            $table->integer('priority')->default(0)->comment('Higher priority = checked first');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['name', 'is_active']);
            $table->index(['priority', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_intents');
    }
};
