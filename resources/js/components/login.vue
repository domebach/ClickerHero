<template>
    <div>
        <div class="bg-header">
            <h1 class="text-4xl text-white ">Free registration for ClickerHero - Let your journey begin</h1>
        </div>
        <div class="flex globalW justify-center p-3 mx-auto">
            <div class="register mx-auto flex w-full">
                <form method="POST" action="/login" @submit.prevent="login" class="w-full">
                    <div class="w-full">
                        <div class="w-full xl:w-1/2 xl:mx-auto">
                            <label class="block tracking-wide xl:w-full ml-1" for="username">Username</label>
                            <input class="tshadow placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full p-2 mb-2"
                                   type="text" id="username" placeholder="Type in your title .." value=""  autofocus="autofocus" v-model="form.name" required>
                        </div>

                        <div class="w-full xl:w-1/2 xl:mx-auto">
                            <label class="block tracking-wide xl:w-full ml-1" for="password">Password</label>
                            <input class="tshadow placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full p-2 mb-2"
                                   type="password" placeholder="Type in your password .." v-model="form.pw" id="password" required>
                        </div>
                    </div>


                    <div class="flex justify-center my-5">
                        <button type="submit" class="borderDesign bg-orange-400 hover:bg-orange-700 text-white
                                text-2xl font-bold py-0.5 px-4 rounded">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-center items-center filler">
            <a class="px-5 hover:underline" href="/">Startpage</a>
            <a class="px-5 hover:underline" href="/support">Impressum</a>
            <a class="px-5 hover:underline" href="/support">Inhalt</a>
            <a class="px-5 hover:underline" href="/support">Datenschutz</a>
            <a class="px-5 hover:underline" href="/support">Support</a>
        </div>
    </div>
</template>

<script>
    export default  ({
        data() {
            return {
                form: {
                    name:   '',
                    pw:     '',
                }
            }
        },

        methods: {
            login() {
                axios.post('/login', {
                    name: this.form.name,
                    password: this.form.pw,
                }).then(response => {
                    if (response) {
                        window.location.href = '/game';
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    });

</script>
