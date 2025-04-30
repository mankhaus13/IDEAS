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
    public function up()
    {
        Schema::create('user__profiles', function (Blueprint $table) {
            $table->id();
            // Связь с пользователем
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Персональные данные
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('birthday')->nullable();

            // Паспортные данные (лучше разделить и добавить валидацию)
            $table->string('passport_series', 10)->nullable()->comment('Серия паспорта');
            $table->string('passport_number', 10)->nullable()->comment('Номер паспорта');
            $table->date('passport_issued_at')->nullable()->comment('Когда выдан');
            $table->string('passport_issued_by', 255)->nullable()->comment('Кем выдан');

            // Дополнительные поля
            $table->string('phone', 20)->nullable()->comment('Телефон');
            $table->string('address', 255)->nullable()->comment('Адрес проживания');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user__profiles');
    }
};
