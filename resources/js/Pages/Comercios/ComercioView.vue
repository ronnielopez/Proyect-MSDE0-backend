<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Comercios
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
                >Crear comercio</a
              >
            </div>
          </div>
          <div class="row">
            <div class="col 12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Rubro</th>
                    <th scope="col" class="text-center">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(comercio, index) in comercios" :key="index">
                    <td scope="row">{{ comercio.id }}</td>
                    <td>{{ comercio.nombre }}</td>
                    <td>{{ comercio.direccion }}</td>
                    <td>{{ comercio.telefono }}</td>
                    <td>{{ comercio.rubro }}</td>
                    <td class="text-center">
                      <a
                        type="button"
                        class="btn btn-info mr-4"
                        data-toggle="modal"
                        data-target="#editarModal"
                        @click="selectedComercio(comercio)"
                        >Editar</a
                      >
                      <a
                        type="button"
                        class="btn btn-danger"
                        @click="selectedComercio(comercio); confirmDelete();"
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
              Crear un nuevo comercio
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
            <form id="crearForm" @submit.prevent="addComercio">
              <div class="form-group">
                <label for="nombre">Nombre del comercio</label>
                <input
                  type="text"
                  v-model="comercio.nombre"
                  class="form-control"
                  id="nombre"
                  placeholder="Comercio"
                />
              </div>
              <div class="form-group">
                <label for="direccion">Direccion</label>
                <input
                  type="text"
                  v-model="comercio.direccion"
                  class="form-control"
                  id="direccion"
                  placeholder="Direccion"
                />
              </div>
              <div class="form-group">
                <label for="telefono">Telefono</label>
                <input
                  type="text"
                  v-model="comercio.telefono"
                  class="form-control"
                  id="telefono"
                  placeholder="Telefono"
                />
              </div>
              <div class="form-group">
              <label for="rubro">Rubro</label>
                <select v-model="comercio.rubro" class="form-control" name="categorias" id="categoriasSlc">
                  <option selected disabled>Seleccione un rubro</option>
                  <option :value="y.nombre" v-for="y in categorias" :key="y.id">{{y.nombre}}</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Crear comercio</button>
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
              Modificar un comercio
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
            <form id="editarForm" @submit.prevent="editComercio">
              <div class="form-group">
                <label for="nombre">Nombre del comercio</label>
                <input
                  type="text"
                  v-model="slcComercio.nombre"
                  class="form-control"
                  id="nombre"
                  placeholder="Comercio"
                />
              </div>
              <div class="form-group">
                <label for="direccion">Direccion</label>
                <input
                  type="text"
                  v-model="slcComercio.direccion"
                  class="form-control"
                  id="direccion"
                  placeholder="Direccion"
                />
              </div>
              <div class="form-group">
                <label for="telefono">Telefono</label>
                <input
                  type="text"
                  v-model="slcComercio.telefono"
                  class="form-control"
                  id="telefono"
                  placeholder="Telefono"
                />
              </div>
              <div class="form-group">
              <label for="rubro">Rubro</label>
                <select v-model="slcComercio.rubro" class="form-control" name="categorias" id="categoriasSlc">
                  <option selected disabled>Seleccione un rubro</option>
                  <option :value="y.nombre" v-for="y in categorias" :key="y.id">{{y.nombre}}</option>
                </select>
              </div>
              <button type="submit" class="btn btn-warning">Editar Comercio</button>
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
      comercios: [],
      categorias: [],
      comercio: {
        nombre: "",
        direccion:"",
        telefono:"",
        rubro:""
      },
       categoria: {
        nombre: "",
      },
      slcComercio: {},
    };
  },
  methods: {
    async getComercio() {
      /*const config = {
        headers: { Authorization: `Bearer 1|9vOuZx3R5eSc5rv7VpA0JKJUZUEOoK78lbMp9t2e` }
        };*/
      const { data } = await axios.get("comercios" , this.config);
      this.comercios = data;
    },
    async getCategorias() {
      const { data } = await axios.get("categoria" , this.config);
      this.categorias = data;
    },

    async addComercio() {
      const res = await axios.post("comercios", this.comercio , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("crearForm").reset();
        $("#crearModal").modal("hide");
        this.getComercio();
        this.comercio = {};
      }
    },

    async editComercio() {
      const res = await axios.put("comercios/"+this.slcComercio.id, this.slcComercio , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("editarForm").reset();
        $("#editarModal").modal("hide");
        this.getComercio();
        this.comercio = {};
      }
    },

    async deleteComercio() {
      const res = await axios.delete("comercios/"+this.slcComercio.id , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });
      }
    },

    selectedComercio(comercio){
      let notReactive = JSON.stringify(comercio);
      this.slcComercio = JSON.parse(notReactive);
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
            this.deleteComercio();
            this.getComercio();
            this.getCategorias();
          }
      });
    }
  },
  created() {
    this.getCategorias(),
    this.getComercio()
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
