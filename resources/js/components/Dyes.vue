<template>
    <div class="container" v-if="$gate.isAdmin() || $gate.isDyesAndChemical()">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dyes and chemical Component</div>

                    <div class="card-body">
                        I'm an Dyes and chemical component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Dyes and chemical Component mounted.')
        }
    }
</script>
