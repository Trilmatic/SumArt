<script setup>
import Table from "@/Components/Automations/Table.vue";
import Pagination from "@/Components/Global/Pagination.vue";
import HeaderFilters from "@/Components/Automations/HeaderFilters.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { router, Link } from "@inertiajs/vue3";
import { reactive } from "vue";
import { alertMessages } from "@/Functions/variables";

const props = defineProps({
  automations: Object,
  filter: Object,
});

const filters = reactive({
  name: null,
});

const eventAutomationDelete = reactive(
  new CustomEvent("alert:push", { detail: alertMessages["automation:deleted"] })
);

const eventAutomationDuplicate = reactive(
  new CustomEvent("alert:push", {
    detail: alertMessages["automation:duplicated"],
  })
);

const eventAutomationError = reactive(
  new CustomEvent("alert:push", {
    detail: alertMessages["automation:duplicated"],
  })
);

const clearFilters = () => {
  filters.name = null;
  applyFilter();
};

const duplicateRow = (row) => {
  router.post(
    route("automations.duplicate", row.hash),
    {},
    {
      onSuccess: () => {
        document.dispatchEvent(eventAutomationDuplicate);
      },
      onError: () => {
        document.dispatchEvent(eventAutomationError);
      },
    }
  );
};

const filterName = (value) => {
  filters.name = value;
  applyFilter();
};

const deleteRow = (row) => {
  if (!confirm("Do you really want to delete the automation?")) return;
  router.delete(route("automations.delete", row.hash), {
    onSuccess: () => {
      document.dispatchEvent(eventAutomationDelete);
    },
    onError: () => {
      document.dispatchEvent(eventAutomationError);
    },
  });
};

const applyFilter = () => {
  router.get(
    "/automations",
    {
      filter: filters,
    },
    {
      preservState: true,
      preserveScroll: true,
    }
  );
};
</script>
<template>
  <AppLayout title="Automations">
    <template #title>Automations</template>
    <template #subtitle>List</template>
    <template #parent
      ><Link class="link" href="/dashboard">Dashboard</Link></template
    >
    <div class="card max-w-7xl mb-6 mx-auto">
      <div class="flex justify-end">
        <HeaderFilters
          @filters:filter="filterName"
          @filters:clear="clearFilters"
          :filter="filter"
        />
      </div>
    </div>
    <Table
      :data="automations.data"
      @row:delete="deleteRow"
      @row:duplicate="duplicateRow"
    />
    <Pagination :pagination="automations" :filter="filter" />
  </AppLayout>
</template>