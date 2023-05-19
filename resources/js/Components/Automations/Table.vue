<script setup>
import { router, Link } from "@inertiajs/vue3";
import { formatDateTime } from "@/Functions/helpers";

import ContextMenu from "@/Components/Global/ContextMenu.vue";
import TrashIcon from "@/Components/Icons/TrashIcon.vue";
import CopyIcon from "@/Components/Icons/CopyIcon.vue";
import EditIcon from "@/Components/Icons/EditIcon.vue";
import ViewIcon from "@/Components/Icons/ViewIcon.vue";

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
    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border max-w-7xl mx-auto"
  >
    <div class="flex-auto px-0 pt-0 pb-2 overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Frequency</th>
            <th scope="col" class="px-6 py-3">Updated at</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in data" :key="row.id">
            <td scope="row">
              <Link class="link" :href="'/automations/' + row.hash">{{
                row.name
              }}</Link>
            </td>
            <td scope="row">
              {{ row.frequency }}
            </td>
            <td scope="row">
              {{ formatDateTime(row.updated_at) }}
            </td>
            <td class="relative" scope="row">
              <ContextMenu>
                <Link
                  :href="'/automations/' + row.hash"
                  class="w-full text-left py-2 px-3 hover:dark:bg-slate-600 hover:bg-slate-200 hover:text-primary transition-colors rounded-xl"
                >
                  <ViewIcon /><span class="ml-1">View</span>
                </Link>
                <Link
                  :href="'/automations/' + row.hash + '/edit'"
                  class="w-full text-left py-2 px-3 hover:dark:bg-slate-600 hover:bg-slate-200 hover:text-warning transition-colors rounded-xl"
                >
                  <EditIcon /><span class="ml-1">Edit</span>
                </Link>
                <button
                  @click="duplicate(row)"
                  class="w-full text-left py-2 px-3 hover:dark:bg-slate-600 hover:bg-slate-200 hover:text-info transition-colors rounded-xl"
                >
                  <CopyIcon /><span class="ml-1">Duplicate</span>
                </button>
                <button
                  @click="deleteRow(row)"
                  class="w-full text-left py-2 px-3 hover:dark:bg-slate-600 hover:bg-slate-200 hover:text-error transition-colors rounded-xl"
                >
                  <TrashIcon /><span class="ml-1">Delete</span>
                </button>
              </ContextMenu>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>