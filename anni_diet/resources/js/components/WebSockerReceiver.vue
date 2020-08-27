<template>

    <b-container fluid class="web-socker-receiver">
        <b-row align-h="center">
            <b-col md="8">

                <b-card header="Receiver" border-variant="danger" header-border-variant="danger">

                    <p>Tous les feux d'artifices</p>
                    <b-form-group>
                        <b-form-textarea
                            :disabled="true"
                            id="textarea"
                            v-model="textarea"
                            rows="3"
                            max-rows="6"
                        ></b-form-textarea>
                        <b-button class="mt-2" variant="danger" @click="reset">
                            reset
                        </b-button>
                    </b-form-group>

                    <b-container fluid>
                        <b-row>
                            <b-col v-for="place in places" md="6">
                                <place :fireworks="fireworksForPlace(place.id)" :id="place.id" :name="place.name"/>
                            </b-col>
                        </b-row>
                    </b-container>


                </b-card>

            </b-col>
        </b-row>
    </b-container>

</template>

<script lang="js">

import moment from "moment"
import Pusher from 'pusher-js/with-encryption'
import Place from "./Place"
import Firework from "../models/Firework";

export default {
    name: 'web-socker-receiver',
    props: {
        pusherAppKey: {String, required: true},
        pusherAppCluster: {String, required: true},
        pusherAuthEndpoint: {String, required: true},
        places: {Array, required: true},
        fireworks: {Array, required: true},
    },
    components: {
        Place,
    },
    mounted() {
        moment.locale('fr')
        Pusher.logConsole = true
        this.pusher = new Pusher(this.pusherAppKey, {
            cluster: this.pusherAppCluster,
            authEndpoint: this.pusherAuthEndpoint,
            auth: {
                headers: {
                    'Authorization': `Bearer ${localStorage.access_token}`,
                    'Accept': 'application/json',
                }
            }
        })

        this.channel = this.pusher.subscribe('private-firework');

        this.channel.bind('firework-placement', (data) => {
            this.textarea += `🎯 ${moment().format('DD.MM.YY LTS')}: ${JSON.stringify(data)}\n`
            const {id, author, x, y, z, type, place_id} = data.message
            this.dynamicFireworks = [...this.dynamicFireworks, new Firework(id, x, y, z, type, place_id, false)]
        });

        this.channel.bind('firework-trigger', (data) => {
            this.textarea += `🚀 ${moment().format('DD.MM.YY LTS')}: ${JSON.stringify(data)}\n`
            const ids = data.message
            this.dynamicFireworks = this.dynamicFireworks.map(f => {
                if (ids.includes(String(f.id))) {
                    f.triggered = true
                }
                return f
            })
        });

        this.dynamicFireworks = this.fireworks

    },
    data() {
        return {
            pusher: null,
            channel: null,
            textarea: '',
            dynamicFireworks: [],
        }
    },
    methods: {
        reset() {
            this.textarea = ''
            this.dynamicFireworks = []
        },
        fireworksForPlace(placeId) {
            return this.dynamicFireworks.filter(f => Number(f.place_id) === Number(placeId))
        },
    },
    computed: {}
}


</script>

<style scoped lang="scss">
.web-socker-receiver {

}
</style>
