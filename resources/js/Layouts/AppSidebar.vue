<script setup>
import { router, Link } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import SidebarDropdown from "@/Components/Global/SidebarDropdown.vue";

const switchToTeam = (team) => {
  router.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};
</script>
<template>
  <aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0 ps shadow-xl"
    aria-expanded="false"
  >
    <div class="h-19">
      <i
        class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
        sidenav-close
      ></i>
      <a
        class="flex items-center text-left px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
        target="_blank"
      >
        <ApplicationMark class="inline mr-2 h-7 w-auto" />
        <span
          class="ml-1 text-lg font-semibold transition-all duration-200 ease-nav-brand"
          >sumART.ai</span
        >
      </a>
    </div>

    <hr
      class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
    />

    <div
      class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full"
    >
      <ul class="list-none flex flex-col pl-0 mb-0">
        <li class="w-full mt-4">
          <h6
            class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60"
          >
            Dashboard
          </h6>
        </li>
        <li class="mt-0.5 w-full">
          <Link
            class="nav-link ease-nav-brand"
            :class="{ active: $page.url.startsWith('/dashboard') }"
            href="/dashboard"
          >
            <div
              class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-1.5"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-align-box-top-center"
                width="30"
                height="30"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path
                  d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"
                ></path>
                <path d="M9 9v-2"></path>
                <path d="M12 13v-6"></path>
                <path d="M15 11v-4"></path>
              </svg>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease"
              >Dashboard</span
            >
          </Link>
        </li>

        <li class="w-full mt-4">
          <h6
            class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60"
          >
            Account
          </h6>
        </li>
        <li class="mt-0.5 w-full">
          <Link
            class="nav-link ease-nav-brand"
            :class="{ active: $page.url.startsWith('/user/profile') }"
            :href="route('profile.show')"
          >
            <div
              class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-1.5"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-user-circle"
                width="30"
                height="30"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                <path
                  d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"
                ></path>
              </svg>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease"
              >Profile</span
            >
          </Link>
        </li>
      </ul>
    </div>

    <div class="mx-4">
      <!-- load phantom colors for card after: -->
      <div
        class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"
        sidenav-card
      >
        <img
          class="w-1/2 mx-auto"
          src="/assets/img/illustrations/icon-documentation.svg"
          alt="sidebar illustrations"
        />
        <div class="flex-auto w-full p-4 pt-0 text-center">
          <div class="transition-all duration-200 ease-nav-brand">
            <h6 class="mb-0 dark:text-white text-slate-700">Need help?</h6>
            <p
              class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60"
            >
              Please check our docs
            </p>
          </div>
        </div>
      </div>
      <a
        href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/"
        target="_blank"
        class="inline-block w-full px-8 py-2 mb-4 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-slate-700 bg-150 hover:shadow-xs hover:-translate-y-px"
        >Documentation</a
      >
      <!-- pro btn  -->
      <a
        class="inline-block w-full px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md select-none bg-150 bg-x-25 hover:shadow-xs hover:-translate-y-px"
        href="https://www.creative-tim.com/product/argon-dashboard-pro-tailwind?ref=sidebarfree"
        target="_blank"
        >Upgrade to pro</a
      >
    </div>
  </aside>
</template>