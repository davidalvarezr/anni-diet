<template>
    <b-container class="web-socket">
        <b-row align-h="center">
            <b-col md="8">

                <b-card header="Test des sockets" border-variant="danger" header-border-variant="danger">

                    <p>Infos feu d'artifice:</p>
                    <b-form-group>
                        <b-input placeholder="author" v-model="author"></b-input>
                        <b-input placeholder="x" v-model="x"></b-input>
                        <b-input placeholder="y" v-model="y"></b-input>
                        <b-button @click="broadcast(author)">ok</b-button>
                    </b-form-group>

                </b-card>

            </b-col>
        </b-row>
    </b-container>
</template>

<script lang="js">
    export default {
        // name: 'web-socket',
        props: [],
        mounted() {

        },
        data() {
            return {
                author: '',
                x: '',
                y: '',
            }
        },
        methods: {
            broadcast(inputToBroadcast) {
                console.log(inputToBroadcast)
                this.$axios.post('/api/firework/broadcast', {
                    author: this.author,
                    x: this.x,
                    y: this.y,
                })
                .then(response => {
                    console.log(response)
                })
            }
        },
        computed: {}
    }
</script>

<style scoped lang="scss">
    .web-socket {
    }
</style>
