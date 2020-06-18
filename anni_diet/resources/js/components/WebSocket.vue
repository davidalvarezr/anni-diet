<template>
    <b-container class="web-socket">
        <b-row align-h="center">
            <b-col md="8">

                <b-card header="Test des sockets" border-variant="danger" header-border-variant="danger">

                    String to broadcast:
                    <b-form-group>
                        <b-input v-model="inputToBroadcast"></b-input>
                        <b-button @click="broadcast(inputToBroadcast)">ok</b-button>
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
                inputToBroadcast: '',
            }
        },
        methods: {
            broadcast: (inputToBroadcast) => {
                console.log(inputToBroadcast)
            }
        },
        computed: {}
    }
</script>

<style scoped lang="scss">
    .web-socket {
    }
</style>
