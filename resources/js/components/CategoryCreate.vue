<template>
  <div>
    <div class="col-12" id="collapseExample">
        <div class="d-flex justify-content-center">
          <div class="col-6">
            <label class="form-label fw-bold">Nom de la catégorie</label>
            <input type="text" class="form-control" name="name" placeholder="Entrez le nom de la catégorie" required>
          </div>
        </div>
        <hr>
        <div>
          <div class="col-12" v-for="(item, index) in subcat" :key="index">
            <div class="d-flex flex-column align-items-center">
              <div class="col-6">
                <label class="form-label fw-bold">Nom de la sous-catégorie</label>
                <input type="text" class="form-control" name="subname[]" placeholder="Entrez le nom de la Sous-catégorie" required>
              </div>
              <div>
                <a @click="removeItem(index)" class="btn btn-danger text-white font-weight-bold text-center mt-2"><i class="fas fa-trash-alt me-1"></i>Supprimer</a>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <a @click="addItem" class="btn btn-success font-weight-bold text-center add-btn col-4 mt-3">Ajouter une sous-catégorie</a>
          </div>
        </div>

    </div>
  </div>
</template>

<script>
export default {

    data(){
      return {
        subcat: []
      }
    },

    methods : {
      addItem () {
        this.subcat.push({
        })
      },
      removeItem(i) {
        this.subcat.splice(i, 1)
      },
    },

    watch: {
      
    },
    computed: {
     
    },

    created() {
      console.log('test')
    }

}
</script>

<style>

</style>