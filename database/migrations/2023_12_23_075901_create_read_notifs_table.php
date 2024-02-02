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
        Schema::create('read_notifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notif_id');
            $table->foreign('notif_id')
                    ->references('id')
                    ->on('notifs')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('read_id');
            $table->foreign('read_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->boolean('read')->default(true);
            $table->text('answer')->nullable();
            $table->text('images')->nullable();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('read_notifs');
    }
};
