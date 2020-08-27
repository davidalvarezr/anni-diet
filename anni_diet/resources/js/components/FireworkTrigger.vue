<template>
    <b-container class="firework-trigger">
        <b-row align-h="center">
            <b-col md="8">
                <b-input type="text"
                         v-model="triggerIds"
                         placeholder="firework ids, separated by ',' (commas)"
                />
                <b-button class="mt-2"
                    variant="primary"
                    :disabled="triggerIdsArray.length === 0"
                    @click="trigger">
                    🚀 trigger
                </b-button>
            </b-col>
        </b-row>
    </b-container>
</template>

<script lang="js">

export default {
    name: 'firework-trigger',
    props: [],
    mounted() {

    },
    data() {
        return {
            triggerIds: ''
        }
    },
    methods: {
        trigger() {
            this.$axios.post('/api/firework/trigger', {
                'firework_ids': this.triggerIdsArray,
            })
        }
    },
    computed: {
        triggerIdsArray: function() {
            return this.triggerIds === '' ? [] : this.triggerIds.split(',')
        }
    }
}


</script>

<style scoped lang="scss">
.firework-trigger {

}
</style>
