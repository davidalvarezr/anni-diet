<template>
    <b-container class="menu">
        <b-row align-h="center">
            <b-col md="8">
                <b-card header="Menu" bg-variant="default">

                    {{$appName}}

                    <b-button class="b-button" variant="danger" @click="goToWebSocket()">
                        Tester la communication WebSocket
                        <b-icon icon="arrow-down-up"></b-icon>
                    </b-button>

                    <b-button class="b-button" variant="warning">
                        Consulter les demandes d'authentification
                        <b-icon icon="unlock"></b-icon>
                    </b-button>

                    <b-button class="b-button" variant="success">
                        Envoyer une confirmation de paiement à un utilisateur
                        <b-icon icon="credit-card"></b-icon>
                    </b-button>

                    <b-button class="b-button" variant="info">
                        Publier une information générale
                        <b-icon icon="info-circle"></b-icon>
                    </b-button>

                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import {goToUrl} from "../helper/helper"

    export default {
        props: {
            token: {
                type: String,
                default: null,
            },
        },

        mounted() {
            console.log('jean paul')
            console.log('Component mounted.')
            if (this.token) {
                console.log('putting token in local storage')
                localStorage.setItem('access_token', this.token)
                this.$axios.defaults.headers.common = {'Authorization': `Bearer ${this.token}`}
            } else {
                console.log('token prop not found')
            }

        },

        methods: {
            goToWebSocket: () => {
                goToUrl('/websocket')
            }
        },
    }
</script>

<style lang="scss">
    .menu {
        .b-button {
            margin: 5px;
        }
    }
</style>
