<script setup>
import { inject } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';

const props = defineProps({
  title: {
    type: String,
    default: 'Room and Equipment Reservation',
  },
});

const $page = usePage();
const collapsed = inject('collapsed', false);
</script>

<template>
  <div class="flex items-center justify-between w-full px-4 py-2">

    <!-- Left: Logo -->
    <div class="flex items-center">
      <img src="/images/UP-NAVS.png" alt="UP Logo" class="h-14 w-auto" />
    </div>

    <!-- Center: Title -->
    <div class="flex-1 flex justify-center">
      <p class="font-semibold text-lg tracking-wide text-[#850038]">
        {{ title }}
      </p>
    </div>

    <!-- Right: Actions -->
    <div class="flex items-center">

      <!-- Notifications Bell -->
      <Link
        href="/notifications"
        :class="['flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-sm transition-all', collapsed ? 'justify-center' : '']"
      >
        <i class="pi pi-bell"></i>
      </Link>

      <!-- User Info -->
      <div class="flex items-center gap-3">
        <Avatar
          :label="$page.props.auth.user.name?.charAt(0).toUpperCase()"
          size="large"
          style="background-color: #850038; color: #FFFFFF"
          shape="circle"
        />
        <div class="leading-tight">
          <span class="text-sm text-black">{{ $page.props.auth.user.name }}</span>
          <p class="text-xs text-gray-500">Administrator</p>
        </div>
      </div>

      <!-- Dropdown Chevron -->
      <Link
        href="/notifications"
        :class="['flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-sm transition-all', collapsed ? 'justify-center' : '']"
      >
        <i class="pi pi-chevron-down"></i>
      </Link>

    </div>
  </div>
</template>