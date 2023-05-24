<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/Global/Tabs.vue";
import Tab from "@/Components/Global/Tab.vue";
import SourceListIcon from "@/Components/Icons/SourceListIcon.vue";
import RemoveSourceIcon from "@/Components/Icons/RemoveSourceIcon.vue";
import EditIcon from "@/Components/Icons/EditIcon.vue";
import ActivityLogList from "@/Components/Global/ActivityLogList.vue";
import { nextTick, onMounted, ref, reactive } from "vue";
import { router, Link } from "@inertiajs/vue3";
import { alertMessages } from "@/Functions/variables";

const props = defineProps({
  automation: Object,
  activity: Array,
  errors: Object,
});

const eventSourceDelete = reactive(
  new CustomEvent("alert:push", { detail: alertMessages["source:deleted"] })
);

const removeSource = (source, index) => {
  if (
    source.id &&
    props.automation.hash &&
    confirm("Do you really want to delete the source?")
  ) {
    router.delete(
      "/automations/" +
        props.automation.hash +
        "/source/" +
        source.id +
        "/delete",
      {
        onSuccess: () => {
          document.dispatchEvent(eventSourceDelete);
        },
      }
    );
  } else {
    sourcesList.value.splice(index, 1);
  }
};

onMounted(() => {});
</script>
<template>
  <AppLayout title="Create Automation">
    <template #title>Automations</template>
    <template #subtitle>{{ automation.name }}</template>
    <template #parent
      ><Link class="link" href="/dashboard">Dashboard</Link></template
    >
    <section class="card max-w-7xl mx-auto">
      <div class="flex mb-2 justify-between items-center">
        <h3 class="mb-0">{{ automation.name }}</h3>
        <Link
          :href="route('automations.edit', automation.hash)"
          class="btn btn-warning btn-sm"
        >
          <EditIcon /><span class="ml-1">Edit</span>
        </Link>
      </div>
      <Tabs>
        <Tab title="Completions"> </Tab>
        <Tab title="Sources">
          <div
            class="flex items-center justify-between bg-slate-200 dark:bg-slate-800 p-2 rounded-lg space-x-1 mb-2"
            v-for="(s, i) in automation.sources"
            :key="i"
          >
            <div class="flex space-x-1 items-center">
              <SourceListIcon />
              <a target="_blank" :href="s" class="link">
                {{ s.url }}
              </a>
            </div>
            <RemoveSourceIcon @click="removeSource(s)" />
          </div>
        </Tab>
        <Tab title="Activity">
          <ActivityLogList :activity="activity" />
        </Tab>
      </Tabs>
    </section>
  </AppLayout>
</template>
