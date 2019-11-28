<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('user_permissionable', function (Blueprint $table) {
            $table->unsignedInteger('user_permission_id');
            $table->unsignedInteger('model_id');
            $table->string('model_type');

            $table->foreign('user_permission_id')
                ->references('id')
                ->on('user_permissions')
                ->onDelete('cascade');

            $table->primary(['user_permission_id', 'model_id', 'model_type'], 'user_permissionable_primary');
        });

        // Schema::create('user_permission_user', function (Blueprint $table) {
        //     $table->unsignedInteger('user_permission_id');
        //     $table->unsignedInteger('user_id');

        //     $table->foreign('user_permission_id')
        //         ->references('id')
        //         ->on('user_permissions')
        //         ->onDelete('cascade');

        //     $table->foreign('user_id')
        //         ->references('id')
        //         ->on('users')
        //         ->onDelete('cascade');

        //     $table->primary(['user_permission_id', 'user_id']);
        // });

        // Schema::create('user_role_permission_user', function (Blueprint $table) {
        //     $table->unsignedInteger('user_permission_id');
        //     $table->unsignedInteger('user_role_id');

        //     $table->foreign('user_permission_id')
        //         ->references('id')
        //         ->on('user_permissions')
        //         ->onDelete('cascade');

        //     $table->foreign('user_role_id')
        //         ->references('id')
        //         ->on('user_roles')
        //         ->onDelete('cascade');

        //     $table->primary(['user_permission_id', 'user_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_permissions');
        // Schema::drop('user_permission_user');
        // Schema::drop('user_role_permission_user');
        Schema::drop('user_permissionable');
    }
}
