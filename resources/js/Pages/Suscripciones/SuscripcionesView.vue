<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Suscripciones
      </h2>
    </template>
  <div v-if="$page.props.user.role === 'administrador'">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="row py-3 container">
            <div class="col s12 text-right" v-if="contador != 3">
              <a
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#crearModal"
                >Crear suscripcion</a
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
                    <th scope="col">Subtitulo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col" class="text-center">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(suscripcion, index) in suscripciones" :key="index">
                    <td scope="row">{{ suscripcion.id }}</td>
                    <td>{{ suscripcion.nombre }}</td>
                    <td>{{ suscripcion.subtitulo }}</td>
                    <td>{{ suscripcion.precio }}</td>
                    <td>{{ suscripcion.descripcion }}</td>
                    <td class="text-center">
                      <a
                        type="button"
                        class="btn btn-info mr-4"
                        data-toggle="modal"
                        data-target="#editarModal"
                        @click="selectedSuscripcion(suscripcion)"
                        >Editar</a
                      >
                      <a
                        type="button"
                        class="btn btn-danger"
                        @click="selectedSuscripcion(suscripcion); confirmDelete();"
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
              Crear una nueva suscripcion
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
            <form id="crearForm" @submit.prevent="addSuscripcion">
              <div class="form-group">
                <label for="nombre">Nombre de la suscripcion</label>
                <input
                  type="text"
                  v-model="suscripcion.nombre"
                  class="form-control"
                  id="nombre"
                  placeholder="Suscripcion"
                />
              </div>
              <div class="form-group">
                <label for="sub">Subtitulo de la suscripcion</label>
                <input
                  type="text"
                  v-model="suscripcion.subtitulo"
                  class="form-control"
                  id="sub"
                  placeholder="Subtitulo"
                />
              </div>
              <div class="form-group">
                <label for="precio">Precio</label>
                <input
                  type="number"
                  step="0.01"
                  v-model="suscripcion.precio"
                  class="form-control"
                  id="precio"
                  placeholder="precio"
                />
              </div>
               <div class="form-group">
                <label for="nombre">Beneficio 1</label>
                <input
                  type="text"
                  v-model="suscripcion.beneficio1"
                  class="form-control"
                  id="beneficio1"
                  placeholder="Beneficio 1"
                />
              </div>
              <div class="form-group">
                <label for="nombre">Beneficio 2</label>
                <input
                  type="text"
                  v-model="suscripcion.beneficio2"
                  class="form-control"
                  id="beneficio2"
                  placeholder="Beneficio 2"
                />
              </div>
              <div class="form-group">
                <label for="nombre">Beneficio 3</label>
                <input
                  type="text"
                  v-model="suscripcion.beneficio3"
                  class="form-control"
                  id="beneficio3"
                  placeholder="Beneficio 3"
                />
              </div>
              <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" 
                id="descripcion" 
                v-model="suscripcion.descripcion" 
                rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Crear suscripcion</button>
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
              Modificar una suscripcion
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
            <form id="editarForm" @submit.prevent="editSuscripciones">
              <div class="form-group">
                <label for="nombre">Nombre de la suscripcion</label>
                <input
                  type="text"
                  v-model="slcSuscripcion.nombre"
                  class="form-control"
                  id="nombre"
                  placeholder="Suscripcion"
                />
              </div>
              <div class="form-group">
                <label for="sub">Subtitulo de la suscripcion</label>
                <input
                  type="text"
                  v-model="slcSuscripcion.subtitulo"
                  class="form-control"
                  id="sub"
                  placeholder="Subtitulo"
                />
              </div>
              <div class="form-group">
                <label for="precio">Precio</label>
                <input
                  type="number"
                  step="0.01"
                  v-model="slcSuscripcion.precio"
                  class="form-control"
                  id="precio"
                  placeholder="precio"
                />
              </div>
              <div class="form-group">
                <label for="nombre">Beneficio 1</label>
                <input
                  type="text"
                  v-model="slcSuscripcion.beneficio1"
                  class="form-control"
                  id="beneficio1"
                  placeholder="Beneficio 1"
                />
              </div>
              <div class="form-group">
                <label for="nombre">Beneficio 2</label>
                <input
                  type="text"
                  v-model="slcSuscripcion.beneficio2"
                  class="form-control"
                  id="beneficio2"
                  placeholder="Beneficio 2"
                />
              </div>
              <div class="form-group">
                <label for="nombre">Beneficio 3</label>
                <input
                  type="text"
                  v-model="slcSuscripcion.beneficio3"
                  class="form-control"
                  id="beneficio3"
                  placeholder="Beneficio 3"
                />
              </div>
              <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" 
                id="descripcion" 
                v-model="slcSuscripcion.descripcion" 
                rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-warning">Editar suscripcion</button>
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
      suscripciones: [],
      contador: 0 ,
      suscripcion: {
        nombre: "",
        subtitulo:"",
        precio:"",
        descripcion:"",
        beneficio1:"",
        beneficio2:"",
        beneficio3:"",
      },
      slcSuscripcion: {},
    };
  },
  methods: {
    async getSuscripciones() {
      const { data } = await axios.get("suscripcion" , this.config);
      this.suscripciones = data;
      this.contador = this.suscripciones.length;
    },

    async addSuscripcion() {
      const res = await axios.post("suscripcion", this.suscripcion , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("crearForm").reset();
        $("#crearModal").modal("hide");
        this.getSuscripciones();
        this.suscripcion = {};
      }
    },

    async editSuscripciones() {
      const res = await axios.put("suscripcion/"+this.slcSuscripcion.id, this.slcSuscripcion, this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("editarForm").reset();
        $("#editarModal").modal("hide");
        this.getSuscripciones();
        this.suscripcion = {};
      }
    },

    async deleteSuscripcion() {
      const res = await axios.delete("suscripcion/"+this.slcSuscripcion.id , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });
      }
    },

    selectedSuscripcion(suscripcion){
      let notReactive = JSON.stringify(suscripcion);
      this.slcSuscripcion = JSON.parse(notReactive);
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
            this.deleteSuscripcion();
            this.getSuscripciones();
          }
      });
    }
  },
  created() {
    this.getSuscripciones();
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
