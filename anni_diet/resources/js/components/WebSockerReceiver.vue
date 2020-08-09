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

                </b-card>

            </b-col>
        </b-row>
    </b-container>

</template>

<script lang="js">

    import moment from "moment";
    import Pusher from 'pusher-js/with-encryption'

    export default {
        name: 'web-socker-receiver',
        props: {
            pusherAppKey: {String, required: true},
            pusherAppCluster: {String, required: true},
            pusherAuthEndpoint: {String, required: true},
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
            this.channel.bind('firework-event', (data) => {
                this.textarea += `${moment().format('DD.MM.YY LTS')}: ${JSON.stringify(data)}\n`
            });
        },
        data() {
            return {
                pusher: null,
                channel: null,
                textarea: '',
            }
        },
        methods: {
            reset() {
              this.textarea = ''
            },
        },
        computed: {}
    }


</script>

<style scoped lang="scss">
    .web-socker-receiver {

    }
</style>
