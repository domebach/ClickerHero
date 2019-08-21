<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clickers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(1);
            $table->float('currentHP')->default(100);
            $table->text('currentHPShown')->default(100);
            $table->float('maxHP')->default(100);
            $table->text('maxHPShown')->default(100);
            $table->float('atkDmg')->default(1);
            $table->float('upgLvl')->default(0);
            $table->float('level')->default(1);
            $table->float('hero1Lvl')->default(0);
            $table->float('hero1Dps')->default(5);
            $table->boolean('hero1DpsEnabled')->default(false);
            $table->float('upgCosts')->default(5);
            $table->text('upgCostsShown')->default(5);
            $table->float('upgHeroCosts')->default(50);
            $table->text('upgHeroCostsShown')->default(50);
            $table->float('money')->default(0);
            $table->text('moneyShown')->default(0);
            $table->float('critChance')->default(0.051);
            $table->float('critDmg')->default(2);
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
        Schema::dropIfExists('clickers');
    }
}
