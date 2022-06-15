<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('urls', static function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->string('client_url')->unique();
            $table->string('short_url')->unique();
            $table->bigInteger('visited_count')->default(0);
            // $table->string('user_ip')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
