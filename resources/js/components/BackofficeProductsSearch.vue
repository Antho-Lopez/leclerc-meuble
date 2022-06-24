<template>
  <div>
    <div class="d-flex justify-content-center m-4">
      <div class="d-flex flex-column col-8">

        <div class="d-flex flex-column">
          <label class="col-12">Recherche par Nom :</label>
          <input type="text" v-model="product_research" @input="search" class="form-control" placeholder="Rechercher...">
        </div>

        <div class="d-flex flex-column mt-4">
          <label class="col-12">Recherche par catégorie :</label>
          <select class="form-select" @change="search" v-model="selectedcategory">
            <option disabled>-- Choisissez un catégorie --</option> 
            <option :value="category.id" v-for="category in categories" v-bind:key="category.id">{{ category.name }}</option>
          </select>
        </div>

        <div class="alert alert-info fw-bold mt-2" v-if="this.product_research && products.length > 0">
          {{products.length}} Résultats trouvé<span v-if="products.length > 1">s</span>.
        </div>

        <div class="alert alert-info fw-bold mt-2" v-if="this.product_research && products.length == 0">
          Aucun résultat ne correspond à votre recherche.
        </div>

      </div>
    </div>

    <div class="card-body table-responsive">
      <table class="table table-hover text-center table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center">Nom</th>
            <th scope="col" class="text-center">Catégorie</th>
            <th scope="col" class="text-center">Collection</th>
            <th scope="col" class="text-center">Voir</th>
            <th scope="col" class="text-center">Modifier</th>
            <th scope="col" class="text-center">Supprimer</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" v-bind:key="product.id">
            <td class="fw-bold">{{ product.name }}</td>
            <td>
                <p v-if="product.category != null">{{ product.category.name }}</p>
                <p class="text-danger" v-else>Catégorie supprimée</p>
            </td>
             <td>
                <p v-if="product.inspiration != null">{{ product.inspiration.name }}</p>
                <p class="text-danger" v-else>Collection supprimée</p>
            </td>
            <td><a :href="newShowRoute(product.id)" class="btn btn-primary"><i class="fas fa-eye me-1"></i>Voir les détails</a></td>
            <td><a :href="newEditRoute(product.id)" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
            <td><a :href="newDeleteRoute(product.id)" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer ce produit ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {

    data(){
       return {
        products: [],
        categories: [],
        product_research: '',
        selectedcategory: '',
       }
    },

    props: ['route_show', 'route_edit', 'route_delete'],

    methods: {

      fetchProducts() {
        axios.get('/api/products')
        .then(response => {
          this.products = response.data;
          console.log(this.products);
        })
        .catch(error => {console.log(error)})
      },

      fetchCategories() {
        axios.get('/api/categories')
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {console.log(error)})
      },

      newEditRoute(id) {
        return this.route_edit.replace('#', id)
      },

       newDeleteRoute(id) {
        return this.route_delete.replace('#', id)
      },

       newShowRoute(id) {
        return this.route_show.replace('#', id)
      },

      search: _.debounce(function() {

          axios.get('/api/productSearch?query=' + this.product_research + '&query2=' + this.selectedcategory)
          .then(response => {
            this.products = response.data;
          })
          .catch(error => {console.log(error)})
      }, 800),

      category(id){
        console.log(id)
      }

    },

    mounted(){
      this.fetchProducts();
      this.fetchCategories();
    }
}
</script>
<style>

</style>
