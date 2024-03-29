<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('sudoer_username');
            $table->text('sudoer_password');
            $table->text('public_ip_address');
            $table->integer('ssh_port');
            $table->string('home_path');
            $table->mediumText('public_key')->nullable();
            $table->mediumText('private_key')->nullable();
            $table->json('web_server');
            $table->json('meta');
            $table->timestamps();
        });
    }
};
