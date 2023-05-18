<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
  pagination: Object,
  filter: [Object, null],
});
</script>
<template>
  <div
    class="flex flex-wrap items-center justify-between w-full card p-4 max-w-7xl mx-auto"
    v-if="pagination.links && pagination.links.length > 3"
  >
    <div>
      <strong>{{ pagination.from }}</strong> to
      <strong>{{ pagination.to }}</strong> of
      <strong>{{ pagination.total }}</strong>
    </div>
    <div>
      <ul class="pagination">
        <li>
          <Link
            class="btn btn-sm pagination-link"
            :href="pagination.first_page_url ? pagination.first_page_url : ''"
            :data="
              filter &&
              pagination.first_page_url &&
              pagination.current_page !== 1
                ? filter
                : {}
            "
            :class="{
              disabled:
                !pagination.first_page_url || pagination.current_page === 1,
            }"
            preserve-state
            preserve-scroll
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-chevrons-left"
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
              <path d="M11 7l-5 5l5 5"></path>
              <path d="M17 7l-5 5l5 5"></path></svg
          ></Link>
        </li>
        <li>
          <Link
            class="btn btn-sm pagination-link"
            :href="pagination.prev_page_url ? pagination.prev_page_url : ''"
            :data="filter && pagination.prev_page_url ? filter : {}"
            :class="{
              disabled: !pagination.prev_page_url,
            }"
            preserve-state
            preserve-scroll
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-chevron-left"
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
              <path d="M15 6l-6 6l6 6"></path></svg
          ></Link>
        </li>
        <li v-for="(l, i) in pagination.links" :key="i">
          <span
            v-if="l.active"
            class="pagination-no-link current flex items-center w-full h-10 space-x-2"
          >
            <span>{{ l.label }}</span
            ><span>of</span>
            <span>{{ pagination.last_page }}</span>
          </span>
        </li>
        <li>
          <Link
            class="btn btn-sm pagination-link"
            :href="pagination.next_page_url ? pagination.next_page_url : ''"
            :data="filter && pagination.next_page_url ? filter : {}"
            :class="{
              disabled: !pagination.next_page_url,
            }"
            preserve-state
            preserve-scroll
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-chevron-right"
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
              <path d="M9 6l6 6l-6 6"></path></svg
          ></Link>
        </li>
        <li>
          <Link
            class="btn btn-sm pagination-link"
            :href="pagination.last_page_url ? pagination.last_page_url : ''"
            :data="
              filter &&
              pagination.last_page_url &&
              pagination.current_page !== pagination.last_page
                ? filter
                : {}
            "
            :class="{
              disabled:
                !pagination.last_page_url ||
                pagination.current_page === pagination.last_page,
            }"
            preserve-state
            preserve-scroll
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-chevrons-right"
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
              <path d="M7 7l5 5l-5 5"></path>
              <path d="M13 7l5 5l-5 5"></path></svg
          ></Link>
        </li>
      </ul>
    </div>
  </div>
</template>