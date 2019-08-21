<template>
    <div>
        <div class="bg-header">
            <h1 class="text-4xl text-white ">Free registration for ClickerHero - Let your journey begin</h1>
        </div>

        <div class="flex globalW justify-center p-3 mx-auto">

            <div class="register mx-auto flex w-full">
                <form method="POST" action="/register" @submit.prevent="onSubmit" class="w-full">
                    <div class="w-full">
                        <div class="w-full xl:w-1/2 xl:mx-auto mb-3" role="alert" v-show="bool_message">
                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                Alert
                            </div>
                            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3">
                                <p class="text-red-700" style="text-shadow: none;">{{ message }}</p>
                            </div>
                        </div>

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

                        <div class="w-full xl:w-1/2 xl:mx-auto">
                            <label class="block tracking-wide xl:w-full ml-1" for="mail">E-Mail address</label>
                            <input class="tshadow placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full p-2 mb-2"
                                   id="mail" placeholder="Type in your E-Mail address .." v-model="form.email"  required>
                        </div>

                        <div class="w-full xl:w-1/2 xl:mx-auto">
                            <label class="block tracking-wide xl:w-full ml-1" for="region">Choose your region</label>
                            <select id="region" class="block tshadow text-gray-700 appearance-none w-full bg-gray-200 border border-gray-200
                                         py-1 pl-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                                         text-xl mb-6" v-model="form.region" style="height: 40px;" required>

                                <option value="-----" selected> {{ form.region }} </option>
                                <option value="na">North America</option>
                                <option value="eu">Europe</option>
                                <option value="ca">Central Asia</option>
                                <option value="oc">Oceania</option>
                                <option value="sa">South America</option>
                            </select>
                        </div>
                    </div>


                    <div class="flex justify-center my-5">
                        <button type="submit" class="borderDesign bg-orange-400 hover:bg-orange-700 text-white
                                text-2xl font-bold py-0.5 px-4 rounded">Create your account</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-center items-center filler">
            <a class="px-5 hover:underline" href="/">Startpage</a>
            <a class="px-5 hover:underline" href="/">Impressum</a>
            <a class="px-5 hover:underline" href="/">Inhalt</a>
            <a class="px-5 hover:underline" href="/">Datenschutz</a>
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
                    email:  '',
                    region: '-----'
                },
                message: '',
                bool_message: false
            }
        },

        methods: {

            onSubmit() {
                // let dataForm = new FormData();
                // dataForm.append('name', this.form.name);
                // dataForm.append('password', this.form.pw);
                // dataForm.append('email', this.form.email);
                // dataForm.append('region', this.form.region);
                //
                // console.log(this.form.name);
                if (this.form.region != '-----') {
                    axios.post('/register', {
                            name: this.form.name,
                            password: this.form.pw,
                            email: this.form.email,
                            region: this.form.region

                        }).then( response => {
                            if (response) {
                                let id = response.data;
                                console.log(id);
                                window.location.href = '/game/'+id;
                            } else {
                                this.bool_message = true;
                                this.message = 'Your given data are incorrect.';
                            }

                            this.form.name      = '';
                            this.form.pw        = '';
                            this.form.email     = '';
                            this.form.region    = '-----';
                            this.form.region    = '-----';
                        }).catch(error => {
                            console.log(error);
                    });
                } else {
                    this.bool_message = true;
                    this.message = 'Your given data are incorrect.';
                }
            }
        }
    });

</script>
