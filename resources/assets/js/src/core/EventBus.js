import Vue from "vue";

export default class EventBus {
    constructor() {
        this.bus = new Vue();
    }

    fire(events, ...data) {
        this.wrapper(
            events,
            () => this.bus.$emit(events, ...data),
            (index) => this.bus.$emit(events[index], ...data)
        );
    }

    listen(events, callback) {
        // if (!Array.isArray(events)) {
        //     this.bus.$on(events, callback);
        //     return;
        // }

        // for (const index in events) {
        //     this.bus.$emit(events[index], callback);
        // }

        this.wrapper(
            events,
            () => this.bus.$on(events, callback),
            (index) => this.bus.$on(events[index], callback)
        );
    }

    wrapper(events, ifNotArray, otherwise) {
        if (!Array.isArray(events)) {
            ifNotArray();
            return;
        }

        for (const index in events) {
            otherwise(index);
        }
    }
}
