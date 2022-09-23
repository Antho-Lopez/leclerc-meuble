<template>
  <div>
    <div class="d-flex flex flex-column align-items-between mb-5">

      <div class="display-product-resp d-flex flex-wrap justify-content-around custom-padding my-4">

          <div class="display-img-list-resp col-md-8 col-sm-8 col-10 d-flex flex-column justify-content-start">
            <div v-if="product.img_products == 0" class="center-resp d-flex justify-content-between mb-2">
              <img class="img-width cursor-pointer selected-resp" :src="this.no_visuel" alt="">
              <div class="selected-img"></div>
            </div>

            <div v-for="img in product.img_products" v-bind:key="img.id" class="center-resp d-flex justify-content-between mb-2">
              <img @click="set_current_img(img.id)" class="img-width cursor-pointer selected-resp" :src="'/storage/product/' + product.id + '/' +  img.id + '-' + img.img_name" alt="">
              <div v-if="img.id == this.current_pic_id" class="selected-img"></div>
            </div>
          </div>

          <div class="col-lg-6 col-md-8 col-sm-8 col-10 d-flex flex-column align-items-center justify-content-center">

            <div v-if="product.img_products == 0" class="img-zoom-container display-zoomed-div d-flex">
              <img class="fixed-height" :src="this.no_visuel" alt="">
            </div>

            <div v-for="img in product.img_products" v-bind:key="img.id" class="">
              <div v-if="img.id == this.current_pic_id" class="img-zoom-container display-zoomed-div d-flex">

                <img class="fixed-height d-none responsive_no_lens" :src="'/storage/product/' + product.id + '/' + img.id + '-' + img.img_name">

                <img id="myimage" @load="get_zommed_img()" class="fixed-height responsive_lens" :src="'/storage/product/' + product.id + '/' + img.id + '-' + img.img_name">
                <div id="myresult" class="img-zoom-result"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-8 col-sm-8 col-10 d-flex flex-column align-items-start justify-content-start">
                <p>E.Leclerc Meubles et Multimédia - Basse-Goulaine</p>
                <p class="h2">{{ product.name }}</p>
                <p class="casse" v-if="product.category_id == 1">{{product.description}}</p>
                <div v-if="this.auth_id != 'not registered'">
                  <div v-if="this.array_for_include.toString().indexOf(product.id) != -1">
                    <form method="post" :action="removeFav(product.id)">
                      <input type="hidden" name="_token" v-bind:value="csrf">
                      <div>
                        <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retirer des favoris" class="col-12 py-3 fs-4 px-3 mt-3 btn bg-dark text-white front-menu-item los-andes text-center">Retirer ce produit de mes favoris <i class="fas fa-minus-circle"></i></button>
                      </div>
                    </form>
                  </div>
                  <div v-else>
                    <form method="post" :action="addFav(product.id)">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <div>
                            <button class="col-12 py-3 fs-4 px-3 mt-3 btn bg-dark text-white front-menu-item los-andes text-center"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ajouter aux favoris">Ajouter ce produit dans mes favoris <i class="fas fa-plus-circle"></i></button>
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
                <div v-if="this.have_img_production == 'yes'" class="mt-2">
                      <img class="fixed-production-img" :src="'/storage/product/' + product.id + '/'  + product.img_production">
                </div>
          </div>
      </div>
      <div class="col-12 bg-beige d-flex align-items-center justify-content-center">
        <div class="col-lg-10 col-12 d-flex flex-wrap justify-content-center">

          <div class="div col-lg-7 col-md-7 col-sm-10 col-10 mx-1 my-4">
            <p class="h5 m-3">Détails du produit</p>

            <div v-if="product.description" class="mx-3">
              <p class="casse">Spécificités <i class="fas fa-angle-down"></i><br>{{ product.description }}</p>
            </div>

            <div v-if="subcategories.length > 0" class="mx-3">
              <div class="d-flex flex-wrap">Catégories :
                <p class="ms-1" v-for="(subcategory, index) in subcategories" v-bind:key="index">
                   {{subcategory}}<span class="me-1" v-if="subcategories.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

            <div v-if="product.brand" class="mx-3">
              <p v-if="product.brand.id != 100" >Marque : {{ product.brand.name }}</p>
            </div>

            <div v-if="colors.length > 0" class="mx-3">
               <div class="d-flex flex-wrap">Coloris :
                <p class="ms-1" v-for="(color, index) in colors" v-bind:key="index">
                   {{color.name}}<span class="me-1" v-if="colors.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

            <div v-if="materials.length > 0" class="mx-3">
              <div class="d-flex flex-wrap">Matériaux / Revetements :
                <p class="ms-1" v-for="(material, index) in materials" v-bind:key="index">
                   {{material.name}}<span class="me-1" v-if="materials.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

            <div v-if="technologies.length > 0" class="mx-3">
              <div class="d-flex flex-wrap">Technologies :
                <p class="ms-1" v-for="(technology, index) in technologies" v-bind:key="index">
                   {{technology.name}}<span class="me-1" v-if="technologies.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

            <div v-if="types.length > 0" class="mx-3">
              <div class="d-flex flex-wrap">Types de produits :
                <p class="ms-1" v-for="(type, index) in types" v-bind:key="index">
                   {{type.name}}<span class="me-1" v-if="types.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

             <div v-if="shapes.length > 0" class="mx-3">
              <div class="d-flex flex-wrap">Formes :
                <p class="ms-1" v-for="(shape, index) in shapes" v-bind:key="index">
                   {{shape.name}}<span class="me-1" v-if="shapes.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

            <div v-if="product.category_id == 1" class="mx-3">
              <div class="d-flex flex-wrap">Dimensions :
                <p class="ms-1" v-for="(dimension, index) in dimensions" v-bind:key="index">
                   {{dimension.size}}<span class="me-1" v-if="dimensions.length != (index + 1)">,</span>
                </p>
              </div>
            </div>

          </div>

          <div class="div col-lg-4 col-md-4 col-sm-10 col-10 mx-1 my-4">
            <p class="h5 m-3">Infos complémentaires</p>
            <p class="casse m-3">{{product.details}}</p>
          </div>

        </div>
      </div>
    </div>


  <div class="container my-3">
    <h2 class="font-weight-light">Vous aimerez aussi</h2>

    <div class="width-overflow d-flex flex-row">
      <div v-for="suggestion in suggestions1" v-bind:key="suggestion.id" class="col-lg-4 col-md-6 col-sm-8 col-12">
        <a :href="suggestionRoute(suggestion.id)" class="fixed-h m-5 no-style-link scalehover shadow border d-flex flex-column align-items-center justify-content-between bg-white cursor-pointer">
          <div class="encadrement d-flex align-items-center justify-content-center">
            <div class="" v-if="suggestion.img_products.length == 0">
                <img class="i-s " :src="this.no_visuel" alt="">
            </div>
            <div v-for="img in suggestion.img_products" v-bind:key="img.id">
                <div v-if="img.is_first == 1">
                <img class="i-s" :src="'/storage/product/' + suggestion.id + '/' +  img.id + '-' + 'miniature' + '-' + img.img_name" alt="">
                </div>
                <div class="" v-if="suggestion.img_products.length == 1 && img.is_first == 0">
                <img class="i-s" :src="this.no_visuel" alt="">
                </div>
            </div>
          </div>
          <div class="col-12">
          <p class="align-self-start h4 pt-3 los-andes ms-3">{{ suggestion.name }}</p>
          <div class="col-11 ms-3 d-flex flex-row justify-content-between pb-1">
                <div class="col-10" v-if="suggestion.description">
                  <p class="casse text-muted">{{ suggestion.description.substr(0, 60) }}<span v-if="suggestion.description.length > 60">...</span></p>
                </div>

                <div v-if="this.auth_id != 'not registered'">
                  <div v-if="this.array_for_include.toString().indexOf(suggestion.id) != -1" class="">
                    <form method="post" :action="removeFav(suggestion.id)">
                      <input type="hidden" name="_token" v-bind:value="csrf">
                      <div>
                        <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retirer des favoris" class="bg-none border-0"><i class="is_fav fas fa-heart fs-3"></i></button>
                      </div>
                    </form>
                  </div>

                  <div v-else class="">
                    <form method="post" :action="addFav(suggestion.id)">
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
                      <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Il faut être connecté pour ajouter un produit à votre liste" class="bg-none border-0"><i class="far fa-heart fs-3"></i></button>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </a>

      </div>
    </div>

  </div>

</div>
</template>

<script>
export default {

    props: ['suggestion', 'id', 'route_add_fav', 'route_remove_fav', 'auth_id', 'no_visuel'],

    data(){
      return {

        //csrf token
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        product: [],
        suggestions1: [],
        colors: [],
        materials: [],
        technologies: [],
        types: [],
        shapes: [],
        dimensions: [],
        subcategories: [],
        current_pic_id: '',

        fav_products: [],
        array_for_include: [],

        have_img_production:'',

      }
    },

    methods : {
       fetchDatas: _.debounce(function(){
        axios.get(`/api/product/${this.id}`)
        .then(response => {
          this.product = response.data[0];
          this.suggestions1 = response.data[1];
          this.colors = response.data[2];
          this.materials = response.data[3];
          this.subcategories = response.data[4];
          this.shapes = response.data[5];
          this.technologies = response.data[6];
          this.types = response.data[7];
          this.dimensions = response.data[8];

          console.log(this.product.img_production);

          if(this.product.img_production == null){
            this.have_img_production = 'no'
          } else {
            this.have_img_production = 'yes'
          }

          response.data[0].img_products.forEach(element => {
          if(element.is_first == 1){
            this.current_pic_id = element.id;
          }
          });

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

      }),

      addFav(id) {
        return this.route_add_fav.replace('#', id)
      },

      removeFav(id) {
        return this.route_remove_fav.replace('#', id)
      },


      set_current_img(id){
        this.current_pic_id = id;
      },

      get_zommed_img(){
        this.imageZoom("myimage", "myresult");
      },

      imageZoom(imgID, resultID) {
        var img, lens, result, cx, cy;
        img = document.getElementById(imgID);
        result = document.getElementById(resultID);
        /*create lens:*/
        lens = document.createElement("DIV");
        lens.setAttribute("class", "img-zoom-lens");
        /*insert lens:*/
        img.parentElement.insertBefore(lens, img);
        /*calculate the ratio between result DIV and lens:*/
        cx = result.offsetWidth / lens.offsetWidth;
        cy = result.offsetHeight / lens.offsetHeight;
        /*set background properties for the result DIV:*/
        result.style.backgroundImage = "url('" + img.src + "')";
        result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
        /*execute a function when someone moves the cursor over the image, or the lens:*/
        lens.addEventListener("mousemove", moveLens);
        img.addEventListener("mousemove", moveLens);
        /*and also for touch screens:*/
        lens.addEventListener("touchmove", moveLens);
        img.addEventListener("touchmove", moveLens);
        function moveLens(e) {
          var pos, x, y;
          /*prevent any other actions that may occur when moving over the image:*/
          e.preventDefault();
          /*get the cursor's x and y positions:*/
          pos = getCursorPos(e);
          /*calculate the position of the lens:*/
          x = pos.x - (lens.offsetWidth / 2);
          y = pos.y - (lens.offsetHeight / 2);
          /*prevent the lens from being positioned outside the image:*/
          if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
          if (x < 0) {x = 0;}
          if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
          if (y < 0) {y = 0;}
          /*set the position of the lens:*/
          lens.style.left = x + "px";
          lens.style.top = y + "px";
          /*display what the lens "sees":*/
          result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
        }
        function getCursorPos(e) {
          var a, x = 0, y = 0;
          e = e || window.event;
          /*get the x and y positions of the image:*/
          a = img.getBoundingClientRect();
          /*calculate the cursor's x and y coordinates, relative to the image:*/
          x = e.pageX - a.left;
          y = e.pageY - a.top;
          /*consider any page scrolling:*/
          x = x - window.pageXOffset;
          y = y - window.pageYOffset;
          return {x : x, y : y};
        }
      },

      suggestionRoute(id) {
        return this.suggestion.replace('#', id)
      },

    },

    mounted(){
      this.fetchDatas();

    },
}
</script>

<style>

.i-s{
    max-width: 100%;
    max-height: 398px;
}
.encadrement{
    width: 100%;
    height: 398px;
    background-color: white;
}

.fixed-production-img{
    max-width: 100px;
}

.casse{
   white-space: pre-wrap;
}
/* Works on Firefox */
* {
  scrollbar-color: rgb(160, 160, 160) #f6f6f6;
}


*::-webkit-scrollbar {
    width: 10px !important;
    height: 10px;
  }

*::-webkit-scrollbar-track {
  background: #f6f6f6;
}

*::-webkit-scrollbar-thumb {
  background-color: rgb(160, 160, 160);
  border-radius: 20px;
  border: 3px solid #f6f6f6;
}


.width-overflow{
  width: 100%;
  overflow: scroll;
  overflow-y: hidden;
}

.img-width{
  width: 100px;
}

.fixed-h{
  min-height: 29em;

}

.maxh{
  max-height: 21em;
}

.minh{
  min-height: 21em;
}

.fa-chevron-circle-left, .fa-chevron-circle-right{
  background-color: white;
  border-radius: 30px;
}

.bg-slider{
  color: rgb(0, 0, 0) !important;
  text-decoration: none;
}

.no-style-link {
  color: black !important;
  text-decoration: none;
}

.div{
  background-color: #f0e0cf96;
  border-left: 8px solid #212529;
}

.selected-img{
  z-index: 3;
  width: 8px;
  height: 100%;
  background-color: #cbaf99c7;

}

.is_fav{
  color: #f34541;
}

.fixed-height{
  max-width: 80vh;
  max-height: 60vh;
}

.bg-beige{
  background-color: #cbaf99c7;

}

.img-zoom-container {
  position: relative;
}

.img-zoom-lens {
  visibility: hidden;
  position: absolute;
  background-color: #ffffffb3;
  /*set the size of the lens:*/
  width: 200px;
  height: 200px;
}

.img-zoom-result {
  visibility: hidden;
  position: absolute;
  border: 1px solid #d4d4d4;
  /*set the size of the result div:*/
  width: 400px;
  height: 400px;
  margin-left: 100%;
}

.display-zoomed-div:hover .img-zoom-result{
  visibility: visible;
}

.display-zoomed-div:hover .img-zoom-lens{
  visibility: visible;
}

.display-img-list-resp{
  overflow: scroll;
  overflow-x: hidden !important;
  overflow-y: visible !important;
}

@media screen and (max-width: 1230px) {

  .display-product-resp{
    flex-direction: column !important;
    align-items: center !important;
  }

  .responsive_no_lens{
    display: initial !important;
  }

  .responsive_lens{
    display: none !important;
  }

  .img-zoom-result, .img-zoom-lens{
    display: none;
  }

  .display-img-list-resp{
    flex-direction: row !important;
    align-items: flex-start !important;
    width: 60vh !important;
    margin-bottom: 10px;
    overflow-y: hidden !important;
    overflow-x: visible !important;
  }

  .selected-img{
    display: none;
  }

  .center-resp{
    flex-direction: column;
    justify-content: center !important;
    align-items: center;
  }

  .img-width{
    margin-right: 5px;
  }
}

@media screen and (max-width: 4000px) {

  .display-img-list-resp{
    width: 8.33%;
    max-height: 60vh;
    overflow: scroll;
  }

}

@media screen and (max-width: 880px) {

  .display-img-list-resp{
    width: 66% !important;
  }
  .fixed-height{
    max-width: 100%;
  }
}


@media screen and (max-width: 600px) {

  .display-img-list-resp{
    width: 85% !important;


  }
}


@media screen and (max-width: 500px) {

  .display-img-list-resp{
    width: 95% !important;
  }
}


</style>
