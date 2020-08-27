export default class Firework {
    constructor(id, x, y, z, type, placeId, triggered = false) {
        this.id = id
        this.x = x
        this.y = y
        this.z = z
        this.place_id = placeId
        this.triggered = triggered
    }

    trigger() {
        this.trigger = true
    }

}

