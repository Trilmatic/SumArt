<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue";
import Tabs from "@/Components/Global/Tabs.vue";
import FieldDescription from "@/Components/Global/FieldDescription.vue";
import Tab from "@/Components/Global/Tab.vue";
import { nextTick, onMounted, ref, reactive } from "vue";
import { router, Link } from "@inertiajs/vue3";
import {
  alertMessages,
  automationTypes,
  automationFrequencies,
} from "@/Functions/variables";
import { createTomSelect } from "@/Functions/helpers";

const sourcesList = ref([]);
const form = reactive({
  name: null,
  type: automationTypes[0].value,
  frequency: automationFrequencies[0].value,
});

const props = defineProps({
  sources: Array,
  errors: Object,
});

const eventSourceValidated = reactive(
  new CustomEvent("alert:push", { detail: alertMessages["source:validated"] })
);

const eventSourceError = reactive(
  new CustomEvent("alert:push", { detail: alertMessages["source:error"] })
);

const removeSource = (index) => {
  sourcesList.value.splice(index, 1);
};

const checkSource = () => {
  const source = document.getElementById("source").value;
  router.post(
    "/automations/source/check",
    {
      source: source,
    },
    {
      onSuccess: (result) => {
        document.dispatchEvent(eventSourceValidated);
        sourcesList.value.push({ url: source });
        document.getElementById("source").value = null;
      },
      onError: (error) => {
        document.dispatchEvent(eventSourceError);
      },
    }
  );
};

const changeAutomationType = (value) => {
  form.type = value;
};
const changeAutomationFrequency = (value) => {
  console.log(value);
  form.frequency = value;
};

const initSelect = () => {
  const typeInput = document.querySelector("#type");
  const frequencyInput = document.querySelector("#frequency");
  if (typeInput) {
    createTomSelect(
      typeInput,
      {
        onChange: changeAutomationType,
        options: automationTypes,
      },
      automationTypes[0].value
    );
  }
  if (frequencyInput) {
    createTomSelect(
      frequencyInput,
      { onChange: changeAutomationFrequency, options: automationFrequencies },
      automationFrequencies[0].value
    );
  }
};

const submit = () => {
  router.post("/automations/store", {
    source: sourcesList.value,
    ...form,
  });
};

onMounted(() => {
  initSelect();
});
</script>
<template>
  <AppLayout title="Dashboard">
    <template #title>Automations</template>
    <template #subtitle>Create</template>
    <template #parent
      ><Link class="link" href="/dashboard">Dashboard</Link></template
    >
    <div class="card">
      <h4>New Automation</h4>
      <div>
        <label
          for="url"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Name<span class="text-error">*</span>
        </label>
        <div class="mb-2">
          <input
            v-model="form.name"
            class="form-input"
            :class="{ error: errors && errors.name }"
            type="text"
            id="name"
          />
        </div>
      </div>
      <div>
        <label
          for="look"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Automation type<span class="text-error">*</span>
        </label>
        <div class="mb-2">
          <input id="type" />
        </div>
        <FieldDescription>
          <span v-show="form.type === 'rss-source-summary'">
            Automation will gather data from RSS sources. Automation will
            display the latest updates from multiple sources in a single
            location, making it easier to stay informed about preferred topics
            without having to visit each website individually. Each topic is
            summarzed and ready with source links.
          </span>
        </FieldDescription>
      </div>
      <div>
        <label
          for="look"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Frequency<span class="text-error">*</span>
        </label>
        <div class="mb-2">
          <input id="frequency" />
        </div>
        <FieldDescription>
          Determines how often will you get new summaries from the source.
        </FieldDescription>
      </div>
      <div>
        <h6>Add RSS sources</h6>
        <FieldDescription>
          RSS is a web feed format that allows users to subscribe to and receive
          updates from their favorite websites or content sources. RSS feeds
          provide a standardized way of delivering regularly updated content,
          such as news articles, blog posts, podcasts, and more.
        </FieldDescription>
      </div>
      <div class="flex space-x-2">
        <input
          class="form-input"
          :class="{ error: errors && errors.source }"
          id="source"
          type="url"
        />
        <button @click="checkSource" class="btn btn-primary">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-playlist-add"
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
            <path d="M19 8h-14"></path>
            <path d="M5 12h9"></path>
            <path d="M11 16h-6"></path>
            <path d="M15 16h6"></path>
            <path d="M18 13v6"></path>
          </svg>
        </button>
      </div>
      <div class="py-6">
        <div
          class="flex items-center justify-between bg-slate-200 dark:bg-slate-800 p-2 rounded-lg space-x-1 mb-2"
          v-for="(s, i) in sourcesList"
          :key="i"
        >
          <div class="flex space-x-1 items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-brand-tabler text-warning"
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
              <path d="M8 9l3 3l-3 3"></path>
              <path d="M13 15l3 0"></path>
              <path
                d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"
              ></path>
            </svg>
            <a target="_blank" :href="s" class="link">
              {{ s.url }}
            </a>
          </div>
          <svg
            @click="removeSource(i)"
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-circle-x text-error hover:text-error-focus hover:cursor-pointer"
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
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
            <path d="M10 10l4 4m0 -4l-4 4"></path>
          </svg>
        </div>
      </div>
      <div class="flex justify-end">
        <button class="btn btn-success" @click="submit">
          Create automation
        </button>
      </div>
    </div>
  </AppLayout>
</template>
