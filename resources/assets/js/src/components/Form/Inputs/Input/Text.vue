<template>
  <input
    type="text"
    :id="indentity"
    :name="name"
    :value="value"
    :maxlength="maxlength"
    :placeholder="placeholder"
    :autocomplete="autocomplete"
    v-focus="focus"
    v-on="inputListeners"
  />
</template>
<script>
import Helper from "../../../../core/Helper";
export default {
  props: {
    group: {
      type: String,
      required: false,
    },
    name: {
      type: String,
      required: true,
    },
    id: {
      type: String,
      required: false,
    },
    value: {
      default: "",
    },
    currentValue: {
      default: "",
    },
    placeholder: {
      type: String,
      required: false,
    },
    focus: {
      type: Boolean,
      default: false,
    },
    maxlength: {
      type: String,
      required: false,
    },
    autocomplete: {
      type: String,
      required: false,
    },
    validation: {
      type: [Array, Object],
      default: () => [],
    },
  },
  data() {
    return {
      indentity: this.id ? this.id : this.name,
      displayValidation: false,
    };
  },
  computed: {
    inputListeners() {
      return Object.assign({}, this.$listeners, {
        input: (event) => {
          this.emit(event.target.value);
        },
      });
    },
  },
  mounted() {
    this.emit(this.currentValue);
    this.initialize();
  },
  methods: {
    emit(value) {
      this.$emit("input", value);
    },
    initialize() {
      if (Helper.isEmpty(this.validation)) {
        return;
      }

      let rules = this.validation;

      if (!Array.isArray(this.validation)) {
        this.displayValidation = true;
        rules = Object.keys(this.validation);
      }

      EventBus.fire("initialize" + this.group, {
        field: this.name,
        rule: rules,
      });
    },
  },
};
</script>