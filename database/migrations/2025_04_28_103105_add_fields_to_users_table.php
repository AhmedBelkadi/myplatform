<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/YYYY_MM_DD_add_fields_to_users_table.php

 public function up()
 {
     Schema::table('users', function (Blueprint $table) {
         if (Schema::hasColumn('table_name', 'first_name')) {
             $table->dropColumn('first_name');
         }
     });
 }

 public function down()
 {
     Schema::table('users', function (Blueprint $table) {
         $table->string('first_name');
     });
 }


};
