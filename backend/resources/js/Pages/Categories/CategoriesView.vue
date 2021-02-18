<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Categorias
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="row container py-3">
            <div class="col s12 text-right">
              <a
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#crearModal"
                >Crear</a
              >
            </div>
          </div>
          <div class="row container">
            <div class="col 12">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                    <th scope="col">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(categoria, index) in categorias" :key="index">
                    <td scope="row">{{ categoria.id }}</td>
                    <td colspan="2">{{ categoria.nombre }}</td>
                    <td>
                      <a
                        type="button"
                        class="btn btn-info mr-4"
                        data-toggle="modal"
                        data-target="#editarModal"
                        @click="selectedCategoria(categoria)"
                        >Editar</a
                      >
                      <a
                        type="button"
                        class="btn btn-danger"
                        @click="selectedCategoria(categoria); confirmDelete();"
                        >Eliminar</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Modal crear de categoria-->
    <div
      class="modal fade"
      id="crearModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Crear una nueva categoria
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="crearForm" @submit.prevent="addCategorias">
              <div class="form-group">
                <label for="nombre">Nombre de la categoria</label>
                <input
                  type="text"
                  v-model="categoria.nombre"
                  class="form-control"
                  id="nombre"
                  placeholder="Categoria"
                />
              </div>
              <button type="submit" class="btn btn-primary">Crear</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--End modal crear de categoria-->

    <!--Modal editar de categoria-->
    <div
      class="modal fade"
      id="editarModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Modificar una categoria
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editarForm" @submit.prevent="editCategorias">
              <div class="form-group">
                <label for="nombre">Nombre de la categoria</label>
                <input
                  type="text"
                  v-model="slcCategoria.nombre"
                  class="form-control"
                  id="nombre"
                  placeholder="Categoria"
                />
              </div>
              <button type="submit" class="btn btn-warning">Editar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--End modal editar de categoria-->

  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
  data() {
    return {
      categorias: [],
      categoria: {
        nombre: "",
      },
      slcCategoria: {},
    };
  },
  methods: {
    async getCategorias() {
      const { data } = await axios.get("api/categoria");
      this.categorias = data;
    },

    async addCategorias() {
      const res = await axios.post("api/categoria", this.categoria);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("crearForm").reset();
        $("#crearModal").modal("hide");
        this.getCategorias();
      }
    },

    async editCategorias() {
      const res = await axios.put("api/categoria/"+this.slcCategoria.id, this.slcCategoria);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("editarForm").reset();
        $("#editarModal").modal("hide");
        this.getCategorias();
      }
    },

    async deleteCategorias() {
      const res = await axios.delete("api/categoria/"+this.slcCategoria.id);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });
      }
    },

    selectedCategoria(categoria){
      let notReactive = JSON.stringify(categoria);
      this.slcCategoria = JSON.parse(notReactive);
    },

    confirmDelete: function(){
      Toast.fire({
        icon: 'warning',
        text: 'Esta seguro que desea eliminar el registro?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
      }).then((result)=> {
          if (result.isConfirmed) {
            this.deleteCategorias();
            this.getCategorias();
          }
      });
    }
  },
  created() {
    this.getCategorias();
  },
};
</script>
