<template>
  <h3 class="pt-2 px-3 text-xs uppercase font-bold tracking-wide">
    {{ filter.name }}
  </h3>

  <div class="p-2">
    <SearchInput
      @input="performSearch"
      @clear="clearSelection"
      @selected="handleChange"
      :value="value"
      :data="availableResources"
      :clearable="false"
      trackBy="value"
      searchBy="display"
    >
      <div v-if="value" class="flex items-center">
        <div v-if="value.avatar" class="mr-3">
          <img :src="value.avatar" class="w-8 h-8 rounded-full block" />
        </div>

        {{ value.display }}
      </div>

      <template #option="{ selected, option }">
        <div class="flex items-center">
          <div v-if="option.avatar" class="mr-3">
            <img :src="option.avatar" class="w-8 h-8 rounded-full block" />
          </div>

          {{ option.display }}
        </div>
      </template>
    </SearchInput>
  </div>
</template>

<script>
import PerformsSearches from "performs-searches";
import storage from "../storage/BelongsToFieldStorage";

export default {
  mixins: [PerformsSearches],

  props: {
    resourceName: {
      type: String,
      required: true,
    },
    filterKey: {
      type: String,
      required: true,
    },
  },

  methods: {
    getAvailableResources() {
      return storage
        .fetchAvailableResources(this.resourceName, this.fieldAttribute, {
          params: {
            search: this.search,
          },
        })
        .then(({ data: { resources } }) => {
          this.availableResources = resources;
        });
    },

    handleChange(resource) {
      this.$store.commit(`${this.resourceName}/updateFilterState`, {
        filterClass: this.filterKey,
        value: resource,
      });

      this.$emit("change");
    },
  },

  computed: {
    filter() {
      return this.$store.getters[`${this.resourceName}/getFilter`](
        this.filterKey
      );
    },

    fieldAttribute() {
      return this.filter.fieldAttribute;
    },

    value() {
      return this.filter.currentValue;
    },
  },
};
</script>
