<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('host');
            $table->integer('port')->nullable();
            $table->enum('protocol', ['http', 'https', 'tcp', 'ping'])->default('https');
            $table->boolean('is_active')->default(true);
            $table->integer('expected_status_code')->default(200);
            $table->integer('timeout')->default(5000); // ms
            $table->enum('auth_type', ['none', 'basic', 'bearer'])->default('none');
            $table->json('headers')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitors');
    }
};
