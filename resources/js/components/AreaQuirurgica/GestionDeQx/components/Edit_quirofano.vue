<template>
   
    <FormSolicitud :edit_solicitudaaaaa="true" />
    
    
</template>

<script>
import FormSolicitud from './FormSolicitud.vue'
// Importa la biblioteca Select2
export default {
    components:{
        FormSolicitud
    },
    mounted(){
        this.$store.commit('updateProperty', {
            fieldName:'loading',
            fieldValue:true,
        });
    }

}
</script>

<style lang="scss" scoped>

.vh-90{
    height: 90vh;
}

</style>