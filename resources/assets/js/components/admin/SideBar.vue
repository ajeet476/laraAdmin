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
                <li class=""><a href="Install">Install</a></li>
                <li class=""><a href="Functional">Functional</a></li>
                <li class=""><a href="Dialog">Dialog</a></li>
                <li class="no-padding">
                    <ul data-collapsible="accordion" class="collapsible">
                        <li class="active">
                            <div class="black-text waves-effect waves-teal collapsible-header active">
                                Components
                            </div>
                            <div class=" collapsible-body" style="display: block;">
                                <ul>
                                    <li class=""><a href="Badge">Badge</a></li>
                                    <li class="active"><a href="Pagination">Pagination</a></li>
                                    <li class=""><a href="Tabs">Tabs</a></li>
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
