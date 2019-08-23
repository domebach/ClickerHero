<template>
    <div>
        <div class="bg-header">
            <h1 class="text-4xl text-white ">Welcome to your ClickerHero player support !</h1>
        </div>
        <div class="bg-base">
            <h2 class="text-4xl subtitle">Let us know, how we can help you out</h2>
            <div class="flex globalW p-3 mx-auto">
                <div class="w-2/3 waller mr-3">
                    <form method="POST" action="/support" @submit.prevent="createTicket(user_id)">
                        <div class="w-full xl:w-1/2 mb-5" role="alert" v-show="bool_message">
                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                Alert
                            </div>
                            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3">
                                <p class="text-red-700" style="text-shadow: none;">{{ message }}</p>
                            </div>
                        </div>

                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert" v-show="bool_ticketSubmit">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">You have successfully send your ticket !</p>
                                    <p class="text-sm">The We will need some time to process your request, thank you for your understanding</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-2">
                            <label class="block tracking-wide xl:w-full" for="topic">Choose your topic</label>
                            <select id="topic" class="block tshadow appearance-none w-full bg-gray-200 border border-gray-200
                                    text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                    focus:border-gray-500 text-xl mb-5 xl:w-1/3" v-model="form.topic">

                                <option value="empty topic" selected> ----- </option>
                                <option value="Account & Login">Account & Login</option>
                                <option value="Payment">Payment</option>
                                <option value="Bug-report">Bug-report</option>
                                <option value="Report a player">Report a player</option>
                                <option value="Other topic">Other topic</option>

                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                                </div>
                            </select>
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="title">Title</label>
                            <input class="tshadow text-black placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full xl:w-2/3 p-2 mb-2" v-model="form.title" type="text" id="title" placeholder="Type in your title ..">
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="description">Description</label>
                            <textarea class="tshadow text-black placeholder-gray-600 focus:placeholder-transparent shadow-none input w-full mb-2 xl:w-2/3 p-2" v-model="form.description" rows="5" id="description" placeholder="Describe your issue .."></textarea>
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="other">Other information / Screenshot-links</label>
                            <input class="tshadow text-black placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full xl:w-2/3 p-2 mb-5" v-model="form.other" type="text" id="other" placeholder="Further information ..">
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="region">Choose your region</label>
                            <select id="region" class="block tshadow text-gray-700 appearance-none w-full bg-gray-200 border border-gray-200
                                         py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                        focus:border-gray-500 text-xl xl:w-1/3 mb-6" v-model="form.region">

                                <option value="emptyRegion" selected> ----- </option>
                                <option value="na">North America</option>
                                <option value="eu">Europe</option>
                                <option value="ca">Central Asia</option>
                                <option value="oc">Oceania</option>
                                <option value="sa">South America</option>
                            </select>
                        </div>


                        <div class="flex justify-center xl:justify-start my-5">
                            <button type="submit" class="borderDesign bg-orange-400 hover:bg-orange-700 text-white
                                    text-2xl font-bold py-0.5 px-4 rounded">Submit your ticket</button>
                        </div>
                    </form>
                </div>
                <div class="w-1/3 py-3  mx-auto">
                    <div class="faq">
                        <h2 class="text-2xl -ml-4 underline pb-5">FAQ</h2>
                        <ul>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> How do I recover my password? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Will I lose my progress if I close the game without saving? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Is there a mobile app? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> How does ascending work? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> When is the next update? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Any tips on what I should do/buy next? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Is [ ... ] considered cheating? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Beginner: What do I have to know? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Why is the support replying with 42? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white text-xl" :href="'/support/' + user_id"> Who is John Doe? </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center filler">
            <a class="px-5 hover:underline" :href="'/startpage/' + user_id">Startpage</a>
            <a class="px-5 hover:underline" :href="'/support/' + user_id">Imprint</a>
            <a class="px-5 hover:underline" :href="'/support/' + user_id">Content</a>
            <a class="px-5 hover:underline" :href="'/support/' + user_id">Data protection</a>
            <a class="px-5 hover:underline" :href="'/game/' + user_id">Back to Game</a>
        </div>
    </div>
</template>


<script>
    export default  ({
        props: {
            user_id: String
        },
        data() {
            return {
                form: {
                    topic: '',
                    title: '',
                    description: '',
                    other: '',
                    region: ''
                },
                message: '',
                bool_message: false,
                bool_ticketSubmit: false
            }
        },
        methods: {
            createTicket(id) {
                axios.post('/api/tickets/'+id, {
                    topic: this.form.topic,
                    title: this.form.title,
                    description: this.form.description,
                    other: this.form.other,
                    region: this.form.region
                }).then(response => {
                    console.log(response.data);
                    this.form.topic         = '';
                    this.form.title         = '';
                    this.form.description   = '';
                    this.form.other         = '';
                    this.form.region        = '';
                    window.location.href    = '/api/tickets/' + id;
                })
            }
        }
    });
</script>
