<template>
<div>
  <div class="col-12 d-flex flex-row justify-content-center">
    <div>
      <div class="d-flex justify-content-center">
        <div class="col-10 d-flex flex-wrap justify-content-between align-items-center mt-5">
          <div class="custom-margin-left">
            {{total_products}} produit(s)
          </div>
          <div class="d-flex flex-row justify-content-end align-items-center">
            <label class="me-3">Trier par :</label>
            <div class="select-custom">
              <select @change="search" v-model="selectedfilter">
                <option :value="1">Nouveautés</option>
                <option :value="2">Prix croissant</option>
                <option :value="3">Prix décroissant</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex flex-wrap justify-content-center mt-2">

        <div v-if="products.length == 1"  class="replace_product">
        </div>

        <a v-for="product in products" v-bind:key="product.id" :href="oneProductRoute(product.id)" class="no-style-link scalehover shadow border col-lg-3 col-md-4 col-sm-4 col-10 d-flex flex-column align-items-center justify-content-between bg-white m-3 cursor-pointer">
          <div v-if="product.img_products.length == 0">
              <img class="img-fluid mb-2" :src="this.no_visuel" alt="">
          </div>
          <div v-for="img in product.img_products" v-bind:key="img.id">
            <div v-if="img.is_first == 1">
              <img class="img-fluid mb-2" :src="'/storage/product/' + product.id + '/' +  img.id + '-' + 'miniature' + '-' + img.img_name" alt="">
            </div>
          </div>
          <div class="col-12">
          <p class="align-self-start h4 pt-3 los-andes ms-3">{{ product.name }}</p>
          <div class="col-11 ms-3 d-flex flex-row justify-content-between pb-1">
                <div class="col-10" v-if="product.description">
                  <p class="casse text-muted">{{ product.description.substr(0, 60) }}<span v-if="product.description.length > 60">...</span></p>
                </div>

                <div v-if="this.auth_id != 'not registered'">
                  <div v-if="this.array_for_include.toString().indexOf(product.id) != -1" class="">
                    <form method="post" :action="removeFav(product.id)">
                      <input type="hidden" name="_token" v-bind:value="csrf">
                      <div>
                        <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retirer des favoris" class="bg-none border-0"><i class="is_fav fas fa-heart fs-3"></i></button>
                      </div>
                    </form>
                  </div>

                  <div v-else class="">
                    <form method="post" :action="addFav(product.id)">
                      <input type="hidden" name="_token" v-bind:value="csrf">
                      <div>
                        <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ajouter aux favoris" class="bg-none border-0"><i class="far fa-heart fs-3"></i></button>
                      </div>
                    </form>
                  </div>
                </div>

                <div v-else>
                  <div class="">
                    <div>
                      <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Il faut être connecté pour ajouter un produit à votre liste"><i class="far fa-heart fs-3"></i></button>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </a>

        <div v-if="products.length == 1"  class="replace_product">
        </div>

        <div v-if="products.length == 0">
          <div class="replace_products">
            <div class="col-12 d-flex justify-content-center">
              <div class="alert alert-primary col-10 d-flex justify-content-center mt-3" role="alert">
                <p class="m-0">Aucun produit ne correspond à votre recherche</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="this.nb_products <= products.length" class="d-flex col-12 justify-content-center">
        <button @click="display_more_products" class="fs-5 m-4 py-2 px-3 btn bg-dark text-white front-menu-item los-andes text-center">Plus de produits <i class="fas fa-plus-circle"></i></button>
      </div>
    </div>
  </div>
</div>
</template>

<script>

export default {

  props: ['one_product', 'id', 'route_add_fav', 'route_remove_fav', 'auth_id', 'no_visuel'],

  data(){
    return {

        //csrf token
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        products: [],
        visible_filters: true,
        selectedfilter: '',
        nb_products: 12,
        total_products: '',

        fav_products: [],
        array_for_include: [],
    }
  },

    methods: {

      display_more_products: _.debounce(function() {

        this.nb_products = this.nb_products + 12;

        axios.get(`/api/collection/${this.id}/productsCollectionSearch?selectedfilter=` + this.selectedfilter + '&nb_products=' + this.nb_products)
          .then(response => {
            this.products = response.data[0];
          })
        .catch(error => {console.log(error)})
      }, 10),

      oneProductRoute(id) {
        return this.one_product.replace('#', id)
      },

      addFav(id) {
        return this.route_add_fav.replace('#', id)
      },

      removeFav(id) {
        return this.route_remove_fav.replace('#', id)
      },

      search: _.debounce(function() {

        axios.get(`/api/collection/${this.id}/productsCollectionSearch?selectedfilter=` + this.selectedfilter + '&nb_products=' + this.nb_products)
          .then(response => {
            this.products = response.data[0];
            this.total_products = response.data[1];
          })
        .catch(error => {console.log(error)})
      }, 10),

    },

    mounted(){
      this.search();
    }
}
</script>

<style scoped>

.casse{
   white-space: pre-wrap;
}

.custom-margin-left{
  margin-left: 2vw;
}

.cursor-pointer:hover{
  cursor: pointer;
}


.scalehover:hover{
  scale: 1.2;
}

select {
  appearance: none;
  box-shadow: none;
  flex: 1;
  padding: 0 1em;
  border: 0;
  background-color: #f6f6f6;
  background-image: none;
  cursor: pointer;
}

select::-ms-expand {
  display: none;
}

.select-custom {
  position: relative;
  display: flex;
  width: 15em;
  height: 2.5em;
  overflow: hidden;
  margin-right: 2vw;
  border: 1px solid #c7c8c9;
}

.select-custom::after {
  content: "\25BC";
  position: absolute;
  top: 0;
  right: 0;
  padding:  0.6em;
  background-color: #f6f6f6;
  transition: 0.25s all ease;
  pointer-events: none;
}

.select-custom:hover::after {
  color: #0371b6;
}

/* Works on Firefox */
* {
  scrollbar-width: thin;
  scrollbar-color: rgb(160, 160, 160) #f6f6f6;
}

/* Works on Chrome, Edge, and Safari */
*::-webkit-scrollbar {
  width: 10px;
}

*::-webkit-scrollbar-track {
  background: #f6f6f6;
}

*::-webkit-scrollbar-thumb {
  background-color: rgb(160, 160, 160);
  border-radius: 20px;
  border: 3px solid #f6f6f6;
}

</style>
