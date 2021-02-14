<template>

<div>
<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-black sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button @click="menuOpen = !menuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!-- Icon when menu is closed. -->
          <!--
            Heroicon name: outline/menu

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Icon when menu is open. -->
          <!--
            Heroicon name: outline/x

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0 flex items-center">
          <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
          <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
        </div>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="text-gray-300 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
            <a href="#" class="text-gray-300 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Nosotros</a>
            <a href="#" class="text-gray-300 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Clinicas</a>
            <a href="#" class="text-gray-300 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Planes</a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

        <!-- Profile dropdown -->
        <div class="ml-3 relative">
          <div>
            <button @click="isOpen = !isOpen" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="http://assets.stickpng.com/images/585e4beacb11b227491c3399.png" alt="">
            </button>
          </div>
          <!--
            Profile dropdown panel, show/hide based on dropdown state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div v-show="isOpen">
          <transition
          enter-active-class= "transition ease-out duration-100"
              enter-from-class= "transform opacity-0 scale-95"
              enter-to-class= "transform opacity-100 scale-100"
            leave-active-class= "transition ease-in duration-75"
              leave-from-class= "transform opacity-100 scale-100"
              leave-to-class= "transform opacity-0 scale-95"
          >
          <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
            
            <div v-if="canLogin">
               <inertia-link v-if="$page.props.user" href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                Dashboard
              </inertia-link>
            <div v-else>
              <inertia-link :href="route('login')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                    Iniciar Sesion
              </inertia-link>

              <inertia-link v-if="canRegister" :href="route('register')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                    Registrar
              </inertia-link>
            </div>
           </div>

          </div>
          </transition>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--
    Mobile menu, toggle classes based on menu state.

    Menu open: "block", Menu closed: "hidden"
  -->
 
    <div :class="menuOpen ? 'hidden sm:hidden' : 'block'">
      <div class="px-2 pt-2 pb-3 space-y-1">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">Inicio</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Nosotros</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Clinicas</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Planes</a>
      </div>
     </div>

</nav>


<main>

      <div
        class="relative pt-16 pb-32 flex content-center items-center justify-center"
        style="min-height: 75vh;"
        >
        <div
          class="absolute top-0 w-full h-full bg-center bg-cover"
          style='background-image: url("https://wallpaperaccess.com/full/136995.jpg");'
        >
          <span
            id="blackOverlay"
            class="w-full h-full absolute opacity-75 bg-black"
          ></span>
        </div>
        <div class="container relative mx-auto">
          <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
              <div class="pr-12">
                <h1 class="text-white font-semibold text-5xl">
                  ALPHA-MEDICOS
                </h1>
                <p class="mt-4 text-lg text-gray-300">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pellentesque 
                ante vel felis dignissim, et fermentum sem mollis. Integer congue vehicula suscipit. 
                Vivamus tincidunt ipsum at semper sodales. Nulla facilisis,
                </p>
              </div>
            </div>
          </div>
        </div>
        <div
          class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
          style="height: 70px; transform: translateZ(0px);"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-gray-300 fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
      </div>
      <section class="pb-20 bg-gray-300 -mt-24">
        <div class="container mx-auto px-4">
          <div class="flex flex-wrap">
            <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400"
                  >
                    <i class="fas fa-award"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Servicio 1</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pellentesque 
                    ante vel felis dignissim, et fermentum sem mollis. Integer congue vehicula suscipit. 
                    Vivamus tincidunt ipsum at semper sodales. Nulla facilisis,
                  </p>
                </div>
              </div>
            </div>
            <div class="w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400"
                  >
                    <i class="fas fa-retweet"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Servicio 2</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Quisque pellentesque ante vel felis dignissim, et fermentum sem mollis. 
                    Integer congue vehicula suscipit. Vivamus tincidunt ipsum at semper sodales. 
                    Nulla facilisis,
                  </p>
                </div>
              </div>
            </div>
            <div class="pt-6 w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400"
                  >
                    <i class="fas fa-fingerprint"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Servicio 3</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque 
                    pellentesque ante vel felis dignissim, et fermentum sem mollis. Integer 
                    congue vehicula suscipit. Vivamus tincidunt ipsum at semper sodales. Nulla 
                    facilisis,
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap items-center mt-32">
            <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
              <div
                class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100"
              >
                <i class="fas fa-user-friends text-xl"></i>
              </div>
              <h3 class="text-3xl mb-2 font-semibold leading-normal">
                Nosotros
              </h3>
              <p
                class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700"
              >
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Quisque pellentesque ante vel felis dignissim, et fermentum sem mollis. 
                Integer congue vehicula suscipit. Vivamus tincidunt ipsum at semper sodales. 
                Nulla facilisis,
              </p>
              <p
                class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700"
              >
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Quisque pellentesque ante vel felis dignissim, et fermentum sem mollis. 
                Integer congue vehicula suscipit. Vivamus tincidunt ipsum at semper sodales. 
                Nulla facilisis,
              </p>
              <a
                href="https://www.creative-tim.com/learning-lab/tailwind-starter-kit#/presentation"
                class="font-bold text-gray-800 mt-8"
                >Empieza tu clinica ya!</a
              >
            </div>
            <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-pink-600"
              >
                <img
                  alt="..."
                  src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1051&amp;q=80"
                  class="w-full align-middle rounded-t-lg"
                />
                <blockquote class="relative p-8 mb-4">
                  <svg
                    preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 583 95"
                    class="absolute left-0 w-full block"
                    style="height: 95px; top: -94px;"
                  >
                    <polygon
                      points="-30,95 583,95 583,65"
                      class="text-pink-600 fill-current"
                    ></polygon>
                  </svg>
                  <h4 class="text-xl font-bold text-white">
                    Mision y Vision
                  </h4>
                  <p class="text-md font-light mt-2 text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Quisque pellentesque ante vel felis dignissim, et fermentum sem mollis. 
                Integer congue vehicula suscipit. Vivamus tincidunt ipsum at semper sodales. 
                Nulla facilisis,
                  </p>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </section>    

      <section class="relative py-20">
        <div
          class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
          style="height: 80px; transform: translateZ(0px);"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-white fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>

        <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Clinicas</h1>
      <p class="lg:w-1/2 w-full leading-relaxed text-base">Mas buscadas</p>
    </div>
    <div class="flex flex-wrap -m-4">
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <div class="border border-gray-300 p-6 rounded-lg">
          <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Clinica 1</h2>
          <p class="leading-relaxed text-base">Fingerstache flexitarian street art 8-bit waist co, subway tile poke farm.</p>
        </div>
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <div class="border border-gray-300 p-6 rounded-lg">
          <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Clinica 2</h2>
          <p class="leading-relaxed text-base">Fingerstache flexitarian street art 8-bit waist co, subway tile poke farm.</p>
        </div>
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <div class="border border-gray-300 p-6 rounded-lg">
          <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Clinica 3</h2>
          <p class="leading-relaxed text-base">Fingerstache flexitarian street art 8-bit waist co, subway tile poke farm.</p>
        </div>
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <div class="border border-gray-300 p-6 rounded-lg">
          <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Clinica 4</h2>
          <p class="leading-relaxed text-base">Fingerstache flexitarian street art 8-bit waist co, subway tile poke farm.</p>
        </div>
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <div class="border border-gray-300 p-6 rounded-lg">
          <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Clinica 5</h2>
          <p class="leading-relaxed text-base">Fingerstache flexitarian street art 8-bit waist co, subway tile poke farm.</p>
        </div>
      </div>
      <div class="xl:w-1/3 md:w-1/2 p-4">
        <div class="border border-gray-300 p-6 rounded-lg">
          <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Clinica 6</h2>
          <p class="leading-relaxed text-base">Fingerstache flexitarian street art 8-bit waist co, subway tile poke farm.</p>
        </div>
      </div>
    </div>
    <button class="flex mx-auto mt-16 text-white bg-black border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">Ver mas</button>
  </div>
</section>


<section class="pb-20 relative block bg-gray-900">
        <div
          class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
          style="height: 80px; transform: translateZ(0px);"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-gray-900 fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
     <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-white">Nuestros Planes</h1>
      <p class="lg:w-1/2 w-full leading-relaxed text-white">Escoge el que tu quieras</p>
    </div>   
    <div class='pricing pricing-palden'>
    <div class='pricing-item'>
      <div class='pricing-deco'>
        <div class='pricing-price'><span class='pricing-currency'>$</span>29
          <span class='pricing-period'>/ mo</span>
        </div>
        <h3 class='pricing-title'>Gratis</h3>
      </div>
      <ul class='pricing-feature-list'>
        <li class='pricing-feature'>Lorem ipsum</li>
        <li class='pricing-feature'>Lorem ipsum</li>
        <li class='pricing-feature'>Lorem ipsum</li>
      </ul>
      <button class='pricing-action'>Escoger este plan</button>
    </div>
    <div class='pricing-item pricing__item--featured'>
      <div class='pricing-deco'>        
        <div class='pricing-price'><span class='pricing-currency'>$</span>59
          <span class='pricing-period'>/ mo</span>
        </div>
        <h3 class='pricing-title'>Empresarial</h3>
      </div>
      <ul class='pricing-feature-list'>
        <li class='pricing-feature'>Lorem ipsum</li>
        <li class='pricing-feature'>Lorem ipsum</li>
        <li class='pricing-feature'>Lorem ipsum</li>
      </ul>
      <button class='pricing-action'>Escoger este plan</button>
    </div>
    <div class='pricing-item'>
      <div class='pricing-deco'>
        <div class='pricing-price'><span class='pricing-currency'>$</span>99
          <span class='pricing-period'>/ mo</span>
        </div>
        <h3 class='pricing-title'>Independiente</h3>
      </div>
      <ul class='pricing-feature-list'>
        <li class='pricing-feature'>Lorem ipsum</li>
        <li class='pricing-feature'>Lorem ipsum</li>
        <li class='pricing-feature'>Lorem ipsum</li>
      </ul>
      <button class='pricing-action'>Escoger este plan</button>
    </div>
  </div>
  </div>
</section>


<footer class="relative bg-gray-300 pt-8 pb-6">
    <div
      class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
      style="height: 80px; transform: translateZ(0px);"
    >
      <svg
        class="absolute bottom-0 overflow-hidden"
        xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="none"
        version="1.1"
        viewBox="0 0 2560 100"
        x="0"
        y="0"
      >
        <polygon
          class="text-gray-300 fill-current"
          points="2560 0 2560 100 0 100"
        ></polygon>
      </svg>
    </div>
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-3xl font-semibold">Visita nuestras redes sociales</h4>
          <h5 class="text-lg mt-0 mb-2 text-gray-700">
            Puedes encontrarnos en:
          </h5>
          <div class="mt-6">
            <button
              class="bg-white text-blue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
              type="button"
            >
              <i class="flex fab fa-twitter"></i></button
            ><button
              class="bg-white text-blue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
              type="button"
            >
              <i class="flex fab fa-facebook-square"></i></button
            ><button
              class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
              type="button"
            >
              <i class="flex fab fa-dribbble"></i></button
            ><button
              class="bg-white text-gray-900 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
              type="button"
            >
              <i class="flex fab fa-github"></i>
            </button>
          </div>
        </div>
      </div>
      <hr class="my-6 border-gray-400" />
      <div
        class="flex flex-wrap items-center md:justify-between justify-center"
      >
        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
          <div class="text-sm text-gray-600 font-semibold py-1">
            Copyright © {{date}} Alpha-Medic
          </div>
        </div>
      </div>
    </div>
  </footer>

</main>



</div>
</template>


<script>

    
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },
        data: () => ({
            isOpen: false,
            menuOpen: true,
            date: new Date().getFullYear()
        })
    }
</script>
