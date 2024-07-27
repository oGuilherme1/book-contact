<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50" @click="handleBackdropClick">
      <div class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px]" @click.stop>
        <h3 :class="titleClass">{{ title }}</h3>
        <span class="bg-indigo-500 mx-auto mb-6 inline-block h-1 w-[90px] rounded"></span>
        <p :class="paragraphClass">{{ paragraph }}</p>
        <div class="flex flex-wrap gap-3">
          <button
            @click="confirmAction"
            class="bg-indigo-500 border-indigo-500 block w-full rounded-lg border p-3 text-center text-base font-medium text-white transition hover:bg-opacity-90">
            {{ textConfirm }}
          </button>
          <button
            @click="closeModal"
            class="text-black block w-full rounded-lg border border-gray-700 p-3 text-center text-base font-medium transition hover:border-red-600 hover:bg-red-600 hover:text-white">
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Confirm',
    props: {
      title: {
        type: String,
        default: 'Deseja excluir este contato?'
      },
      paragraph: {
        type: String,
        default: 'Atenção: Esta ação é irreversível e não poderá ser desfeita. Certifique-se de que deseja continuar.'
      },
      textConfirm: {
        type: String,
        default: 'Confirmar'
      },
      titleSize: {
        type: String,
        default: 'text-xl'
      },
      paragraphSize: {
        type: String,
        default: 'text-base'
      },
      showConfirm: {
        type: Boolean,
        default: false
      }
    },
    
    computed: {
      titleClass() {
        return `text-black pb-2 font-bold sm:text-2xl ${this.titleSize}`;
      },
      paragraphClass() {
        return `text-gray-400 mb-10 leading-relaxed ${this.paragraphSize}`;
      }
    },
    methods: {
      handleBackdropClick(event) {
        // Fechar o modal ao clicar fora da área do modal
        if (event.target === event.currentTarget) {
          this.closeModal();
        }
      },
      closeModal() {
        this.$emit('closeModal');
      },
      confirmAction() {
        this.$emit('confirmAction');
        this.closeModal();
      }
    }
  }
  </script>
  
  <style scoped>
  /* Adicione estilos adicionais aqui se necessário */
  </style>
  