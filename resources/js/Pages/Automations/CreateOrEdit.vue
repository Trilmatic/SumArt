<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue";
import Tabs from "@/Components/Global/Tabs.vue";
import FieldDescription from "@/Components/Global/FieldDescription.vue";
import CreateAutomationIcon from "@/Components/Icons/CreateAutomationIcon.vue";
import AddSourceIcon from "@/Components/Icons/AddSourceIcon.vue";
import SourceListIcon from "@/Components/Icons/SourceListIcon.vue";
import RemoveSourceIcon from "@/Components/Icons/RemoveSourceIcon.vue";
import Tab from "@/Components/Global/Tab.vue";
import { nextTick, onMounted, ref, reactive } from "vue";
import { router, Link } from "@inertiajs/vue3";
import {
  alertMessages,
  automationTypes,
  automationFrequencies,
} from "@/Functions/variables";
import { createTomSelect, createFlatpickr } from "@/Functions/helpers";

const sourcesList = ref([]);
const form = reactive({
  name: null,
  type: automationTypes[0].value,
  frequency: automationFrequencies[0].value,
  time: null,
});

const props = defineProps({
  automation: Object,
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
  form.frequency = value;
  if (value !== "daily") form.time = null;
  else form.time = "12:00";
};

const changeAutomationTime = (selectedDates, dateStr, instance) => {
  form.time = dateStr;
};

const parseFrequency = (frequency) => {
  const split = frequency.split("|");
  if (split[0]) form.frequency = split[0];
  if (split[1]) form.time = split[1];
};

const loadAutomationData = () => {
  if (!props.automation || !props.automation.sources) return;
  sourcesList.value = props.automation.sources;
  form.name = props.automation.name;
  form.type = props.automation.type;
  parseFrequency(props.automation.frequency);
};

const initFlatpickr = () => {
  createFlatpickr("#time", {
    onChange: changeAutomationTime,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
  });
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
  const url = props.automation
    ? "/automations/" + props.automation.hash + "/update"
    : "/automations/store";
  const method = props.automation ? "put" : "post";
   router[method](url, {
    source: sourcesList.value,
    ...form,
  });
};

onMounted(() => {
  initSelect();
  initFlatpickr();
  loadAutomationData();
});
</script>
<template>
  <AppLayout title="Create Automation">
    <template #title>Automations</template>
    <template #subtitle
      ><span v-if="props.automation">Edit</span
      ><span v-else>Create</span></template
    >
    <template #parent
      ><Link class="link" href="/dashboard">Dashboard</Link></template
    >
    <section class="card max-w-7xl mx-auto">
      <h4>
        <span v-if="props.automation">{{ props.automation.name }}</span
        ><span v-else>New Automation</span>
      </h4>
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
      <div class="flex space-x-2">
        <div class="w-full">
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
        <div v-show="form.frequency == 'daily'" class="w-full">
          <label
            for="time"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >At<span class="text-error">*</span>
          </label>
          <div class="mb-2" :class="{ error: errors && errors.time }">
            <input class="form-input" v-model="form.time" id="time" />
          </div>
          <FieldDescription> Determines time when </FieldDescription>
        </div>
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
          <AddSourceIcon />
        </button>
      </div>
      <div class="py-6">
        <div
          class="flex items-center justify-between bg-slate-200 dark:bg-slate-800 p-2 rounded-lg space-x-1 mb-2"
          v-for="(s, i) in sourcesList"
          :key="i"
        >
          <div class="flex space-x-1 items-center">
            <SourceListIcon />
            <a target="_blank" :href="s" class="link">
              {{ s.url }}
            </a>
          </div>
          <RemoveSourceIcon @click="removeSource(i)" />
        </div>
      </div>
      <div class="flex justify-end">
        <button class="btn btn-success font-bold" @click="submit">
          <CreateAutomationIcon /><span class="ml-1"
            ><span v-if="props.automation">Edit</span
            ><span v-else>Create</span></span
          >
        </button>
      </div>
    </section>
  </AppLayout>
</template>
