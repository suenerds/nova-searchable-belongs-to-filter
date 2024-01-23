Nova.booting((Vue, router) => {
  router.addRoutes([
    {
      name: "nova-searchable-belongs-to-filter",
      path: "/nova-searchable-belongs-to-filter",
      component: require("./components/Filter"),
    },
  ]);
});

Nova.booting((Vue) => {
  Nova.inertia(
    "NovaSearchableBelongsToFilter",
    require("./components/Filter").default
  );
});
