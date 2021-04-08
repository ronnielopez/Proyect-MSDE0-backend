<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clinicas
            </h2>
        </template>
        <div v-if="$page.props.user.role === 'administrador'">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    >
                        <div class="row py-3 container">
                            <div class="col s12 text-right">
                                <a
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#crearModal"
                                    >Crear Clinica</a
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
                                            <th scope="col">Sub-Descripcion</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col" class="text-center">
                                                Accion
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(clinica, index) in clinicas"
                                            :key="index"
                                        >
                                            <td scope="row">
                                                {{ clinica.id }}
                                            </td>
                                            <td>{{ clinica.nombre }}</td>
                                            <td>
                                                {{ clinica.subDescripcion }}
                                            </td>
                                            <td>{{ clinica.descripcion }}</td>
                                            <td>
                                                {{
                                                    clinica.estado == 2
                                                        ? "Activo"
                                                        : "Desabilitado"
                                                }}
                                            </td>
                                            <td class="text-center">
                                                <a
                                                    type="button"
                                                    class="btn btn-info mr-4"
                                                    data-toggle="modal"
                                                    data-target="#editarModal"
                                                    @click="
                                                        selectedClinica(clinica)
                                                    "
                                                    >Editar</a
                                                >
                                                <a
                                                    type="button"
                                                    class="btn btn-warning mr-4 text-white"
                                                    data-toggle="modal"
                                                    data-target="#sucursales"
                                                    >Sucursales</a
                                                >
                                                <a
                                                    type="button"
                                                    class="btn btn-danger"
                                                    @click="
                                                        selectedClinica(
                                                            clinica
                                                        );
                                                        confirmDelete();
                                                    "
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
                                Crear una nueva Clinica
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
                            <form id="crearForm" @submit.prevent="addClinicas">
                                <div class="form-group">
                                    <label for="nombre"
                                        >Nombre de la Clinica</label
                                    >
                                    <input
                                        type="text"
                                        v-model="clinica.nombre"
                                        class="form-control"
                                        id="nombre"
                                        placeholder="Nombre"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input
                                        type="file"
                                        ref="logo"
                                        class="form-control-file"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="sub"
                                        >Sub descripcion de la clinica</label
                                    >
                                    <input
                                        type="text"
                                        v-model="clinica.subDescripcion"
                                        class="form-control"
                                        id="sub"
                                        placeholder="SubDescripcion"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="apr1">Precio minimo</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="clinica.apr1"
                                        class="form-control"
                                        id="apr1"
                                        placeholder="Aproximado minimo por consulta"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="apr2">Precio Maximo</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="clinica.apr2"
                                        class="form-control"
                                        id="apr2"
                                        placeholder="Aproximado maximo por consulta"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea
                                        class="form-control"
                                        id="descripcion"
                                        v-model="clinica.descripcion"
                                        rows="3"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <select
                                        v-model="clinica.userId"
                                        class="form-control"
                                        name="usuarios"
                                        id="usuarios"
                                    >
                                        <option selected disabled>
                                            Seleccione un Usuario
                                        </option>
                                        <option
                                            :value="y.id"
                                            v-for="y in user"
                                            :key="y.id"
                                        >
                                            {{ y.email }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="categorias">Categorias</label>
                                    <div class="row">
                                        <div
                                            v-for="y in categorias"
                                            class="col-sm-6"
                                        >
                                            <label class="pr-2">{{
                                                y.nombre
                                            }}</label>
                                            <input
                                                type="checkbox"
                                                v-model="clinica.categoriaId"
                                                :label="`${y.nombre}`"
                                                :value="y.id"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="categoria">Estado</label>
                                    <select
                                        v-model="clinica.estado"
                                        class="form-control"
                                        name="estado"
                                        id="estado"
                                    >
                                        <option selected disabled>
                                            Seleccione una estado
                                        </option>
                                        <option value="1">Desabilitado</option>
                                        <option value="2">Activo</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Crear Clinica
                                </button>
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
                                Modificar una Clinica
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
                            <form
                                id="editarForm"
                                @submit.prevent="editClinicas"
                            >
                                <div class="form-group">
                                    <label for="nombre"
                                        >Nombre de la Clinica</label
                                    >
                                    <input
                                        type="text"
                                        v-model="slcClinicas.nombre"
                                        class="form-control"
                                        id="nombre"
                                        placeholder="Nombre"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input
                                        type="file"
                                        ref="logoedit"
                                        class="form-control-file"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="sub"
                                        >Sub descripcion de la clinica</label
                                    >
                                    <input
                                        type="text"
                                        v-model="slcClinicas.subDescripcion"
                                        class="form-control"
                                        id="sub"
                                        placeholder="SubDescripcion"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="apr1">Precio minimo</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="slcClinicas.apr1"
                                        class="form-control"
                                        id="apr1"
                                        placeholder="Aproximado minimo por consulta"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="apr2">Precio Maximo</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="slcClinicas.apr2"
                                        class="form-control"
                                        id="apr2"
                                        placeholder="Aproximado maximo por consulta"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea
                                        class="form-control"
                                        id="descripcion"
                                        v-model="slcClinicas.descripcion"
                                        rows="3"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <select
                                        v-model="slcClinicas.userId"
                                        class="form-control"
                                        name="usuarios"
                                        id="usuarios"
                                    >
                                        <option selected disabled>
                                            Seleccione un Usuario
                                        </option>
                                        <option
                                            :value="y.id"
                                            v-for="y in user"
                                            :key="y.id"
                                        >
                                            {{ y.email }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="categorias">Categorias</label>
                                    <div class="row">
                                        <div
                                            v-for="y in categorias"
                                            class="col-sm-6"
                                        >
                                            <label class="pr-2">{{
                                                y.nombre
                                            }}</label>
                                            <input
                                                type="checkbox"
                                                v-model="
                                                    slcClinicas.categoriaId
                                                "
                                                :label="`${y.nombre}`"
                                                :value="y.id"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="categoria">Estado</label>
                                    <select
                                        v-model="slcClinicas.estado"
                                        class="form-control"
                                        name="estado"
                                        id="estado"
                                    >
                                        <option selected disabled>
                                            Seleccione una estado
                                        </option>
                                        <option value="1">Desabilitado</option>
                                        <option value="2">Activo</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning">
                                    Editar clinicas
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End modal editar de categoria-->

            <!--Modal editar de categoria-->
            <div
                class="modal fade"
                id="sucursales"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Todas tus sucursales
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
                            <a
                                type="button"
                                class="btn btn-primary my-2"
                                v-if="crearSucbtn == false"
                                @click="
                                    crearSuc = true;
                                    crearSucbtn = true;
                                    editarSucSec = true;
                                "
                                >Crear sucursal</a
                            >
                            <div class="row">
                                <div class="col 12">
                                    <table
                                        class="table"
                                        v-if="editarSucSec === false"
                                    >
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th
                                                    scope="col"
                                                    class="text-center"
                                                >
                                                    Accion
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    sucursal, index
                                                ) in sucursales"
                                                :key="index"
                                            >
                                                <td scope="row">
                                                    {{ sucursal.id }}
                                                </td>
                                                <td>{{ sucursal.nombre }}</td>
                                                <td class="text-center">
                                                    <a
                                                        type="button"
                                                        class="btn btn-info mr-4"
                                                        @click="
                                                            editarSucSec = true;
                                                            crearSucbtn = true;
                                                            selectedSucursal(
                                                                sucursal
                                                            );
                                                        "
                                                        >Editar</a
                                                    >
                                                    <a
                                                        type="button"
                                                        class="btn btn-danger"
                                                        @click=""
                                                        >Eliminar</a
                                                    >
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div v-else-if="crearSuc">
                                        <button
                                            type="button"
                                            class="close"
                                            @click="
                                                crearSuc = false;
                                                crearSucbtn = false;
                                                editarSucSec = false;
                                            "
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                        <form
                                            id="editarForm"
                                            @submit.prevent="addSucursal"
                                        >
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Nombre de la
                                                    Sucursal</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="sucursal.nombre"
                                                    class="form-control"
                                                    id="nombre"
                                                    placeholder="Nombre"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="ubicacion"
                                                    >Ubicacion</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="sucursal.ubicacion"
                                                    class="form-control"
                                                    id="ubicacion"
                                                    placeholder="Ubicacion"
                                                />
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Puntos de Referencia
                                                    (opcional)</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        sucursal.puntosReferencia
                                                    "
                                                    class="form-control"
                                                    id="puntosReferencia"
                                                    placeholder="puntosRef"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Hora de Entrada de L a
                                                    V</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="sucursal.horarioI"
                                                    class="form-control"
                                                    id="horarioI"
                                                    placeholder="9:00 am"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Hora de Salida de L a
                                                    V</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="sucursal.horarioF"
                                                    class="form-control"
                                                    id="horarioF"
                                                    placeholder="5:00 pm"
                                                />
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Telefono</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="sucursal.telefono"
                                                    class="form-control"
                                                    id="telefono"
                                                    placeholder="2222-8888"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Municipio</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="sucursal.municipio"
                                                    class="form-control"
                                                    id="municipio"
                                                    placeholder=""
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Departamento</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        sucursal.departamento
                                                    "
                                                    class="form-control"
                                                    id="departamento"
                                                    placeholder=""
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion"
                                                    >Descripcion</label
                                                >
                                                <textarea
                                                    class="form-control"
                                                    id="descripcion"
                                                    v-model="
                                                        sucursal.descripcion
                                                    "
                                                    rows="3"
                                                ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="clinica"
                                                    >Clinica</label
                                                >
                                                <select
                                                    v-model="sucursal.clinicaId"
                                                    class="form-control"
                                                    name="clinicaId"
                                                    id="clinicaId"
                                                >
                                                    <option selected disabled>
                                                        Seleccione una Clinica
                                                    </option>
                                                    <option
                                                        :value="y.id"
                                                        v-for="y in clinicas"
                                                        :key="y.id"
                                                    >
                                                        {{ y.nombre }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria"
                                                    >Estado</label
                                                >
                                                <select
                                                    v-model="sucursal.estado"
                                                    class="form-control"
                                                    name="estado"
                                                    id="estado"
                                                >
                                                    <option selected disabled>
                                                        Seleccione una estado
                                                    </option>
                                                    <option value="1">
                                                        Desabilitado
                                                    </option>
                                                    <option value="2">
                                                        Activo
                                                    </option>
                                                </select>
                                            </div>
                                            <button
                                                type="submit"
                                                class="btn btn-success"
                                            >
                                                Crear sucursal
                                            </button>
                                        </form>
                                    </div>
                                    <div v-else>
                                        <button
                                            type="button"
                                            class="close"
                                            @click="
                                                crearSucbtn = false;
                                                editarSucSec = false;
                                            "
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                        <form
                                            id="editarForm"
                                            @submit.prevent="editSucursal"
                                        >
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Nombre de la
                                                    Sucursal</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="slcSucursal.nombre"
                                                    class="form-control"
                                                    id="nombre"
                                                    placeholder="Nombre"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="ubicacion"
                                                    >Ubicacion</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.ubicacion
                                                    "
                                                    class="form-control"
                                                    id="ubicacion"
                                                    placeholder="Ubicacion"
                                                />
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Puntos de Referencia
                                                    (opcional)</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.puntosReferencia
                                                    "
                                                    class="form-control"
                                                    id="puntosReferencia"
                                                    placeholder="puntosRef"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Hora de Entrada de L a
                                                    V</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.horarioI
                                                    "
                                                    class="form-control"
                                                    id="horarioI"
                                                    placeholder="9:00 am"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Hora de Salida de L a
                                                    V</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.horarioF
                                                    "
                                                    class="form-control"
                                                    id="horarioF"
                                                    placeholder="5:00 pm"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Telefono</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.telefono
                                                    "
                                                    class="form-control"
                                                    id="telefono"
                                                    placeholder="2222-8888"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Municipio</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.municipio
                                                    "
                                                    class="form-control"
                                                    id="municipio"
                                                    placeholder=""
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre"
                                                    >Departamento</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="
                                                        slcSucursal.departamento
                                                    "
                                                    class="form-control"
                                                    id="departamento"
                                                    placeholder=""
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion"
                                                    >Descripcion</label
                                                >
                                                <textarea
                                                    class="form-control"
                                                    id="descripcion"
                                                    v-model="
                                                        slcSucursal.descripcion
                                                    "
                                                    rows="3"
                                                ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="clinica"
                                                    >Clinica</label
                                                >
                                                <select
                                                    v-model="
                                                        slcSucursal.clinicaId
                                                    "
                                                    class="form-control"
                                                    name="clinicaId"
                                                    id="clinicaId"
                                                >
                                                    <option selected disabled>
                                                        Seleccione una Clinica
                                                    </option>
                                                    <option
                                                        :value="y.id"
                                                        v-for="y in clinicas"
                                                        :key="y.id"
                                                    >
                                                        {{ y.nombre }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria"
                                                    >Estado</label
                                                >
                                                <select
                                                    v-model="slcSucursal.estado"
                                                    class="form-control"
                                                    name="estado"
                                                    id="estado"
                                                >
                                                    <option selected disabled>
                                                        Seleccione una estado
                                                    </option>
                                                    <option value="1">
                                                        Desabilitado
                                                    </option>
                                                    <option value="2">
                                                        Activo
                                                    </option>
                                                </select>
                                            </div>
                                            <button
                                                type="submit"
                                                class="btn btn-warning text-white"
                                            >
                                                Editar sucursal
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End modal editar de categoria-->
        </div>
        <div v-else>Usted no tiene permiso para poder ver esta seccion</div>
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
            clinicas: [],
            user: [],
            categorias: [],
            editarSuc: false,
            editarSucSec: false,
            crearSuc: false,
            crearSucbtn: false,
            sucursales: [],
            sucursal: {
                nombre: "",
                ubicacion: "",
                puntosReferencia: "",
                horarioI: "",
                horarioF: "",
                descripcion: "",
                telefono: "",
                municipio: "",
                departamento: "",
                clinicaId: "",
                estado: "",
            },
            clinica: {
                nombre: "",
                logo: "",
                subDescripcion: "",
                descripcion: "",
                apr1: "",
                apr2: "",
                userId: "",
                categoriaId: [],
                estado: "",
            },
            slcClinicas: {},
            slcSucursales: {},
        };
    },
    methods: {
        async getClinicas() {
            const { data } = await axios.get("clinica", this.config);
            this.clinicas = data;
        },
        async getUsuarios() {
            const { data } = await axios.get("usuario", this.config);
            this.user = data;
        },
        async getCategorias() {
            const { data } = await axios.get("categoria", this.config);
            this.categorias = data;
        },
        async getSucursales() {
            const { data } = await axios.get("sucursal", this.config);
            this.sucursales = data;
        },

        async addClinicas() {
            this.clinica.categoriaId = JSON.stringify(this.clinica.categoriaId);
            let data = this.FormData(this.clinica);
            let logo = this.$refs.logo.files[0];
            console.log(logo);
            data.append("logo", logo);
            const res = await axios.post("clinica", data, this.config);
            if (res.status === 201) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });

                document.getElementById("crearForm").reset();
                $("#crearModal").modal("hide");
                this.getClinicas();
                this.getUsuarios();
                this.getCategorias();
                this.getSucursales();
                this.clinica = {};
            }
        },
        FormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
        async addSucursal() {
            const res = await axios.post(
                "sucursal",
                this.sucursal,
                this.config2
            );
            if (res.status === 201) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });
                this.getClinicas();
                this.getUsuarios();
                this.getCategorias();
                this.getSucursales();
                this.sucursal = {};
            }
        },
        async editClinicas() {
            const res = await axios.put(
                "clinica/" + this.slcClinicas.id,
                this.slcClinicas,
                this.config
            );
            if (res.status === 201) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });

                document.getElementById("editarForm").reset();
                $("#editarModal").modal("hide");
                this.getClinicas();
                this.getUsuarios();
                this.getCategorias();
                this.getSucursales();
                this.clinica = {};
            }
        },
        async editSucursal() {
            const res = await axios.put(
                "sucursal/" + this.slcSucursal.id,
                this.slcSucursal,
                this.config2
            );
            if (res.status === 201) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });

                this.getClinicas();
                this.getUsuarios();
                this.getCategorias();
                this.getSucursales();
                this.clinica = {};
            }
        },

        async deleteClinica() {
            const res = await axios.delete(
                "clinica/" + this.slcClinicas.id,
                this.config
            );
            if (res.status === 201) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });
            }
        },
        async deleteSucursal() {
            const res = await axios.delete(
                "sucursal/" + this.slcSucursal.id,
                this.config2
            );
            if (res.status === 201) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });
            }
        },

        selectedClinica(clinica) {
            let notReactive = JSON.stringify(clinica);
            this.slcClinicas = JSON.parse(notReactive);
            this.slcClinicas.categoriaId = JSON.parse(
                this.slcClinicas.categoriaId
            );
        },
        selectedSucursal(sucursal) {
            let notReactive = JSON.stringify(sucursal);
            this.slcSucursal = JSON.parse(notReactive);
        },

        confirmDelete: function () {
            Toast.fire({
                icon: "warning",
                text: "Esta seguro que desea eliminar el registro?",
                showCancelButton: true,
                confirmButtonText: "Eliminar",
                confirmButtonColor: "#e3342f",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteClinica();
                    this.getClinicas();
                    this.getUsuarios();
                    this.getCategorias();
                }
            });
        },
    },
    created() {
        this.getClinicas();
        this.getUsuarios();
        this.getCategorias();
        this.getSucursales();
    },
    computed: {
        config() {
            let token = null;
            var match = document.cookie.match(
                new RegExp("(^| )" + "XSRF-TOKEN" + "=([^;]+)")
            );
            if (match) {
                token = match[2];
            } else {
                return false;
            }
            return {
                headers: {
                    Authorization: `${token}`,
                    "Content-Type": "multipart/form-data",
                },
            };
        },
        config2() {
            let token = null;
            var match = document.cookie.match(
                new RegExp("(^| )" + "XSRF-TOKEN" + "=([^;]+)")
            );
            if (match) {
                token = match[2];
            } else {
                return false;
            }
            return {
                headers: {
                    Authorization: `${token}`,
                },
            };
        },
    },
};
</script>
