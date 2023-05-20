<script setup>
//Imports
import { onMounted, provide, ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import AppSidebar from "@/Layouts/AppSidebar.vue";
import AppFooter from "@/Layouts/AppFooter.vue";
import AppHeader from "@/Layouts/AppHeader.vue";
import AppSettings from "@/Layouts/AppSettings.vue";
import Alerts from "@/Components/Global/Alerts.vue";
//Helpers
import {
  handleAside,
  handleSettings,
  handleColorSchemeToggle,
  handleHelpersToggle,
} from "@/Functions/helpers";

const props = defineProps({
  title: String,
});

const showHelpers = ref(handleHelpersToggle());

provide("showHelpers", showHelpers);

const toggleHelpers = (value) => {
  showHelpers.value = value;
};

onMounted(() => {
  handleAside();
  handleSettings();
  handleColorSchemeToggle();
});
</script>

<template>
  <Head :title="title" />
  <body
    class="min-h-screen overflow-hidden m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500"
  >
    <div class="absolute w-full dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <AppSidebar />
    <!-- end sidenav -->

    <main
      class="relative h-full transition-all duration-200 ease-in-out xl:ml-68 rounded-xl ps ps--active-y min-h-screen"
      id="main"
    >
      <AppHeader>
        <template #parent>
          <slot name="parent"></slot>
        </template>
        <template #subtitle>
          <slot name="subtitle"></slot>
        </template>
        <template #title>
          <slot name="title"></slot>
        </template>
      </AppHeader>
      <div class="w-full px-6 py-6 mx-auto">
        <slot :showHelpers="showHelpers"></slot>
      </div>
      <!-- App footer -->
      <AppFooter />
    </main>
    <div>
      <AppSettings
        @helpers:toggle="toggleHelpers"
        :userActivity="$page.props.userActivity"
      />
    </div>
    <Alerts />
  </body>
</template>
