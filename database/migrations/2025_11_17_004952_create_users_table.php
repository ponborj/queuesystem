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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password')->nullable()->default(null);
            $table->integer('id_company')->default(null)->index(); // id da company
            $table->enum('role', ['sys-admin', 'client-admin', 'client-user'])->default('client-user'); // admin do sistema, admin da company e client da company
            $table->dateTime('last_login')->nullable()->default(null); // ultimo login
            $table->string('code', 64)->nullable()->default(null);
            $table->dateTime('code_expires_at')->nullable()->default(null);
            $table->boolean('active')->default(false);
            $table->dateTime('blocked_until')->nullable()->default(null); // bloqueado até
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->useCurrent()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
