<template>
  <div class="form" :class="form_class + (is_short_form ? ' short-form' : '')">
    <div class="form-container">
      <div class="form-header">
        <div class="form-content">
          <h1>{{ headline }}</h1>
        </div>
      </div>
      <div class="form-body">
        <div class="form-content">
          <BaseNotification
            v-if="store.status.msg != null"
            :type="store.status.type"
            :text="store.status.msg"
            :title="store.status.title"
          />
          <slot></slot>
        </div>
      </div>
    </div>  
  </div>
</template>

<script>
import BaseNotification from "@/components/general/notification/BaseNotification";
import store from "@/store";

export default {
  name: "BaseFormContainer",
  components: {
    BaseNotification,
  },
  props: {
      headline: {
      type: String,
      required: true,
    },
    form_class: {
      type: String,
      default: '',
    },
    is_short_form: {
      type: Boolean,
      default: false,
    },
  },
  data: () => ({
    store,
  })
}

</script>