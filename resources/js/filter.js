Nova.booting((Vue) => {
  Nova.inertia(
    "NovaSearchableBelongsToFilter",
    require("./components/Filter").default
  );
});
