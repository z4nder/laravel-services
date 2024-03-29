<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="flex h-screen overflow-hidden bg-gray-100">
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog
        as="div"
        static
        class="fixed inset-0 z-40 flex md:hidden"
        @close="sidebarOpen = false"
        :open="sidebarOpen"
      >
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-300"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>
        <TransitionChild
          as="template"
          enter="transition ease-in-out duration-300 transform"
          enter-from="-translate-x-full"
          enter-to="translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="translate-x-0"
          leave-to="-translate-x-full"
        >
          <div class="relative flex flex-col flex-1 w-full max-w-xs bg-gray-800">
            <TransitionChild
              as="template"
              enter="ease-in-out duration-300"
              enter-from="opacity-0"
              enter-to="opacity-100"
              leave="ease-in-out duration-300"
              leave-from="opacity-100"
              leave-to="opacity-0"
            >
              <div class="absolute top-0 right-0 pt-2 -mr-12">
                <button
                  class="flex items-center justify-center w-10 h-10 ml-1 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                  @click="sidebarOpen = false"
                >
                  <span class="sr-only">Close sidebar</span>
                  <XIcon class="w-6 h-6 text-white" aria-hidden="true" />
                </button>
              </div>
            </TransitionChild>
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
              <div class="flex items-center flex-shrink-0 px-4">
                <img
                  class="w-auto h-8"
                  src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                  alt="Workflow"
                />
              </div>
              <nav class="px-2 mt-5 space-y-1">
                <inertia-link
                  v-for="item in navigation"
                  :key="item.name"
                  :href="route(item.href)"
                  :class="[
                    item.current
                      ? 'bg-gray-900 text-white'
                      : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                    'group flex items-center px-2 py-2 text-base font-medium rounded-md',
                  ]"
                >
                  <component
                    :is="item.icon"
                    :class="[
                      item.current ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300',
                      'mr-4 h-6 w-6',
                    ]"
                    aria-hidden="true"
                  />
                  {{ item.name }}
                </inertia-link>
              </nav>
            </div>
            <div class="flex flex-shrink-0 p-4 bg-gray-700">
              <a href="#" class="flex-shrink-0 block group">
                <div class="flex items-center">
                  <div>
                    <img
                      class="inline-block w-10 h-10 rounded-full"
                      src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                      alt=""
                    />
                  </div>
                  <div class="ml-3">
                    <p class="text-base font-medium text-white">{{ $page.props?.auth?.user?.data.name }}</p>
                    <inertia-link :href="route('profileIndex')" class="text-sm font-medium text-gray-400 group-hover:text-gray-300">
                        View profile
                    </inertia-link>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </TransitionChild>
        <div class="flex-shrink-0 w-14">
          <!-- Force sidebar to shrink to fit close icon -->
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:flex-shrink-0">
      <div class="flex flex-col w-64">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex flex-col flex-1 h-0 bg-gray-800">
          <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
              <img
                class="w-auto h-8"
                src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                alt="Workflow"
              />
            </div>
            <nav class="flex-1 px-2 mt-5 space-y-1 bg-gray-800">
              <inertia-link
                v-for="item in navigation"
                :key="item.name"
                :href="route(item.href)"
                :class="[
                  item.current
                    ? 'bg-gray-900 text-white'
                    : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                  'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                ]"
              >
                <component
                  :is="item.icon"
                  :class="[
                    item.current ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300',
                    'mr-3 h-6 w-6',
                  ]"
                  aria-hidden="true"
                />
                {{ item.name }}
              </inertia-link>
            </nav>
          </div>
          <div class="flex flex-shrink-0 p-4 hover:bg-gray-700">
            <a href="#" class="flex-shrink-0 block w-full group">
              <div class="flex items-center">
                <div class="ml-3">
                  <inertia-link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-sm font-medium text-white"
                    >Log Out</inertia-link
                  >
                </div>
              </div>
            </a>
          </div>
          <div class="flex flex-shrink-0 p-4 bg-gray-700">
            <a href="#" class="flex-shrink-0 block w-full group">
              <div class="flex ite ms-center">
                <div>
                  <img
                    class="inline-block rounded-full h-9 w-9"
                    :src="$page.props?.auth?.user?.data.picture"
                    alt=""
                  />
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{ $page.props?.auth?.user?.data.name }}</p>
                    <inertia-link :href="route('profileIndex')" class="text-xs font-medium text-gray-300 group-hover:text-gray-200">
                        View profile
                    </inertia-link>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col flex-1 w-0 overflow-hidden">
      <div class="pt-1 pl-1 md:hidden sm:pl-3 sm:pt-3">
        <button
          class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
          @click="sidebarOpen = true"
        >
          <span class="sr-only">Open sidebar</span>
          <MenuIcon class="w-6 h-6" aria-hidden="true" />
        </button>
      </div>
      <main class="relative z-0 flex-1 overflow-y-auto focus:outline-none">
        <flash-messages />
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import {
  Dialog,
  DialogOverlay,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  BellIcon,
  HomeIcon,
  MenuAlt1Icon,
  UserGroupIcon,
  XIcon,
  MenuIcon,
  ShoppingBagIcon,
  ShoppingCartIcon,
  GiftIcon
} from '@heroicons/vue/outline'

import {
  CashIcon,
  CheckCircleIcon,
  ChevronDownIcon,
  ChevronRightIcon,
  OfficeBuildingIcon,
  ColorSwatchIcon,
  SearchIcon,
  TruckIcon
} from '@heroicons/vue/solid'
import FlashMessages from '@/Shared/FlashMessages'
const navigation = [
  { name: 'Dashboard', href: 'dashboardIndex', icon: HomeIcon, current: true },
  { name: 'Pedidos', href: 'orderIndex', icon: TruckIcon, current: false },
  { name: 'Usuários', href: 'userIndex', icon: UserGroupIcon, current: false },
  { name: 'Categorias', href: 'categoryIndex', icon: ShoppingBagIcon, current: false },
  { name: 'Produtos', href: 'productIndex', icon: ShoppingCartIcon, current: false },
  { name: 'Adicionais', href: 'additionalIndex', icon: GiftIcon, current: false },
  { name: 'Estabelecimentos', href: 'establishmentIndex', icon: OfficeBuildingIcon, current: false },
  { name: 'Temas', href: 'themeIndex', icon: ColorSwatchIcon, current: false },
]

export default {
  components: {
    MenuIcon,
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    BellIcon,
    CashIcon,
    CheckCircleIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    MenuAlt1Icon,
    OfficeBuildingIcon,
    SearchIcon,
    XIcon,
    FlashMessages,
  },
  setup() {
    const sidebarOpen = ref(false)
    return {
      navigation,
      sidebarOpen,
    }
  },
}
</script>
