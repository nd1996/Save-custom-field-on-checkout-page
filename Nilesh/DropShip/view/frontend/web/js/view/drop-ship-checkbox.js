define([
        'ko',
        'uiComponent',
        'jquery',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/url',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Ui/js/model/messageList',
        'mage/translate'
    ], function (ko, Component, $, customer, quote, urlBuilder, urlFormatter, errorProcessor, messageContainer, __) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Nilesh_DropShip/drop-ship-checkbox'
            },
            initialize: function() {
                this._super();
                var self = this;
                self.isDropShipChecked = ko.observable(1);
                self.validate = ko.computed(function () {
                    var isCustomer = customer.isLoggedIn(),
                        quoteId = quote.getQuoteId(),
                        dropShip = self.isDropShipChecked() ? 1 : 0,
                        url = urlBuilder.createUrl('/dropship/savedropship', {});

                    console.log(url);

                    if (!isCustomer) {
                        return '';
                    }

                    var payload = {
                        cartId: quoteId,
                        dropShip: dropShip
                    };

                    $.ajax({
                        url: urlFormatter.build(url),
                        data: JSON.stringify(payload),
                        global: false,
                        contentType: 'application/json',
                        type: 'POST',
                        async: false
                    }).done(
                        function (response) {
                            //
                            console.log(response);
                        }
                    ).fail(
                        function (response) {
                            //
                            console.log(response);
                            errorProcessor.process(response);
                        }
                    );

                    return "";
                });
            },

            // isDropShipChecked: false
        });
    }
);
