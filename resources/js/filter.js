Nova.booting((Vue) => {
  Vue.component(
    "nova-searchable-belongs-to-filter",
    require("./components/Filter").default
  );
});
