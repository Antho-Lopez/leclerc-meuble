<template>
    <input v-model="products_research" @input="fetchProducts" class="custom-search" type="search" placeholder="&#xF002; Rechercher un produit" style="font-family:Arial, FontAwesome;" aria-label="Search">
    <div class="position-absolute margin-top-for-pc p-2 z-index-cus">
        <div class="bg-dark text-white teeee" v-for="product in products" v-bind:key="product.id">
            <a :href="oneProductRoute(product.id)" class="text-decoration-none text-white style-research-result">
                <div class="d-flex flex-row align-items-center py-2 px-3">
                    <div v-if="product.img_products == 0">
                        <img class="img-se img-fluid mb-2" :src="this.no_visuel" alt="">
                    </div>

                    <div v-for="img in product.img_products" v-bind:key="img.id">
                        <div v-if="img.is_first == 1">
                        <img class="img-se img-fluid mb-2" :src="'/storage/product/' + product.id + '/' +  img.id + '-' + 'miniature' + '-' + img.img_name" alt="">
                        </div>
                    </div>
                    <div class="ms-2">{{ product.name }}</div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
export default {

    props: ['one_product', 'no_visuel'],

    data(){

       return {
        products: [],
        products_research: '',
       }

    },

     methods: {

        fetchProducts: _.debounce(function(){
            if(this.products_research.length >= 3){
                axios.get('/api/navSearch?query=' + this.products_research)
                .then(response => {
                    this.products = response.data;
                      console.log(this.products);
                })
                .catch(error => {console.log(error)})
            } else {
                this.products = [];
            }
        }, 800),

        oneProductRoute(id) {
            return this.one_product.replace('#', id)
        },
    }

}
</script>

<style>

.z-index-cus{
    z-index: 2;
}

.margin-top-for-pc{
    margin-top: 60px;
}
.style-research-result{
    margin-bottom: 0 !important;
}

.teeee:hover{
    background-color: #313131 !important;
}

.img-se{
    max-width: 100px;
}

@media screen and (max-width: 992px) {

    .margin-top-for-pc{
        margin-top: 0px;
    }
}

</style>
