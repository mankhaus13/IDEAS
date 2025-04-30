<?php

use App\Constants\Permissions;
use App\Models\Permission;
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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        $permissions = Permissions::getAll();

        foreach ($permissions as $permission) {
            Permission::create([
                'title' => $permission
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permissions = Permissions::getAll();
        Permission::whereIn('title', $permissions)->delete();

        Schema::dropIfExists('permissions');
    }
};
