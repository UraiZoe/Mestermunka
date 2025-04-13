<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 45);
            $table->string('email', 150)->unique();
            $table->string('address', 150)->nullable();
            $table->string('password', 255);
            $table->string('image_name', 500)->default('https://cdn-icons-png.flaticon.com/512/1144/1144760.png');
            $table->unsignedInteger('admin')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
class User extends Model
{
    public function salons()
    {
        return $this->hasMany(Salon::class, 'owner_id');
    }
}