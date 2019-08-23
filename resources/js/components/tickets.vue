<template>
    <div>
        <div class="bg-header">
            <h1 class="text-4xl text-white ">ClickerHero Player-Support</h1>
        </div>
        <div class="bg-base pb-2">
            <h2 class="text-4xl subtitle">Your recent requests are listed below</h2>
            <div class="tickets globalW mx-auto p-3 mt-2">
                <div class="flex items-center w-full mb-3 tableHead">
                    <div class="flex w-full">
                        <div class="flex pt-2 w-2/3">
                            <h2 class="flex w-1/5 text-4xl text-orange-700">Ticket ID</h2>
                            <h2 class="flex w-1/5 text-4xl text-orange-700">[Topic]</h2>
                            <h2 class="flex w-2/5 text-4xl text-orange-700">Title</h2>
                            <h2 class="flex w-1/5 text-4xl text-orange-700 mr-2">Status</h2>
                        </div>
                        <div class="flex pt-2 w-1/3">
                            <h2 class="flex text-4xl text-orange-700 mr-2">Administration</h2>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="flex w-full">
                        <ul class="w-full">
                            <li v-for="item in items" style="list-style: none;" class="flex w-full items-center tableBody">
                                <div class="flex pt-2 w-2/3 ">
                                    <h2 class="flex w-1/5 text-2xl text-orange-700">Ticket #{{ item.id }}</h2>
                                    <h2 class="flex w-1/5 text-2xl text-orange-700">[{{ item.topic }}]</h2>
                                    <h2 class="flex w-2/5 text-2xl text-orange-700 italic overflow-hidden">{{ item.title }}</h2>
                                    <h2 class="flex w-1/5 text-xl text-orange-700 mr-2 my-auto">Awaiting answer</h2>
                                </div>
                                <div class="flex pt-2 w-1/3 mb-1">
                                    <button class="text-xl borderDesign bg-orange-400 hover:bg-orange-700 text-white font-bold py-0.5 px-3 mr-2 rounded"
                                            @click="viewTicket(item.id)">View</button>

                                    <button class="text-xl borderDesign bg-red-700 hover:bg-red-900 text-white font-bold py-0.5 px-2 rounded"
                                            @click="deleteTicket(item.id)">Delete</button>
                                </div>
                            </li>
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
                items: [],
                message: '',
                bool_message: true
            }
        },

        mounted() {
            this.getTickets(this.user_id);
        },

        methods: {
            getTickets(user_id) {
                axios.get('/api/tickets/list/' + user_id)
                    .then(response => {
                    this.items = response.data;
                })
            },

            viewTicket(id) {
                window.location.href = '/api/ticket/view/' + id;
            },

            deleteTicket(id) {
                axios.post('tickets/delete/' + id)
                    .then(response => {
                        if (response) {
                            this.getTickets(this.user_id);
                        }
                    })
            }
        }
    });
</script>
