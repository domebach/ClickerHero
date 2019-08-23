<template>
    <div>
        <div v-for="ticket in tickets">
            <div class="bg-header">
                <h1 class="text-4xl text-white ">ClickerHero Player-Support</h1>
            </div>
            <div class="bg-base pb-2">
                <h2 class="text-4xl w-1/2 subtitle">Ticket #{{ ticket.id }}</h2>
                <div class="tickets w-1/2 mx-auto p-3 mt-2">
                    <h2 class="text-3xl mb-5">[{{ ticket.topic }}]</h2>
                    <div class="border-2 border-black rounded p-3">
                        <h2 class="text-3xl mb-4 underline">{{ ticket.title }}</h2>
                        <div class="my-5">
                            <h2 class="text-xl italic mb-1">Description:</h2>
                            <h2 class="text-xl italic">{{ ticket.description }}</h2>
                        </div>
                        <div class="mt-5">
                            <h2 class="text-xl italic mb-1">Further information:</h2>
                            <h2 class="text-xl italic">{{ ticket.other }}</h2>
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
    </div>
</template>


<script>
    export default  ({
        props: {
            user_id: String,
            ticket_id: String
        },

        data() {
            return {
                tickets: []
            }
        },

        mounted() {
            this.getTicket(this.ticket_id)
        },

        methods: {
            getTicket(id) {
                axios.get('/api/ticket/get/' + id)
                    .then(response => {
                        console.log(response);
                        this.tickets = response.data;
                    })
            }
        }
    });
</script>
