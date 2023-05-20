<script setup>
import CategoryIcon from "@/Components/Icons/CategoryIcon.vue";
</script>
<template>
  <!-- Navbar -->
  <nav
    class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main
    navbar-scroll="false"
  >
    <div
      class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit"
    >
      <nav>
        <!-- breadcrumb -->
        <ol
          class="list-none flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16"
        >
          <li
            class="text-sm leading-normal dark:text-white text-gray-900 opacity-50"
          >
            <slot name="parent"></slot>
          </li>
          <li
            class="text-sm pl-2 capitalize leading-normal dark:text-white text-gray-900 before:float-left before:pr-2 dark:before:text-white before:text-gray-900 before:content-['/']"
            aria-current="page"
          >
            <slot name="title"></slot>
          </li>
        </ol>
        <h6 class="mb-0 font-bold dark:text-white text-gray-900 capitalize">
          <slot name="subtitle"></slot>
        </h6>
      </nav>

      <div
        class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto"
      >
        <div class="flex items-center md:ml-auto md:pr-4">
          <!-- Serach input place -->
        </div>
        <ul
          class="list-none flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full"
        >
          <li class="flex items-center">
            <a
              settings-button
              href="javascript:;"
              class="p-0 text-sm dark:text-white text-gray-900 transition-all ease-nav-brand hover:text-primary dark:hover:text-info px-4 py-2"
            >
              <CategoryIcon />
              <!-- fixed-plugin-button-nav  -->
            </a>
          </li>
          <li class="flex items-center pl-4 xl:hidden">
            <a
              href="javascript:;"
              class="block p-0 text-sm text-white transition-all ease-nav-brand"
              sidenav-trigger
            >
              <div class="w-4.5 overflow-hidden">
                <i
                  class="ease mb-0.75 relative block h-0.5 rounded-sm dark:bg-white bg-gray-900 transition-all"
                ></i>
                <i
                  class="ease mb-0.75 relative block h-0.5 rounded-sm dark:bg-white bg-gray-900 transition-all"
                ></i>
                <i
                  class="ease relative block h-0.5 rounded-sm dark:bg-white bg-gray-900 transition-all"
                ></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- end Navbar -->
</template>