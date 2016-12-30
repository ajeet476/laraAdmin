<template>
    <div class="row">
        <v-breadcrumbs class="light-bue">
            <a v-for="item in items"
               :href="item.href"
               class="breadcrumb"
               v-text="item.text">
            </a>
        </v-breadcrumbs>
    </div>
</template>
<style scoped>

</style>
<script>
    export default{
        data(){
            return{
                items: [
                    {
                        text: 'First',
                        href: '#!'
                    },
                    {
                        text: 'Second',
                        href: '#!'
                    },
                    {
                        text: 'Third',
                        href: '#!'
                    }
                ]
            }
        },
        mounted() {
            console.log('breadcrumbs');
        }
    }
</script>
