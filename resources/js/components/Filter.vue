<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
            {{ filter.name }}
        </h3>

        <div class="p-2">
            <search-input
                @input="performSearch"
                @clear="clearSelection"
                @selected="handleChange"
                :value="value"
                :data="availableResources"
                :clearable="false"
                trackBy="value"
                searchBy="display"
            >
                <div
                    slot="default"
                    v-if="value"
                    class="flex items-center"
                >
                    <div
                        v-if="value.avatar"
                        class="mr-3"
                    >
                        <img
                            :src="value.avatar"
                            class="w-8 h-8 rounded-full block"
                        />
                    </div>

                    {{ value.display }}
                </div>

                <div
                    slot="option"
                    slot-scope="{ option, selected }"
                    class="flex items-center"
                >
                    <div
                        v-if="option.avatar"
                        class="mr-3"
                    >
                        <img
                            :src="option.avatar"
                            class="w-8 h-8 rounded-full block"
                        />
                    </div>

                    {{ option.display }}
                </div>
            </search-input>

        </div>
    </div>
</template>

<script>
import { PerformsSearches } from "laravel-nova"
import storage from '../storage/BelongsToFieldStorage'

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
            return storage.fetchAvailableResources(
                this.resourceName,
                this.fieldAttribute,
                {
                    params: {
                        search: this.search,
                    },
                }
            ).then(({ data: { resources } }) => {
                this.availableResources = resources;
            });
        },

        handleChange(resource) {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: resource
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
