<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {

            // Add user_id table
            $table->unsignedBigInteger('user_id')
                  ->nullable()
                  ->after('description'); 

            // Add relation
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            
            // Delete relation
            $table->dropForeign('todos_user_id_foreign');

            // Delete user_id table
            $table->dropColumn('user_id');
        });
    }
}
