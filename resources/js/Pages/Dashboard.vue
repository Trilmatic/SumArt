<script setup>
import TomSelect from "tom-select/dist/js/tom-select.complete.min";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import Modal from "@/Components/Modal.vue";
import Tabs from "@/Components/Global/Tabs.vue";
import Tab from "@/Components/Global/Tab.vue";
import { nextTick, onMounted, ref } from "vue";
import { lookForList, actionsList } from "@/Functions/variables";

const showSumCreation = ref(false);

const initSelect = () => {
  const renderItem = (data, escape) => {
    return "<div>" + escape(data.name) + "</div>";
  };
  const lookInput = document.querySelector("#look");
  if (lookInput) {
    const renderItem = (data, escape) => {
      return "<div>" + escape(data.name) + "</div>";
    };
    new TomSelect(lookInput, {
      valueField: "value",
      searchField: "name",
      options: lookForList,
      maxItems: 1,
      render: {
        option: renderItem,
        item: renderItem,
      },
    });
  }
  const actionInput = document.querySelector("#action");
  if (actionInput) {
    new TomSelect(actionInput, {
      create: true,
      createFilter: function (input) {
        return input.length >= 2;
      },
      maxItems: 1,
    });
  }
};

onMounted(() => {
  initSelect();
});
</script>

<template>
  <AppLayout title="Dashboard">
    <template #parent>Dashboard</template>
    <div class="card">
      <h4>Summaries</h4>
      <button class="btn btn-primary" @click="showSumCreation = true">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-file-plus"
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
          <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
          <path
            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"
          ></path>
          <path d="M12 11l0 6"></path>
          <path d="M9 14l6 0"></path></svg
        ><span class="ml-1 font-bold">Run</span>
      </button>
    </div>
    <Modal
      @close="showSumCreation = false"
      :show="showSumCreation"
      maxWidth="4xl"
    >
      <div class="relative w-full max-h-full">
        <!-- Modal content -->
        <div class="relative card px-6">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-4 rounded-t">
            <h3
              class="text-xl font-semibold text-gray-900 dark:text-white mb-0"
            >
              Run summary
            </h3>
            <button
              type="button"
              class="btn btn-sm btn-slate"
              data-modal-hide="staticModal"
              @click="showSumCreation = false"
            >
              <svg
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
          </div>
          <!-- Modal body -->
          <div class="space-y-6 mb-6">
            <Tabs>
              <Tab title="From URL">
                <div>
                  <label
                    for="url"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >URL address
                  </label>
                  <div class="mb-2">
                    <input class="form-input" type="url" id="url" />
                  </div>
                </div>
                <div>
                  <label
                    for="action"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Action
                  </label>
                  <div class="mb-2">
                    <select id="action">
                      <option value=""></option>
                      <option
                        v-for="action in actionsList"
                        :key="action.value"
                        :value="action.value"
                      >
                        {{ action.name }}
                      </option>
                    </select>
                  </div>
                  <div>
                    <label
                      for="look"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Look for
                    </label>
                    <div class="mb-2">
                      <input id="look" />
                    </div>
                  </div>
                </div>
              </Tab>
              <Tab title="From text"></Tab>
            </Tabs>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center py-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-700"
          >
            <button
              data-modal-hide="staticModal"
              type="button"
              class="btn btn-primary font-bold"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-analyze-filled"
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
                  d="M4.99 12.862a7.1 7.1 0 0 0 12.171 3.924a1.956 1.956 0 0 1 -.156 -.637l-.005 -.149l.005 -.15a2 2 0 1 1 1.769 2.137a9.099 9.099 0 0 1 -15.764 -4.85a1 1 0 0 1 1.98 -.275z"
                  stroke-width="0"
                  fill="currentColor"
                ></path>
                <path
                  d="M12 8a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z"
                  stroke-width="0"
                  fill="currentColor"
                ></path>
                <path
                  d="M13.142 3.09a9.1 9.1 0 0 1 7.848 7.772a1 1 0 0 1 -1.98 .276a7.1 7.1 0 0 0 -6.125 -6.064a7.096 7.096 0 0 0 -6.048 2.136a2 2 0 1 1 -3.831 .939l-.006 -.149l.005 -.15a2 2 0 0 1 2.216 -1.838a9.094 9.094 0 0 1 7.921 -2.922z"
                  stroke-width="0"
                  fill="currentColor"
                ></path>
              </svg>
              <span class="ml-1">Run</span>
            </button>
          </div>
        </div>
      </div>
    </Modal>
  </AppLayout>
</template>
