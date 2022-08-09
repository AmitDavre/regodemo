"use strict";
! function(e) {
    "object" == typeof module && "object" == typeof module.exports ? e(require("jquery"), window, document) : e(jQuery, window, document)
}(function(p, u, f, d) {
    function t(e, t) {
        this.$chartContainer = p(e), this.opts = t, this.defaultOptions = {
            nodeTitle: "name",
            nodeId: "id",
            toggleSiblingsResp: !1,
            visibleLevel: 999,
            chartClass: "",
            exportButton: !1,
            exportButtonName: "Export",
            exportFilename: "OrgChart",
            exportFileextension: "png",
            parentNodeSymbol: "oci-leader",
            draggable: !1,
            direction: "t2b",
            pan: !1,
            zoom: !1,
            zoominLimit: 7,
            zoomoutLimit: .5
        }
    }
    t.prototype = {
        init: function(e) {
            var n = this;
            this.options = p.extend({}, this.defaultOptions, this.opts, e);
            var t = this.$chartContainer;
            this.$chart && this.$chart.remove();
            var i = this.options.data,
                s = this.$chart = p("<div>", {
                    data: {
                        options: this.options
                    },
                    class: "orgchart" + ("" !== this.options.chartClass ? " " + this.options.chartClass : "") + ("t2b" !== this.options.direction ? " " + this.options.direction : ""),
                    click: function(e) {
                        p(e.target).closest(".node").length || s.find(".node.focused").removeClass("focused")
                    }
                });
            "undefined" != typeof MutationObserver && this.triggerInitEvent();
            var o = s.append(p('<ul class="nodes"><li class="hierarchy"></li></ul>')).find(".hierarchy");
            return "object" === p.type(i) ? i instanceof p ? this.buildHierarchy(o, this.buildJsonDS(i.children()), 0, this.options) : this.buildHierarchy(o, this.options.ajaxURL ? i : this.attachRel(i, "00")) : (s.append('<i class="oci oci-spinner spinner"></i>'), p.ajax({
                url: i,
                dataType: "json"
            }).done(function(e, t, i) {
                n.buildHierarchy(o, n.options.ajaxURL ? e : n.attachRel(e, "00"), 0, n.options)
            }).fail(function(e, t, i) {
                console.log(i)
            }).always(function() {
                s.children(".spinner").remove()
            })), t.append(s), this.options.exportButton && !p(".oc-export-btn").length && this.attachExportButton(), this.options.pan && this.bindPan(), this.options.zoom && this.bindZoom(), this
        },
        triggerInitEvent: function() {
            var s = this,
                o = new MutationObserver(function(e) {
                    o.disconnect();
                    e: for (var t = 0; t < e.length; t++)
                        for (var i = 0; i < e[t].addedNodes.length; i++)
                            if (e[t].addedNodes[i].classList.contains("orgchart")) {
                                s.options.initCompleted && "function" == typeof s.options.initCompleted && s.options.initCompleted(s.$chart);
                                var n = p.Event("init.orgchart");
                                s.$chart.trigger(n);
                                break e
                            }
                });
            o.observe(this.$chartContainer[0], {
                childList: !0
            })
        },
        triggerLoadEvent: function(e, t) {
            var i = p.Event("load-" + t + ".orgchart");
            e.trigger(i)
        },
        triggerShowEvent: function(e, t) {
            var i = p.Event("show-" + t + ".orgchart");
            e.trigger(i)
        },
        triggerHideEvent: function(e, t) {
            var i = p.Event("hide-" + t + ".orgchart");
            e.trigger(i)
        },
        attachExportButton: function() {
            var t = this,
                e = p("<button>", {
                    class: "oc-export-btn",
                    text: this.options.exportButtonName,
                    click: function(e) {
                        e.preventDefault(), t.export()
                    }
                });
            this.$chartContainer.after(e)
        },
        setOptions: function(e, t) {
            return "string" == typeof e && ("pan" === e && (t ? this.bindPan() : this.unbindPan()), "zoom" === e && (t ? this.bindZoom() : this.unbindZoom())), "object" == typeof e && (e.data ? this.init(e) : (void 0 !== e.pan && (e.pan ? this.bindPan() : this.unbindPan()), void 0 !== e.zoom && (e.zoom ? this.bindZoom() : this.unbindZoom()))), this
        },
        panStartHandler: function(e) {
            var o = p(e.delegateTarget);
            if (p(e.target).closest(".node").length || e.touches && 1 < e.touches.length) o.data("panning", !1);
            else {
                o.css("cursor", "move").data("panning", !0);
                var t = 0,
                    i = 0,
                    n = o.css("transform");
                if ("none" !== n) {
                    var s = n.split(",");
                    i = -1 === n.indexOf("3d") ? (t = parseInt(s[4]), parseInt(s[5])) : (t = parseInt(s[12]), parseInt(s[13]))
                }
                var a = 0,
                    r = 0;
                if (e.targetTouches) {
                    if (1 === e.targetTouches.length) a = e.targetTouches[0].pageX - t, r = e.targetTouches[0].pageY - i;
                    else if (1 < e.targetTouches.length) return
                } else a = e.pageX - t, r = e.pageY - i;
                o.on("mousemove touchmove", function(e) {
                    if (o.data("panning")) {
                        var t = 0,
                            i = 0;
                        if (e.targetTouches) {
                            if (1 === e.targetTouches.length) t = e.targetTouches[0].pageX - a, i = e.targetTouches[0].pageY - r;
                            else if (1 < e.targetTouches.length) return
                        } else t = e.pageX - a, i = e.pageY - r;
                        var n = o.css("transform");
                        if ("none" === n) - 1 === n.indexOf("3d") ? o.css("transform", "matrix(1, 0, 0, 1, " + t + ", " + i + ")") : o.css("transform", "matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, " + t + ", " + i + ", 0, 1)");
                        else {
                            var s = n.split(","); - 1 === n.indexOf("3d") ? (s[4] = " " + t, s[5] = " " + i + ")") : (s[12] = " " + t, s[13] = " " + i), o.css("transform", s.join(","))
                        }
                    }
                })
            }
        },
        panEndHandler: function(e) {
            e.data.chart.data("panning") && e.data.chart.data("panning", !1).css("cursor", "default").off("mousemove")
        },
        bindPan: function() {
            this.$chartContainer.css("overflow", "hidden"), this.$chart.on("mousedown touchstart", this.panStartHandler), p(f).on("mouseup touchend", {
                chart: this.$chart
            }, this.panEndHandler)
        },
        unbindPan: function() {
            this.$chartContainer.css("overflow", "auto"), this.$chart.off("mousedown touchstart", this.panStartHandler), p(f).off("mouseup touchend", this.panEndHandler)
        },
        zoomWheelHandler: function(e) {
            var t = e.data.oc;
            e.preventDefault();
            var i = 1 + (0 < e.originalEvent.deltaY ? -.2 : .2);
            t.setChartScale(t.$chart, i)
        },
        zoomStartHandler: function(e) {
            if (e.touches && 2 === e.touches.length) {
                var t = e.data.oc;
                t.$chart.data("pinching", !0);
                var i = t.getPinchDist(e);
                t.$chart.data("pinchDistStart", i)
            }
        },
        zoomingHandler: function(e) {
            var t = e.data.oc;
            if (t.$chart.data("pinching")) {
                var i = t.getPinchDist(e);
                t.$chart.data("pinchDistEnd", i)
            }
        },
        zoomEndHandler: function(e) {
            var t = e.data.oc;
            if (t.$chart.data("pinching")) {
                t.$chart.data("pinching", !1);
                var i = t.$chart.data("pinchDistEnd") - t.$chart.data("pinchDistStart");
                0 < i ? t.setChartScale(t.$chart, 1.2) : i < 0 && t.setChartScale(t.$chart, .8)
            }
        },
        bindZoom: function() {
            this.$chartContainer.on("wheel", {
                oc: this
            }, this.zoomWheelHandler), this.$chartContainer.on("touchstart", {
                oc: this
            }, this.zoomStartHandler), p(f).on("touchmove", {
                oc: this
            }, this.zoomingHandler), p(f).on("touchend", {
                oc: this
            }, this.zoomEndHandler)
        },
        unbindZoom: function() {
            this.$chartContainer.off("wheel", this.zoomWheelHandler), this.$chartContainer.off("touchstart", this.zoomStartHandler), p(f).off("touchmove", this.zoomingHandler), p(f).off("touchend", this.zoomEndHandler)
        },
        getPinchDist: function(e) {
            return Math.sqrt((e.touches[0].clientX - e.touches[1].clientX) * (e.touches[0].clientX - e.touches[1].clientX) + (e.touches[0].clientY - e.touches[1].clientY) * (e.touches[0].clientY - e.touches[1].clientY))
        },
        setChartScale: function(e, t) {
            var i = e.data("options"),
                n = e.css("transform"),
                s = "",
                o = 1;
            "none" === n ? e.css("transform", "scale(" + t + "," + t + ")") : (s = n.split(","), -1 === n.indexOf("3d") ? (o = Math.abs(u.parseFloat(s[3]) * t)) > i.zoomoutLimit && o < i.zoominLimit && e.css("transform", n + " scale(" + t + "," + t + ")") : (o = Math.abs(u.parseFloat(s[1]) * t)) > i.zoomoutLimit && o < i.zoominLimit && e.css("transform", n + " scale3d(" + t + "," + t + ", 1)"))
        },
        buildJsonDS: function(e) {
            var t = this,
                i = {
                    name: e.contents().eq(0).text().trim(),
                    relationship: (e.parent().parent().is("li") ? "1" : "0") + (e.siblings("li").length ? 1 : 0) + (e.children("ul").length ? 1 : 0)
                };
            return p.each(e.data(), function(e, t) {
                i[e] = t
            }), e.children("ul").children().each(function() {
                i.children || (i.children = []), i.children.push(t.buildJsonDS(p(this)))
            }), i
        },
        attachRel: function(t, e) {
            var i = this;
            return t.relationship = e + (t.children && 0 < t.children.length ? 1 : 0), t.children && t.children.forEach(function(e) {
                i.attachRel(e, "1" + (1 < t.children.length ? 1 : 0))
            }), t
        },
        loopChart: function(e, t) {
            t = null !== t && t !== d && t;
            var i = this,
                n = e.find(".node:first"),
                s = {
                    id: n[0].id
                };
            return t && p.each(n.data("nodeData"), function(e, t) {
                s[e] = t
            }), n.siblings(".nodes").children().each(function() {
                s.children || (s.children = []), s.children.push(i.loopChart(p(this), t))
            }), s
        },
        getHierarchy: function(e) {
            if (e = null !== e && e !== d && e, void 0 === this.$chart) return "Error: orgchart does not exist";
            if (!this.$chart.find(".node").length) return "Error: nodes do not exist";
            var t = !0;
            return this.$chart.find(".node").each(function() {
                if (!this.id) return t = !1
            }), t ? this.loopChart(this.$chart, e) : "Error: All nodes of orghcart to be exported must have data-id attribute!"
        },
        getNodeState: function(e, t) {
            var i = {},
                n = !!e.closest("vertical").length;
            if ("parent" === (t = t || "self")) {
                if (n ? (i = e.closest("ul").parents("ul")).length || (i = e.closest(".nodes")).length || (i = e.closest(".vertical").siblings(":first")) : i = e.closest(".nodes").siblings(".node"), i.length) return i.is(".hidden") || !i.is(".hidden") && i.closest(".nodes").is(".hidden") || !i.is(".hidden") && i.closest(".vertical").is(".hidden") ? {
                    exist: !0,
                    visible: !1
                } : {
                    exist: !0,
                    visible: !0
                }
            } else if ("children" === t) {
                if ((i = n ? e.parent().children("ul") : e.siblings(".nodes")).length) return i.is(".hidden") ? {
                    exist: !0,
                    visible: !1
                } : {
                    exist: !0,
                    visible: !0
                }
            } else if ("siblings" === t) {
                if ((i = n ? e.closest("ul") : e.parent().siblings()).length && (!n || 1 < i.children("li").length)) return i.is(".hidden") || i.parent().is(".hidden") || n && i.closest(".vertical").is(".hidden") ? {
                    exist: !0,
                    visible: !1
                } : {
                    exist: !0,
                    visible: !0
                }
            } else if ((i = e).length) return i.closest(".nodes").length && i.closest(".nodes").is(".hidden") || i.closest(".hierarchy").length && i.closest(".hierarchy").is(".hidden") || i.closest(".vertical").length && (i.closest(".nodes").is(".hidden") || i.closest(".vertical").is(".hidden")) ? {
                exist: !0,
                visible: !1
            } : {
                exist: !0,
                visible: !0
            };
            return {
                exist: !1,
                visible: !1
            }
        },
        getRelatedNodes: function(e, t) {
            return e && e instanceof p && e.is(".node") ? "parent" === t ? e.closest(".nodes").siblings(".node") : "children" === t ? e.siblings(".nodes").children(".hierarchy").find(".node:first") : "siblings" === t ? e.closest(".hierarchy").siblings().find(".node:first") : p() : p()
        },
        hideParentEnd: function(e) {
            p(e.target).removeClass("sliding"), e.data.parent.addClass("hidden")
        },
        hideParent: function(e) {
            var t = e.closest(".nodes").siblings(".node");
            t.find(".spinner").length && e.closest(".orgchart").data("inAjax", !1), this.getNodeState(e, "siblings").visible && this.hideSiblings(e), e.parent().addClass("isAncestorsCollapsed"), this.getNodeState(t).visible && t.addClass("sliding slide-down").one("transitionend", {
                parent: t
            }, this.hideParentEnd), this.getNodeState(t, "parent").visible && this.hideParent(t)
        },
        showParentEnd: function(e) {
            var t = e.data.node;
            p(e.target).removeClass("sliding"), this.isInAction(t) && this.switchVerticalArrow(t.children(".topEdge"))
        },
        showParent: function(e) {
            var t = e.closest(".nodes").siblings(".node").removeClass("hidden");
            e.closest(".hierarchy").removeClass("isAncestorsCollapsed"), this.repaint(t[0]), t.addClass("sliding").removeClass("slide-down").one("transitionend", {
                node: e
            }, this.showParentEnd.bind(this))
        },
        stopAjax: function(e) {
            e.find(".spinner").length && e.closest(".orgchart").data("inAjax", !1)
        },
        isVisibleNode: function(e, t) {
            return this.getNodeState(p(t)).visible
        },
        hideChildrenEnd: function(e) {
            var t = e.data.node;
            e.data.animatedNodes.removeClass("sliding"), e.data.animatedNodes.closest(".nodes").addClass("hidden"), this.isInAction(t) && this.switchVerticalArrow(t.children(".bottomEdge"))
        },
        hideChildren: function(e) {
            e.closest(".hierarchy").addClass("isChildrenCollapsed");
            var t = e.siblings(".nodes");
            this.stopAjax(t);
            var i = t.find(".node").filter(this.isVisibleNode.bind(this));
            t.is(".vertical") || i.closest(".hierarchy").addClass("isCollapsedDescendant"), (t.is(".vertical") || t.find(".vertical").length) && i.find(".oci-minus-square").removeClass("oci-minus-square").addClass("oci-plus-square"), this.repaint(i.get(0)), i.addClass("sliding slide-up").eq(0).one("transitionend", {
                animatedNodes: i,
                lowerLevel: t,
                node: e
            }, this.hideChildrenEnd.bind(this))
        },
        showChildrenEnd: function(e) {
            var t = e.data.node;
            e.data.animatedNodes.removeClass("sliding"), this.isInAction(t) && this.switchVerticalArrow(t.children(".bottomEdge"))
        },
        showChildren: function(e) {
            e.closest(".hierarchy").removeClass("isChildrenCollapsed");
            var t = e.siblings(".nodes"),
                i = t.is(".vertical"),
                n = i ? t.removeClass("hidden").find(".node").filter(this.isVisibleNode.bind(this)) : t.removeClass("hidden").children(".hierarchy").find(".node:first").filter(this.isVisibleNode.bind(this));
            i || (n.filter(":not(:only-child)").closest(".hierarchy").addClass("isChildrenCollapsed"), n.closest(".hierarchy").removeClass("isCollapsedDescendant")), this.repaint(n.get(0)), n.addClass("sliding").removeClass("slide-up").eq(0).one("transitionend", {
                node: e,
                animatedNodes: n
            }, this.showChildrenEnd.bind(this))
        },
        hideSiblingsEnd: function(e) {
            var t = e.data.node,
                i = e.data.nodeContainer,
                n = e.data.direction,
                s = n ? "left" === n ? i.prevAll(":not(.hidden)") : i.nextAll(":not(.hidden)") : i.siblings();
            e.data.animatedNodes.removeClass("sliding"), s.find(".node:gt(0)").filter(this.isVisibleNode.bind(this)).removeClass("slide-left slide-right").addClass("slide-up"), s.find(".nodes, .vertical").addClass("hidden").end().addClass("hidden"), this.isInAction(t) && this.switchHorizontalArrow(t)
        },
        hideSiblings: function(e, t) {
            var i = e.closest(".hierarchy").addClass("isSiblingsCollapsed");
            i.siblings().find(".spinner").length && e.closest(".orgchart").data("inAjax", !1), t ? "left" === t ? i.addClass("left-sibs").prevAll(".isSiblingsCollapsed").removeClass("isSiblingsCollapsed left-sibs").end().prevAll().addClass("isCollapsedSibling isChildrenCollapsed").find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-right") : i.addClass("right-sibs").nextAll(".isSiblingsCollapsed").removeClass("isSiblingsCollapsed right-sibs").end().nextAll().addClass("isCollapsedSibling isChildrenCollapsed").find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-left") : (i.prevAll().find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-right"), i.nextAll().find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-left"), i.siblings().addClass("isCollapsedSibling isChildrenCollapsed"));
            var n = i.siblings().find(".sliding");
            n.eq(0).one("transitionend", {
                node: e,
                nodeContainer: i,
                direction: t,
                animatedNodes: n
            }, this.hideSiblingsEnd.bind(this))
        },
        showSiblingsEnd: function(e) {
            var t = e.data.node;
            e.data.visibleNodes.removeClass("sliding"), this.isInAction(t) && (this.switchHorizontalArrow(t), t.children(".topEdge").removeClass("oci-chevron-up").addClass("oci-chevron-down"))
        },
        showRelatedParentEnd: function(e) {
            p(e.target).removeClass("sliding")
        },
        showSiblings: function(e, t) {
            var i = p(),
                n = e.closest(".hierarchy");
            i = t ? "left" === t ? n.prevAll().removeClass("hidden") : n.nextAll().removeClass("hidden") : e.closest(".hierarchy").siblings().removeClass("hidden");
            var s = e.closest(".nodes").siblings(".node");
            t ? (n.removeClass(t + "-sibs"), n.is("[class*=-sibs]") || n.removeClass("isSiblingsCollapsed"), i.removeClass("isCollapsedSibling " + t + "-sibs")) : (e.closest(".hierarchy").removeClass("isSiblingsCollapsed"), i.removeClass("isCollapsedSibling")), this.getNodeState(e, "parent").visible || (e.closest(".hierarchy").removeClass("isAncestorsCollapsed"), s.removeClass("hidden"), this.repaint(s[0]), s.addClass("sliding").removeClass("slide-down").one("transitionend", this.showRelatedParentEnd));
            var o = i.find(".node").filter(this.isVisibleNode.bind(this));
            this.repaint(o.get(0)), o.addClass("sliding").removeClass("slide-left slide-right"), o.eq(0).one("transitionend", {
                node: e,
                visibleNodes: o
            }, this.showSiblingsEnd.bind(this))
        },
        startLoading: function(e) {
            var t = this.$chart;
            return (void 0 === t.data("inAjax") || !0 !== t.data("inAjax")) && (e.addClass("hidden"), e.parent().append('<i class="oci oci-spinner spinner"></i>').children().not(".spinner").css("opacity", .2), t.data("inAjax", !0), p(".oc-export-btn").prop("disabled", !0), !0)
        },
        endLoading: function(e) {
            var t = e.parent();
            e.removeClass("hidden"), t.find(".spinner").remove(), t.children().removeAttr("style"), this.$chart.data("inAjax", !1), p(".oc-export-btn").prop("disabled", !1)
        },
        isInAction: function(e) {
            return -1 < e.children(".edge").attr("class").indexOf("oci-")
        },
        switchVerticalArrow: function(e) {
            e.toggleClass("oci-chevron-up").toggleClass("oci-chevron-down")
        },
        switchHorizontalArrow: function(e) {
            var t = this.options;
            if (t.toggleSiblingsResp && (void 0 === t.ajaxURL || e.closest(".nodes").data("siblingsLoaded"))) {
                var i = e.parent().prev();
                i.length && (i.is(".hidden") ? e.children(".leftEdge").addClass("oci-chevron-left").removeClass("oci-chevron-right") : e.children(".leftEdge").addClass("oci-chevron-right").removeClass("oci-chevron-left"));
                var n = e.parent().next();
                n.length && (n.is(".hidden") ? e.children(".rightEdge").addClass("oci-chevron-right").removeClass("oci-chevron-left") : e.children(".rightEdge").addClass("oci-chevron-left").removeClass("oci-chevron-right"))
            } else {
                var s = e.parent().siblings(),
                    o = !!s.length && !s.is(".hidden");
                e.children(".leftEdge").toggleClass("oci-chevron-right", o).toggleClass("oci-chevron-left", !o), e.children(".rightEdge").toggleClass("oci-chevron-left", o).toggleClass("oci-chevron-right", !o)
            }
        },
        repaint: function(e) {
            e && (e.style.offsetWidth = e.offsetWidth)
        },
        nodeEnterLeaveHandler: function(e) {
            var t = p(e.delegateTarget),
                i = !1;
            if (t.closest(".nodes.vertical").length) {
                var n = t.children(".toggleBtn");
                "mouseenter" === e.type ? t.children(".toggleBtn").length && (i = this.getNodeState(t, "children").visible, n.toggleClass("oci-plus-square", !i).toggleClass("oci-minus-square", i)) : n.removeClass("oci-plus-square oci-minus-square")
            } else {
                var s = t.children(".topEdge"),
                    o = (t.children(".rightEdge"), t.children(".bottomEdge")),
                    a = t.children(".leftEdge");
                "mouseenter" === e.type ? (s.length && (i = this.getNodeState(t, "parent").visible, s.toggleClass("oci-chevron-up", !i).toggleClass("oci-chevron-down", i)), o.length && (i = this.getNodeState(t, "children").visible, o.toggleClass("oci-chevron-down", !i).toggleClass("oci-chevron-up", i)), a.length && this.switchHorizontalArrow(t)) : t.children(".edge").removeClass("oci-chevron-up oci-chevron-down oci-chevron-right oci-chevron-left")
            }
        },
        nodeClickHandler: function(e) {
            this.$chart.find(".focused").removeClass("focused"), p(e.delegateTarget).addClass("focused")
        },
        loadNodes: function(t, e, i) {
            var n = this;
            this.options;
            p.ajax({
                url: e,
                dataType: "json"
            }).done(function(e) {
                n.$chart.data("inAjax") && ("parent" === t ? p.isEmptyObject(e) || n.addParent(i.parent(), e) : "children" === t ? e.children.length && n.addChildren(i.parent(), e[t]) : n.addSiblings(i.parent(), e.siblings ? e.siblings : e), n.triggerLoadEvent(i.parent(), t))
            }).fail(function() {
                console.log("Failed to get " + t + " data")
            }).always(function() {
                n.endLoading(i)
            })
        },
        HideFirstParentEnd: function(e) {
            var t = e.data.topEdge,
                i = t.parent();
            this.isInAction(i) && (this.switchVerticalArrow(t), this.switchHorizontalArrow(i))
        },
        topEdgeClickHandler: function(e) {
            e.stopPropagation();
            var t = p(e.target),
                i = p(e.delegateTarget),
                n = this.getNodeState(i, "parent");
            if (n.exist) {
                var s = i.closest(".nodes").siblings(".node");
                if (s.is(".sliding")) return;
                n.visible ? (this.hideParent(i), s.one("transitionend", {
                    topEdge: t
                }, this.HideFirstParentEnd.bind(this)), this.triggerHideEvent(i, "parent")) : (this.showParent(i), this.triggerShowEvent(i, "parent"))
            } else if (this.startLoading(t)) {
                var o = this.options,
                    a = p.isFunction(o.ajaxURL.parent) ? o.ajaxURL.parent(i.data("nodeData")) : o.ajaxURL.parent + i[0].id;
                this.loadNodes("parent", a, t)
            }
        },
        bottomEdgeClickHandler: function(e) {
            e.stopPropagation();
            var t = p(e.target),
                i = p(e.delegateTarget),
                n = this.getNodeState(i, "children");
            if (n.exist) {
                if (i.siblings(".nodes").children().children(".node").is(".sliding")) return;
                n.visible ? (this.hideChildren(i), this.triggerHideEvent(i, "children")) : (this.showChildren(i), this.triggerShowEvent(i, "children"))
            } else if (this.startLoading(t)) {
                var s = this.options,
                    o = p.isFunction(s.ajaxURL.children) ? s.ajaxURL.children(i.data("nodeData")) : s.ajaxURL.children + i[0].id;
                this.loadNodes("children", o, t)
            }
        },
        hEdgeClickHandler: function(e) {
            e.stopPropagation();
            var t = p(e.target),
                i = p(e.delegateTarget),
                n = this.options,
                s = this.getNodeState(i, "siblings");
            if (s.exist) {
                if (i.closest(".hierarchy").siblings().find(".sliding").length) return;
                if (n.toggleSiblingsResp) {
                    var o = i.closest(".hierarchy").prev(),
                        a = i.closest(".hierarchy").next();
                    t.is(".leftEdge") ? o.is(".hidden") ? (this.showSiblings(i, "left"), this.triggerShowEvent(i, "siblings")) : (this.hideSiblings(i, "left"), this.triggerHideEvent(i, "siblings")) : a.is(".hidden") ? (this.showSiblings(i, "right"), this.triggerShowEvent(i, "siblings")) : (this.hideSiblings(i, "right"), this.triggerHideEvent(i, "siblings"))
                } else s.visible ? (this.hideSiblings(i), this.triggerHideEvent(i, "siblings")) : (this.showSiblings(i), this.triggerShowEvent(i, "siblings"))
            } else if (this.startLoading(t)) {
                var r = i[0].id,
                    d = this.getNodeState(i, "parent").exist ? p.isFunction(n.ajaxURL.siblings) ? n.ajaxURL.siblings(i.data("nodeData")) : n.ajaxURL.siblings + r : p.isFunction(n.ajaxURL.families) ? n.ajaxURL.families(i.data("nodeData")) : n.ajaxURL.families + r;
                this.loadNodes("siblings", d, t)
            }
        },
        expandVNodesEnd: function(e) {
            e.data.vNodes.removeClass("sliding")
        },
        collapseVNodesEnd: function(e) {
            e.data.vNodes.removeClass("sliding").closest("ul").addClass("hidden")
        },
        toggleVNodes: function(e) {
            var t = p(e.target),
                i = t.parent().next(),
                n = i.find(".node"),
                s = i.children().children(".node");
            s.is(".sliding") || (t.toggleClass("oci-plus-square oci-minus-square"), n.eq(0).is(".slide-up") ? (i.removeClass("hidden"), this.repaint(s.get(0)), s.addClass("sliding").removeClass("slide-up").eq(0).one("transitionend", {
                vNodes: s
            }, this.expandVNodesEnd)) : (n.addClass("sliding slide-up").eq(0).one("transitionend", {
                vNodes: n
            }, this.collapseVNodesEnd), n.find(".toggleBtn").removeClass("oci-minus-square").addClass("oci-plus-square")))
        },
        createGhostNode: function(e) {
            var t, i, n = p(e.target),
                s = this.options,
                o = e.originalEvent,
                a = /firefox/.test(u.navigator.userAgent.toLowerCase());
            if (f.querySelector(".ghost-node")) t = n.closest(".orgchart").children(".ghost-node").get(0), i = p(t).children().get(0);
            else {
                if (!(t = f.createElementNS("http://www.w3.org/2000/svg", "svg")).classList) return;
                t.classList.add("ghost-node"), i = f.createElementNS("http://www.w3.org/2000/svg", "rect"), t.appendChild(i), n.closest(".orgchart").append(t)
            }
            var r = n.closest(".orgchart").css("transform").split(","),
                d = "t2b" === s.direction || "b2t" === s.direction,
                l = Math.abs(u.parseFloat(d ? r[0].slice(r[0].indexOf("(") + 1) : r[1]));
            t.setAttribute("width", d ? n.outerWidth(!1) : n.outerHeight(!1)), t.setAttribute("height", d ? n.outerHeight(!1) : n.outerWidth(!1)), i.setAttribute("x", 5 * l), i.setAttribute("y", 5 * l), i.setAttribute("width", 120 * l), i.setAttribute("height", 40 * l), i.setAttribute("rx", 4 * l), i.setAttribute("ry", 4 * l), i.setAttribute("stroke-width", 1 * l);
            var h = o.offsetX * l,
                c = o.offsetY * l;
            if ("l2r" === s.direction ? (h = o.offsetY * l, c = o.offsetX * l) : "r2l" === s.direction ? (h = n.outerWidth(!1) - o.offsetY * l, c = o.offsetX * l) : "b2t" === s.direction && (h = n.outerWidth(!1) - o.offsetX * l, c = n.outerHeight(!1) - o.offsetY * l), a) {
                i.setAttribute("fill", "rgb(255, 255, 255)"), i.setAttribute("stroke", "rgb(191, 0, 0)");
                var g = f.createElement("img");
                g.src = "data:image/svg+xml;utf8," + (new XMLSerializer).serializeToString(t), o.dataTransfer.setDragImage(g, h, c)
            } else o.dataTransfer.setDragImage && o.dataTransfer.setDragImage(t, h, c)
        },
        filterAllowedDropNodes: function(i) {
            var n = this.options,
                s = i.closest("[draggable]").hasClass("node"),
                o = i.closest(".nodes").siblings(".node"),
                a = i.closest(".hierarchy").find(".node");
            this.$chart.data("dragged", i).find(".node").each(function(e, t) {
                s && -1 !== a.index(t) || (n.dropCriteria ? n.dropCriteria(i, o, p(t)) && p(t).addClass("allowedDrop") : p(t).addClass("allowedDrop"))
            })
        },
        dragstartHandler: function(e) {
            e.originalEvent.dataTransfer.setData("text/html", "hack for firefox"), "none" !== this.$chart.css("transform") && this.createGhostNode(e), this.filterAllowedDropNodes(p(e.target))
        },
        dragoverHandler: function(e) {
            p(e.delegateTarget).is(".allowedDrop") ? e.preventDefault() : e.originalEvent.dataTransfer.dropEffect = "none"
        },
        dragendHandler: function(e) {
            this.$chart.find(".allowedDrop").removeClass("allowedDrop")
        },
        dropHandler: function(e) {
            var t = p(e.delegateTarget),
                i = this.$chart.data("dragged");
            if (i.hasClass("node")) {
                if (t.hasClass("allowedDrop")) {
                    var n = i.closest(".nodes").siblings(".node"),
                        s = p.Event("nodedrop.orgchart");
                    if (this.$chart.trigger(s, {
                            draggedNode: i,
                            dragZone: n,
                            dropZone: t
                        }), !s.isDefaultPrevented()) {
                        if (t.siblings(".nodes").length) {
                            var o = '<i class="edge horizontalEdge rightEdge oci"></i><i class="edge horizontalEdge leftEdge oci"></i>';
                            i.find(".horizontalEdge").length || i.append(o), t.siblings(".nodes").append(i.closest(".hierarchy"));
                            var a = i.closest(".hierarchy").siblings().find(".node:first");
                            1 === a.length && a.append(o)
                        } else t.append('<i class="edge verticalEdge bottomEdge oci"></i>').after('<ul class="nodes"></ul>').siblings(".nodes").append(i.find(".horizontalEdge").remove().end().closest(".hierarchy")), t.children(".title").length && t.children(".title").prepend('<i class="oci ' + this.$chart.data("options").parentNodeSymbol + ' symbol"></i>');
                        1 === n.siblings(".nodes").children(".hierarchy").length ? n.siblings(".nodes").children(".hierarchy").find(".node:first").find(".horizontalEdge").remove() : 0 === n.siblings(".nodes").children(".hierarchy").length && n.find(".bottomEdge, .symbol").remove().end().siblings(".nodes").remove()
                    }
                }
            } else this.$chart.triggerHandler({
                type: "otherdropped.orgchart",
                draggedItem: i,
                dropZone: t
            })
        },
        touchstartHandler: function(e) {
            this.touchHandled || e.touches && 1 < e.touches.length || (this.touchHandled = !0, this.touchMoved = !1, e.preventDefault())
        },
        touchmoveHandler: function(e) {
            if (this.touchHandled && !(e.touches && 1 < e.touches.length)) {
                e.preventDefault(), this.touchMoved || (this.filterAllowedDropNodes(p(e.currentTarget)), this.touchDragImage = this.createDragImage(e, this.$chart.data("dragged")[0])), this.touchMoved = !0, this.moveDragImage(e, this.touchDragImage);
                var t = p(f.elementFromPoint(e.touches[0].clientX, e.touches[0].clientY)).closest("div.node");
                if (0 < t.length) {
                    var i = t[0];
                    t.is(".allowedDrop") ? this.touchTargetNode = i : this.touchTargetNode = null
                } else this.touchTargetNode = null
            }
        },
        touchendHandler: function(e) {
            if (this.touchHandled) {
                if (this.destroyDragImage(), this.touchMoved) {
                    if (this.touchTargetNode) {
                        var t = {
                            delegateTarget: this.touchTargetNode
                        };
                        this.dropHandler(t), this.touchTargetNode = null
                    }
                    this.dragendHandler(e)
                } else {
                    var i = e.changedTouches[0],
                        n = f.createEvent("MouseEvents");
                    n.initMouseEvent("click", !0, !0, u, 1, i.screenX, i.screenY, i.clientX, i.clientY, e.ctrlKey, e.altKey, e.shiftKey, e.metaKey, 0, null), e.target.dispatchEvent(n)
                }
                this.touchHandled = !1
            }
        },
        createDragImage: function(e, t) {
            var i = t.cloneNode(!0);
            this.copyStyle(t, i), i.style.top = i.style.left = "-9999px";
            var n = t.getBoundingClientRect(),
                s = this.getTouchPoint(e);
            return this.touchDragImageOffset = {
                x: s.x - n.left,
                y: s.y - n.top
            }, i.style.opacity = "0.5", f.body.appendChild(i), i
        },
        destroyDragImage: function() {
            this.touchDragImage && this.touchDragImage.parentElement && this.touchDragImage.parentElement.removeChild(this.touchDragImage), this.touchDragImageOffset = null, this.touchDragImage = null
        },
        copyStyle: function(e, t) {
            if (["id", "class", "style", "draggable"].forEach(function(e) {
                    t.removeAttribute(e)
                }), e instanceof HTMLCanvasElement) {
                var i = e,
                    n = t;
                n.width = i.width, n.height = i.height, n.getContext("2d").drawImage(i, 0, 0)
            }
            for (var s = getComputedStyle(e), o = 0; o < s.length; o++) {
                var a = s[o];
                a.indexOf("transition") < 0 && (t.style[a] = s[a])
            }
            t.style.pointerEvents = "none";
            for (o = 0; o < e.children.length; o++) this.copyStyle(e.children[o], t.children[o])
        },
        getTouchPoint: function(e) {
            return e && e.touches && (e = e.touches[0]), {
                x: e.clientX,
                y: e.clientY
            }
        },
        moveDragImage: function(i, n) {
            if (i && n) {
                var s = this;
                requestAnimationFrame(function() {
                    var e = s.getTouchPoint(i),
                        t = n.style;
                    t.position = "absolute", t.pointerEvents = "none", t.zIndex = "999999", s.touchDragImageOffset && (t.left = Math.round(e.x - s.touchDragImageOffset.x) + "px", t.top = Math.round(e.y - s.touchDragImageOffset.y) + "px")
                })
            }
        },
        bindDragDrop: function(e) {
            e.on("dragstart", this.dragstartHandler.bind(this)).on("dragover", this.dragoverHandler.bind(this)).on("dragend", this.dragendHandler.bind(this)).on("drop", this.dropHandler.bind(this)).on("touchstart", this.touchstartHandler.bind(this)).on("touchmove", this.touchmoveHandler.bind(this)).on("touchend", this.touchendHandler.bind(this))
        },
        createNode: function(i) {
            var n = this.options,
                e = i.level;
            i.children && i[n.nodeId] && p.each(i.children, function(e, t) {
                t.parentId = i[n.nodeId]
            });
            var t = p("<div" + (n.draggable ? ' draggable="true"' : "") + (i[n.nodeId] ? ' id="' + i[n.nodeId] + '"' : "") + (i.parentId ? ' data-parent="' + i.parentId + '"' : "") + ">").addClass("node " + (i.className || "") + (e > n.visibleLevel ? " slide-up" : ""));
            n.nodeTemplate ? t.append(n.nodeTemplate(i)) : t.append('<div class="title">' + i[n.nodeTitle] + "</div>").append(void 0 !== n.nodeContent ? '<div class="content">' + (i[n.nodeContent] || "") + "</div>" : "");
            var s = p.extend({}, i);
            delete s.children, t.data("nodeData", s);
            var o = i.relationship || "";
            return n.verticalLevel && e >= n.verticalLevel ? e + 1 > n.verticalLevel && Number(o.substr(2, 1)) && t.append('<i class="toggleBtn oci"></i>').children(".title").prepend('<i class="oci ' + n.parentNodeSymbol + ' symbol"></i>') : (Number(o.substr(0, 1)) && t.append('<i class="edge verticalEdge topEdge oci"></i>'), Number(o.substr(1, 1)) && t.append('<i class="edge horizontalEdge rightEdge oci"></i><i class="edge horizontalEdge leftEdge oci"></i>'), Number(o.substr(2, 1)) && t.append('<i class="edge verticalEdge bottomEdge oci"></i>').children(".title").prepend('<i class="oci ' + n.parentNodeSymbol + ' symbol"></i>')), t.on("mouseenter mouseleave", this.nodeEnterLeaveHandler.bind(this)), t.on("click", this.nodeClickHandler.bind(this)), t.on("click", ".topEdge", this.topEdgeClickHandler.bind(this)), t.on("click", ".bottomEdge", this.bottomEdgeClickHandler.bind(this)), t.on("click", ".leftEdge, .rightEdge", this.hEdgeClickHandler.bind(this)), t.on("click", ".toggleBtn", this.toggleVNodes.bind(this)), n.draggable && (this.bindDragDrop(t), this.touchHandled = !1, this.touchMoved = !1, this.touchTargetNode = null), n.createNode && n.createNode(t, i), t
        },
        buildHierarchy: function(e, t) {
            var i = this,
                n = this.options,
                s = 0;
            if (s = t.level ? t.level : t.level = e.parentsUntil(".orgchart", ".nodes").length, 2 < Object.keys(t).length) {
                var o = this.createNode(t);
                n.verticalLevel && n.verticalLevel, e.append(o)
            }
            if (t.children && t.children.length) {
                var a, r = s + 1 > n.visibleLevel || t.collapsed !== d && t.collapsed;
                n.verticalLevel && s + 1 >= n.verticalLevel ? (a = p('<ul class="nodes">'), r && s + 1 >= n.verticalLevel && a.addClass("hidden"), s + 1 === n.verticalLevel ? e.addClass("hybrid").append(a.addClass("vertical")) : e.append(a)) : (a = p('<ul class="nodes' + (r ? " hidden" : "") + '">'), 2 === Object.keys(t).length || r && e.addClass("isChildrenCollapsed"), e.append(a)), p.each(t.children, function() {
                    var e = p('<li class="hierarchy">');
                    a.append(e), this.level = s + 1, i.buildHierarchy(e, this)
                })
            }
        },
        buildChildNode: function(e, t) {
            this.buildHierarchy(e, {
                children: t
            })
        },
        addChildren: function(e, t) {
            this.buildChildNode(e.closest(".hierarchy"), t), e.find(".symbol").length || e.children(".title").prepend('<i class="oci ' + this.options.parentNodeSymbol + ' symbol"></i>'), e.closest(".nodes.vertical").length ? e.children(".toggleBtn").length || e.append('<i class="toggleBtn oci"></i>') : e.children(".bottomEdge").length || e.append('<i class="edge verticalEdge bottomEdge oci"></i>'), this.isInAction(e) && this.switchVerticalArrow(e.children(".bottomEdge"))
        },
        buildParentNode: function(e, t) {
            t.relationship = t.relationship || "001";
            var i = p('<ul class="nodes"><li class="hierarchy"></li></ul>').find(".hierarchy").append(this.createNode(t)).end();
            this.$chart.prepend(i).find(".hierarchy:first").append(e.closest("ul").addClass("nodes"))
        },
        addParent: function(e, t) {
            this.buildParentNode(e, t), e.children(".topEdge").length || e.children(".title").after('<i class="edge verticalEdge topEdge oci"></i>'), this.isInAction(e) && this.switchVerticalArrow(e.children(".topEdge"))
        },
        buildSiblingNode: function(e, t) {
            var i = p.isArray(t) ? t.length : t.children.length,
                n = e.parent().is(".nodes") ? e.siblings().length + 1 : 1,
                s = n + i,
                o = 1 < s ? Math.floor(s / 2 - 1) : 0;
            if (e.closest(".nodes").parent().is(".hierarchy")) {
                this.buildChildNode(e.parent().closest(".hierarchy"), t);
                var a = e.parent().closest(".hierarchy").children(".nodes:last").children(".hierarchy");
                1 < n ? a.eq(0).before(e.siblings().addBack().unwrap()) : a.eq(o).after(e.unwrap())
            } else this.buildHierarchy(e.parent().prepend(p('<li class="hierarchy">')).children(".hierarchy:first"), t), e.prevAll(".hierarchy").children(".nodes").children().eq(o).after(e)
        },
        addSiblings: function(e, t) {
            this.buildSiblingNode(e.closest(".hierarchy"), t), e.closest(".nodes").data("siblingsLoaded", !0), e.children(".leftEdge").length || e.children(".topEdge").after('<i class="edge horizontalEdge rightEdge oci"></i><i class="edge horizontalEdge leftEdge oci"></i>'), this.isInAction(e) && (this.switchHorizontalArrow(e), e.children(".topEdge").removeClass("oci-chevron-up").addClass("oci-chevron-down"))
        },
        removeNodes: function(e) {
            var t = e.closest(".hierarchy").parent();
            t.parent().is(".hierarchy") ? this.getNodeState(e, "siblings").exist ? (e.closest(".hierarchy").remove(), 1 === t.children().length && t.find(".node:first .horizontalEdge").remove()) : t.siblings(".node").find(".bottomEdge").remove().end().end().remove() : t.closest(".orgchart").remove()
        },
        hideDropZones: function() {
            this.$chart.find(".allowedDrop").removeClass("allowedDrop")
        },
        showDropZones: function(e) {
            this.$chart.find(".node").each(function(e, t) {
                p(t).addClass("allowedDrop")
            }), this.$chart.data("dragged", p(e))
        },
        processExternalDrop: function(e, t) {
            t && this.$chart.data("dragged", p(t)), e.closest(".node").triggerHandler({
                type: "drop"
            })
        },
        exportPDF: function(e, t) {
            var i = {},
                n = Math.floor(e.width),
                s = Math.floor(e.height);
            u.jsPDF || (u.jsPDF = u.jspdf.jsPDF), (i = s < n ? new jsPDF({
                orientation: "landscape",
                unit: "px",
                format: [n, s]
            }) : new jsPDF({
                orientation: "portrait",
                unit: "px",
                format: [s, n]
            })).addImage(e.toDataURL(), "png", 0, 0), i.save(t + ".pdf")
        },
        exportPNG: function(e, t) {
            var i = "WebkitAppearance" in f.documentElement.style,
                n = !!u.sidebar,
                s = "Microsoft Internet Explorer" === navigator.appName || "Netscape" === navigator.appName && -1 < navigator.appVersion.indexOf("Edge"),
                o = this.$chartContainer;
            if (!i && !n || s) u.navigator.msSaveBlob(e.msToBlob(), t + ".png");
            else {
                var a = ".oci-download-btn" + ("" !== this.options.chartClass ? "." + this.options.chartClass : "");
                o.find(a).length || o.append('<a class="oci-download-btn' + ("" !== this.options.chartClass ? " " + this.options.chartClass : "") + '" download="' + t + '.png"></a>'), o.find(a).attr("href", e.toDataURL())[0].click()
            }
        },
        export: function(t, i) {
            var n = this;
            if (t = void 0 !== t ? t : this.options.exportFilename, i = void 0 !== i ? i : this.options.exportFileextension, p(this).children(".spinner").length) return !1;
            var s = this.$chartContainer,
                e = s.find(".mask");
            e.length ? e.removeClass("hidden") : s.append('<div class="mask"><i class="oci oci-spinner spinner"></i></div>');
            var o = s.addClass("canvasContainer").find('.orgchart:not(".hidden")').get(0),
                a = "l2r" === n.options.direction || "r2l" === n.options.direction;
            html2canvas(o, {
                width: a ? o.clientHeight : o.clientWidth,
                height: a ? o.clientWidth : o.clientHeight,
                onclone: function(e) {
                    p(e).find(".canvasContainer").css("overflow", "visible").find('.orgchart:not(".hidden"):first').css("transform", "")
                }
            }).then(function(e) {
                s.find(".mask").addClass("hidden"), "pdf" === i.toLowerCase() ? n.exportPDF(e, t) : n.exportPNG(e, t), s.removeClass("canvasContainer")
            }, function() {
                s.removeClass("canvasContainer")
            })
        }
    }, p.fn.orgchart = function(e) {
        return new t(this, e).init()
    }
});
