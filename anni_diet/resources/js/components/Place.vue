<template>
    <b-container fluid class="place">
        <b-row align-h="center">
            <b-col>

                <h3>({{ id }}) {{ name }}</h3>

                <div class="chart-container" style="position: relative; width:300px;">
                    <scatter-plot :chart-data="computedDatacollection" :options="computedOptions"></scatter-plot>
                </div>

            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import ScatterPlot from "./ScatterPlot";
import Firework from "../models/Firework";
import _ from 'lodash'

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
        fireworks: function (newVal) {
            this.dynamicFireworks = newVal
        }
    },
    mounted() {
        // Second and later animations instant
        setTimeout(() => {
            this.animationDuration = 0
        }, 500)
    },
    data() {
        return {
            i: 3,
            dynamicFireworks: [],
            animationDuration: 5000,
            options: {
                animation: {
                  duration: 5000, // First animation is slow
                },
                tooltips: {
                    callbacks: {
                        label: (tooltipItem, data) => {
                            const fw = this.getCurrentFirework(tooltipItem.datasetIndex, tooltipItem.index)
                            return ` ${fw.id} => (${fw.x}, ${fw.y})`
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        type: 'linear',
                        ticks: {
                            min: -10, max: 10,
                        }
                    }],
                    yAxes: [{
                        type: 'linear',
                        ticks: {
                            min: -10, max: 10,
                        }
                    }],
                }
            },
            datacollection: {
                labels: ['x', 'y'],
                datasets: [
                    {
                        label: 'Fireworks on the floor',
                        backgroundColor: '#000000',
                        data: this.fireworksDataFloor,
                    },
                    {
                        label: 'Fireworks triggered',
                        backgroundColor: '#ff0000',
                        data: this.fireworksDataTriggered,
                    }
                ]
            }
        }
    },
    methods: {
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        },
        getCurrentFirework(datasetIndex, index) {
            if (datasetIndex === 0) {
                return this.fireworksDataFloor[index]
            } else if (datasetIndex === 1) {
                return this.fireworksDataTriggered[index]
            } else {
                return undefined
            }
        }
    },
    computed: {
        maxCoordinate() {
            return this.dynamicFireworks.reduce((prevVal, f) => {
                const max = _.max([Math.abs(f.x), Math.abs(f.y)])
                console.log('max', max)
                return _.max([prevVal, max])
            }, 0)
        },

        maxCoordinateWithSpace() {
            const space = 2
            return this.maxCoordinate + space
        },

        fireworksDataFloor() {
            return this.dynamicFireworks.reduce((prevVal, f) => {
                if (!f.triggered) {
                    prevVal.push({id: f.id, x: f.x, y: f.y})
                }
                return prevVal
            }, [])
        },

        fireworksDataTriggered() {
            return this.dynamicFireworks.reduce((prevVal, f) => {
                if (f.triggered) {
                    prevVal.push({id: f.id, x: f.x, y: f.y})
                }
                return prevVal
            }, [])
        },

        computedOptions() {
            return {
                ...this.options,
                animation: {
                    duration: this.animationDuration,
                },
                scales: {
                    xAxes: [{
                        ...this.options.scales.xAxes[0],
                        ticks: {
                            ...this.options.scales.xAxes[0].ticks,
                            min: -this.maxCoordinateWithSpace, max: this.maxCoordinateWithSpace,
                        }
                    }],
                    yAxes: [{
                        ...this.options.scales.yAxes[0],
                        ticks: {
                            ...this.options.scales.yAxes[0].ticks,
                            min: -this.maxCoordinateWithSpace, max: this.maxCoordinateWithSpace,
                        }
                    }],
                }
            }
        },

        computedDatacollection() {
            return {

                ...this.datacollection,
                datasets: [
                    {
                        ...this.datacollection.datasets[0],
                        data: this.fireworksDataFloor,
                    },
                    {
                        ...this.datacollection.datasets[1],
                        data: this.fireworksDataTriggered,
                    }
                ]
            }
        }
    }
}
</script>

<style lang="scss">
.place {
}
</style>
