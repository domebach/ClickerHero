<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.0.4/math.js"></script>

<html>
    <head>
        <title>Vue</title>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">


    </head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

    <body>
        <script>

        </script>

        <div class="" id="root">
            <div class="mb-2">
                <h1 id="mShown" class="text-orange-600 text-center text-lg"> Level: <span id="sLvl"></span>, Current money: <span id="curM"></span></h1>
            </div>
            <h1 class="text-center text-4xl my-2"> HP <span id="curHP"></span> / <span id="maxHP"></span></h1>
            <div class="flex justify-center mb-6">
                <img @click="attack" src="/images/boss.png">
            </div>

            {{--<input type="number" v-model="atkDmg">--}}
            <div class="flex justify-center">
                <button id="atkBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-1 rounded">
                    Attack
                </button>
                <button id="upgBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upgrade
                </button>
            </div>

            <div class="flex justify-center my-4">
                <h1> Heroes </h1>
            </div>
            <div class="flex justify-center items-center">
                <h1 class="mr-6 text-4xl"> Hero 1 </h1>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        id="upgHBtn"> Upgrade Hero
                </button>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                //variables
                let currentHP       = 25;
                let currentHPShown  = 25;
                let maxHP           = 25;
                let maxHPShown      = 25;
                let atkDmg          = 100;
                let upgLvl          = 1;
                let level           = 1;
                let hero1Lvl        = 0;
                let hero1Dps        = 5;
                let hero1DpsEnabled = false;
                let upgCosts        = 10;
                let upgCostsShown   = 10;
                let upgHeroCosts    = 10;
                let upgHeroCostsShown= 10;
                let money           = 0;
                let moneyShown      = '0';
                let restHP;
                let restHP2;

                let sLvl = $('#sLvl');
                let curM = $('#curM');
                let curHP = $('#curHP');
                let maxHPA =$('#maxHP');

                sLvl.html(level);
                curM.html(moneyShown);
                curHP.html(currentHPShown);
                maxHPA.html(maxHPShown);

                $('#atkBtn').click(function () {
                    restHP = currentHP - atkDmg;

                    money = parseInt(money) + parseInt(atkDmg);

                    dmgCounting(restHP);

                    moneyShown = number_format_short(money);
                    currentHPShown = number_format_short(currentHP);
                    maxHPShown = number_format_short(maxHP);

                    sLvl.html(level);
                    curM.html(moneyShown);
                    curHP.html(currentHPShown);
                    maxHPA.html(maxHPShown);
                });

                $('#upgBtn').click(function () {
                    if (money > upgCosts) {
                        upgLvl++;
                        atkDmg = atkDmg + (atkDmg * 0.1);
                        money = money - upgCosts;
                        upgCosts = upgCosts + (upgCosts * 0.1);

                        upgCosts = Math.round(upgCosts * 1000) / 1000;
                        atkDmg = Math.round(atkDmg * 1000) / 1000;
                        money = Math.round(money * 1000) / 1000;

                        moneyShown = number_format_short(money);

                        curM.html(moneyShown);
                    }
                });

                $('#upgHBtn').click(function () {
                    if (money >= upgHeroCosts) {
                        money = money - upgHeroCosts;
                        upgHeroCosts = upgHeroCosts + (upgHeroCosts * 0.1);
                        hero1Lvl++;
                        hero1Dps = hero1Dps + (hero1Dps * 0.1);

                        moneyShown = number_format_short(money);
                        $('#curM').text(moneyShown);

                        if (hero1Lvl > 0 && hero1DpsEnabled === false) {
                            dps();
                            hero1DpsEnabled = true;
                        }
                    }
                });

                function dps() {
                    setTimeout(function () { dps() }, 1000);

                    restHP2 = currentHP - hero1Dps;
                    money = parseInt(money) + parseInt(hero1Dps);

                    dmgCounting(restHP2);

                    moneyShown = number_format_short(money);
                    currentHPShown = number_format_short(currentHP);
                    maxHPShown = number_format_short(maxHP);

                    sLvl.html(level);
                    curM.html(moneyShown);
                    curHP.html(currentHPShown);
                    maxHPA.html(maxHPShown);
                }

                function dmgCounting(restHP) {
                    money = Math.round(money * 1000) / 1000;

                    if (restHP > 0) {
                        currentHP = restHP;
                    } else if (restHP === 0) {
                        maxHP = maxHP + (maxHP * 0.1);
                        currentHP = maxHP;
                        level++;
                    } else {
                        maxHP = maxHP + (maxHP * 0.1);
                        currentHP = maxHP + restHP;
                        level++;

                        while (currentHP <= 0) {
                            restHP = currentHP;
                            maxHP = maxHP + (maxHP * 0.1);
                            level++;
                            currentHP = maxHP + restHP;
                        }
                    }
                    currentHP = Math.round(currentHP * 10) / 10;
                    maxHP = Math.round(maxHP * 10) / 10;
                }

                function number_format_short( n ) {
                    let suffix;
                    let n_format;

                    if (n >= 0 && n < 1000) {
                        // 1 - 999
                        n_format = Math.round(n * 1000) / 1000;
                        suffix = '';
                    } else if (n >= 1000 && n < 1000000) {
                        // 1k-999k
                        n_format = Math.round(n) / 1000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'K';
                    } else if (n >= 1000000 && n < 1000000000) {
                        // 1m-999m
                        n_format = Math.round(n) / 1000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'M';
                    } else if (n >= 1000000000 && n < 1000000000000) {
                        // 1b-999b
                        n_format = Math.round(n) / 1000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'B';
                    } else if (n >= 1000000000000 && n < 1000000000000000) {
                        // 1t+
                        n_format = Math.round(n) / 1000000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'T';
                    } else if (n >= 1000000000000000 && n < 1000000000000000000) {
                        // 1q+
                        n_format = Math.round(n) / 1000000000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'q';
                    } else if (n >= 1000000000000000000 && n < 1000000000000000000000) {
                        // 1Q+
                        n_format = Math.round(n) / 1000000000000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'Q';
                    } else if (n >= 1000000000000000000000 && n < 1000000000000000000000000) {
                        // 1s+
                        n_format = Math.round(n) / 1000000000000000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 's';
                    } else if (n >= 1000000000000000000000000 && n < 1000000000000000000000000000) {
                        // 1S+
                        n_format = Math.round(n) / 1000000000000000000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'S';
                    }
                    else if (n >= 1000000000000000000000000000) {
                        // 1O+
                        n_format = Math.round(n) / 1000000000000000000000000000;
                        n_format = Math.round(n_format * 1000) / 1000;
                        suffix = 'O';
                    }

                    return !isEmpty(n_format + suffix) ? n_format + suffix : 0;
                }

                function isEmpty(str) {
                    return (!str || 0 === str.length);
                }
            });
        </script>
    </body>
</html>
