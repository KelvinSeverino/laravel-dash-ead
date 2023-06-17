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
            $table->uuid('admin_id')->index()->nullable();
            $table->uuid('user_id')->index()->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('support_id')
                    ->references('id')
                    ->on('supports');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->foreign('admin_id')
                    ->references('id')
                    ->on('admins');
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
