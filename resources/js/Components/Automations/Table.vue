<script setup>
import { router, Link } from "@inertiajs/vue3";
const props = defineProps({
  data: Array,
});

const emit = defineEmits(["row:delete"]);

const deleteRow = (row) => {
  emit("row:delete", row);
};
</script>
<template>
  <div
    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
  >
    <div class="flex-auto px-0 pt-0 pb-2 overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Frequency</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in data" :key="row.id">
            <td scope="row">
              {{ row.name }}
            </td>
            <td scope="row">
              {{ row.frequency }}
            </td>
            <td scope="row">
              <button @click="deleteRow(row)" class="btn btn-sm btn-error">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-trash"
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
                  <path d="M4 7l16 0"></path>
                  <path d="M10 11l0 6"></path>
                  <path d="M14 11l0 6"></path>
                  <path
                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                  ></path>
                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl"></div>
</template>