public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('specialization')->nullable()->after('role');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('specialization');
    });
}
