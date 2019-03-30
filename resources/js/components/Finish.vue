<template>
    <div class="container" v-if="$gate.isAdmin() || $gate.isFinishFabric()">

    </div>
</template>

<script>
    export default {


      mounted() {

      }


    }
</script>
