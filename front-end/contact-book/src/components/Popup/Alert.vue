<template>
  <div class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-gray-800 bg-opacity-50 z-50" @click="closeModal">
    <div class="modal-content w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px]"
         @click.stop>
      <h3 :class="titleClass">{{ title }}</h3>
      <span class="bg-indigo-500 mx-auto mb-6 inline-block h-1 w-[90px] rounded"></span>
      <p :class="paragraphClass">{{ paragraph }}</p>
      <div class="flex flex-wrap gap-3">
        <button
          class="bg-indigo-500 border-indigo-500 block w-full rounded-lg border p-3 text-center text-base font-medium text-white transition hover:bg-opacity-90"
          @click="closeModal">
          {{ textConfirm }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Alert',
  props: {
    title: {
      type: String,
      default: 'Error'
    },
    paragraph: {
      type: String,
      default: ''
    },
    textConfirm: {
      type: String,
      default: 'Fechar'
    },
    titleSize: {
      type: String,
      default: 'text-xl'
    },
    paragraphSize: {
      type: String,
      default: 'text-base'
    },
    alertOpen: {
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
    closeModal() {
      this.$emit('closeAlert');
    }
  }
}
</script>

<style scoped>
/* Tamanho padrão do modal */
.modal-content {
  max-width: 570px;
}

/* Reduz a largura do modal em telas menores */
@media (max-width: 768px) {
  .modal-content {
    max-width: 90%; /* Ajusta o modal para 90% da largura da tela */
  }
}

/* Reduz ainda mais a largura em telas muito pequenas */
@media (max-width: 480px) {
  .modal-content {
    max-width: 95%; /* Ajusta o modal para 95% da largura da tela */
  }
}
</style>
