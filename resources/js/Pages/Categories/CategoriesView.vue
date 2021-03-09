<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Categorias
      </h2>
    </template>
  <div v-if="$page.props.user.role === 'administrador'">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="row py-3 container">
            <div class="col s12 text-right">
              <a
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#crearModal"
                >Crear categoria</a
              >
            </div>
          </div>
          <div class="row">
            <div class="col 12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombres</th>
                    <th scope="col"></th>
                    <th scope="col" class="text-center">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(categoria, index) in categorias" :key="index">
                    <td scope="row">{{ categoria.id }}</td>
                    <td colspan="2">{{ categoria.nombre }}</td>
                    <td class="text-center">
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
  </div>
  <div v-else>
  Usted no tiene permiso para poder ver esta seccion
  </div>
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
      const { data } = await axios.get("categoria" , this.config);
      this.categorias = data;
    },

    async addCategorias() {
      const res = await axios.post("categoria", this.categoria , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("crearForm").reset();
        $("#crearModal").modal("hide");
        this.getCategorias();
        this.categoria = {};
      }
    },

    async editCategorias() {
      const res = await axios.put("categoria/"+this.slcCategoria.id, this.slcCategoria , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("editarForm").reset();
        $("#editarModal").modal("hide");
        this.getCategorias();
        this.categoria = {};
      }
    },

    async deleteCategorias() {
      const res = await axios.delete("categoria/"+this.slcCategoria.id , this.config);
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
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#e3342f',
        cancelButtonText: 'Cancelar'
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
  computed: {
    config(){
      let token = null;
      var match = document.cookie.match(new RegExp('(^| )' + 'XSRF-TOKEN' + '=([^;]+)'));
      if (match) {
        token = match[2];
      }
      else{
        return false;
      }
      return {
          headers: { Authorization: `${token}` }
      };
    }
  }
};
</script>
