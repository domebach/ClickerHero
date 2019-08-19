<template>
    <div id="root">
        <div class="mb-2">
            <h2 class="text-orange-400 text-left text-3xl pt-9 pl-9 float-left"> Level: {{ UserData.level }}</h2>
            <h2 class="text-orange-400 text-right text-3xl pt-9 pr-9">Current money: {{ UserData.moneyShown }}</h2>
        </div>
        <h1 class="text-center text-3xl mt-2"> HP {{ UserData.currentHPShown }} / {{ UserData.maxHPShown }}</h1>
        <div class="flex justify-center my-6">
            <img class="borderDesign imgShadow fixedSize" @click="attack" :src="myImg">
        </div>

        <div class="flex justify-center flex-1 flex-wrap">
            <div>
                <button class="borderDesign bg-orange-400 hover:bg-orange-700 text-white text-2xl font-bold py-0.5 px-4 mr-2 rounded"
                        @click="attack" @keypress="imgChanger" @mouseup="imgChanger">Attack</button>
                <h2 class="text-left text-xl mr-3">Damage: {{ UserData.atkDmg }}</h2>
            </div>
            <div>
                <button :class="[UserData.money >= UserData.upgCosts ? 'bg-green-400' : 'bg-red-700',
                        UserData.money >= UserData.upgCosts ? 'hover:bg-green-600' : 'hover:bg-red-800' ]"
                        class="borderDesign text-white text-2xl font-bold py-0.5 px-3 ml-2 rounded"
                        @click="upgrade">Upgrade</button>
                <h2 class="text-right text-xl">Costs: {{ UserData.upgCosts }}</h2>
            </div>
        </div>

        <div class="borderHeroes my-5 mx-auto p-2">
            <div class="flex justify-center my-4">
                <h2 class="border-b text-4xl"> Heroes </h2>
            </div>
            <div class="flex justify-center items-center mb-6">
                <h2 class="flex text-2xl mb-0 mr-3"> Scully R. Johnson </h2>
                <button :class="[UserData.money >= UserData.upgHeroCosts ? 'bg-green-400' : 'bg-red-700',
                        UserData.money >= UserData.upgHeroCosts ? 'hover:bg-green-600' : 'hover:bg-red-800' ]"
                        class="borderDesign text-white font-bold ml-3 py-1 px-1 rounded"
                        @click="upgradeHero"> Upgrade Hero </button>
            </div>
        </div>

        <div class="flex justify-center text-center w-full mt-7">
            <div class="border-b w-full">
                <h2 class="text-4xl">Settings</h2>
            </div>
        </div>
        <div class="flex ">
            <div class="flex justify-start flex-col w-50">
                <div class="flex justify-center items-center mt-2">
                    <h2 class="flex w-50 text-xl text-orange-700 mb-0">Start a new Game:</h2>
                    <button class="borderDesign buttons bg-orange-400 hover:bg-orange-700 text-white font-bold py-1 px-3 mr-1 rounded"
                        @click="newGame">New</button>
                </div>
                <div class="flex justify-center items-center mt-2">
                    <h2 class="flex w-50 text-xl text-orange-700 mb-0">Save the current Game:</h2>
                    <button class="borderDesign buttons bg-orange-400 hover:bg-orange-700 text-white font-bold py-1 px-3 rounded"
                        @click="save">Save</button>
                </div>
            </div>

            <div class="flex justify-center w-50">
                <ul>
                    <li v-for="id in items" style="list-style: none;">
                        <div class="flex justify-center items-center">
                            <h2 class="flex w-50 text-xl text-orange-700 mr-2 my-2">Game-Id: {{ id }}</h2>
                            <button class="borderDesign bg-orange-400 hover:bg-orange-700 text-white font-bold py-0.5 px-3 my-1 mx-2 rounded"
                                    @click="load(id)">Load</button>

                            <button class="borderDesign bg-red-700 hover:bg-red-900 text-white font-bold py-0.5 px-2 my-1 rounded"
                                    @click="deleteGame(id)">Delete</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <div class="flex justify-center">
            {{ message }}
        </div>

        <div class="w-full">
            <a class="text-left text-xl no-underline text-orange-200 hover:text-orange-500" href="/">Startpage</a>
            <a class="text-right text-xl no-underline text-orange-200 hover:text-orange-500" href="/support">Support</a>
        </div>
    </div>
</template>
    <script>
        export default ({
            data() {
                return {
                    UserData: [],
                    message: '',
                    delWarn: false,
                    deleteId: 0,
                    loadId: 0,
                    UserId: null,
                    items: [],
                    myImg: "/images/satan.gif",
                    stdImg: "/images/satan.gif",
                    atomicGif: "/images/atomic2.webp",
                    gifEnabled: false,
                    var_crit: 1
                }
            },

            mounted() {
                this.loadAll();
                this.init();
            },


            methods: {
                imgChanger() {
                    if (this.var_crit <= this.UserData.critChance && this.gifEnabled === false) {
                        this.myImg = this.atomicGif;
                        this.gifEnabled = true;
                        let that = this;
                        setTimeout(function () {
                            that.myImg = that.stdImg;
                            that.gifEnabled = false;
                        }, 1900);
                    }
                },

                attack() {
                    this.var_crit = Math.random();
                    let restHP = this.UserData.currentHP;
                    if (this.var_crit <= this.UserData.critChance) {
                        restHP = restHP - (this.UserData.atkDmg * this.UserData.critDmg);
                        this.UserData.money = parseInt(this.UserData.money) + (parseInt(this.UserData.atkDmg) * parseInt(this.UserData.critDmg));
                    } else {
                        restHP = restHP - this.UserData.atkDmg;
                        this.UserData.money = parseInt(this.UserData.money) + parseInt(this.UserData.atkDmg);
                    }

                    this.dmgCounting(restHP);
                },

                dps() {
                    if (this.UserData.hero1Lvl > 0) {
                        let that = this;
                        setTimeout(function () { that.dps() }, 200);

                        this.var_crit = Math.random();

                        let restHP = this.UserData.currentHP;

                        if (this.var_crit <= this.UserData.critChance) {
                            restHP = restHP - ((this.UserData.hero1Dps / 5) * this.UserData.critDmg);
                            this.UserData.money = parseInt(this.UserData.money) + ((parseInt(this.UserData.hero1Dps) / 5) * parseInt(this.UserData.critDmg));
                            this.imgChanger();
                        } else {
                            restHP = restHP - this.UserData.hero1Dps / 5;
                            this.UserData.money = parseInt(this.UserData.money) + (parseInt(this.UserData.hero1Dps) / 5);
                        }

                        this.dmgCounting(restHP);
                    }
                },

                dmgCounting(restHP) {
                    this.UserData.money = Math.round(this.UserData.money * 1000) / 1000;

                    if (restHP > 0) {
                        this.UserData.currentHP = restHP;
                    } else if (restHP === 0) {
                        this.UserData.maxHP = this.UserData.maxHP + (this.UserData.maxHP * 0.1);
                        this.UserData.currentHP = this.UserData.maxHP;
                        this.UserData.level++;
                    } else {
                        this.UserData.maxHP = this.UserData.maxHP + (this.UserData.maxHP * 0.1);
                        this.UserData.currentHP = this.UserData.maxHP + restHP;
                        this.UserData.level++;

                        while (this.UserData.currentHP <= 0) {
                            restHP = this.UserData.currentHP;
                            this.UserData.maxHP = this.UserData.maxHP + (this.UserData.maxHP * 0.1);
                            this.UserData.level++;
                            this.UserData.currentHP = this.UserData.maxHP + restHP;
                        }
                    }
                    this.UserData.currentHP = Math.round(this.UserData.currentHP * 10) / 10;
                    this.UserData.maxHP = Math.round(this.UserData.maxHP * 10) / 10;
                },

                upgrade() {
                    if (this.UserData.money < this.UserData.upgCosts) {
                        //
                    } else {
                        this.UserData.upgLvl++;
                        this.UserData.atkDmg = this.UserData.atkDmg + (this.UserData.atkDmg * 0.02);
                        this.UserData.money = this.UserData.money - this.UserData.upgCosts;
                        this.UserData.upgCosts = this.UserData.upgCosts + (this.UserData.upgCosts * 0.02);

                        this.UserData.upgCosts = Math.round(this.UserData.upgCosts * 1000) / 1000;
                        this.UserData.atkDmg = Math.round(this.UserData.atkDmg * 1000) / 1000;
                        this.UserData.money = Math.round(this.UserData.money * 1000) / 1000;

                        this.UserData.moneyShown = number_format_short(this.UserData.money);
                    }
                },

                upgradeHero() {
                    if (this.UserData.money < this.UserData.upgHeroCosts) {
                        //
                    } else {
                        this.UserData.money = this.UserData.money - this.UserData.upgHeroCosts;
                        this.UserData.upgHeroCosts = this.UserData.upgHeroCosts + (this.UserData.upgHeroCosts * 0.04);
                        this.UserData.hero1Lvl++;
                        this.UserData.hero1Dps = this.UserData.hero1Dps + (this.UserData.hero1Dps * 0.04);

                        this.UserData.moneyShown = number_format_short(this.UserData.money);

                        if (this.UserData.hero1Lvl > 0 && this.UserData.hero1DpsEnabled === false) {
                            this.dps();
                            this.UserData.hero1DpsEnabled = true;
                        }
                    }
                },

                init() {
                    axios.get('/api/clickers/init')
                        .then(response => {
                            this.UserData = response.data;
                            if (response.data === '') {
                                this.newGame();
                            }
                            if (this.UserData.hero1DpsEnabled === true) {
                                this.dps();
                            }
                        })
                        .catch(err => {
                            console.log(err.response)
                        })
                },

                newGame() {

                    axios.post('/api/clickers/create', this.UserData)
                        .then(response => {
                            this.UserData = response.data;
                            this.loadAll();
                        })
                        .catch(err => {
                            console.log(err.response)
                        });
                },

                save() {
                    axios.post('/api/clickers/' + this.UserData.id, this.UserData)
                        .then(response => {
                            this.message = response.data;
                        })
                        .catch(err => {
                            console.log(err.response)
                        })
                },

                loadAll() {
                    axios.get('/api/clickers')
                        .then(response => {
                            this.items = response.data;
                        })
                        .catch(err => {
                            console.log(err.response)
                    })
                },

                load(id) {
                    axios.get('/api/clickers/' + id)
                        .then(response => {
                            this.UserId = response.data.id;
                            this.UserData = response.data;
                            if (this.UserData.hero1DpsEnabled === true) {
                                this.message = '';
                                this.dps();
                            }
                        })
                        .catch(err => {
                            console.log(err);
                        });

                },


                deleteGame(id) {
                    if (this.delWarn === true) {
                        this.delWarn = true;
                        window.alert("Alert! You are going to delete your current game!")
                    } else {
                        axios.post('/api/clickers/delete/' + id)
                            .then(response => {
                                this.message = response.data;
                                this.loadAll();
                            })
                            .catch(err => {
                                console.log(err.response)
                            })
                    }
                }
            },

            watch: {
                UserData: {
                    handler: function() {
                        this.UserData.moneyShown = number_format_short(this.UserData.money);
                        this.UserData.currentHPShown = number_format_short(this.UserData.currentHP);
                        this.UserData.maxHPShown = number_format_short(this.UserData.maxHP);
                    },
                    deep: true
                }
            }
        });

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
    </script>
