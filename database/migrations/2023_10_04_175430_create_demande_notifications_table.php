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
        Schema::create('demande_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('demande_notification_id');
            $table->foreign('demande_notification_id')->references('id')->on('demande_auteurs')->onDelete('cascade');
            $table->text('message')->nullable();
            $table->boolean('lu')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_notifications');
    }
};
