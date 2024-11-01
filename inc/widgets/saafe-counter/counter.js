var SaafeCounterHandler = function ($scope, $) {
    var counterElement = $scope.find(".ste-counter"),
        counterSettings = counterElement.data(),
        incrementElement = counterElement.find(".ste-counter-init");

    var waypoint = new Waypoint({
        element: counterElement,  // Target the #counter element
        handler: function(direction) {
            if (direction === 'down') {
                $(incrementElement).numerator(counterSettings);
            }
        },
        offset: '80%'  // Trigger when 80% of the element is in view
    });
};
jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/saafe-counter.default",
        SaafeCounterHandler
    );
});