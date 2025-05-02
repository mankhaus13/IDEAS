<?php

use App\Constants\Auth\Permissions;
use App\Constants\Auth\Roles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Role_Permission;
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
        Schema::create('role__permissions', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained()->cascadeOnDelete();
            $table->primary(['role_id', 'permission_id']);
            $table->timestamps();
        });

        $rolesPermissions = [
            Roles::ADMIN => [Permissions::READ, Permissions::UPDATE, Permissions::DELETE, Permissions::CREATE],
            Roles::USER => [Permissions::READ],
            Roles::MANAGER => [Permissions::READ, Permissions::UPDATE, Permissions::DELETE]
        ];

        foreach ($rolesPermissions as $role => $permissions) {
            $roleId = Role::where('title', $role)->first()->id;
            foreach ($permissions as $permission) {
                $permissionId = Permission::where('title', $permission)->first()->id;
                Role_Permission::insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('role__permissions')->truncate();

        Schema::dropIfExists('role_permissions');
    }
};
