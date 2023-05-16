<script setup>
import Table from "@/Components/Automations/Table.vue";
import Pagination from "@/Components/Global/Pagination.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { router, Link } from "@inertiajs/vue3";

const props = defineProps({
  automations: Object,
  filter: Object,
});
</script>
<template>
  <AppLayout title="Automations">
    <template #title>Automations</template>
    <template #subtitle>List</template>
    <template #parent
      ><Link class="link" href="/dashboard">Dashboard</Link></template
    >
    <Table :data="automations.data" />
    <Pagination :pagination="automations" :filter="filter" />
  </AppLayout>
</template>