<template>
    <b-container fluid class="web-socket-emitter">
        <b-row align-h="center">
            <b-col md="8">

                <b-card header="Emitter" border-variant="danger" header-border-variant="danger">

                    <p>Infos feu d'artifice:</p>
                    <b-form-group>
                        <b-input placeholder="x" v-model="x"></b-input>
                        <b-input placeholder="y" v-model="y"></b-input>
                        <b-input placeholder="z" v-model="z"></b-input>
                        <b-input placeholder="type" v-model="type"></b-input>
                        <b-input placeholder="place id" v-model="placeId"></b-input>
                        <b-button class="mt-2" variant="success" @click="broadcast()">
                            🎯 broadcast (send)
                        </b-button>
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
            x: '1',
            y: '2',
            z: '3',
            type: 'basic',
            placeId: 1,
        }
    },
    methods: {
        broadcast() {

            this.$axios.post('/api/firework/broadcast', {
                x: this.x,
                y: this.y,
                z: this.z,
                type: this.type,
                place_id: this.placeId,
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
