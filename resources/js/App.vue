<script>

import CategoryCreate from './components/CategoryCreate.vue';
import CategoryEdit from './components/CategoryEdit.vue';
import ProductSearch from './components/ProductSearch.vue';
import SelectCategory from './components/SelectCategory.vue';
import OneProduct from './components/OneProduct.vue';
import NavSearch from './components/NavSearch.vue';
import BackofficeProductsSearch from './components/BackofficeProductsSearch.vue';

export default {
  name: 'App',
  components: {
    "category-create": CategoryCreate,
    "category-edit": CategoryEdit,
    "select-category": SelectCategory,
    "product-search": ProductSearch,
    "one-product": OneProduct,
    "nav-search": NavSearch,
    "backoffice-products-search": BackofficeProductsSearch,

  },
}

</script>
