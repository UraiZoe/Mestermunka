<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('salon_id')->constrained('salons')->onDelete('cascade');
            $table->string('title', 20);
            $table->string('location', 150);
            $table->string('short_information', 100)->nullable();
            $table->text('information');
            $table->string('image_name', 500)->nullable()->default('https://cdni.iconscout.com/illustration/premium/thumb/event-planning-illustration-download-in-svg-png-gif-file-formats--plan-party-managing-service-manager-pack-entertainment-illustrations-4693328.png');
            $table->dateTime('starts_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
