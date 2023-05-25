<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reply_support', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('support_id')->index();
            $table->uuid('admin_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('support_id')
                    ->references('id')
                    ->on('supports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_support');
    }
};
