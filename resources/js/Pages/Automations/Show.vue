<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/Global/Tabs.vue";
import RemoveSourceIcon from "@/Components/Icons/RemoveSourceIcon.vue";
import Tab from "@/Components/Global/Tab.vue";
import { nextTick, onMounted, ref, reactive } from "vue";
import { router, Link } from "@inertiajs/vue3";

const props = defineProps({
  automation: Object,
  activity: Array,
  errors: Object,
});

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
      <h2>{{ automation.name }}</h2>
      <Tabs>
        <Tab title="Completions"> </Tab>
        <Tab title="Activity">
          {{ activity }}
        </Tab>
      </Tabs>
    </section>
  </AppLayout>
</template>
