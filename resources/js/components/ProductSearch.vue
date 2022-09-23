<template>
  <div class="col-12 d-flex flex-row justify-content-end custom-for-resp">

    <!-- INTERFACE FILTRES RESPONSIVE  -->
    <div class="show-in-resp">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="filters">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title">Filtres</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

          <transition :css="false" @enter="enterf" @leave="leavef">
          <div v-if="visible_filters" class="d-flex justify-content-between">
          <div class="col-12 d-flex flex-column">
              <div>
                <div>
                  <div class="col-12 d-flex flex-row align-items-center justify-content-between mt-3 mb-2 cursor-pointer" @click="toggle_subcategories">
                    <button v-if="id_category != 1" class="custom-filter-resp ps-3">Catégories</button>
                    <button v-else class="custom-filter-resp ps-3">Types de confort</button>
                    <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                  </div>
                  <transition :css="false" @enter="enter" @leave="leave">
                    <div v-if="visible_subcategories">
                      <div v-for="subcategory in subcategories" v-bind:key="subcategory.id" class="form-check ms-3">
                        <label class="cursor-pointer">
                          <input :value="subcategory.id" v-model="subcategory_search" @click="search" class="form-check-input" type="checkbox">
                          {{ subcategory.subname }}
                        </label>
                      </div>
                    </div>
                  </transition>
                  <hr>
                </div>
              </div>
              <div v-if="colors.length > 0">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_colors">
                  <button class="custom-filter-resp ps-3">Coloris</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>

                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_colors" class="d-flex flex-wrap">
                    <div v-for="color in colors" v-bind:key="color.id" class="col-6">
                      <label class="d-flex justify-content-center cursor-pointer">
                        <div class="d-flex flex-column align-items-center col-12  cursor-pointer">
                          <input v-if="color.id == 1" :value="color.id" v-bind:style="{ background: this.bg, background: this.gradient}" v-model="color_search" @click="search" class="form-check-input round" type="checkbox"/>
                          <input v-else :value="color.id" v-bind:style="{ backgroundColor: color.color_code}" v-model="color_search" @click="search" class="form-check-input round" type="checkbox"/>
                          <p>{{color.name}}</p>
                        </div>
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

              <div v-if="this.materials.length > 0">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_materials">
                  <button class="custom-filter-resp ps-3">Matériaux / Revetements</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_materials">
                    <div v-for="material in materials" v-bind:key="material.id" class="form-check ms-3">
                      <label class="cursor-pointer">
                        <input :value="material.id" v-model="material_search" @click="search" class="form-check-input" type="checkbox">
                        {{ material.name }}
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

              <div v-if="this.technologies.length > 0">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_technologies">
                  <button class="custom-filter-resp ps-3">Technologies</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_technologies">
                    <div v-for="technology in technologies" v-bind:key="technology.id" class="form-check ms-3">
                      <label class="cursor-pointer">
                        <input :value="technology.id" v-model="technology_search" @click="search" class="form-check-input" type="checkbox">
                        {{ technology.name }}
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

              <div v-if="this.types.length > 0">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_types">
                  <button class="custom-filter-resp ps-3">Types de produits</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_types">
                    <div v-for="type in types" v-bind:key="type.id" class="form-check ms-3">
                      <label class="cursor-pointer">
                        <input :value="type.id" v-model="type_search" @click="search" class="form-check-input" type="checkbox">
                        {{ type.name }}
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

              <div v-if="this.shapes.length > 0">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_shapes">
                  <button class="custom-filter-resp ps-3">Formes</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_shapes">
                    <div v-for="shape in shapes" v-bind:key="shape.id" class="form-check ms-3">
                      <label class="cursor-pointer d-flex flex-row align-items-center">
                        <input :value="shape.id" v-model="shape_search" @click="search" class="form-check-input me-1" type="checkbox">
                        <img class="m-w mx-2" :src="'/storage/' + shape.img_name">
                        <p class="m-0">{{ shape.name }}</p>
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

              <div v-if="this.brands.length > 0">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_brands">
                  <button class="custom-filter-resp ps-3">Marques</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_brands">
                    <div v-for="brand in brands" v-bind:key="brand.id" class="form-check ms-3">
                      <label class="form-check-label cursor-pointer">
                      <input :value="brand.id" v-model="brand_search" @click="search" class="form-check-input" type="checkbox">
                        {{ brand.name }}
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

              <div v-if="this.id_category == 1">
                <div class="col-12 d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_dimensions">
                  <button class="custom-filter-resp ps-3">Dimensions</button>
                  <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_dimensions">
                    <div v-for="dimension in dimensions" v-bind:key="dimension.id" class="form-check ms-3">
                      <label class="form-check-label cursor-pointer">
                      <input :value="dimension.id" v-model="dimension_search" @click="search" class="form-check-input" type="checkbox">
                        {{ dimension.size }}
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>

          </div>
          </div>
          </transition>
        </div>
      </div>
      <div class="">
        <button @click="filters_resp" class="scalehover btn btn-primary down-right" type="button" data-bs-toggle="offcanvas" data-bs-target="#filters" aria-controls="filters">
          <i class="fas fa-sliders-h" data-bs-toggle="offcanvas" data-bs-target="#filters" aria-controls="filters"></i>
        </button>
      </div>
    </div>
    <!-- FIN FILTRES RESPONSIVE  -->

    <!-- FILTRES FORMAT PC  -->
    <transition :css="false" @enter="enterf" @leave="leavef">
    <div v-if="visible_filters" class="col-2 bg-filters d-none-resp">
    </div>
    </transition>

    <transition :css="false" @enter="enterf" @leave="leavef">
    <div v-if="visible_filters" class="col-2 d-flex justify-content-between d-none-resp zzz">
        <div class="col-12 filters-resp d-flex flex-column">
            <div>
              <div>
                <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between mt-3 mb-2 cursor-pointer" @click="toggle_subcategories">
                    <button v-if="id_category != 1" class="custom-filter ps-3">Catégories</button>
                    <button v-else class="custom-filter ps-3">Types de confort</button>
                  <div v-if="!visible_subcategories" class="pe-3"><i class="fas fa-plus"></i></div>
                  <div v-if="visible_subcategories" class="pe-3"><i class="fas fa-minus"></i></div>
                </div>
                <transition :css="false" @enter="enter" @leave="leave">
                  <div v-if="visible_subcategories">
                    <div v-for="subcategory in subcategories" v-bind:key="subcategory.id" class="form-check ms-3">
                      <label class="cursor-pointer">
                        <input :value="subcategory.id" v-model="subcategory_search" @click="search" class="form-check-input" type="checkbox">
                        {{ subcategory.subname }}
                      </label>
                    </div>
                  </div>
                </transition>
                <hr>
              </div>
            </div>
            <div v-if="colors.length > 0">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_colors">
                <button class="custom-filter ps-3">Coloris</button>
                <div v-if="!visible_colors" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_colors" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>

              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_colors" class="d-flex flex-wrap">
                  <div v-for="color in colors" v-bind:key="color.id" class="col-6">
                    <label class="d-flex justify-content-center cursor-pointer">
                      <div class="d-flex flex-column align-items-center col-12 cursor-pointer">
                        <input v-if="color.id == 1" :value="color.id" v-bind:style="{ background: this.bg, background: this.gradient}" v-model="color_search" @click="search" class="form-check-input round" type="checkbox"/>
                        <input v-else :value="color.id" v-bind:style="{ backgroundColor: color.color_code}" v-model="color_search" @click="search" class="form-check-input round" type="checkbox"/>
                        <p>{{color.name}}</p>
                      </div>
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>

            <div v-if="this.materials.length > 0">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_materials">
                <button class="custom-filter ps-3">Matériaux / Revetements</button>
                <div v-if="!visible_materials" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_materials" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>
              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_materials">
                  <div v-for="material in materials" v-bind:key="material.id" class="form-check ms-3">
                    <label class="cursor-pointer">
                      <input :value="material.id" v-model="material_search" @click="search" class="form-check-input" type="checkbox">
                      {{ material.name }}
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>

            <div v-if="this.technologies.length > 0">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_technologies">
                <button class="custom-filter ps-3">Technologies</button>
                <div v-if="!visible_technologies" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_technologies" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>
              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_technologies">
                  <div v-for="technology in technologies" v-bind:key="technology.id" class="form-check ms-3">
                    <label class="cursor-pointer">
                      <input :value="technology.id" v-model="technology_search" @click="search" class="form-check-input" type="checkbox">
                      {{ technology.name }}
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>

             <div v-if="this.types.length > 0">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_types">
                <button class="custom-filter ps-3">Types de produits</button>
                <div v-if="!visible_types" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_types" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>
              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_types">
                  <div v-for="type in types" v-bind:key="type.id" class="form-check ms-3">
                    <label class="cursor-pointer">
                      <input :value="type.id" v-model="type_search" @click="search" class="form-check-input" type="checkbox">
                      {{ type.name }}
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>

            <div v-if="this.shapes.length > 0">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_shapes">
                <button class="custom-filter ps-3">Formes</button>
                <div v-if="!visible_shapes" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_shapes" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>
              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_shapes">
                  <div v-for="shape in shapes" v-bind:key="shape.id" class="form-check ms-3">
                    <label class="cursor-pointer d-flex flex-row align-items-center">
                      <input :value="shape.id" v-model="shape_search" @click="search" class="form-check-input me-1" type="checkbox">
                      <img class="m-w" :src="'/storage/' + shape.img_name">
                      <p class="m-0">{{ shape.name }}</p>
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>


            <div v-if="this.brands.length > 0">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_brands">
                <button class="custom-filter ps-3">Marques</button>
                <div v-if="!visible_brands" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_brands" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>
              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_brands">
                  <div v-for="brand in brands" v-bind:key="brand.id" class="form-check ms-3">
                    <label class="form-check-label cursor-pointer">
                    <input :value="brand.id" v-model="brand_search" @click="search" class="form-check-input" type="checkbox">
                      {{ brand.name }}
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>

            <div v-if="this.id_category == 1">
              <div class="col-12 one-filter-resp d-flex flex-row align-items-center justify-content-between cursor-pointer" @click="toggle_dimensions">
                <button class="custom-filter ps-3">Dimensions</button>
                <div v-if="!visible_dimensions" class="pe-3"><i class="fas fa-plus"></i></div>
                <div v-if="visible_dimensions" class="pe-3"><i class="fas fa-minus"></i></div>
              </div>
              <transition :css="false" @enter="enter" @leave="leave">
                <div v-if="visible_dimensions">
                  <div v-for="dimension in dimensions" v-bind:key="dimension.id" class="form-check ms-3">
                    <label class="form-check-label cursor-pointer">
                    <input :value="dimension.id" v-model="dimension_search" @click="search" class="form-check-input" type="checkbox">
                      {{ dimension.size }}
                    </label>
                  </div>
                </div>
              </transition>
              <hr>
            </div>

        </div>
    </div>
    </transition>
    <!-- FIN FILTRES FORMAT PC -->

    <div v-if="toggle_filters">
      <div class="d-flex flex-wrap justify-content-end mt-3">
        <div @click="toggle_filters" class="d-none-resp d-flex flex-row align-items-center me-4 cursor-pointer">
          <a class="text-decoration-none me-2 text-dark"><span v-if="!visible_filters">Afficher</span><span v-if="visible_filters">Masquer</span> les filtres</a>
          <i class="fas fa-sliders-h"></i>
        </div>
        <div class="d-flex flex-row align-items-center">
          <label class="me-3">Trier par :</label>
          <div class="select-custom">
            <select @change="search" v-model="selectedfilter">
              <option :value="1">Nouveautés</option>
              <option :value="2">Alphabétique croissant</option>
              <option :value="3">Alphabétique décroissant</option>
              <option :value="4">En vedette</option>
            </select>
          </div>
        </div>
      </div>

      <div class="d-flex flex-wrap justify-content-center mt-2">

        <div v-if="products.length == 1"  class="replace_product">
        </div>

        <a v-for="product in products" v-bind:key="product.id" :href="oneProductRoute(product.id)" class="no-style-link scalehover shadow border col-lg-3 col-md-4 col-sm-4 col-10 d-flex flex-column align-items-center justify-content-between bg-white m-3 cursor-pointer">
          <div class="encadrement d-flex align-items-center justify-content-center">
            <div class="" v-if="product.img_products.length == 0">
                <img class="i-s " :src="this.no_visuel" alt="">
            </div>
            <div v-for="img in product.img_products" v-bind:key="img.id">
                <div v-if="img.is_first == 1">
                <img class="i-s" :src="'/storage/product/' + product.id + '/' +  img.id + '-' + 'miniature' + '-' + img.img_name" alt="">
                </div>
                <div class="" v-if="product.img_products.length == 1 && img.is_first == 0">
                <img class="i-s" :src="this.no_visuel" alt="">
                </div>
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
                    <form id="myForm" method="post" :action="removeFav(product.id)">
                      <input type="hidden" name="_token" v-bind:value="csrf">
                      <div>
                        <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retirer des favoris" class="bg-none border-0"><i class="is_fav fas fa-heart fs-3"></i></button>
                      </div>
                    </form>
                  </div>

                  <div v-else class="">
                    <form id="myForm" method="post" :action="addFav(product.id)">
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
                      <a :href="notConnected()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Connectez vous pour ajouter un produit dans vos favoris" class="bg-none border-0"><i class="far fa-heart fs-3"></i></a>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </a>

        <div v-if="products.length == 1 || products.length == 2"  class="replace_product">
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
</template>

<script>

export default {

    props: [
        'one_product',
        'id_category',
        'route_add_fav',
        'route_remove_fav',
        'route_not_connected',
        'auth_id',
        'no_visuel'
    ],

    data(){
        return {
            //csrf token
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            array_for_include: [],
            products: [],
            fav_products: [],
            brands: [],
            brand_search: [],
            visible_brands: false,

            dimensions: [],
            dimension_search: [],
            visible_dimensions: false,

            materials: [],
            material_search: [],
            visible_materials: false,

            technologies: [],
            technology_search: [],
            visible_technologies: false,

            types: [],
            type_search: [],
            visible_types: false,

            shapes: [],
            shape_search: [],
            visible_shapes: false,

            colors: [],
            color_search: [],
            visible_colors: false,

            subcategories: [],
            subcategory_search: [],
            visible_subcategories: false,

            visible_filters: true,
            selectedfilter: '',
            gradient: 'linear-gradient(90deg, rgba(31,31,31,1) 10%, rgba(222,222,222,1) 90%)',
            bg: 'rgb(31,31,31)',

            nb_products: 12,
        }
    },

    methods: {

      display_more_products: _.debounce(function() {

        this.nb_products = this.nb_products + 12;

        axios.get(`/api/category/${this.id_category}/productsSearch?brand=` + this.brand_search + '&dimension=' + this.dimension_search + '&material=' + this.material_search + '&technology=' + this.technology_search + '&type=' + this.type_search + '&shape=' + this.shape_search + '&color=' + this.color_search  + '&subcategory=' + this.subcategory_search + '&selectedfilter=' + this.selectedfilter + '&nb_products=' + this.nb_products)
          .then(response => {
            this.products = response.data;
          })
        .catch(error => {console.log(error)})
      }, 10),

      enter: function (el, done) {
        $(el).hide().slideDown(400, done)
      },

      leave: function (el, done) {
        $(el).show().slideUp(400, done)
      },

      enterf: function (el, done) {
        $(el).hide().slideDown(700, done)
      },

      leavef: function (el, done) {
      $(el).show().slideUp(700, done)
      },

      oneProductRoute(id) {
        return this.one_product.replace('#', id)
      },

      addFav(id) {
        return this.route_add_fav.replace('#', id)
      },

      removeFav(id) {
        return this.route_remove_fav.replace('#', id)
      },

      notConnected() {
        return this.route_not_connected
      },

      fetchDatas: _.debounce(function(){

        axios.get(`/api/filters/${this.id_category}`)
        .then(response => {
          if(this.id_category == 1){
              this.dimensions = response.data[0];
          }
            this.colors = response.data[1];
            this.materials = response.data[2];
            this.brands = response.data[3];
            this.shapes = response.data[4];
            this.technologies = response.data[5];
            this.types = response.data[6];
        })
        .catch(error => {console.log(error)})

        axios.get(`/api/fav_products/${this.auth_id}`)
        .then(response => {
          this.fav_products = response.data;
          this.array_for_include = [];
          this.fav_products.forEach(e => {
             this.array_for_include.push(e.product_id);
          });
        })
        .catch(error => {console.log(error)})

        axios.get(`/api/subcategories/${this.id_category}`)
        .then(response => {
          this.subcategories = response.data[1];
        })
        .catch(error => {console.log(error)})
      }, 1),

      toggle_filters: function (){
        this.visible_filters = !this.visible_filters
      },

      filters_resp: function (){
        this.visible_filters = true
      },

      toggle_brands: function (){
        this.visible_brands = !this.visible_brands
        this.visible_dimensions = false
        this.visible_materials = false
        this.visible_shapes = false
        this.visible_colors = false
        this.visible_subcategories = false
        this.visible_technologies = false
        this.visible_types = false
      },

      toggle_dimensions: function (){
        this.visible_dimensions = !this.visible_dimensions
        this.visible_brands = false
        this.visible_materials = false
        this.visible_shapes = false
        this.visible_colors = false
        this.visible_subcategories = false
        this.visible_technologies = false
        this.visible_types = false
      },

       toggle_materials: function (){
        this.visible_materials = !this.visible_materials
        this.visible_shapes = false
        this.visible_dimensions = false
        this.visible_brands = false
        this.visible_colors = false
        this.visible_subcategories = false
        this.visible_technologies = false
        this.visible_types = false
      },

       toggle_colors: function (){
        this.visible_colors = !this.visible_colors
        this.visible_dimensions = false
        this.visible_materials = false
        this.visible_shapes = false
        this.visible_brands = false
        this.visible_subcategories = false
        this.visible_technologies = false
        this.visible_types = false
      },

      toggle_subcategories: function (){
        this.visible_subcategories = !this.visible_subcategories
        this.visible_dimensions = false
        this.visible_materials = false
        this.visible_shapes = false
        this.visible_colors = false
        this.visible_brands = false
        this.visible_technologies = false
        this.visible_types = false
      },
      toggle_shapes: function (){
        this.visible_shapes = !this.visible_shapes
        this.visible_dimensions = false
        this.visible_materials = false
        this.visible_colors = false
        this.visible_brands = false
        this.visible_technologies = false
        this.visible_types = false
        this.visible_subcategories = false
      },

      toggle_technologies: function (){
        this.visible_technologies = !this.visible_technologies
        this.visible_dimensions = false
        this.visible_materials = false
        this.visible_colors = false
        this.visible_brands = false
        this.visible_shapes = false
        this.visible_types = false
        this.visible_subcategories = false
      },

      toggle_types: function (){
        this.visible_types = !this.visible_types
        this.visible_dimensions = false
        this.visible_materials = false
        this.visible_colors = false
        this.visible_brands = false
        this.visible_technologies = false
        this.visible_shapes = false
        this.visible_subcategories = false
      },


      search: _.debounce(function() {

        axios.get(`/api/category/${this.id_category}/productsSearch?brand=` + this.brand_search + '&dimension=' + this.dimension_search + '&material=' + this.material_search + '&technology=' + this.technology_search + '&type=' + this.type_search + '&shape=' + this.shape_search + '&color=' + this.color_search  + '&subcategory=' + this.subcategory_search + '&selectedfilter=' + this.selectedfilter + '&nb_products=' + this.nb_products)
          .then(response => {
            this.products = response.data;
          })
        .catch(error => {console.log(error)})

        sessionStorage.setItem('subcategories', this.subcategory_search);

      }, 10),

    },

    mounted(){
      this.fetchDatas();
      this.search();
    }
}
</script>

<style scoped>

.i-s{
    max-width: 100%;
    max-height: 398px;
}
.encadrement{
    width: 100%;
    height: 398px;
    background-color: white;
}

.m-w{
    width: 75px;
}
.casse{
   white-space: pre-wrap;
}

.no-style-link {
  color: black !important;
  text-decoration: none;
}

.replace_products{
  width: 82.4vw;
}

.replace_product{
  width: 27.5vw;
}

.custom-filter{
  background-color: rgba(245, 245, 220, 0);
  border: none;
  font-size: 1vw;
}

.custom-filter-resp{
  background-color: rgba(245, 245, 220, 0);
  border: none;
  font-size: 1.5vw;
}

.offcanvas-body{
  padding: 0px;
}

.cursor-pointer:hover{
  cursor: pointer;
}
hr{
  width: 90%;
  margin-left: 5%;
  color: #a5a5a5;
}

.is_fav{
  color: #f34541;
}

.scalehover:hover{
  scale: 1.2;
}

.zzz{
  height: 100vh;
  position: -webkit-sticky;
  position: sticky;
  top: 10vh;
  background-color: #f6f6f6;
  border-right: 1px solid #e4e4e4;
  overflow:auto;
}

.bg-filters{
  position: fixed;
  height: 100vh;
  left: 0;
  top: 0;
  z-index: -1;
  background-color: #f6f6f6;
  border-right: 1px solid #e4e4e4;
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
  margin-right: 8vw;
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

.round{
   border-radius: 50%;
   height: 35px;
   width: 35px;
}

input[type="checkbox"]:checked + p {
    font-weight: bold;
}


.left{
 left: 0 !important;
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

.show-in-resp{
    display: none;
  }

.down-right{
  position: fixed;
  bottom: 10px;
  right: 10px;
  border-radius: 140px !important;
  width: 70px !important;
  height: 70px !important;
  z-index: 9;
  font-size: 25px !important;
}

@media screen and (max-width: 1100px) {

  .d-none-resp{
    display: none !important;
  }

  .custom-for-resp{
    display: flex !important;
    flex-direction: column !important;
  }

  .zzz{
  height: auto;
  position: initial;
  background-color: #f6f6f6;
  border-bottom: 1px solid #e4e4e4;
  border-right: initial;
  overflow: initial;
  width: 98vw !important;
  }

  .show-in-resp{
    display: initial;
  }
  .custom-filter-resp{
    font-size: 24px;
  }
}

@media screen and (max-width: 768px) {

  .custom-filter-resp{
    font-size: 20px;
  }

}

@media screen and (max-width: 500px) {

  .scalehover:hover{
    scale: 1;
  }

}
</style>
