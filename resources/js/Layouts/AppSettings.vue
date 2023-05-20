<script setup>
import { onMounted, ref, defineEmits } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { handleHelpersToggle } from "@/Functions/helpers";
import DateFormatSelect from "@/Components/Global/DateFormatSelect.vue";
import ActivityLogList from "@/Components/Global/ActivityLogList.vue";

const emit = defineEmits(["helpers:toggle"]);
const helpersToggle = ref(null);

const activeTab = ref(null);

const props = defineProps({ userActivity: Array });

const initHelpersToggle = () => {
  helpersToggle.value.checked = handleHelpersToggle();
  helpersToggle.value.addEventListener("change", (event) => {
    const value = event.target.checked;
    localStorage.setItem("helpers-enabled", value);
    emit("helpers:toggle", value);
  });
};

const logout = () => {
  router.post(route("logout"));
};

onMounted(() => {
  initHelpersToggle();
});
</script>
<template>
  <div
    settings-bar
    class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200"
  >
    <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
      <div class="float-left">
        <h5 class="mt-4 mb-0 dark:text-white">Settings</h5>
        <p class="dark:text-white dark:opacity-80">See our apps options.</p>
      </div>
      <div class="float-right mt-6">
        <button
          settings-button-close
          class="inline-block p-0 mb-4 text-sm font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-x"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M18 6l-12 12"></path>
            <path d="M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr
      class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
    />
    <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4 ps">
      <div class="flex flex-col h-full justify-between">
        <div>
          <label class="flex my-4 hover:cursor-pointer">
            <h6 class="mb-0 dark:text-white">Dark mode</h6>
            <div class="block relative pl-0 ml-auto min-h-6">
              <input
                type="checkbox"
                id="theme-toggle"
                value=""
                class="sr-only peer"
              />
              <div class="form-toggle dark-mode peer">
                <svg
                  id="theme-toggle-dark-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-moon-stars stroke-gray-800 z-2 rounded-full shadow bg-white border-gray-300 absolute right-0.5 top-0.5"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"
                  ></path>
                  <path
                    d="M17 4a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2"
                  ></path>
                  <path d="M19 11h2m-1 -1v2"></path>
                </svg>
                <svg
                  id="theme-toggle-light-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-sun-high stroke-gray-800 rounded-full shadow bg-white border-gray-300 absolute left-0.5 top-0.5"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"
                  ></path>
                  <path d="M6.343 17.657l-1.414 1.414"></path>
                  <path d="M6.343 6.343l-1.414 -1.414"></path>
                  <path d="M17.657 6.343l1.414 -1.414"></path>
                  <path d="M17.657 17.657l1.414 1.414"></path>
                  <path d="M4 12h-2"></path>
                  <path d="M12 4v-2"></path>
                  <path d="M20 12h2"></path>
                  <path d="M12 20v2"></path>
                </svg>
              </div>
            </div>
          </label>
          <label class="flex my-4 hover:cursor-pointer">
            <h6 class="mb-0 dark:text-white">Show help</h6>
            <div class="block relative pl-0 ml-auto min-h-6">
              <input
                ref="helpersToggle"
                type="checkbox"
                value=""
                class="sr-only peer"
              />
              <div class="form-toggle peer"></div>
            </div>
          </label>
          <div>
            <h6 class="mb-0 dark:text-white">Date format</h6>
          </div>
          <div>
            <DateFormatSelect />
          </div>
          <ActivityLogList :activity="userActivity" />
        </div>
        <div>
          <div class="flex justify-center">
            <form @submit.prevent="logout">
              <button class="btn btn-primary text-white">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-logout inline mr-1"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"
                  ></path>
                  <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                </svg>
                Logout
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>