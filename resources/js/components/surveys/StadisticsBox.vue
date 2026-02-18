<template>
    <!-- <div class="col-6 col-sm-6 col-md-4 col-xl-3 col-xxl-2">
        <div class="col-12 rounded-xl py-sm-1 py-md-2"
        :class="{
            'text-bg-primary': (sent) === 0 ? true : false,
            'text-bg-success': (((answered*100)/sent) >= 80) && sent != 0 ? true : false,
            'text-bg-warning': (((answered*100)/sent) < 80) && sent != 0 ? true : false,
            'text-bg-danger': (((answered*100)/sent) < 50) && sent != 0 ? true : false,
        }"
        >
            <div class="row">
                <div class="col-4 big-icon align-middle">
                    <i :class="big_icon"></i>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div v-if="sent !== 0" class="col-12 percentage">{{ Math.round((answered*100)/sent) }}%</div>
                        <div v-else class="col-12 percentage">0%</div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center">
                            <i :class="sent_icon"></i> {{ sent }}
                        </div>
                        <div class="col-6 text-center">
                            <i :class="answered_icon"></i> {{ answered }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-6 col-sm-4 col-md-3 col-xl-2 col-xxl-2">
        <div class="col-12 rounded-xl py-sm-1 py-md-2 bg-gradient"
        :class="{
            'text-bg-primary': (sent) === 0 ? true : false,
            'text-bg-success': (((answered*100)/sent) >= 80) && sent != 0 ? true : false,
            'text-bg-warning': (((answered*100)/sent) < 80) && sent != 0 ? true : false,
            'text-bg-danger': (((answered*100)/sent) < 30) && sent != 0 ? true : false,
        }"
        >


            <div class="row percentage">
                <div class="col-12 text-center ">
                    <div v-if="sent !== 0" class="d-inline-flex">{{ Math.round((answered*100)/sent) }}%</div>
                    <div v-else class="d-inline-flex">0%</div>
                    <i :class="big_icon"></i>
                </div>
            </div>
            <div class="row stadistics">
                <div class="col-6 text-center">
                    <i :class="sent_icon"></i> {{ sent }}
                </div>
                <div class="col-6 text-center">
                    <i :class="answered_icon"></i> {{ answered }}
                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    props: ["big_icon", "sent_icon", "sent", "answered_icon", "answered"],
    data() {
        return {};
    },
    methods: {},
    created() {},
};
</script>
<style scoped>
.stadistics {
    font-size: .8em;
    text-align: center;
}
.percentage {
    font-size: 1.4em;
    font-weight: bold;
    text-align: center;
}
.rounded-xl {
    border-radius: 1.5rem;
    border-width: 5px;
    padding:.2em;
}
/* .big-icon {
    font-size: 3em;
    text-align: center;
}
.percentage {
    font-size: 1.8em;
    font-weight: bold;
    text-align: center;
}
.rounded-xl {
    border-radius: 1.5rem;
    border-width: 5px;
} */

</style>
