<template>
  <div>
    <div class="col-12" id="collapseExample">
        <div class="d-flex justify-content-center">
          <div class="col-6">
            <label class="form-label fw-bold">Nom de la catégorie</label>
            <input type="text" class="form-control" name="name" v-model="this.categoryObj.name" required placeholder="Entrez le nom de la catégorie">
          </div>
        </div>
        <hr>
        <div class="d-flex flex-row">
          <div class="col-6">
            <p class="h4 fw-bold text-center mt-2 mb-2">Sous-catégories existantes</p>
            <div class="col-12 card" v-for="(item, index) in this.categoryObj.subcategories" :key="index">

              <div class="d-flex flex-column align-items-center">
                <div class="col-10">
                  <label class="mt-2 form-label fw-bold">Nom de la sous-catégorie</label>
                  <input type="text" class="form-control" name="existing_subnames[]" v-model="item.subname" placeholder="Entrez le nom de la Sous-catégorie" required>
                  <input type="text" class="d-none" name="id[]" v-model="item.id" required>
                </div>
                <div>
                  <label class="style-check">Supprimer
                    <input type="checkbox" :value="item.id" name="deleted_at[]" v-model="item.deleted_at">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>

            </div>
          </div>

          <div class="col-6">
            <p class="h4 fw-bold text-center mt-2 mb-2">Ajouter une sous-catégorie</p>
            <div class="col-12 card" v-for="(item, index) in subcat" :key="index">
                <div class="d-flex flex-column align-items-center">
                  <div class="col-10">
                    <label class="mt-2 form-label fw-bold">Nom de la sous-catégorie</label>
                    <input type="text" class="form-control" name="new_subnames[]" placeholder="Entrez le nom de la Sous-catégorie" required>
                  </div>
                  <div>
                    <a @click="removeItem(index)" class="btn btn-danger text-white font-weight-bold text-center mt-2 mb-2"><i class="fas fa-trash-alt me-1"></i>Supprimer</a>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <a @click="addItem" class="btn btn-success font-weight-bold text-center add-btn col-4 mt-3">Ajouter une sous-catégorie</a>
              </div>
            </div>
          </div>
    </div>
  </div>
</template>

<script>
export default {

    props: ['category'],

    data(){
      return {
        categoryObj: {},
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

      removeExistingItem(i) {
        this.categoryObj.subcategories.splice(i, 1)
      },

      oldValue() {
          this.categoryObj = JSON.parse(this.category)
      },
    },

    watch: {

    },
    computed: {

    },

    created() {
      this.oldValue();
    }

}
</script>

<style>
.style-check {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-top: 11.5px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 20px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.style-check input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  margin-top: 7px;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.style-check:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.style-check input:checked ~ .checkmark {
  background-color: #dc3545;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.style-check input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.style-check .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
