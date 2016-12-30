<template>
    <div id="striped" class="section">
        <div class="row">
            <div class="col s12">

                <div class="dv-header-title">
                    {{title}}
                </div>
                <div class="row">
                    <div class="col s6 m3 l3">
                        <v-select name="select"
                                  id="select"
                                  :items="columns"
                                  :v-model="query.search_column"
                        ></v-select>
                        <label for="select">Search:</label>
                    </div>
                    <div class="col s6 m3 l3">
                        <v-select name="select-operators"
                                  id="select-operators"
                                  :items="operators"
                                  :v-model="query.search_operator"
                        ></v-select>
                    </div>
                    <div class="col s6 m3 l3">
                        <input type="text"
                               placeholder="Search"
                               v-model="query.search_input"
                               @keyup.enter="fetchIndexData()">
                    </div>
                    <div class="col s6 m3 l3">
                        <button class="waves-effect light-green btn" @click="fetchIndexData()">Filter
                            <i class="material-icons small">filter_list</i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <table class="highlight responsive-table">
                    <thead>
                    <tr>
                        <th v-for="column in columns" @click="toggleOrder(column)">
                            <span>{{column}}</span>
                            <span class="dv-table-column" v-if="column === query.column">
                <span v-if="query.direction === 'desc'">&darr;</span>
                <span v-else>&uarr;</span>
              </span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="row in model.data">
                        <td v-for="(value, key) in row">{{value}}</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="divider"></div>
            <div class="col s12">
                <div class="row">
                    <div class="section col s12 m12 l12">
                        <span>Displaying {{model.from}} - {{model.to}} of {{model.total}} rows</span>
                    </div>
                    <div class="section col s12 m12 l12"></div>
                    <div class="section col s7 m4 l4">
                        <div class="input-field inline">
                            <input id="per-page" type="text" v-model="query.per_page"
                                   class="dv-footer-input"
                                   @keyup.enter="fetchIndexData()">
                            <label for="per-page" data-error="wrong" data-success="right">Rows per page:</label>
                        </div>
                    </div>
                    <div class="section col s12 m6 l6">
                        <ul class="pagination">
                            <li v-bind:class='{ disabled:noPrevPage }' class="hoverable">
                                <a href="#" aria-label="Previous"
                                   @click.prevent="changePage(pagination.current_page - 1)">
                                    <i class="material-icons">chevron_left</i>
                                </a>
                            </li>
                            <li v-for="page in pagesNumber" class="hoverable"
                                v-bind:class="[ page == isActivated ? 'active' : '']">
                                <a href="#"
                                   @click.prevent="changePage(page)">{{ page }}</a>
                            </li>
                            <li v-bind:class='{ disabled:noNextPage }' class="hoverable">
                                <a href="#" aria-label="Next"
                                   @click.prevent="changePage(pagination.current_page + 1)">
                                    <i class="material-icons">chevron_right</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    body{
        background-color:#ff0000;
    }


</style>
<script>
    export default {
    props: ['source', 'title'],
    data() {
      return {
        model: {},
        columns: {},
        pagination: {
            total: 0,
            per_page: 15,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 2,
        query: {
          page: 1,
          column: 'id',
          direction: 'desc',
          per_page: 15,
          search_column: 'id',
          search_operator: 'equal',
          search_input: ''
        },
        operators: {
          equal: '=',
          not_equal: '<>',
          less_than: '<',
          greater_than: '>',
          less_than_or_equal_to: '<=',
          greater_than_or_equal_to: '>=',
          in: 'IN',
          like: 'LIKE'
        }
      }
    },
    created() {
      this.fetchIndexData()
    },
    computed: {
            isActivated: function () {
                return this.pagination.current_page;
            },
            noPrevPage: function () {
                return this.pagination.current_page <= 1;
            },
            noNextPage: function () {
                return this.pagination.current_page == this.pagination.last_page
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                if(!this.pagination.last_page){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                console.log(this.pagination.last_page)
                console.log(to)
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                console.log(pagesArray);
                return pagesArray;
            }
        },
    methods: {
      changePage: function (page) {
        if(page < 1 || page > this.pagination.last_page){
            // do nothing
        }else{
          this.pagination.current_page = page;
          this.query.page = page;
          this.fetchIndexData();
        }
      },
      toggleOrder(column) {
        if(column === this.query.column) {
          // only change direction
          if(this.query.direction === 'desc') {
            this.query.direction = 'asc'
          } else {
            this.query.direction = 'desc'
          }
        } else {
          this.query.column = column
          this.query.direction = 'asc'
        }
        this.fetchIndexData()
      },
      fetchIndexData() {
        var vm = this
        var query;

        this.$http.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
          .then(function(response) {
            Vue.set(vm.$data, 'model', response.data.model)
            Vue.set(vm.$data, 'columns', response.data.columns)
            this.setPagination(response.data.model)
          })
          .catch(function(response) {
            console.log(response)
          })
      },
      setPagination(model){
            var pagination = {
                total: model.total,
                per_page: model.per_page,
                from: model.from,
                to: model.to,
                current_page: model.current_page,
                last_page: model.last_page
            };
            Vue.set(this.$data, 'pagination', pagination);
      },
    }
  }


</script>
