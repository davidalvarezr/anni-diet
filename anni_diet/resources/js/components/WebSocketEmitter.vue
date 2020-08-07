<template>
    <b-container class="web-socket-emitter">
        <b-row align-h="center">
            <b-col md="8">

                <b-card header="Emitter" border-variant="danger" header-border-variant="danger">

                    <p>Infos feu d'artifice:</p>
                    <b-form-group>
                        <b-input placeholder="author" v-model="author"></b-input>
                        <b-input placeholder="x" v-model="x"></b-input>
                        <b-input placeholder="y" v-model="y"></b-input>
                        <b-input placeholder="z" v-model="z"></b-input>
                        <b-input placeholder="type" v-model="type"></b-input>
                        <b-button @click="broadcast(author)">ok</b-button>
                    </b-form-group>

                </b-card>

            </b-col>
        </b-row>
    </b-container>
</template>

<script lang="js">
    export default {
        props: [],
        mounted() {

        },
        data() {
            return {
                author: 'test',
                x: '1',
                y: '2',
                z: '3',
                type: 'basic',
            }
        },
        methods: {
            broadcast(inputToBroadcast) {



                this.$axios.post('/api/firework/broadcast', {
                    author: this.author,
                    x: this.x,
                    y: this.y,
                    z: this.z,
                    type: this.type,
                })
                .then(response => {
                })

            }
        },
        computed: {}
    }
</script>

<style scoped lang="scss">
    .web-socket-emitter {
    }
</style>
