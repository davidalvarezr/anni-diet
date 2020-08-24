<template>
    <b-container fluid class="place">
        <b-row align-h="center">
            <b-col>

                <h3>({{ id }}) {{ name }}</h3>


                <div class="chart-container" style="position: relative; width:300px;">
                    <scatter-plot :chart-data="datacollection" :options="options"></scatter-plot>
                </div>

                <b-button @click="fillData">btn</b-button>

            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import ScatterPlot from "./ScatterPlot";

export default {
    props: {
        id: Number,
        name: String,
        fireworks: Array,
    },
    components: {
        ScatterPlot,
    },
    watch: {
        fireworks: function (newVal, oldVal) {
            console.log('props changed')
            // TODO: this.draw()
        }
    },
    mounted() {
        this.fillData()
    },
    data() {
        return {
            options: {
                scales: {
                    xAxes: [{
                        type: 'linear'
                    }]
                }
            },
            datacollection: {
                labels: [this.getRandomInt(), this.getRandomInt()],
                datasets: [
                    {
                        label: 'Data One',
                        backgroundColor: '#f87979',
                        data: [{x: this.getRandomInt(), y: this.getRandomInt()}]
                    }
                ]
            }
        }
    },
    methods: {
        fillData() {
            this.datacollection = {
                labels: [this.getRandomInt(), this.getRandomInt()],
                datasets: [
                    {
                        label: 'Data One',
                        backgroundColor: '#000000',
                        data: [{x: this.getRandomInt(), y: this.getRandomInt()}]
                    },
                ]
            }
        },
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        }
    },
    computed: {}
}
</script>

<style lang="scss">
.place {
}
</style>
