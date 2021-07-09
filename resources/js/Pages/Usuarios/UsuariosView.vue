<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Usuarios
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
                >Crear usuario</a
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
                    <th scope="col">Email</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Rol</th>
                    <th scope="col" class="text-center">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(usuario, index) in usuarios" :key="index" >
                    <td scope="row">{{ usuario.id }}</td>
                    <td>{{ usuario.name }}</td>
                    <td>{{ usuario.email }}</td>
                    <td v-if="usuario.estado === '1'" class='text-primary'>Paciente</td>
                    <td v-else-if="usuario.estado === '2'" class='text-success'>Completo</td>
                    <td v-else-if="usuario.estado === '3'" class='text-muted'>Standar</td>
                    <td v-else-if="usuario.estado === '4'" class='text-warning'>Gold</td>
                    <td v-else="usuario.estado === '5'" class='text-danger'>Premium</td>
                    <td>{{ usuario.role }}</td>
                    <td class="text-center">
                      <a
                        type="button"
                        class="btn btn-info mr-4"
                        data-toggle="modal"
                        data-target="#editarModal"
                        @click="selectedUsuario(usuario)"
                        >Editar</a
                      >
                      <a
                        v-if="$page.props.user.id != usuario.id"
                        type="button"
                        class="btn btn-danger"
                        @click="selectedUsuario(usuario); confirmDelete();"
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
              Crear un nuevo usuario
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
            <form id="crearForm" @submit.prevent="addUsuario">
              <div class="form-group">
                <label for="nombre">Nombre de usuario</label>
                <input
                  type="text"
                  v-model="usuario.name"
                  class="form-control"
                  id="nombre"
                  placeholder="Nombre"
                />
              </div>
              <div class="form-group">
                <label for="email">Correo electronico</label>
                <input
                  type="text"
                  v-model="usuario.email"
                  class="form-control"
                  id="email"
                  placeholder="Email"
                />
              </div>
              <div class="form-group">
                <label for="email">Contraseña</label>
                <input
                  type="password"
                  v-model="usuario.password"
                  class="form-control"
                  id="password"
                  placeholder="Contraseña"
                />
              </div>
              <div class="form-group">
              <label for="estado">Estado</label>
                <select v-model="usuario.estado" class="form-control" name="estado" id="estado">
                  <option selected disabled>Seleccione un estado</option>
                  <option value="1">Incompleto</option>
                  <option value="2">Completo</option>
                  <option value="3">Estandar</option>
                  <option value="4">Gold</option>
                  <option value="5">Premium</option>
                </select>
              </div>
              <div class="form-group">
              <label for="rubro">Rol</label>
                <select v-model="usuario.role" class="form-control" name="rol" id="rol">
                  <option selected disabled>Seleccione un rol</option>
                  <option value="administrador">Administrador</option>
                  <option value="cliente">Cliente</option>
                </select>
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
              Modificar usuario
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
            <form id="editarForm" @submit.prevent="editUsuario">
              <div class="form-group">
                <label for="nombre">Nombre de usuario</label>
                <input
                  type="text"
                  v-model="slcUsuario.name"
                  class="form-control"
                  id="nombre"
                  placeholder="Nombre"
                />
              </div>
              <div class="form-group">
                <label for="email">Correo electronico</label>
                <input
                  type="text"
                  v-model="slcUsuario.email"
                  class="form-control"
                  id="email"
                  placeholder="Email"
                />
              </div>
              <div class="form-group">
                <label for="email">Contraseña</label>
                <input
                  type="password"
                  v-model="slcUsuario.password"
                  class="form-control"
                  id="password"
                  placeholder="Contraseña"
                />
              </div>
              <div class="form-group">
              <label for="estado">Estado</label>
                <select v-model="slcUsuario.estado" class="form-control" name="estado" id="estado">
                  <option selected disabled>Seleccione un estado</option>
                  <option value="1">Paciente</option>
                  <option value="2">Completo</option>
                  <option value="3">Estandar</option>
                  <option value="4">Gold</option>
                  <option value="5">Premium</option>
                </select>
              </div>
              <div class="form-group">
              <label for="rubro">Rol</label>
                <select v-model="slcUsuario.role" class="form-control" name="rol" id="rol">
                  <option selected disabled>Seleccione un rol</option>
                  <option value="administrador">Administrador</option>
                  <option value="cliente">Cliente</option>
                </select>
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
      usuarios: [],
      usuario: {
        name: "",
        email: "",
        estado:"",
        password: "",
        role: ""
      },
      slcUsuario: {},
    };
  },
  methods: {
    async getUsuarios() {
      const { data } = await axios.get("usuario", this.config);
      this.usuarios = data;
    },

    async addUsuario() {
      const res = await axios.post("usuario", this.usuario , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("crearForm").reset();
        $("#crearModal").modal("hide");
        this.getUsuarios();
        this.usuarios = {};
      }
    },

    async editUsuario() {
      const res = await axios.put("usuario/" + this.slcUsuario.id, this.slcUsuario , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });

        document.getElementById("editarForm").reset();
        $("#editarModal").modal("hide");
        this.getUsuarios();
        this.usuarios = {};
      }
    },

    async deleteUsuario() {
      const res = await axios.delete("usuario/" + this.slcUsuario.id , this.config);
      if (res.status === 201) {
        Toast.fire({
          icon: "success",
          title: res.data,
        });
      }
    },

    selectedUsuario(usuario){
      let notReactive = JSON.stringify(usuario);
      this.slcUsuario = JSON.parse(notReactive);
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
            this.deleteUsuario();
            this.getUsuarios();
          }
      });
    }
  },
  created() {
    this.getUsuarios();
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
