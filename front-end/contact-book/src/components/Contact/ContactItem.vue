<template>
  <tr>
    <!-- Desktop view -->
    <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap hidden lg:table-cell">
      <div class="inline-flex items-center gap-x-3">
        <span>{{ contact.name }}</span>
      </div>
    </td>
    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap hidden lg:table-cell">
      {{ contact.email }}
    </td>
    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap hidden lg:table-cell">
      <div
        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60 dark:bg-gray-800">
        <h2 class="text-sm font-normal">{{ contact.phone }}</h2>
      </div>
    </td>
    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap hidden lg:table-cell">
      <div class="flex items-center gap-x-2">
        <img :src="contact.imageURL" alt="" class=" object-cover w-8 h-8 rounded-full" />
      </div>
    </td>
    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap hidden lg:table-cell">

    </td>
    <!-- Actions column for desktop -->
    <td class="px-4 py-4 text-sm whitespace-nowrap hidden lg:table-cell">
      <div class="flex items-center gap-x-6">
        <button @click="updateContact"
          class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-[#6A64F1] focus:outline-none">
          Update
        </button>
        <button @click="openModal"
          class="text-red-500 pl-3 transition-colors duration-200 hover:text-red-600 focus:outline-none">
          Delete
        </button>
      </div>
    </td>
  </tr>

  <tr class="flex w-full lg:hidden">
    <td class="flex-1 px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
      <div class="flex w-full gap-x-4">
        <!-- Display image, name, and email in the same line -->
        <div class="flex items-center gap-x-3 flex-grow">
          <img class="object-cover w-8 h-8 rounded-full" :src="contact.imageURL" alt="">
          <div class="flex flex-col">
            <h2 class="text-sm font-medium text-gray-800 dark:text-white">{{ contact.name }}</h2>
            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ contact.email }}</p>
          </div>
        </div>
      </div>
    </td>
    <td class="flex-1 px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
      <div class="flex gap-x-4 justify-end">
        <button @click="updateContact"
          class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-[#6A64F1] focus:outline-none">
          Update
        </button>
        <button @click="openModal"
          class="text-red-500 transition-colors duration-200 hover:text-red-600 focus:outline-none">
          Delete
        </button>
      </div>
    </td>
  </tr>

  <Confirm v-if="showConfirm" @closeModal="closeModal" @confirmAction="handleDeleteContact" />

</template>


<script lang="ts">
import { defineComponent, PropType } from 'vue';
import Confirm from '@/components/Popup/Confirm.vue';
import { deleteContact } from '@/service/api/axios';

export default defineComponent({
  name: 'ContactItem',
  components: {
    Confirm
  },
  props: {
    contact: {
      type: Object as PropType<{
        id: string;
        name: string;
        email: string;
        phone: string;
        imageURL: string;
      }>,
      required: true,
      default: () => ({
        id: '',
        name: '',
        email: '',
        phone: '',
        imageURL: ''
      })
    }
  },
  data() {
    return {
      showConfirm: false
    }

  },

  emits: ['edit', 'contactDeleted'],
  methods: {
    closeModal() {
      this.showConfirm = false
    },
    openModal() {
      this.showConfirm = true
    },
    updateContact() {
      this.$emit('edit', this.contact);
    },
    async handleDeleteContact() {
      try {
        await deleteContact(this.contact.id);
        this.$emit('contactDeleted');
      } catch (error) {
        console.error('Erro ao deletar contato:', error);
      }
    }
  }
});
</script>

<style scoped>
/* Adicione estilos personalizados, se necessário */
</style>
