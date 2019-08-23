<template>
    <div id="root" class="relative">

        <div class="absolute left-0" style="top:45px;">
            <transition name="rotate">
                <i class="fas fa-angle-double-right" style="font-size: 40px;" @click="showSidebar = !showSidebar"
                    :class="[showSidebar ? 'rotate-left' : 'rotate-right']"></i>
            </transition>
<!--            <button class="borderDesign bg-orange-400 hover:bg-orange-700 text-white text-xl font-bold py-0.5 px-4 rounded" @click="show = !show">-->
<!--               Menu-->
<!--            </button>-->
            <transition name="slide-fade" v-if="showSidebar">
                <div class="borderHeroes p-2" style="min-width: 250px;max-width: 100%;">
                    <div class="flex items-center mb-2">
                        <h2 class="text-xl" style="min-width: 150px;">Crit-Chance +1%</h2>
                        <button :class="[UserData.money >= UserData.upgCCCosts ? 'bg-green-400' : 'bg-red-700',
                                UserData.money >= UserData.upgCCCosts ? 'hover:bg-green-600' : 'hover:bg-red-800' ]"
                                class="borderDesign text-white font-bold ml-3 py-1 px-1 rounded"
                                @click="upgCritChance"> Upgrade
                        </button>
                        <h2>{{ UserData.critChance }}</h2>
                    </div>

                    <div class="flex items-center mb-2">
                        <h2 class="text-xl" style="min-width: 150px;">Crit-Damage +5%</h2>
                        <button :class="[UserData.money >= UserData.upgCDCosts ? 'bg-green-400' : 'bg-red-700',
                                UserData.money >= UserData.upgCDCosts ? 'hover:bg-green-600' : 'hover:bg-red-800' ]"
                                class="borderDesign text-white font-bold ml-3 py-1 px-1 rounded"
                                @click="upgCritDmg"> Upgrade
                        </button>
                        <h2>{{ UserData.critDmg }}</h2>
                    </div>

                    <div class="flex items-center">
                        <h2 class="text-xl" style="min-width: 150px;">Cost reduction -1%</h2>
                        <button :class="[UserData.money >= UserData.upgRUCosts ? 'bg-green-400' : 'bg-red-700',
                                UserData.money >= UserData.upgRUCosts ? 'hover:bg-green-600' : 'hover:bg-red-800' ]"
                                class="borderDesign text-white font-bold ml-3 py-1 px-1 rounded"
                                @click="upgReduceCosts"> Upgrade
                        </button>
                    </div>
                </div>
            </transition>
        </div>
        <div class="mb-2 flex items-center justify-between">
            <div class="w-1/3">
                <h2 class="text-orange-400 text-left text-3xl pt-9 pl-9 float-left"> Level: {{ UserData.level }}</h2>
            </div>

            <div class="w-1/3">
                <h2 class="text-left text-xl text-center float-center" >Damage: {{ UserData.atkDmgShown }}</h2>
            </div>

            <div class="w-1/3">
                <h2 class="text-orange-400 text-right text-3xl pt-9 pr-9">Current money: {{ UserData.moneyShown }}</h2>
            </div>
        </div>
        <h1 class="text-center text-3xl mt-2"> HP {{ UserData.currentHPShown }} / {{ UserData.maxHPShown }}</h1>
        <div class="flex justify-center my-6">
            <img class="borderDesign imgShadow fixedSize" @click="attack" :src="myImg">
        </div>

        <div class="flex justify-center flex-1 flex-wrap">
            <div>
                <button
                    class="borderDesign bg-orange-400 hover:bg-orange-700 text-white text-2xl font-bold py-0.5 px-4 mr-2 rounded"
                    @click="attack" @keypress="imgChanger" @mouseup="imgChanger">Attack
                </button>

            </div>
            <div>
                <div>
                    <button :class="[UserData.money >= UserData.upgCosts ? 'bg-green-400' : 'bg-red-700',
                                UserData.money >= UserData.upgCosts ? 'hover:bg-green-600' : 'hover:bg-red-800' ]"
                            class="borderDesign text-white text-2xl font-bold py-0.5 px-3 ml-2 rounded"
                            @click="upgrade">{{ UserData.upgCostsShown }}
                    </button>

                    <button :class="[x100 ? 'bg-green-400' : 'bg-red-700',
                                x100 ? 'border-5' : 'border-1' ]"
                            class="borderDesign text-white text-2xl font-bold py-0.5 px-3 ml-2 rounded"
                            @click="upgrade">x100
                    </button>
                </div>
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
                        @click="upgradeHero"> Upgrade Hero
                </button>
                <h2 class="w-full">{{ UserData.hero1Dps }}</h2>
                <h2>{{ UserData.upgHeroCosts }}</h2>
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
                    <h2 class="flex w-50 text-2xl text-orange-700 mb-0">Start a new Game:</h2>
                    <button
                        class="text-xl borderDesign buttons bg-orange-400 hover:bg-orange-700 text-white font-bold py-1 px-3 mr-1 rounded"
                        @click="newGame(UserData.user_id)">New
                    </button>
                </div>
                <div class="flex justify-center items-center mt-2">
                    <h2 class="flex w-50 text-2xl text-orange-700 mb-0">Save the current Game:</h2>
                    <button
                        class="text-xl borderDesign buttons bg-orange-400 hover:bg-orange-700 text-white font-bold py-1 px-3 rounded"
                        @click="save">Save
                    </button>
                </div>
            </div>

            <div class="flex justify-center w-50">
                <div class="scroll overflow-y-auto w-full">
                    <ul>
                        <li v-for="id in items" style="list-style: none;">
                            <div class="flex justify-center items-center mt-2">
                                <h2 class="flex w-50 text-2xl text-orange-700 mr-2 mb-1">Game-Id: {{ id }}</h2>
                                <button
                                    class="text-xl borderDesign bg-orange-400 hover:bg-orange-700 text-white font-bold py-0.5 px-3 my-1 mx-2 rounded"
                                    @click="load(id)">Load
                                </button>

                                <button
                                    class="text-xl borderDesign bg-red-700 hover:bg-red-900 text-white font-bold py-0.5 px-2 my-1 rounded"
                                    @click="deleteGame(id)">Delete
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class=" text-center py-4 lg:px-4 alerts">
            <div class="p-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                 v-show="bool_message" role="alert">
                <span class="flex rounded-full bg-green-700 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ message }}</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                </svg>
            </div>
        </div>

        <div class="flex justify-between w-full">
            <div class="flex justify-start ">
                <a class="text-xl no-underline text-orange-200 hover:text-orange-500" :href="'/startpage/' + user_id">Startpage</a>
            </div>
            <div class="flex justify-end">
                <a class="text-xl no-underline text-orange-200 hover:text-orange-500" :href="'/support/' + user_id">Support</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default ({
        props: {
            user_id: String
        },

        data() {
            return {
                UserData: [],
                message: '',
                bool_message: false,
                delWarn: false,
                deleteId: 0,
                loadId: 0,
                UserId: null,
                items: [],
                myImg: "/images/satan.gif",
                stdImg: "/images/satan.gif",
                atomicGif: "/images/atomic2.webp",
                gifEnabled: false,
                var_crit: 1,
                showSidebar: false,
                x100: false
            }
        },

        mounted() {
            this.UserData.user_id = this.user_id;
            this.init(this.UserData.user_id);
            this.loadAllById(this.UserData.user_id);
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
                    setTimeout(function () {
                        that.dps()
                    }, 200);

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
                    this.UserData.atkDmg = this.UserData.atkDmg + (this.UserData.atkDmg * 10.005);
                    this.UserData.money = this.UserData.money - this.UserData.upgCosts;
                    this.UserData.upgCosts = this.UserData.upgCosts + (this.UserData.upgCosts * 0.005);

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
                    this.UserData.hero1Dps = this.UserData.hero1Dps + (this.UserData.hero1Dps * 0.1);

                    this.UserData.moneyShown = number_format_short(this.UserData.money);

                    if (this.UserData.hero1Lvl > 0 && this.UserData.hero1DpsEnabled === false) {
                        this.dps();
                        this.UserData.hero1DpsEnabled = true;
                    }
                }
            },

            upgCritChance() {
                if (this.UserData.money < this.UserData.upgCCCosts) {
                    //
                } else {
                    this.UserData.critChance = this.UserData.critChance + 0.01;
                    this.UserData.money = this.UserData.money - this.UserData.upgCCCosts;
                    this.UserData.upgCCCosts = this.UserData.upgCCCosts * 10;

                    this.UserData.upgCCCosts = Math.round(this.UserData.upgCCCosts * 1000) / 1000;
                    this.UserData.critChance = Math.round(this.UserData.critChance * 1000) / 1000;
                    this.UserData.money = Math.round(this.UserData.money * 1000) / 1000;

                    this.UserData.moneyShown = number_format_short(this.UserData.money);
                }
            },

            upgCritDmg() {
                if (this.UserData.money < this.UserData.upgCDCosts) {
                    //
                } else {
                    this.UserData.critDmg = this.UserData.critDmg * 1.05;
                    this.UserData.money = this.UserData.money - this.UserData.upgCDCosts;
                    this.UserData.upgCDCosts = this.UserData.upgCDCosts * 10;

                    this.UserData.upgCDCosts = Math.round(this.UserData.upgCDCosts * 1000) / 1000;
                    this.UserData.critDmg = Math.round(this.UserData.critDmg * 1000) / 1000;
                    this.UserData.money = Math.round(this.UserData.money * 1000) / 1000;

                    this.UserData.moneyShown = number_format_short(this.UserData.money);
                }
            },

            upgReduceCosts() {
                if (this.UserData.money < this.UserData.upgRUCosts) {
                    //
                } else {
                    this.UserData.upgCosts = this.UserData.upgCosts * 0.99;
                    this.UserData.money = this.UserData.money - this.UserData.upgRUCosts;
                    this.UserData.upgRUCosts = this.UserData.upgRUCosts * 10;

                    this.UserData.upgRUCosts = Math.round(this.UserData.upgRUCosts * 1000) / 1000;
                    this.UserData.upgCosts = Math.round(this.UserData.upgCosts * 1000) / 1000;
                    this.UserData.money = Math.round(this.UserData.money * 1000) / 1000;

                    this.UserData.moneyShown = number_format_short(this.UserData.money);
                }
            },

            init(id) {
                axios.get('/api/clickers/init/' + id)
                    .then(response => {
                        if (response.data === '') {
                            this.UserData.user_id = id;
                            this.newGame(this.UserData.user_id);
                        } else {
                            this.UserData = response.data;
                        }
                        if (this.UserData.hero1DpsEnabled === true) {
                            this.dps();
                        }
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },

            newGame(id) {
                axios.post('/api/clickers/create/' + id, this.UserData)
                    .then(response => {
                        this.UserData = response.data;
                        this.UserData.user_id = this.user_id;
                        this.loadAllById(this.UserData.user_id);

                        this.message = 'Created a new game with ID: ' + this.UserData.id + ' !';
                        this.bool_message = true;
                        let that = this;
                        setTimeout(function () {
                            that.bool_message = false;
                            that.message = '';
                        }, 3000);
                    })
                    .catch(err => {
                        console.log(err.response)
                    });
            },

            save() {
                axios.post('/api/clickers/' + this.UserData.id, this.UserData)
                    .then(response => {
                        this.message = response.data;
                        this.bool_message = true;
                        let that = this;
                        setTimeout(function () {
                            that.bool_message = false;
                            that.message = '';
                        }, 3000);
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },

            loadAllById(id) {
                axios.get('/api/clickers/get/' + id)
                    .then(response => {
                        this.items = response.data;
                        if (Array.isArray(this.items) && !this.items.length) {
                            this.init(id);
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },

            load(id) {
                axios.get('/api/clickers/' + id)
                    .then(response => {
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
                            this.message = 'Deleted Game ' + id + ' successfully';
                            this.bool_message = true;
                            let that = this;
                            setTimeout(function () {
                                that.bool_message = false;
                                that.message = '';
                            }, 3000);
                            this.loadAllById(this.UserData.user_id);
                        })
                        .catch(err => {
                            console.log(err.response)
                        })
                }
            }
        },

        watch: {
            UserData: {
                handler: function () {
                    this.UserData.moneyShown = number_format_short(this.UserData.money);
                    this.UserData.currentHPShown = number_format_short(this.UserData.currentHP);
                    this.UserData.maxHPShown = number_format_short(this.UserData.maxHP);

                    this.UserData.atkDmgShown = number_format_short(this.UserData.atkDmg);
                    this.UserData.upgCostsShown = number_format_short(this.UserData.upgCosts);
                },
                deep: true
            }
        }
    });

    function number_format_short(n) {
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
        } else if (n >= 1000000000000000000000000000) {
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
<style>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all .8s ease;
    }

    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */
    {
        /*transform: translateX(-10px);*/
        opacity: 0.1;
    }

    .rotate-left {
        transform: rotate( -180deg );
        transition: transform .8s ease;
    }

    .rotate-right {
        transform: rotate( -360deg );
        transition: transform .8s ease;
    }
</style>
