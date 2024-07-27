<template>
  <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Fundo escuro com desfoque -->
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="closeModal"></div>

    <!-- Modal centralizado -->
    <div class="relative z-10 mx-auto w-full max-w-lg sm:max-w-md xs:max-w-xs bg-white rounded-lg shadow-lg">
      <form @submit.prevent="handleSubmit" class="py-6 px-9" enctype="multipart/form-data">
        <!-- Nome -->
        <div class="mb-5">
          <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
            Nome: <span v-if="mode === 'create'" class="text-red-500">*</span>
          </label>
          <input type="text" v-model="form.name" id="name" placeholder="Seu Nome"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.name" class="text-red-500 text-sm mt-2">{{ errors.name }}</p>
        </div>

        <!-- Email -->
        <div class="mb-5">
          <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
            Email: <span v-if="mode === 'create'" class="text-red-500">*</span>
          </label>
          <input type="email" v-model="form.email" id="email" placeholder="example@domain.com"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.email" class="text-red-500 text-sm mt-2">{{ errors.email }}</p>
        </div>

        <!-- Telefone -->
        <div class="mb-5">
          <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
            Telefone: <span v-if="mode === 'create'" class="text-red-500">*</span>
          </label>
          <input type="tel" v-model="form.phone" id="phone" placeholder="(00) 00000-0000" maxlength="11"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.phone" class="text-red-500 text-sm mt-2">{{ errors.phone }}</p>
        </div>

        <!-- Upload de Imagem -->
        <div class="mb-6 pt-4">
          <label class=" block text-xl font-semibold text-[#07074D]">
            Upload da imagem <span v-if="mode === 'create'" class="text-red-500">*</span>
          </label>
          <p v-if="errors.image" class="text-red-500 text-sm mt-2 mb-5">{{ errors.image }}</p>
          <div
            class="relative border border-dashed border-[#e0e0e0] rounded-md min-h-[150px] p-8 text-center cursor-pointer"
            @dragover.prevent="handleDragOver" @drop="handleDrop" @click="$refs.fileInput.click()">
            <input type="file" ref="fileInput" @change="handleFileChange" id="file" class="sr-only" accept="image/*" />
            <div>
              <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                Solte a imagem aqui
              </span>
              <span class="mb-2 block text-base font-medium text-[#6B7280]">
                Ou
              </span>
              <span class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                Navegar
              </span>
            </div>

          </div>
          <!-- Status da Imagem -->
          <div v-if="form.image" class="mt-4 bg-[#F5F7FB] p-3 rounded-md">
            <div class="flex items-center justify-between">
              <span class="text-base font-medium text-[#07074D]">{{ form.image.name }}</span>
              <button @click="removeImage" class="text-[#07074D]">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                    fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                    fill="currentColor" />
                </svg>
              </button>
            </div>
            <div class="relative mt-3 h-[6px] w-full rounded-lg bg-[#E2E5EF]">
              <div class="absolute left-0 right-0 h-full rounded-lg bg-[#6A64F1]" :style="{ width: '100%' }"></div>
            </div>
          </div>
        </div>

        <!-- Botão de Envio -->
        <div>
          <button type="submit"
            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
            {{ mode === 'create' ? 'Criar' : 'Atualizar' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>

import { createContact, updateContact } from '@/service/api/axios';

export default {
  props: {
    isModalOpen: {
      type: Boolean,
      required: true
    },
    formSuccess: {
      type: Boolean,
      required: true
    },
    mode: {
      type: String,
      required: true,
      validator: value => ['create', 'update'].includes(value)
    },
    contact: {
      type: Object,
      default: () => ({
        id: '',
        name: '',
        email: '',
        phone: '',
        image: ''
      })
    }
  },
  data() {
    return {
      form: { ...this.getDefaultForm() },
      errors: {
        id: '',
        name: '',
        email: '',
        phone: '',
        image: ''
      }
    };
  },
  watch: {
    contact: {
      immediate: true,
      handler(newData) {
        if (this.mode === 'update') {
          this.form = { ...this.getFormFromContact(newData) };
        }
        if (this.mode === 'create') {
          this.form = { ...this.getDefaultForm() };
        }
      }
    }
  },
  methods: {
    getDefaultForm() {
      return {
        id: '',
        name: '',
        email: '',
        phone: '',
        image: ''
      };
    },
    getFormFromContact(contact) {
      return {
        id: contact?.id || '',
        name: contact?.name || '',
        email: contact?.email || '',
        phone: contact?.phone || '',
        image: contact?.imageURL || ''
      };
    },
    async handleSubmit() {
      // Resetar erros
      this.errors = { id: '', name: '', email: '', phone: '', image: '' };

      let valid = true;

      if (!this.form.name) {
        this.errors.name = 'Nome é obrigatório.';
        valid = false;
      }

      if (!this.form.email) {
        this.errors.email = 'Email é obrigatório.';
        valid = false;
      }

      if (!this.form.phone) {
        this.errors.phone = 'Telefone é obrigatório.';
        valid = false;
      }

      if(this.form.phone.length < 11) {
        this.errors.phone = 'Telefone deve ter pelo menos 11 caracteres.';
        valid = false;
      }

      if (!this.form.image) {
        this.errors.image = 'Imagem é obrigatória.';
        valid = false;
      }

      if (!valid) {
        console.log('error:', this.errors);
        return;
      }

      const formData = new FormData();
      if(this.mode === 'update'){
        formData.append('id', this.contact.id);
      }
      formData.append('name', this.form.name);
      formData.append('email', this.form.email);
      formData.append('phone', this.form.phone);
      formData.append('image', this.form.image);

      try {
        if (this.mode === 'create') {
          await createContact(formData);
          this.$emit('contactCreated');
          this.closeModal();
          this.updateFormSuccess();
          this.form = { ...this.getDefaultForm()};
        }
        if (this.mode === 'update') {
          if (!this.contact.id) {
            throw new Error('ID do contato não fornecido para atualização');
          }
          await updateContact(formData);
          this.$emit('contactUpdated');
          this.closeModal();
          this.updateFormSuccess();
        }

      } catch (error) {
        console.error('Erro:', error);

      }
    },

    handleFileChange(event) {
      this.form.image = event.target.files[0];
    },

    removeImage() {
      this.form.image = '';
    },

    handleDragOver(event) {
      event.preventDefault();
    },

    handleDrop(event) {
      event.preventDefault();
      const files = event.dataTransfer.files;
      if (files.length) {
        this.form.image = files[0];
      }
    },

    closeModal() {
      this.$emit('update:isModalOpen', false);
    },

    updateFormSuccess() {
      this.$emit('update:formSuccess', true);
    }
  }
};
</script>

<style scoped>
/* Ajuste para tamanhos de tela */
@media (max-width: 640px) {
  .max-w-lg {
    max-width: 90%;
  }
}

@media (max-width: 480px) {
  .max-w-md {
    max-width: 85%;
  }

  .min-h-[150px] {
    min-height: 150px;
  }
}
</style>
