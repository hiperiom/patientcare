<template>
    <div
        :id="'badge_walkin_'+patient_data['user_id']"
        :class="[getVisibility(),'mt-1 mr-1 badge font-italic',getTextColor()]"
        style=" font-size: 0.8rem;"
    >
        <i :class="['pc-servicio_walkin ',getTextColor2()]"></i> {{patient_data['servicio_emergencia']['description']}}
    </div>
</template>

<script>
    export default {
        name:"TagWalkin",
        props:{
            patient_data:Object,
            index:Number,
        },
        methods: {
            getVisibility() {
                return [1,2,3,4,5,6].includes( Number( this.patient_data['servicio_emergencia']['value']) ) ? '' : 'd-none'
            },
            getTextColor2() {
                return [1,2,3,4,5].includes( Number( this.patient_data['servicio_emergencia']['value']) ) ? 'text-white' : 'text-secondary'
            },
            getTextColor(){
                return 'badge-'+this.patient_data['servicio_emergencia']['color']
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
