<script setup>
import { ref, onMounted, watch, provide } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import Button from 'primevue/button'

const $page = usePage()

const collapsed = ref(false)

onMounted(() => {
  const savedState = localStorage.getItem('adminSidebarCollapsed')
  if (savedState !== null) {
    collapsed.value = savedState === 'true'
  }
})

watch(collapsed, (newValue) => {
  localStorage.setItem('adminSidebarCollapsed', newValue)
})

const toggleCollapse = () => {
  collapsed.value = !collapsed.value
}

const logout = () => router.post('/logout')

// Provide collapsed state so child pages can inject it if needed
provide('collapsed', collapsed)
</script>

<template>
  <div class="flex flex-col h-screen bg-gray-100">
    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center border-b-4 border-[#850038]">
      <div class="flex items-center gap-3 w-full">
        <slot name="header-actions" />
      </div>
    </nav>

    <!-- Sidebar + Main Content Row (below the nav) -->
    <div class="flex flex-1 overflow-hidden">
      <!-- Collapsible Sidebar -->
      <aside
        :class="[
          'bg-white shadow flex flex-col transition-all duration-300 ease-in-out',
          collapsed ? 'w-20' : 'w-64',
        ]"
      >
        <!-- Sidebar Header with toggle button -->
        <div
          :class="[
            'p-5 text-primary-600 flex items-center',
            collapsed ? 'justify-center' : 'justify-between',
          ]"
        >
          <span v-if="!collapsed" class="whitespace-nowrap"></span>
          <Button
            :icon="collapsed ? 'pi pi-bars' : 'pi pi-times'"
            text
            rounded
            @click="toggleCollapse"
            class="!p-2"
            :class="collapsed ? 'mx-auto' : ''"
            :pt="{ icon: { style: 'color: #850038' } }"
          />
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 p-4 flex flex-col gap-1">
          <Link
            href="/dashboard"
            :class="[
              'flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-sm transition-all',
              collapsed ? 'justify-center' : '',
              $page.url.startsWith('/dashboard') ? 'bg-[#f9f0f3] text-[#850038] font-medium' : '',
            ]"
          >
            <i class="pi pi-objects-column"></i>
            <span v-if="!collapsed">Overview</span>
          </Link>

          <Link
            href="/reservation"
            :class="[
              'flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-sm transition-all',
              collapsed ? 'justify-center' : '',
              $page.url.startsWith('/reservation') ? 'bg-[#f9f0f3] text-[#850038] font-medium' : '',
            ]"
          >
            <i class="pi pi-pen-to-square"></i>
            <span v-if="!collapsed">Reservations</span>
          </Link>

          <Link
            href="/pending"
            :class="[
              'flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-sm transition-all',
              collapsed ? 'justify-center' : '',
              $page.url.startsWith('/pending') ? 'bg-[#f9f0f3] text-[#850038] font-medium' : '',
            ]"
          >
            <i class="pi pi-clock"></i>
            <span v-if="!collapsed">Pending</span>
          </Link>

          <Link
            href="/rejected"
            :class="[
              'flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 text-sm transition-all',
              collapsed ? 'justify-center' : '',
              $page.url.startsWith('/rejected') ? 'bg-[#f9f0f3] text-[#850038] font-medium' : '',
            ]"
          >
            <i class="pi pi-times-circle"></i>
            <span v-if="!collapsed">Rejected</span>
          </Link>
        </nav>

        <!-- Logout Button -->
        <div class="p-4">
          <form @submit.prevent="logout">
            <Button
              type="submit"
              :label="collapsed ? '' : 'Log out'"
              severity="secondary"
              text
              class="w-full"
              icon="pi pi-sign-out"
              :class="collapsed ? 'justify-center' : ''"
              :pt="{ icon: { style: 'color: #850038' } }"
            />
          </form>
        </div>
      </aside>

      <!-- Main Content Area -->
      <main class="flex-1 overflow-y-auto p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<style scoped>
aside {
  transition-property: width;
  transition-duration: 200ms;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>