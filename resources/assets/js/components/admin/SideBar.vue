<template>
    <div class="nav-wrapper">
        <div>
            <h1 class="page-title light-green dark">
                <a class="left button-collapse light-green dark" v-side-nav:sideBar="nav">
                    <i class="material-icons">menu</i></a>
                Admin Control
            </h1>
        </div>
        <v-side-nav id="sideBar" class="side-nav fixed" style="transform: translateX(0%);">
            <ul id="side-nav" >
                <li class=""><v-btn-link class="light-green dark" href="Install">Install</v-btn-link></li>
                <li class=""><v-btn-link class="light-green dark" href="Functional">Functional</v-btn-link></li>
                <li class=""><v-btn-link class="light-green dark" href="Dialog">Dialog</v-btn-link></li>
                <li class="no-padding">
                    <ul data-collapsible="accordion" class="collapsible">
                        <li class="active">
                            <div class="black-text waves-effect waves-teal collapsible-header active">
                                <i class="material-icons right">&#xE313;</i>
                                Components
                            </div>
                            <div class=" collapsible-body" style="display: block;">
                                <ul>
                                    <li class=""><v-btn-link href="Badge" class="light-green dark">Badge</v-btn-link></li>
                                    <li class="active"><v-btn-link href="Pagination" class="light-green dark">Pagination</v-btn-link></li>
                                    <li class=""><v-btn-link href="Tabs" class="light-green dark">Tabs</v-btn-link></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </v-side-nav>
    </div>
</template>
<script>
    export default{
         data () {
            return {
                nav: {
                    edge: 'left'
                }
            }
        },
         mounted() {
            console.log('sidebar ready.')
        }
    }


</script>
