<template>
  <div>
    <div class="col-12 d-flex flex-column">
      <div class="col-10 d-flex justify-content-between">
        <p>Catégorie *</p>
        <div class="py-1 me-1 col-md-7 d-flex flex-wrap">
          <select class="form-select" name="category_id" @change="setCategory">
            <option disabled>-- Choisissez une catégorie --</option>
            <option :value="c.id" v-for="c in cate" v-bind:key="c.id">{{ c.name }}</option>
          </select>
        </div>
      </div>
      <div class="col-10 d-flex justify-content-between" style="height:20vh;">
        <p>Sous catégories</p>
        <div v-for="c in cate" v-bind:key="c.id" class="d-flex flex-wrap col-6 position-absolute my-1" style="margin-left: 28vw;"> 
          <div v-for="sub in c.subcategories" v-bind:key="sub.id" class="col-3">
            <div v-if="currentCategory == sub.category_id">
              <input class="form-check-input" name="subcategory_id[]" type="checkbox" :value="sub.id" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault"> {{ sub.subname }} </label>
            </div>
          </div>   
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

    data(){
      return {
        cate: [],
        currentCategory: '',
      }
    },

     methods: {
      
      fetchCategories() {
        axios.get('/api/categories')
        .then(response => {
          // console.log(response.data);  
          this.cate = response.data;
        })
        .catch(error => {console.log(error)})
      },

      setCategory(event){
        this.currentCategory = event.target.value
      }
    },

    watch: {
      
    },

    computed: {
     
    },

    created() {
      this.fetchCategories();
    }
    
}
</script>

<style>

</style>