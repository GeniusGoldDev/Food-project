(window.webpackJsonp = window.webpackJsonp || []).push([
    [17], {
        192: function (e, t, a) {
            "use strict";
            var l = a(3),
                o = a(4),
                r = a(7),
                n = a(6),
                c = a(8),
                s = a(0),
                i = a.n(s),
                m = a(18),
                u = a.n(m),
                d = a(217),
                p = a.n(d),
                g = function (e) {
                    function t() {
                        var e, a;
                        Object(l.a)(this, t);
                        for (var o = arguments.length, c = new Array(o), s = 0; s < o; s++) c[s] = arguments[s];
                        return (a = Object(r.a)(this, (e = Object(n.a)(t)).call.apply(e, [this].concat(c)))).state = {
                            shareButton: !1
                        }, a.shareLink = function (e) {
                            navigator.share && navigator.share({
                                url: e.link
                            }).then(function () {
                                return console.log("Successful share")
                            }).catch(function (e) {
                                return console.log("Error sharing", e)
                            })
                        }, a
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "componentDidMount",
                        value: function () {
                            navigator.share && this.setState({
                                shareButton: !0
                            })
                        }
                    }, {
                        key: "render",
                        value: function () {
                            var e = this;
                            return i.a.createElement(i.a.Fragment, null, this.state.shareButton && i.a.createElement("button", {
                                type: "button",
                                className: "btn search-navs-btns nav-home-btn",
                                style: {
                                    position: "relative"
                                },
                                onClick: function () {
                                    return e.shareLink(e.props)
                                }
                            }, i.a.createElement("i", {
                                className: "si si-share"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            })))
                        }
                    }]), t
                }(s.Component),
                h = function (e) {
                    function t() {
                        return Object(l.a)(this, t), Object(r.a)(this, Object(n.a)(t).apply(this, arguments))
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "render",
                        value: function () {
                            var e = this;
                            return i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "col-12 p-0 fixed",
                                style: {
                                    zIndex: "9"
                                }
                            }, i.a.createElement("div", {
                                className: "block m-0"
                            }, i.a.createElement("div", {
                                className: "block-content p-0 ".concat(this.props.dark && "nav-dark")
                            }, i.a.createElement("div", {
                                className: "input-group ".concat(this.props.boxshadow && "search-box")
                            }, !this.props.disable_back_button && i.a.createElement("div", {
                                className: "input-group-prepend"
                            }, this.props.back_to_home && i.a.createElement("button", {
                                type: "button",
                                className: "btn search-navs-btns",
                                style: {
                                    position: "relative"
                                },
                                onClick: function () {
                                    setTimeout(function () {
                                        e.context.router.history.push("/")
                                    }, 200)
                                }
                            }, i.a.createElement("i", {
                                className: "si si-arrow-left"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            })), this.props.goto_orders_page && i.a.createElement("button", {
                                type: "button",
                                className: "btn search-navs-btns",
                                style: {
                                    position: "relative"
                                },
                                onClick: function () {
                                    setTimeout(function () {
                                        e.context.router.history.push("/my-orders")
                                    }, 200)
                                }
                            }, i.a.createElement("i", {
                                className: "si si-arrow-left"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            })), this.props.goto_accounts_page && i.a.createElement("button", {
                                type: "button",
                                className: "btn search-navs-btns",
                                style: {
                                    position: "relative"
                                },
                                onClick: function () {
                                    setTimeout(function () {
                                        e.context.router.history.push("/my-account")
                                    }, 200)
                                }
                            }, i.a.createElement("i", {
                                className: "si si-arrow-left"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            })), !this.props.back_to_home && !this.props.goto_orders_page && !this.props.goto_accounts_page && i.a.createElement("button", {
                                type: "button",
                                className: "btn search-navs-btns ".concat(this.props.dark && "nav-dark"),
                                style: {
                                    position: "relative"
                                },
                                onClick: function () {
                                    setTimeout(function () {
                                        e.context.router.history.goBack()
                                    }, 200)
                                }
                            }, i.a.createElement("i", {
                                className: "si si-arrow-left"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            }))), i.a.createElement("p", {
                                className: "form-control search-input d-flex align-items-center ".concat(this.props.dark && "nav-dark")
                            }, this.props.logo && i.a.createElement("img", {
                                src: "/assets/img/logos/logo.png",
                                alt: localStorage.getItem("storeName"),
                                width: "120"
                            }), this.props.has_title ? i.a.createElement(i.a.Fragment, null, this.props.from_checkout ? i.a.createElement("span", {
                                className: "nav-page-title"
                            }, localStorage.getItem("cartToPayText"), " ", i.a.createElement("span", {
                                style: {
                                    color: localStorage.getItem("storeColor")
                                }
                            }, "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), this.props.title, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))) : i.a.createElement("span", {
                                className: "nav-page-title"
                            }, this.props.title)) : null, this.props.has_delivery_icon && i.a.createElement(p.a, {
                                left: !0
                            }, i.a.createElement("img", {
                                src: "/assets/img/various/delivery-bike.png",
                                alt: this.props.title,
                                className: "nav-page-title"
                            }))), this.props.has_restaurant_info ? i.a.createElement("div", {
                                className: "fixed-restaurant-info hidden",
                                ref: function (t) {
                                    e.heading = t
                                }
                            }, i.a.createElement("span", {
                                className: "font-w700 fixedRestaurantName"
                            }, this.props.restaurant.name), i.a.createElement("br", null), i.a.createElement("span", {
                                className: "font-w400 fixedRestaurantTime"
                            }, i.a.createElement("i", {
                                className: "si si-clock"
                            }), " ", this.props.restaurant.delivery_time, " ", localStorage.getItem("homePageMinsText"))) : null, i.a.createElement("div", {
                                className: "input-group-append"
                            }, !this.props.disable_search && i.a.createElement("button", {
                                type: "submit",
                                className: "btn search-navs-btns",
                                style: {
                                    position: "relative"
                                }
                            }, i.a.createElement("i", {
                                className: "si si-magnifier"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            })), this.props.homeButton && i.a.createElement("button", {
                                type: "button",
                                className: "btn search-navs-btns nav-home-btn",
                                style: {
                                    position: "relative"
                                },
                                onClick: function () {
                                    setTimeout(function () {
                                        e.context.router.history.push("/")
                                    }, 200)
                                }
                            }, i.a.createElement("i", {
                                className: "si si-home"
                            }), i.a.createElement(u.a, {
                                duration: "500"
                            })), this.props.shareButton && i.a.createElement(g, {
                                link: window.location.href
                            })))))))
                        }
                    }]), t
                }(s.Component);
            h.contextTypes = {
                router: function () {
                    return null
                }
            };
            t.a = h
        },
        218: function (e, t, a) {
            "use strict";
            a.d(t, "a", function () {
                return l
            });
            var l = function (e) {
                if (e) {
                    var t = parseFloat(e);
                    return t = t.toFixed(2)
                }
                return 0
            }
        },
        221: function (e, t, a) {
            "use strict";
            a.d(t, "a", function () {
                return r
            });
            var l = a(99),
                o = a(218),
                r = function (e) {
                    return function (t) {
                        var a = {
                            productQuantity: e.reduce(function (e, t) {
                                return ++e
                            }, 0),
                            totalPrice: e.reduce(function (e, t) {
                                var a = 0;
                                return t.selectedaddons && t.selectedaddons.map(function (e) {
                                    return a += parseFloat(e.price)
                                }), e += t.price * t.quantity + a * t.quantity, e = parseFloat(e), Object(o.a)(e), e
                            }, 0)
                        };
                        t({
                            type: l.a,
                            payload: a
                        })
                    }
                }
        },
        227: function (e, t, a) {
            "use strict";
            a.d(t, "a", function () {
                return l
            });
            var l = function (e, t, a, l) {
                function o(e) {
                    return e * Math.PI / 180
                }
                var r = o(l - t),
                    n = o(a - e),
                    c = Math.sin(r / 2) * Math.sin(r / 2) + Math.cos(o(t)) * Math.cos(o(l)) * Math.sin(n / 2) * Math.sin(n / 2);
                return 6371 * (2 * Math.atan2(Math.sqrt(c), Math.sqrt(1 - c)))
            }
        },
        230: function (e, t, a) {
            "use strict";
            a.d(t, "b", function () {
                return c
            }), a.d(t, "a", function () {
                return s
            });
            var l = a(102),
                o = a(9),
                r = a(5),
                n = a.n(r),
                c = function () {
                    return function (e) {
                        return e({
                            type: l.a,
                            payload: !0
                        })
                    }
                },
                s = function (e) {
                    return function (t) {
                        return n.a.post(o.h, {
                            items: e
                        }).then(function (e) {
                            return e.data
                        }).catch(function (e) {
                            console.log(e)
                        })
                    }
                }
        },
        237: function (e, t, a) {
            "use strict";
            a.d(t, "a", function () {
                return i
            });
            var l = a(101),
                o = a(9),
                r = a(80),
                n = a(5),
                c = a.n(n),
                s = a(221),
                i = function (e, t, a, n, i, m, u, d, p, g, h, y, f, b) {
                    return function (v, E) {
                        return c.a.post(o.bb, {
                            token: e.data.auth_token,
                            user: e,
                            order: t,
                            coupon: a,
                            location: n,
                            order_comment: i,
                            total: m,
                            method: u,
                            payment_token: d,
                            delivery_type: p,
                            partial_wallet: g,
                            dis: h,
                            pending_payment: y,
                            tipAmount: f,
                            cash_change_amount: b
                        }).then(function (e) {
                            var t = e.data;
                            if (!t.success) return t;
                            v({
                                type: l.a,
                                payload: t
                            });
                            var a = E().cart.products;
                            localStorage.removeItem("orderComment");
                            for (var o = a.length - 1; o >= 0; o--) a.splice(o, 1);
                            v(Object(s.a)(a)), localStorage.removeItem("appliedCoupon");
                            v({
                                type: r.a,
                                payload: []
                            })
                        }).catch(function (e) {
                            return e.response
                        })
                    }
                }
        },
        238: function (e, t, a) {
            "use strict";
            var l = a(227);
            t.a = function (e, t, a, o, r, n) {
                var c = [{
                        lat: parseFloat(t),
                        lng: parseFloat(e)
                    }],
                    s = [{
                        lat: parseFloat(o),
                        lng: parseFloat(a)
                    }],
                    i = r.maps.TravelMode.DRIVING;
                (new r.maps.DistanceMatrixService).getDistanceMatrix({
                    origins: c,
                    destinations: s,
                    travelMode: i
                }, function (r, c) {
                    if (console.log("RESPONSE", r), console.log("STATUS", r.rows[0].elements[0].status), "OK" === r.rows[0].elements[0].status) {
                        var s = (r.rows[0].elements[0].distance.value / 1e3).toFixed(1);
                        n(s)
                    } else {
                        console.log("Falling back to basic distance calculation");
                        var i = Object(l.a)(e, t, a, o);
                        n(i)
                    }
                })
            }
        },
        338: function (e, t, a) {
            "use strict";
            a.r(t);
            var l = a(3),
                o = a(4),
                r = a(7),
                n = a(6),
                c = a(8),
                s = a(0),
                i = a.n(s),
                m = a(192),
                u = a(43),
                d = a(50),
                p = a(97),
                g = a(42),
                h = a(59),
                y = a(288),
                f = a.n(y),
                b = a(293),
                v = a.n(b),
                E = a(9),
                S = a(16),
                k = a(218),
                w = a(237),
                _ = a(96),
                I = a(227),
                C = a(238),
                N = a(5),
                x = a.n(N),
                P = a(58),
                O = a(28),
                F = a.n(O),
                T = a(40),
                j = a(241),
                A = a(242),
                W = function (e) {
                    function t() {
                        var e, a;
                        Object(l.a)(this, t);
                        for (var o = arguments.length, c = new Array(o), s = 0; s < o; s++) c[s] = arguments[s];
                        return (a = Object(r.a)(this, (e = Object(n.a)(t)).call.apply(e, [this].concat(c)))).state = {
                            postal: ""
                        }, a.handleSubmit = function () {
                            var e = Object(T.a)(F.a.mark(function e(t) {
                                var l, o, r, n, c, s, i, m, u;
                                return F.a.wrap(function (e) {
                                    for (;;) switch (e.prev = e.next) {
                                        case 0:
                                            return t.preventDefault(), l = a.props, o = l.stripe, r = l.elements, n = l.data, c = r.getElement(A.CardNumberElement), e.next = 5, o.createPaymentMethod({
                                                type: "card",
                                                card: c
                                            });
                                        case 5:
                                            s = e.sent, i = s.error, m = s.paymentMethod, i ? console.log(i) : (n.data.handlePaymentProcessing(!0), u = m.id, x.a.post(E.lb, {
                                                token: n.data.user.data.auth_token,
                                                id: u,
                                                amount: 100 * n.data.total,
                                                currency: localStorage.getItem("currencyId"),
                                                payment_method_types: ["card"]
                                            }).then(function (e) {
                                                console.log("STRIPE DATA", e.data);
                                                var t = e.data.client_secret;
                                                console.log(t), o.confirmCardPayment(t).then(function (e) {
                                                    e.paymentIntent && "succeeded" === e.paymentIntent.status ? (console.log("Payment successful!!!"), n.data.placeOrder("", "STRIPE")) : (console.log("Something went wrong..."), n.data.handlePaymentProcessing(!1))
                                                }).catch(function (e) {
                                                    console.log(e)
                                                })
                                            }).catch(function (e) {
                                                n.data.handlePaymentProcessing(!1), console.log(e)
                                            }));
                                        case 9:
                                        case "end":
                                            return e.stop()
                                    }
                                }, e, this)
                            }));
                            return function (t) {
                                return e.apply(this, arguments)
                            }
                        }(), a
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "render",
                        value: function () {
                            var e = this,
                                t = this.props,
                                a = t.stripe,
                                l = t.data;
                            return i.a.createElement(i.a.Fragment, null, i.a.createElement("form", {
                                onSubmit: this.handleSubmit
                            }, i.a.createElement("label", {
                                htmlFor: "cardNumber"
                            }, localStorage.getItem("checkoutCardNumber")), i.a.createElement(A.CardNumberElement, {
                                id: "cardNumber"
                            }), i.a.createElement("label", {
                                htmlFor: "expiry"
                            }, localStorage.getItem("checkoutCardExpiration")), i.a.createElement(A.CardExpiryElement, {
                                id: "expiry"
                            }), i.a.createElement("label", {
                                htmlFor: "cvc"
                            }, localStorage.getItem("checkoutCardCvv")), i.a.createElement(A.CardCvcElement, {
                                id: "cvc"
                            }), "true" === localStorage.getItem("stripeCheckoutPostalCode") && i.a.createElement(i.a.Fragment, null, i.a.createElement("label", {
                                htmlFor: "postal"
                            }, localStorage.getItem("checkoutCardPostalCode")), i.a.createElement("input", {
                                id: "postal",
                                required: !0,
                                value: this.state.postal,
                                className: "form-control StripeElement",
                                onChange: function (t) {
                                    e.setState({
                                        postal: t.target.value
                                    })
                                }
                            })), i.a.createElement("button", {
                                type: "submit",
                                disabled: !a,
                                className: "btn stripe-pay-btn"
                            }, localStorage.getItem("checkoutPayText"), " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), l.data.total, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))))
                        }
                    }]), t
                }(s.Component),
                M = function (e) {
                    return i.a.createElement(i.a.Fragment, null, i.a.createElement(A.ElementsConsumer, null, function (t) {
                        var a = t.stripe,
                            l = t.elements;
                        return i.a.createElement(W, {
                            stripe: a,
                            elements: l,
                            data: e
                        })
                    }))
                },
                B = Object(j.a)(localStorage.getItem("stripePublicKey"), {
                    locale: localStorage.getItem("stripeLocale")
                }),
                L = function (e) {
                    return i.a.createElement(A.Elements, {
                        stripe: B
                    }, i.a.createElement(M, {
                        data: e
                    }))
                },
                z = {
                    classes: {
                        base: "StripeElementIdeal",
                        focus: "StripeElementIdeal--focus"
                    },
                    style: {
                        base: {
                            padding: "10px 8px",
                            fontSize: "15px",
                            color: "#5f5f5f",
                            letterSpacing: "0.025em",
                            "::placeholder": {
                                color: "#aab7c4"
                            }
                        },
                        invalid: {
                            color: "#9e2146"
                        }
                    }
                },
                R = function (e) {
                    function t() {
                        var e, a;
                        Object(l.a)(this, t);
                        for (var o = arguments.length, c = new Array(o), s = 0; s < o; s++) c[s] = arguments[s];
                        return (a = Object(r.a)(this, (e = Object(n.a)(t)).call.apply(e, [this].concat(c)))).state = {
                            name: "",
                            errorMessage: null,
                            paymentMethod: null,
                            client_secret: ""
                        }, a.handleSubmit = function () {
                            var e = Object(T.a)(F.a.mark(function e(t) {
                                var l, o, r, n, c, s, i, m;
                                return F.a.wrap(function (e) {
                                    for (;;) switch (e.prev = e.next) {
                                        case 0:
                                            return t.preventDefault(), l = a.props, o = l.stripe, r = l.elements, n = l.data, e.next = 4, o.createPaymentMethod({
                                                type: "ideal",
                                                ideal: r.getElement(A.IdealBankElement)
                                            });
                                        case 4:
                                            c = e.sent, s = c.error, i = c.paymentMethod, s || (n.data.handlePaymentProcessing(!0), m = i.id, x.a.post(E.lb, {
                                                token: n.data.user.data.auth_token,
                                                id: m,
                                                amount: 100 * n.data.total,
                                                currency: "eur",
                                                payment_method_types: ["ideal"]
                                            }).then(function (e) {
                                                new Promise(function (e) {
                                                    n.data.placeOrder("", "STRIPE", !0), e("Order Placed")
                                                }).then(function () {
                                                    a.setState({
                                                        client_secret: e.data.client_secret
                                                    })
                                                })
                                            }).catch(function (e) {
                                                n.data.handlePaymentProcessing(!1), console.log(e)
                                            }));
                                        case 8:
                                        case "end":
                                            return e.stop()
                                    }
                                }, e, this)
                            }));
                            return function (t) {
                                return e.apply(this, arguments)
                            }
                        }(), a.handleConfirmIdealPayment = function (e) {
                            var t = a.props,
                                l = t.stripe,
                                o = t.elements;
                            if ("" !== a.state.client_secret) {
                                var r = l.confirmIdealPayment(a.state.client_secret, {
                                    payment_method: {
                                        ideal: o.getElement(A.IdealBankElement),
                                        billing_details: {
                                            name: a.state.name
                                        }
                                    },
                                    return_url: E.mb + "?order_id=" + e.data.id
                                }).error;
                                r && console.log(r.message)
                            }
                        }, a
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "componentWillReceiveProps",
                        value: function (e) {
                            this.props.data.data.checkout !== e.data.data.checkout && (console.log("Order Placed"), this.handleConfirmIdealPayment(e.data.data.checkout))
                        }
                    }, {
                        key: "render",
                        value: function () {
                            var e = this,
                                t = this.props,
                                a = t.stripe,
                                l = t.data;
                            return i.a.createElement(i.a.Fragment, null, i.a.createElement("form", {
                                onSubmit: this.handleSubmit
                            }, i.a.createElement("label", {
                                htmlFor: "name"
                            }, localStorage.getItem("checkoutCardFullname")), i.a.createElement("input", {
                                id: "name",
                                required: !0,
                                className: "form-control StripeElement",
                                onChange: function (t) {
                                    e.setState({
                                        name: t.target.value
                                    })
                                }
                            }), i.a.createElement("label", {
                                htmlFor: "ideal"
                            }, localStorage.getItem("checkoutIdealSelectBankText")), i.a.createElement(A.IdealBankElement, {
                                id: "ideal",
                                options: z
                            }), i.a.createElement("button", {
                                type: "submit",
                                disabled: !a,
                                className: "btn stripe-pay-btn"
                            }, localStorage.getItem("checkoutPayText"), " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), l.data.total, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))))
                        }
                    }]), t
                }(s.Component),
                G = function (e) {
                    return i.a.createElement(A.ElementsConsumer, null, function (t) {
                        var a = t.stripe,
                            l = t.elements;
                        return i.a.createElement(R, {
                            stripe: a,
                            elements: l,
                            data: e
                        })
                    })
                },
                D = Object(j.a)(localStorage.getItem("stripePublicKey"), {
                    locale: localStorage.getItem("stripeLocale")
                }),
                K = Object(S.b)(function (e) {
                    return {
                        checkout: e.checkout.checkout
                    }
                }, {})(function (e) {
                    return i.a.createElement(A.Elements, {
                        stripe: D
                    }, i.a.createElement(G, {
                        data: e
                    }))
                }),
                Y = {
                    accountHolderType: "individual",
                    classes: {
                        base: "StripeElementFpx",
                        focus: "StripeElementFpx--focus"
                    },
                    style: {
                        base: {
                            padding: "10px 8px",
                            fontSize: "15px",
                            color: "#5f5f5f",
                            letterSpacing: "0.025em",
                            "::placeholder": {
                                color: "#aab7c4"
                            }
                        },
                        invalid: {
                            color: "#9e2146"
                        }
                    }
                },
                V = function (e) {
                    function t() {
                        var e, a;
                        Object(l.a)(this, t);
                        for (var o = arguments.length, c = new Array(o), s = 0; s < o; s++) c[s] = arguments[s];
                        return (a = Object(r.a)(this, (e = Object(n.a)(t)).call.apply(e, [this].concat(c)))).state = {
                            name: "",
                            errorMessage: null,
                            paymentMethod: null,
                            client_secret: ""
                        }, a.handleSubmit = function () {
                            var e = Object(T.a)(F.a.mark(function e(t) {
                                var l, o, r, n, c, s, i, m;
                                return F.a.wrap(function (e) {
                                    for (;;) switch (e.prev = e.next) {
                                        case 0:
                                            return t.preventDefault(), l = a.props, o = l.stripe, r = l.elements, n = l.data, e.next = 4, o.createPaymentMethod({
                                                type: "fpx",
                                                fpx: r.getElement(A.FpxBankElement)
                                            });
                                        case 4:
                                            c = e.sent, s = c.error, i = c.paymentMethod, s || (n.data.handlePaymentProcessing(!0), m = i.id, x.a.post(E.lb, {
                                                token: n.data.user.data.auth_token,
                                                id: m,
                                                amount: 100 * n.data.total,
                                                currency: "myr",
                                                payment_method_types: ["fpx"]
                                            }).then(function (e) {
                                                new Promise(function (e) {
                                                    n.data.placeOrder("", "STRIPE", !0), e("Order Placed")
                                                }).then(function () {
                                                    a.setState({
                                                        client_secret: e.data.client_secret
                                                    })
                                                })
                                            }).catch(function (e) {
                                                n.data.handlePaymentProcessing(!1), console.log(e)
                                            }));
                                        case 8:
                                        case "end":
                                            return e.stop()
                                    }
                                }, e, this)
                            }));
                            return function (t) {
                                return e.apply(this, arguments)
                            }
                        }(), a.handleConfirmFpxPayment = function (e) {
                            var t = a.props,
                                l = t.stripe,
                                o = t.elements;
                            if ("" !== a.state.client_secret) {
                                var r = l.confirmFpxPayment(a.state.client_secret, {
                                    payment_method: {
                                        fpx: o.getElement(A.FpxBankElement),
                                        billing_details: {
                                            name: a.state.name
                                        }
                                    },
                                    return_url: E.mb + "?order_id=" + e.data.id
                                }).error;
                                r && console.log(r.message)
                            }
                        }, a
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "componentWillReceiveProps",
                        value: function (e) {
                            this.props.data.data.checkout !== e.data.data.checkout && (console.log("Order Placed"), this.handleConfirmFpxPayment(e.data.data.checkout))
                        }
                    }, {
                        key: "render",
                        value: function () {
                            var e = this,
                                t = this.props,
                                a = t.stripe,
                                l = t.data;
                            return i.a.createElement(i.a.Fragment, null, i.a.createElement("form", {
                                onSubmit: this.handleSubmit
                            }, i.a.createElement("label", {
                                htmlFor: "name"
                            }, localStorage.getItem("checkoutCardFullname")), i.a.createElement("input", {
                                id: "name",
                                required: !0,
                                className: "form-control StripeElement",
                                onChange: function (t) {
                                    e.setState({
                                        name: t.target.value
                                    })
                                }
                            }), i.a.createElement("label", {
                                htmlFor: "fpx"
                            }, localStorage.getItem("checkoutFpxSelectBankText")), i.a.createElement(A.FpxBankElement, {
                                accountHolderType: "individual",
                                id: "fpx",
                                options: Y
                            }), i.a.createElement("button", {
                                type: "submit",
                                disabled: !a,
                                className: "btn stripe-pay-btn"
                            }, localStorage.getItem("checkoutPayText"), " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), l.data.total, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))))
                        }
                    }]), t
                }(s.Component),
                U = function (e) {
                    return i.a.createElement(A.ElementsConsumer, null, function (t) {
                        var a = t.stripe,
                            l = t.elements;
                        return i.a.createElement(V, {
                            stripe: a,
                            elements: l,
                            data: e
                        })
                    })
                },
                q = Object(j.a)(localStorage.getItem("stripePublicKey"), {
                    locale: localStorage.getItem("stripeLocale")
                }),
                H = Object(S.b)(function (e) {
                    return {
                        checkout: e.checkout.checkout
                    }
                }, {})(function (e) {
                    return i.a.createElement(A.Elements, {
                        stripe: q
                    }, i.a.createElement(U, {
                        data: e
                    }))
                }),
                J = a(311),
                Z = a(358),
                Q = a(1),
                X = a(297),
                $ = function (e) {
                    function t() {
                        return Object(l.a)(this, t), Object(r.a)(this, Object(n.a)(t).apply(this, arguments))
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "render",
                        value: function () {
                            var e = this.props,
                                t = e.total,
                                a = e.user,
                                l = e.placeOrder,
                                o = e.reset,
                                r = {
                                    public_key: localStorage.getItem("flutterwavePublicKey"),
                                    tx_ref: Date.now(),
                                    amount: t,
                                    currency: localStorage.getItem("currencyId"),
                                    payment_options: "card,mobilemoney,ussd",
                                    customer: {
                                        email: a.data.email,
                                        phonenumber: a.data.phone,
                                        name: a.data.name
                                    },
                                    customizations: {
                                        logo: window.location.origin + "/assets/img/favicons/" + localStorage.getItem("favicon-96x96")
                                    }
                                },
                                n = Object(Q.a)({}, r, {
                                    text: "Pay with Flutterwave",
                                    className: "flutterwave-btn",
                                    callback: function (e) {
                                        console.log(e), "successful" === e.status && l("", "FLUTTERWAVE"), Object(X.b)()
                                    },
                                    onClose: function () {
                                        console.log("flutterwave closed."), o()
                                    }
                                });
                            return i.a.createElement(i.a.Fragment, null, i.a.createElement(X.a, n))
                        }
                    }]), t
                }(s.Component),
                ee = a(298),
                te = a.n(ee),
                ae = function (e) {
                    function t() {
                        var e, a;
                        Object(l.a)(this, t);
                        for (var o = arguments.length, c = new Array(o), s = 0; s < o; s++) c[s] = arguments[s];
                        return (a = Object(r.a)(this, (e = Object(n.a)(t)).call.apply(e, [this].concat(c)))).state = {
                            payment_gateway_loading: !0,
                            loading: !1,
                            stripe_opened: !1,
                            delivery_charges: 0,
                            error: !1,
                            razorpay_opened: !1,
                            razorpay_success: !1,
                            canPayPartialWithWallet: !1,
                            walletChecked: !1,
                            canPayFullWithWallet: !1,
                            distance: 0,
                            placeOrderError: !1,
                            errorMessage: "",
                            payWithStripeCard: !1,
                            payWithStripeIdeal: !1,
                            payWithStripeFpx: !1,
                            paymongoCCNumber: "",
                            paymongoCCExp: "",
                            paymongoCCCvv: "",
                            showPaymongoForm: !1,
                            paymongoRedirect: "",
                            paymongo_processing: !1,
                            cashChange: "",
                            regexp: /^[0-9\b]+$/
                        }, a.__doesRestaurantOperatesAtThisLocation = function (e) {
                            var t = a.props.user;
                            if (t.success) {
                                var l = Object(p.a)(Object(p.a)(a));
                                if ("true" === localStorage.getItem("enGDMA")) "DELIVERY" === localStorage.getItem("userSelected") && a.props.handleProcessDistanceCalcLoading(!0), Object(C.a)(e.longitude, e.latitude, t.data.default_address.longitude, t.data.default_address.latitude, a.props.google, function (e) {
                                    "DELIVERY" === localStorage.getItem("userSelected") && ("DYNAMIC" === l.props.restaurant_info.delivery_charge_type && l.setState({
                                        distance: e
                                    }, function () {
                                        l.calculateDynamicDeliveryCharge()
                                    }), l.props.handleProcessDistanceCalcLoading(!1))
                                });
                                else {
                                    var o = Object(I.a)(e.longitude, e.latitude, t.data.default_address.longitude, t.data.default_address.latitude);
                                    "DELIVERY" === localStorage.getItem("userSelected") && "DYNAMIC" === a.props.restaurant_info.delivery_charge_type && a.setState({
                                        distance: o
                                    }, function () {
                                        a.calculateDynamicDeliveryCharge()
                                    })
                                }
                            }
                        }, a.calculateDynamicDeliveryCharge = function () {
                            var e = a.props.restaurant_info,
                                t = a.state.distance;
                            if (t > e.base_delivery_distance) {
                                var l = (t - e.base_delivery_distance) / e.extra_delivery_distance * e.extra_delivery_charge,
                                    o = parseFloat(e.base_delivery_charge) + parseFloat(l);
                                "true" === localStorage.getItem("enDelChrRnd") && (o = Math.ceil(o)), a.setState({
                                    delivery_charges: o
                                }, function () {
                                    a.processPayWithWalletBlocks()
                                })
                            } else a.setState({
                                delivery_charges: e.base_delivery_charge
                            }, function () {
                                a.processPayWithWalletBlocks()
                            })
                        }, a.processPayWithWalletBlocks = function () {
                            a.props.user.data.wallet_balance > 0 && (console.log("Can pay partial with wallet"), a.setState({
                                canPayPartialWithWallet: !0,
                                canPayFullWithWallet: !1
                            })), a.props.user.data.wallet_balance > 0 && a.props.user.data.wallet_balance >= parseFloat(a.getTotalAfterCalculation()) && (console.log("Can pay full with wallet"), a.setState({
                                canPayFullWithWallet: !0,
                                canPayPartialWithWallet: !1
                            }))
                        }, a.onOpened = function () {
                            a.setState({
                                stripe_opened: !0
                            })
                        }, a.onToken = function (e) {
                            a.__placeOrder(e, "STRIPE")
                        }, a.onSuccess = function (e) {
                            a.__placeOrder("", "PAYPAL")
                        }, a.onCancel = function (e) {
                            console.log("Paypal Payment Canceled")
                        }, a.onError = function (e) {
                            console.log("Error!")
                        }, a.callback = function (e) {
                            if ("success" === e.status) {
                                var t = e.reference;
                                a.__placeOrder(t, "PAYSTACK")
                            } else console.log(e)
                        }, a.close = function () {
                            console.log("PayStack Payment Closed")
                        }, a.getReference = function () {
                            for (var e = "", t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.=", a = 0; a < 15; a++) e += t.charAt(Math.floor(Math.random() * t.length));
                            return e
                        }, a.__placeOrder = function (e, t) {
                            for (var l = arguments.length > 2 && void 0 !== arguments[2] && arguments[2], o = document.getElementsByClassName("paymentGatewayBlock"), r = 0; r < o.length; r++) o[r].classList.add("no-click");
                            var n = null;
                            console.log("cart_tips", JSON.parse(localStorage.getItem("cart_tips"))), null != JSON.parse(localStorage.getItem("cart_tips")) && (n = JSON.parse(localStorage.getItem("cart_tips")).value);
                            var c = a.props,
                                s = c.user,
                                i = c.cartProducts,
                                m = c.coupon,
                                u = c.cartTotal;
                            if (s.success) {
                                "SELFPICKUP" === localStorage.getItem("userSelected") ? a.props.placeOrder(s, i, m.success ? m : null, JSON.parse(localStorage.getItem("userSetAddress")), localStorage.getItem("orderComment"), u, t, e, 2, a.state.walletChecked, parseFloat(a.state.distance), l, null, null).then(function (e) {
                                    e && (e.success || (a.setState({
                                        placeOrderError: !0,
                                        errorMessage: e.message
                                    }), 429 === e.status && a.setState({
                                        errorMessage: localStorage.getItem("tooManyApiCallMessage")
                                    }), a.resetPage()))
                                }) : a.props.placeOrder(s, i, m.success ? m : null, JSON.parse(localStorage.getItem("userSetAddress")), localStorage.getItem("orderComment"), u, t, e, 1, a.state.walletChecked, parseFloat(a.state.distance), l, n, a.state.cashChange).then(function (e) {
                                    e && (console.log("Came here"), console.log("THIS", e), 401 === e.status ? (a.setState({
                                        placeOrderError: !0,
                                        errorMessage: localStorage.getItem("userInActiveMessage")
                                    }), a.resetPage()) : e.success || (a.setState({
                                        placeOrderError: !0,
                                        errorMessage: e.message
                                    }), 429 === e.status && a.setState({
                                        errorMessage: localStorage.getItem("tooManyApiCallMessage")
                                    }), a.resetPage()))
                                });
                                var d = document.getElementById("progressBar");
                                d.classList.remove("hidden");
                                var p = 0,
                                    g = setInterval(function () {
                                        p > 100 && clearInterval(g), p += 1, d.style.width = p + "%"
                                    }, 20);
                                a.setState({
                                    stripe_opened: !1
                                })
                            }
                        }, a.resetPage = function () {
                            var e = document.getElementById("progressBar");
                            e.classList.add("hidden"), setTimeout(function () {
                                e.style.width = "0%"
                            }, 2200);
                            for (var t = document.getElementsByClassName("paymentGatewayBlock"), a = 0; a < t.length; a++) t[a].classList.remove("no-click")
                        }, a.getTotalAfterCalculation = function () {
                            var e = a.props,
                                t = e.coupon,
                                l = e.restaurant_info,
                                o = e.user,
                                r = JSON.parse(localStorage.getItem("cart_tips")),
                                n = a.props.cartTotal.totalPrice,
                                c = 0;
                            if (t.code)
                                if ("PERCENTAGE" === t.discount_type) {
                                    var s = Object(k.a)(t.discount / 100 * parseFloat(n));
                                    t.max_discount && parseFloat(s) >= t.max_discount && (s = t.max_discount), t.appliedAmount = s, c = Object(k.a)(Object(k.a)(parseFloat(n) - s + parseFloat(l.restaurant_charges || 0) + parseFloat(a.state.delivery_charges || 0)))
                                } else c = Object(k.a)(parseFloat(n) - (parseFloat(t.discount) || 0) + ((parseFloat(l.restaurant_charges) || 0) + (parseFloat(a.state.delivery_charges) || 0)));
                            else c = Object(k.a)(parseFloat(n) + parseFloat(l.restaurant_charges || 0) + parseFloat(a.state.delivery_charges || 0));
                            return "true" === localStorage.getItem("taxApplicable") ? (c = Object(k.a)(parseFloat(parseFloat(c) + parseFloat(parseFloat(localStorage.getItem("taxPercentage")) / 100) * c)), a.state.walletChecked && o.data.wallet_balance < c && (c -= o.data.wallet_balance)) : a.state.walletChecked && o.data.wallet_balance < c && (c -= o.data.wallet_balance), r && r.value > 0 && (c = parseFloat(c) + parseFloat(r.value)), Object(k.a)(c)
                        }, a.__handleKhaltiPayment = function () {
                            a.props.handleLoading(!0);
                            var e = Object(p.a)(Object(p.a)(a)),
                                t = {
                                    publicKey: localStorage.getItem("khaltiPublicKey"),
                                    productIdentity: localStorage.getItem("storeName"),
                                    productName: localStorage.getItem("storeName"),
                                    productUrl: localStorage.getItem("storeUrl"),
                                    eventHandler: {
                                        onSuccess: function (t) {
                                            console.log(t), e.__handleKhaltiPaymentSuccess(t)
                                        },
                                        onError: function (e) {
                                            console.log(e), alert("Something went wrong. Please try again.")
                                        },
                                        onClose: function () {
                                            e.props.handleLoading(!1)
                                        }
                                    }
                                },
                                l = new te.a(t),
                                o = 100 * a.getTotalAfterCalculation();
                            l.show({
                                amount: o
                            })
                        }, a.__handleKhaltiPaymentSuccess = function (e) {
                            x.a.get(E.R, {
                                params: {
                                    token: e.token,
                                    amount: e.amount
                                }
                            }).then(function (e) {
                                console.log("Verification Response: ", e), e.data.success && (console.log("success.. place order now"), a.__placeOrder(e.data.idx, "KHALTI"))
                            }).catch(function (e) {
                                alert("Something went wrong."), this.props.handleLoading(!1)
                            })
                        }, a.__handleRazorPay = function () {
                            var e = Object(p.a)(Object(p.a)(a));
                            a.setState({
                                razorpay_opened: !0
                            });
                            var t = Object(k.a)(parseFloat(a.getTotalAfterCalculation()));
                            x.a.post(E.cb, {
                                totalAmount: t
                            }).then(function (l) {
                                if (l.data.razorpay_success) {
                                    var o = {
                                        key: localStorage.getItem("razorpayKeyId"),
                                        amount: t,
                                        name: localStorage.getItem("storeName"),
                                        currency: localStorage.getItem("currencyId"),
                                        order_id: l.data.response.id,
                                        handler: function (t) {
                                            e.setState({
                                                razorpay_opened: !1,
                                                razorpay_success: !0
                                            });
                                            e.__placeOrder("", "RAZORPAY")
                                        },
                                        modal: {
                                            ondismiss: function () {
                                                console.log("closed"), e.setState({
                                                    razorpay_opened: !1,
                                                    razorpay_success: !1
                                                })
                                            }
                                        },
                                        prefill: {
                                            name: a.props.user.data.name,
                                            email: a.props.user.data.email,
                                            contact: a.props.user.data.phone
                                        }
                                    };
                                    new window.Razorpay(o).open()
                                }
                            }).catch(function (e) {
                                console.log(e)
                            })
                        }, a.handleInput = function (e) {
                            var t = e.target,
                                l = t.name,
                                o = t.value;
                            a.setState(Object(d.a)({}, l, o))
                        }, a.__showPaymongoForm = function () {
                            a.setState({
                                showPaymongoForm: !0
                            })
                        }, a.handlePaymongo = function (e) {
                            e.preventDefault();
                            var t = a.state.paymongoCCNumber,
                                l = a.state.paymongoCCExp,
                                o = a.state.paymongoCCCvv;
                            if ("" === t || "" === l || "" === o) a.setState({
                                placeOrderError: !0,
                                errorMessage: "Please enter credit card details."
                            });
                            else {
                                a.props.handleLoading(!0), a.setState({
                                    paymongo_processing: !0
                                });
                                var r = Object(p.a)(Object(p.a)(a));
                                a.setState({
                                    paymongo_opened: !0,
                                    showPaymongoForm: !1,
                                    placeOrderError: !1,
                                    errorMessage: ""
                                });
                                var n = Object(k.a)(parseFloat(a.getTotalAfterCalculation()));
                                x.a.post(E.Y, {
                                    amount: n,
                                    name: a.props.user.data.name,
                                    email: a.props.user.data.email,
                                    phone: a.props.user.data.phone,
                                    ccNum: t,
                                    ccExp: l,
                                    ccCvv: o
                                }).then(function (e) {
                                    console.log(e), e.data.paymongo_success && ("succeeded" === e.data.status ? (r.setState({
                                        paymongo_opened: !1,
                                        paymongo_success: !0
                                    }), a.__placeOrder(e.data.token, "PAYMONGO", !1)) : "awaiting_next_action" === e.data.status ? (console.log("3d secure"), r.setState({
                                        paymongo_opened: !1,
                                        paymongo_success: !0,
                                        paymongoRedirect: e.data.redirect_url
                                    }), a.__placeOrder(e.data.token, "PAYMONGO", !0)) : (a.props.handleLoading(!1), r.setState({
                                        paymongo_processing: !1,
                                        paymongo_opened: !0,
                                        paymongo_success: !1,
                                        placeOrderError: !0,
                                        errorMessage: "Payment failed: " + e.data.error
                                    })))
                                }).catch(function (e) {
                                    console.log(e)
                                })
                            }
                        }, a.handlePayWithStripeCardToggle = function (e) {
                            a.setState({
                                payWithStripeCard: !a.state.payWithStripeCard
                            }, function () {
                                a.state.payWithStripeCard ? (a.refs.payWithStripeCardToggle.classList.add("stripe-toggle-active"), a.refs.payWithStripeCardToggle.scrollIntoView({
                                    behavior: "instant",
                                    block: "start"
                                })) : a.refs.payWithStripeCardToggle.classList.remove("stripe-toggle-active")
                            })
                        }, a.handlePayWithStripeIdealToggle = function (e) {
                            a.setState({
                                payWithStripeIdeal: !a.state.payWithStripeIdeal
                            }, function () {
                                a.state.payWithStripeIdeal ? (a.refs.payWithStripeIdealToggle.classList.add("stripe-toggle-active"), a.refs.payWithStripeIdealToggle.scrollIntoView({
                                    behavior: "instant",
                                    block: "start"
                                })) : a.refs.payWithStripeIdealToggle.classList.remove("stripe-toggle-active")
                            })
                        }, a.handlePayWithStripeFpxToggle = function (e) {
                            a.setState({
                                payWithStripeFpx: !a.state.payWithStripeFpx
                            }, function () {
                                a.state.payWithStripeFpx ? (a.refs.payWithStripeFpxToggle.classList.add("stripe-toggle-active"), a.refs.payWithStripeFpxToggle.scrollIntoView({
                                    behavior: "instant",
                                    block: "start"
                                })) : a.refs.payWithStripeFpxToggle.classList.remove("stripe-toggle-active")
                            })
                        }, a.handlePaymentGatewayRedirect = function (e) {
                            console.log("I am here"), console.log("Placed order", a.props.checkout.id);
                            var t = e + "&order_id=" + a.props.checkout.id;
                            window.location.replace(t)
                        }, a.__processFlutterWave = function () {
                            for (var e = document.getElementsByClassName("paymentGatewayBlock"), t = 0; t < e.length; t++) e[t].classList.add("no-click");
                            document.getElementsByClassName("flutterwave-btn")[0].click()
                        }, a.__showCashChangeBlock = function (e) {
                            a.refs.cashAmountBlock.classList.remove("hidden");
                            for (var t = document.getElementsByClassName("paymentGatewayBlock"), l = 0; l < t.length; l++) t[l].classList.add("hidden");
                            a.refs.paymentListTitle.innerHTML = localStorage.getItem("cashChangeTitle")
                        }, a.__handleCashInput = function (e) {
                            var t = e.target.value;
                            ("" === t || a.state.regexp.test(t)) && t.length <= 8 && a.setState(Object(d.a)({}, e.target.name, t))
                        }, a.__handleCashInputConfirm = function (e) {
                            e.target.disabled = !0, a.__placeOrder("", "COD")
                        }, a
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "componentDidMount",
                        value: function () {
                            var e = this,
                                t = this.props.user;
                            null !== localStorage.getItem("activeRestaurant") && this.props.getRestaurantInfoById(localStorage.getItem("activeRestaurant")).then(function (t) {
                                t && t.payload.id && e.__doesRestaurantOperatesAtThisLocation(t.payload)
                            }), t.success && this.props.updateUserInfo(t.data.id, t.data.auth_token, null), "SELFPICKUP" === localStorage.getItem("userSelected") ? this.setState({
                                delivery_charges: 0
                            }) : this.setState({
                                delivery_charges: this.props.restaurant_info.delivery_charges
                            })
                        }
                    }, {
                        key: "componentWillReceiveProps",
                        value: function (e) {
                            if (e.gatewayStatus && this.setState({
                                    payment_gateway_loading: !1
                                }), e.checkout !== this.props.checkout) {
                                if (localStorage.removeItem("appliedCoupon"), "PAYMONGO" === e.checkout.data.payment_mode && "" !== this.state.paymongoRedirect) return window.location = this.state.paymongoRedirect, null;
                                if ("MERCADOPAGO" === e.checkout.data.payment_mode) return window.location = E.W + "/" + e.checkout.data.id, null;
                                if (8 !== e.checkout.data.orderstatus_id && this.context.router.history.push("/running-order/" + e.checkout.data.unique_order_id), "PAYTM" === e.checkout.data.payment_mode) return window.location = E.Z + "/" + e.checkout.data.id, null
                            }
                            e.user.data.wallet_balance > 0 && this.setState({
                                canPayPartialWithWallet: !0,
                                canPayFullWithWallet: !1
                            }), console.log("Outside:" + parseFloat(this.getTotalAfterCalculation())), e.user.data.wallet_balance > 0 && e.user.data.wallet_balance >= parseFloat(this.getTotalAfterCalculation()) && (console.log("Inside:" + parseFloat(this.getTotalAfterCalculation())), this.setState({
                                canPayFullWithWallet: !0,
                                canPayPartialWithWallet: !1
                            }))
                        }
                    }, {
                        key: "render",
                        value: function () {
                            var e = this,
                                t = {
                                    sandbox: localStorage.getItem("paypalSandboxKey"),
                                    production: localStorage.getItem("paypalProductionKey")
                                };
                            return this.props.toPay(Object(k.a)(parseFloat(this.getTotalAfterCalculation()))), this.props.restaurant_info && !this.props.restaurant_info.is_active ? (console.log("store is closed"), i.a.createElement(Z.a, {
                                to: "/cart"
                            })) : i.a.createElement(i.a.Fragment, null, this.state.placeOrderError && i.a.createElement("div", {
                                className: "auth-error ongoing-payment"
                            }, i.a.createElement("div", {
                                className: "error-shake"
                            }, this.state.errorMessage)), this.props.paymentgateways.some(function (e) {
                                return "Razorpay" === e.name
                            }) && i.a.createElement(h.Helmet, null, i.a.createElement("script", {
                                src: "https://checkout.razorpay.com/v1/checkout.js"
                            })), (this.state.stripe_opened || this.state.razorpay_opened) && i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "height-80 overlay-loading ongoing-payment-spin"
                            }, i.a.createElement("div", {
                                className: "spin-load"
                            })), i.a.createElement("div", {
                                className: "auth-error ongoing-payment"
                            }, i.a.createElement("div", {
                                className: "error-shake"
                            }, localStorage.getItem("checkoutPaymentInProcess")))), i.a.createElement("div", {
                                className: "col-12 mb-50"
                            }, this.state.payment_gateway_loading ? i.a.createElement("div", {
                                className: "row"
                            }, i.a.createElement("div", {
                                className: "col-12"
                            }, i.a.createElement("div", {
                                className: "block block-link-shadow text-left shadow-light"
                            }, i.a.createElement("div", {
                                className: "block-content block-content-full clearfix py-3 payment-select-block"
                            }, i.a.createElement(g.a, {
                                height: 70,
                                width: window.innerWidth,
                                speed: 1.2,
                                primaryColor: "#f3f3f3",
                                secondaryColor: "#ecebeb"
                            }, i.a.createElement("rect", {
                                x: "320",
                                y: "10",
                                rx: "4",
                                ry: "4",
                                width: "55",
                                height: "55"
                            }), i.a.createElement("rect", {
                                x: "0",
                                y: "10",
                                rx: "0",
                                ry: "0",
                                width: "85",
                                height: "20"
                            }), i.a.createElement("rect", {
                                x: "0",
                                y: "40",
                                rx: "0",
                                ry: "0",
                                width: "190",
                                height: "18"
                            }))))), i.a.createElement("div", {
                                className: "col-12"
                            }, i.a.createElement("div", {
                                className: "block block-link-shadow text-left shadow-light"
                            }, i.a.createElement("div", {
                                className: "block-content block-content-full clearfix py-3 payment-select-block"
                            }, i.a.createElement(g.a, {
                                height: 70,
                                width: window.innerWidth,
                                speed: 1.2,
                                primaryColor: "#f3f3f3",
                                secondaryColor: "#ecebeb"
                            }, i.a.createElement("rect", {
                                x: "320",
                                y: "10",
                                rx: "4",
                                ry: "4",
                                width: "55",
                                height: "55"
                            }), i.a.createElement("rect", {
                                x: "0",
                                y: "10",
                                rx: "0",
                                ry: "0",
                                width: "85",
                                height: "20"
                            }), i.a.createElement("rect", {
                                x: "0",
                                y: "40",
                                rx: "0",
                                ry: "0",
                                width: "190",
                                height: "18"
                            })))))) : i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "row"
                            }, this.state.canPayPartialWithWallet && i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "col-12",
                                onClick: function () {
                                    return e.setState({
                                        walletChecked: !e.state.walletChecked
                                    })
                                }
                            }, i.a.createElement("div", {
                                className: "block block-link-shadow text-left shadow-light"
                            }, i.a.createElement("div", {
                                className: "block-content block-content-full clearfix py-3 payment-select-block"
                            }, i.a.createElement("div", {
                                className: "float-right mt-10"
                            }, i.a.createElement("img", {
                                src: "/assets/img/various/wallet.png",
                                alt: localStorage.getItem("walletName"),
                                className: "img-fluid"
                            })), i.a.createElement("input", {
                                type: "checkbox",
                                name: "walletcheckbox",
                                defaultChecked: this.props.walletChecked,
                                className: "wallet-checkbox"
                            }), i.a.createElement("div", {
                                className: "font-size-h3 font-w600"
                            }, this.state.walletChecked && i.a.createElement("i", {
                                className: "si si-check mr-2",
                                style: {
                                    color: localStorage.getItem("cartColorBg"),
                                    fontWeight: "900"
                                }
                            }), localStorage.getItem("walletName"), ":", " ", i.a.createElement("span", {
                                style: {
                                    color: localStorage.getItem("storeColor")
                                }
                            }, "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), this.props.user.data.wallet_balance, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))), i.a.createElement("div", {
                                className: "font-size-sm font-w600 text-muted"
                            }, this.state.walletChecked ? i.a.createElement(i.a.Fragment, null, i.a.createElement("span", {
                                style: {
                                    color: localStorage.getItem("storeColor")
                                }
                            }, " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), this.props.user.data.wallet_balance, " ", "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat")), " ", localStorage.getItem("willbeDeductedText"), " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), this.props.user.data.wallet_balance, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat")) : i.a.createElement(i.a.Fragment, null, i.a.createElement("span", null, localStorage.getItem("payPartialWithWalletText")), i.a.createElement("button", {
                                className: "btn btn-redeem mt-2",
                                style: {
                                    color: localStorage.getItem("cartColorBg"),
                                    borderColor: localStorage.getItem("cartColorBg")
                                }
                            }, localStorage.getItem("walletRedeemBtnText")))))), i.a.createElement("hr", {
                                className: "mb-4"
                            }))), i.a.createElement("hr", null), i.a.createElement("div", {
                                className: "col-12 text-center mb-0 mt-4"
                            }, i.a.createElement("h4", {
                                className: "text-muted",
                                ref: "paymentListTitle"
                            }, localStorage.getItem("checkoutPaymentListTitle"))), this.state.canPayFullWithWallet && i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "col-12 paymentGatewayBlock",
                                onClick: function () {
                                    return e.__placeOrder("", "WALLET")
                                }
                            }, i.a.createElement("p", {
                                className: "mb-1"
                            }), i.a.createElement("div", {
                                className: "block block-link-shadow text-left shadow-light"
                            }, i.a.createElement("div", {
                                className: "block-content block-content-full clearfix py-3 payment-select-block"
                            }, i.a.createElement("div", {
                                className: "float-right mt-10"
                            }, i.a.createElement("img", {
                                src: "/assets/img/various/wallet.png",
                                alt: localStorage.getItem("walletName"),
                                className: "img-fluid"
                            })), i.a.createElement("div", {
                                className: "font-size-h3 font-w600"
                            }, localStorage.getItem("walletName")), i.a.createElement("div", {
                                className: "font-size-sm font-w600 text-muted"
                            }, localStorage.getItem("payFullWithWalletText"), i.a.createElement("br", null), i.a.createElement("span", {
                                style: {
                                    color: localStorage.getItem("storeColor")
                                }
                            }, "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), parseFloat(this.getTotalAfterCalculation()), "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat")), " ", localStorage.getItem("willbeDeductedText"), " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), this.props.user.data.wallet_balance, "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))))), i.a.createElement("hr", null)), i.a.createElement("div", {
                                className: "col-12"
                            }, "true" === localStorage.getItem("stripeAcceptIdealPayment") && i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "col-12 p-0",
                                ref: "payWithStripeIdealToggle",
                                onClick: this.handlePayWithStripeIdealToggle
                            }, i.a.createElement("div", {
                                className: "block block-link-shadow text-left shadow-light"
                            }, i.a.createElement("div", {
                                className: "block-content block-content-full clearfix py-3 payment-select-block"
                            }, i.a.createElement("div", {
                                className: "float-right mt-10"
                            }, i.a.createElement("img", {
                                src: "/assets/img/various/ideal.png",
                                alt: "stripe-ideal",
                                className: "img-fluid",
                                style: {
                                    width: "50px"
                                }
                            })), i.a.createElement("div", {
                                className: "font-size-h3 font-w600"
                            }, localStorage.getItem("checkoutStripeIdealText"), i.a.createElement("div", {
                                className: "font-size-sm font-w600 text-muted"
                            }, localStorage.getItem("checkoutStripeIdealSubText")))))), this.state.payWithStripeIdeal && i.a.createElement("div", {
                                className: "stripe-card-container"
                            }, i.a.createElement(K, {
                                user: this.props.user,
                                total: Object(k.a)(parseFloat(this.getTotalAfterCalculation())),
                                handlePaymentProcessing: this.props.handleLoading,
                                placeOrder: this.__placeOrder,
                                handlePaymentGatewayRedirect: this.handlePaymentGatewayRedirect,
                                checkout: this.props.checkout
                            })))), i.a.createElement("div", {
                                className: "col-12"
                            }, "true" === localStorage.getItem("stripeAcceptFpxPayment") && i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                className: "col-12 p-0",
                                ref: "payWithStripeFpxToggle",
                                onClick: this.handlePayWithStripeFpxToggle
                            }, i.a.createElement("div", {
                                className: "block block-link-shadow text-left shadow-light"
                            }, i.a.createElement("div", {
                                className: "block-content block-content-full clearfix py-3 payment-select-block"
                            }, i.a.createElement("div", {
                                className: "float-right mt-10"
                            }, i.a.createElement("img", {
                                src: "/assets/img/various/fpx.png",
                                alt: "stripe-fpx",
                                className: "img-fluid",
                                style: {
                                    width: "50px"
                                }
                            })), i.a.createElement("div", {
                                className: "font-size-h3 font-w600"
                            }, localStorage.getItem("checkoutStripeFpxText"), i.a.createElement("div", {
                                className: "font-size-sm font-w600 text-muted"
                            }, localStorage.getItem("checkoutStripeFpxSubText")))))), this.state.payWithStripeFpx && i.a.createElement("div", {
                                className: "stripe-card-container"
                            }, i.a.createElement(H, {
                                user: this.props.user,
                                total: Object(k.a)(parseFloat(this.getTotalAfterCalculation())),
                                handlePaymentProcessing: this.props.handleLoading,
                                placeOrder: this.__placeOrder,
                                handlePaymentGatewayRedirect: this.handlePaymentGatewayRedirect,
                                checkout: this.props.checkout
                            })))), this.props.paymentgateways.map(function (a) {
                                return i.a.createElement(i.a.Fragment, {
                                    key: a.id
                                }, "Stripe" === a.name && i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock stripe-gateway-block"
                                }, i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                    className: "col-12 p-0",
                                    ref: "payWithStripeCardToggle",
                                    onClick: e.handlePayWithStripeCardToggle
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/stripe.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutStripeText"), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutStripeSubText")))))), e.state.payWithStripeCard && i.a.createElement("div", {
                                    className: "stripe-card-container"
                                }, i.a.createElement(L, {
                                    user: e.props.user,
                                    total: Object(k.a)(parseFloat(e.getTotalAfterCalculation())),
                                    handlePaymentProcessing: e.props.handleLoading,
                                    placeOrder: e.__placeOrder
                                })))), "COD" === a.name && i.a.createElement(i.a.Fragment, null, "true" === localStorage.getItem("showCashChange") ? i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__showCashChangeBlock()
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/cod.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutCodText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutCodSubText"))))), i.a.createElement("div", {
                                    className: "col-12 hidden",
                                    ref: "cashAmountBlock"
                                }, i.a.createElement("div", {
                                    className: "text-left"
                                }, i.a.createElement("input", {
                                    type: "tel",
                                    name: "cashChange",
                                    value: e.state.cashChange,
                                    className: "form-control cash-change-input",
                                    placeholder: localStorage.getItem("cashChangeInputPlaceholder"),
                                    onChange: e.__handleCashInput
                                }), i.a.createElement("button", {
                                    className: "btn btn-main",
                                    style: {
                                        backgroundColor: localStorage.getItem("cartColorBg")
                                    },
                                    onClick: e.__handleCashInputConfirm
                                }, localStorage.getItem("cashChangeConfirmButton")), i.a.createElement("p", {
                                    className: "pt-2"
                                }, localStorage.getItem("cashChangeHelpText"))))) : i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__placeOrder("", "COD")
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/cod.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutCodText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutCodSubText")))))), "Khalti" === a.name && i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__handleKhaltiPayment()
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/khalti.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutKhaltiText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutKhaltiSubText"))))), "Paytm" === a.name && i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__placeOrder("", "PAYTM")
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/paytm.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutPaytmText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutPaytmSubText"))))), "Flutterwave" === a.name && i.a.createElement(i.a.Fragment, null, i.a.createElement($, {
                                    user: e.props.user,
                                    total: Object(k.a)(parseFloat(e.getTotalAfterCalculation())),
                                    placeOrder: e.__placeOrder,
                                    reset: e.resetPage
                                }), i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__processFlutterWave()
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/flutterwave.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutFlutterwaveText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutFlutterwaveSubText")))))), "Razorpay" === a.name && i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__handleRazorPay()
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/razorpay.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutRazorpayText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutRazorpaySubText"))))), "PayStack" === a.name && i.a.createElement("div", {
                                    className: "col-12 mb-4 mt-4 paymentGatewayBlock"
                                }, i.a.createElement(v.a, {
                                    text: localStorage.getItem("paystackPayText"),
                                    class: "payButton",
                                    callback: e.callback,
                                    close: e.close,
                                    disabled: !1,
                                    embed: !1,
                                    reference: e.getReference(),
                                    email: e.props.user.data.email,
                                    amount: parseInt(parseFloat(100 * e.getTotalAfterCalculation())),
                                    paystackkey: localStorage.getItem("paystackPublicKey"),
                                    tag: "button",
                                    currency: localStorage.getItem("currencyId")
                                })), "Paypal" === a.name && i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock"
                                }, i.a.createElement(f.a, {
                                    env: localStorage.getItem("paypalEnv"),
                                    client: t,
                                    currency: localStorage.getItem("currencyId"),
                                    total: parseFloat(e.getTotalAfterCalculation()),
                                    shipping: 1,
                                    onError: e.onError,
                                    onSuccess: e.onSuccess,
                                    onCancel: e.onCancel,
                                    style: {
                                        size: "responsive",
                                        color: "silver",
                                        shape: "rect"
                                    }
                                })), "MercadoPago" === a.name && i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__placeOrder("", "MERCADOPAGO")
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/mercadopago.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutMercadoPagoText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutMercadoPagoSubText"))))), "PayMongo" === a.name && (e.state.showPaymongoForm ? i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock"
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("form", {
                                    onSubmit: e.handlePaymongo
                                }, i.a.createElement(J.a, null, function (t) {
                                    var a = t.meta,
                                        l = t.getCardNumberProps,
                                        o = t.getExpiryDateProps,
                                        r = t.getCVCProps;
                                    return i.a.createElement(i.a.Fragment, null, i.a.createElement("div", {
                                        className: "font-size-h4 font-w600 mb-2"
                                    }, localStorage.getItem("checkoutPayMongoText")), i.a.createElement("input", Object.assign({
                                        className: "form-control edit-address-input"
                                    }, l({
                                        onChange: e.handleInput
                                    }), {
                                        name: "paymongoCCNumber",
                                        value: e.state.paymongoCCNumber,
                                        placeholder: localStorage.getItem("checkoutCardNumber")
                                    })), i.a.createElement("input", Object.assign({
                                        className: "form-control edit-address-input"
                                    }, o({
                                        onChange: e.handleInput
                                    }), {
                                        name: "paymongoCCExp",
                                        value: e.state.paymongoCCExp,
                                        placeholder: localStorage.getItem("checkoutCardExpiration")
                                    })), i.a.createElement("input", Object.assign({
                                        className: "form-control edit-address-input"
                                    }, r({
                                        onChange: e.handleInput
                                    }), {
                                        value: e.state.paymongoCCCvv,
                                        name: "paymongoCCCvv",
                                        placeholder: localStorage.getItem("checkoutCardCvv")
                                    })), a.isTouched && a.error && i.a.createElement("span", null, "Error: ", a.error))
                                }), i.a.createElement("div", {
                                    className: "mt-20 px-15 pt-15 button-block"
                                }, i.a.createElement("button", {
                                    type: "submit",
                                    className: "btn btn-main",
                                    style: {
                                        backgroundColor: localStorage.getItem("storeColor")
                                    }
                                }, localStorage.getItem("checkoutPayText"), " ", "left" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"), e.getTotalAfterCalculation(), "right" === localStorage.getItem("currencySymbolAlign") && localStorage.getItem("currencyFormat"))))))) : i.a.createElement("div", {
                                    className: "col-12 paymentGatewayBlock",
                                    onClick: function () {
                                        return e.__showPaymongoForm()
                                    }
                                }, i.a.createElement("div", {
                                    className: "block block-link-shadow text-left shadow-light"
                                }, i.a.createElement("div", {
                                    className: "block-content block-content-full clearfix py-3 payment-select-block"
                                }, i.a.createElement("div", {
                                    className: "float-right mt-10"
                                }, i.a.createElement("img", {
                                    src: "/assets/img/various/paymongo.png",
                                    alt: a.name,
                                    className: "img-fluid"
                                })), i.a.createElement("div", {
                                    className: "font-size-h3 font-w600"
                                }, localStorage.getItem("checkoutPayMongoText")), i.a.createElement("div", {
                                    className: "font-size-sm font-w600 text-muted"
                                }, localStorage.getItem("checkoutPayMongoSubText")))))))
                            })))),i.a.createElement("div", {
                                className: "col-12 test",
                                style: {
                                    color:"black",
                                    width:"100%",
                                },
                                },i.a.innerHTML='You can check out with your credit card without creating a PayPal account'
                            ),
                             i.a.createElement("div", {
                                className: "progress push m-0 progress-transparent",
                                style: {
                                    height: "8px"
                                }
                            }, i.a.createElement("div", {
                                className: "progress-bar progress-bar-striped progress-bar-animated hidden",
                                role: "progressbar",
                                id: "progressBar",
                                style: {
                                    backgroundColor: localStorage.getItem("storeColor"),
                                    width: "10%"
                                }
                            })))
                        }
                    }]), t
                }(s.Component);
            ae.contextTypes = {
                router: function () {
                    return null
                }
            };
            var le = Object(S.b)(function (e) {
                    return {
                        user: e.user.user,
                        addresses: e.addresses.addresses,
                        cartProducts: e.cart.products,
                        cartTotal: e.total.data,
                        coupon: e.coupon.coupon,
                        checkout: e.checkout.checkout,
                        restaurant_info: e.items.restaurant_info
                    }
                }, {
                    placeOrder: w.a,
                    updateUserInfo: _.l,
                    getRestaurantInfoById: P.d
                })(ae),
                oe = a(230),
                re = a(119),
                ne = a(231),
                ce = a(13),
                se = function (e) {
                    function t() {
                        var e, a;
                        Object(l.a)(this, t);
                        for (var o = arguments.length, c = new Array(o), s = 0; s < o; s++) c[s] = arguments[s];
                        return (a = Object(r.a)(this, (e = Object(n.a)(t)).call.apply(e, [this].concat(c)))).state = {
                            loading: !1,
                            process_distance_calc_loading: !1,
                            continueFetchPaymentGateway: !0,
                            gateways_received: !1,
                            toPay: ""
                        }, a.handleLoading = function (e) {
                            a.setState({
                                loading: e
                            })
                        }, a.fetchPaymentGateways = function (e) {
                            a.state.continueFetchPaymentGateway ? (console.log("fetching again..."), a.props.getPaymentGateways(e, localStorage.getItem("activeRestaurant")).then(function (e) {
                                e && e.payload && a.setState({
                                    continueFetchPaymentGateway: !1,
                                    gateways_received: !0
                                })
                            })) : clearInterval(a.retryPaymentGatewaySetInterval)
                        }, a.handleProcessDistanceCalcLoading = function (e) {
                            a.setState({
                                process_distance_calc_loading: e
                            })
                        }, a.handleToPayText = function (e) {
                            setTimeout(function () {
                                a.setState({
                                    toPay: e
                                })
                            }, 200)
                        }, a
                    }
                    return Object(c.a)(t, e), Object(o.a)(t, [{
                        key: "componentDidMount",
                        value: function () {
                            var e = this,
                                t = this.props.user;
                            t && this.props.getPaymentGateways(t.data.auth_token, localStorage.getItem("activeRestaurant")).then(function (a) {
                                a && a.payload ? e.setState({
                                    gateways_received: !0
                                }) : (console.error("fetching payment gateways failed... trying again after 2.5s"), e.retryPaymentGatewaySetInterval = setInterval(function () {
                                    e.fetchPaymentGateways(t.data.auth_token)
                                }, 2500))
                            }), this.props.cartProducts.length && document.getElementsByTagName("body")[0].classList.add("bg-grey-light")
                        }
                    }, {
                        key: "componentWillUnmount",
                        value: function () {
                            document.getElementsByTagName("body")[0].classList.remove("bg-grey-light"), clearInterval(this.retryPaymentGatewaySetInterval)
                        }
                    }, {
                        key: "render",
                        value: function () {
                            return this.props.cartProducts.length, window.innerWidth > 768 ? i.a.createElement(Z.a, {
                                to: "/"
                            }) : this.props.confirmCart ? null === localStorage.getItem("storeColor") ? i.a.createElement(Z.a, {
                                to: "/"
                            }) : i.a.createElement(i.a.Fragment, null, this.state.loading && i.a.createElement(ce.a, null), this.state.process_distance_calc_loading && i.a.createElement(ce.a, null), i.a.createElement(u.a, {
                                seotitle: localStorage.getItem("checkoutPageTitle"),
                                seodescription: localStorage.getItem("seoMetaDescription"),
                                ogtype: "website",
                                ogtitle: localStorage.getItem("seoOgTitle"),
                                ogdescription: localStorage.getItem("seoOgDescription"),
                                ogurl: window.location.href,
                                twittertitle: localStorage.getItem("seoTwitterTitle"),
                                twitterdescription: localStorage.getItem("seoTwitterDescription")
                            }), i.a.createElement(m.a, {
                                boxshadow: !0,
                                has_title: !0,
                                title: this.state.toPay,
                                disable_search: !0,
                                from_checkout: !0
                            }), i.a.createElement("div", {
                                className: "pt-50"
                            }, i.a.createElement("div", {
                                className: "pt-30"
                            }), i.a.createElement(le, {
                                handleProcessDistanceCalcLoading: this.handleProcessDistanceCalcLoading,
                                paymentgateways: this.props.paymentgateways,
                                gatewayStatus: this.state.gateways_received,
                                handleLoading: this.handleLoading,
                                toPay: this.handleToPayText,
                                google: this.props.google
                            }))) : i.a.createElement(Z.a, {
                                to: "/cart"
                            })
                        }
                    }]), t
                }(s.Component);
            t.default = Object(ne.GoogleApiWrapper)({
                apiKey: localStorage.getItem("googleApiKey"),
                LoadingContainer: ce.a
            })(Object(S.b)(function (e) {
                return {
                    total: e.total.total,
                    user: e.user.user,
                    cartProducts: e.cart.products,
                    cartTotal: e.total.data,
                    coupon: e.coupon.coupon,
                    confirmCart: e.confirmCart.confirmCart,
                    paymentgateways: e.paymentgateways.paymentgateways
                }
            }, {
                checkConfirmCart: oe.b,
                getPaymentGateways: function (e, t) {
                    return function (a) {
                        return x.a.post(E.z, {
                            token: e,
                            restaurant_id: t
                        }).then(function (e) {
                            var t = e.data;
                            return a({
                                type: re.a,
                                payload: t
                            })
                        }).catch(function (e) {
                            console.log(e)
                        })
                    }
                }
            })(se))
        }
    }
]);