Array.prototype.forEach || (Array.prototype.forEach = function(a, b) {
    var c, d;
    if (null == this) throw new TypeError("this is null or not defined");
    var e = Object(this),
        f = e.length >>> 0;
    if ("[object Function]" !== {}.toString.call(a)) throw new TypeError(a + " is not a function");
    b && (c = b);
    for (d = 0; d < f;) {
        var g;
        Object.prototype.hasOwnProperty.call(e, d) && (g = e[d], a.call(c, g, d, e));
        d++
    }
});

OpenLayers.Lang.setCode('es'); 
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor = OpenLayers.Class({
    map: null,
    id: null,
    editLayer: null,
    editorPanel: null,
    editMode: !1,
    dialog: null,
    showStatus: function(a, b) {
        "error" === a && alert(b)
    },
    activeControls: [],
    editorControls: "CleanFeature DeleteFeature DeleteAllFeatures Dialog DrawHole DrawRegular DrawPolygon DrawPath DrawPoint DrawText EditorPanel ImportFeature MergeFeature SnappingSettings SplitFeature CADTools TransformFeature".split(" "),
    featureTypes: ["text", "point", "path", "polygon", "regular"],
    sourceLayers: [],
    params: {},
    geoJSON: new OpenLayers.Format.GeoJSON,
    options: {},
    oleUrl: "",
    controls: {},
    undoRedoActive: !0,
    initialize: function(a, b) {
        OpenLayers.Util.extend(this, b);
        this.map = a instanceof OpenLayers.Map ? a : new OpenLayers.Map;
        b || (b = {});
        b.dialog || (this.dialog = new OpenLayers.Editor.Control.Dialog, this.map.addControl(this.dialog));
        this.id = OpenLayers.Util.createUniqueID("OpenLayers.Editor_");
        this.editLayer = b.editLayer ? b.editLayer : new OpenLayers.Layer.Vector("Editor", {
            displayInLayerSwitcher: !1
        });
        this.editLayer.styleMap = b.styleMap ? b.styleMap : new OpenLayers.StyleMap({
            "default": new OpenLayers.Style({
                fillColor: "#07f",
                fillOpacity: 0.8,
                strokeColor: "#037",
                strokeWidth: 2,
                graphicZIndex: 1,
                pointRadius: 5
            }),
            defaultLabel: new OpenLayers.Style({
                fillColor: "#07f",
                fillOpacity: 0.8,
                strokeColor: "#037",
                strokeWidth: 2,
                graphicZIndex: 11,
                pointRadius: 0,
                cursor: "default",
                label: "${label}",
                fontColor: "#000000",
                fontSize: "11px",
                fontFamily: "Verdana, Arial, Helvetica, sans-serif",
                fontWeight: "bold",
                labelOutlineColor: "#FFFFFF",
                labelOutlineWidth: 4,
                labelSelect: !0
            }),
            select: new OpenLayers.Style({
                fillColor: "#fc0",
                strokeColor: "#f70",
                graphicZIndex: 2
            }),
            selectLabel: new OpenLayers.Style({
                pointRadius: 5,
                label: "${label}",
                fontColor: "black",
                fontSize: "11px",
                fontFamily: "Verdana, Arial, Helvetica, sans-serif",
                fontWeight: "bold",
                labelAlign: "cm",
                labelXOffset: "${xOffset}",
                labelYOffset: "${yOffset}",
                fillColor: "#fc0",
                strokeColor: "#f70",
                labelOutlineColor: "#fc0",
                labelOutlineWidth: 6,
                graphicZIndex: 2
            }),
            temporary: new OpenLayers.Style({
                fillColor: "#fc0",
                fillOpacity: 0.8,
                strokeColor: "#f70",
                strokeWidth: 2,
                graphicZIndex: 2,
                pointRadius: 5
            })
        });
        var c = {
            editor: this,
            layer: this.editLayer,
            controls: ["OpenLayers.Editor.Control.DeleteFeature",
                "OpenLayers.Editor.Control.CleanFeature", "OpenLayers.Editor.Control.MergeFeature", "OpenLayers.Editor.Control.SplitFeature"
            ]
        };
        this.editLayer.events.register("featureselected", c, this.selectionChanged);
        this.editLayer.events.register("featureunselected", c, this.selectionChanged);
        for (var d = 0, e = this.featureTypes.length; d < e; d++) "polygon" == this.featureTypes[d] ? this.activeControls.push("DrawPolygon") : "path" == this.featureTypes[d] ? this.activeControls.push("DrawPath") : "point" == this.featureTypes[d] ? this.activeControls.push("DrawPoint") :
            "regular" == this.featureTypes[d] ? this.activeControls.push("DrawRegular") : "text" == this.featureTypes[d] && this.activeControls.push("DrawText");
        d = 0;
        for (e = this.sourceLayers.length; d < e; d++) c = {
            editor: this,
            layer: this.sourceLayers[d],
            controls: ["OpenLayers.Editor.Control.ImportFeature"]
        }, this.sourceLayers[d].events.register("featureselected", c, this.selectionChanged), this.sourceLayers[d].events.register("featureunselected", c, this.selectionChanged), this.sourceLayers[d].styleMap = new OpenLayers.StyleMap({
            "default": new OpenLayers.Style({
                fillColor: "#0c0",
                fillOpacity: 0.8,
                strokeColor: "#070",
                strokeWidth: 2,
                graphicZIndex: 1,
                pointRadius: 5
            }),
            select: new OpenLayers.Style({
                fillColor: "#fc0",
                strokeColor: "#f70",
                graphicZIndex: 2
            }),
            temporary: new OpenLayers.Style({
                fillColor: "#fc0",
                fillOpacity: 0.8,
                strokeColor: "#f70",
                strokeWidth: 2,
                graphicZIndex: 2,
                pointRadius: 5
            })
        }), this.map.addLayer(this.sourceLayers[d]);
        this.map.editor = this;
        this.map.addLayer(this.editLayer);
        this.map.addControl(new OpenLayers.Editor.Control.LayerSettings(this));
        this.undoRedoActive && this.map.addControl(new OpenLayers.Editor.Control.UndoRedo(this.editLayer));
        this.addEditorControls();
        return this
    },
    selectionChanged: function() {
        var a = this.editor.editorPanel.getControlsByClass("OpenLayers.Control.SelectFeature")[0];
        if (0 < this.layer.selectedFeatures.length && a && a.active)
            for (var a = 0, b = this.controls.length; a < b; a++) {
                var c = this.editor.editorPanel.getControlsByClass(this.controls[a])[0];
                c && OpenLayers.Element.removeClass(c.panel_div, "oleControlDisabled")
            } else {
                a = 0;
                for (b = this.controls.length; a < b; a++)(c = this.editor.editorPanel.getControlsByClass(this.controls[a])[0]) &&
                    OpenLayers.Element.addClass(c.panel_div, "oleControlDisabled")
            }
        this.editor.editorPanel.redraw()
    },
    startEditMode: function() {
        this.editMode = !0;
        this.editorPanel.activate()
    },
    stopEditMode: function() {
        this.editMode = !1;
        this.editorPanel.deactivate()
    },
    addEditorControls: function() {
        for (var a = null, b = [], c = 0, d = this.activeControls.length; c < d; c++) {
            a = this.activeControls[c]; - 1 < OpenLayers.Util.indexOf(this.editorControls, a) && b.push(new OpenLayers.Editor.Control[a](this.editLayer, this.options[a]));
            switch (a) {
                case "Separator":
                    b.push(new OpenLayers.Control.Button({
                        displayClass: "olControlSeparator"
                    }));
                    break;
                case "Navigation":
                    b.push(new OpenLayers.Control.Navigation(OpenLayers.Util.extend({
                        title: OpenLayers.i18n("oleNavigation")
                    }, this.options.Navigation)));
                    break;
                case "DragFeature":
                    b.push(new OpenLayers.Editor.Control.DragFeature(this.editLayer, OpenLayers.Util.extend({}, this.options.DragFeature)));
                    break;
                case "ModifyFeature":
                    b.push(new OpenLayers.Control.ModifyFeature(this.editLayer, OpenLayers.Util.extend({
                        title: OpenLayers.i18n("oleModifyFeature")
                    }, this.options.ModifyFeature)));
                    break;
                case "SelectFeature":
                    b.push(new OpenLayers.Control.SelectFeature(this.sourceLayers.concat([this.editLayer]),
                        OpenLayers.Util.extend({
                            title: OpenLayers.i18n("oleSelectFeature"),
                            clickout: !0,
                            toggle: !1,
                            multiple: !1,
                            hover: !1,
                            toggleKey: "ctrlKey",
                            multipleKey: "ctrlKey",
                            box: !0
                        }, this.options.SelectFeature)));
                    break;
                case "DownloadFeature":
                    b.push(new OpenLayers.Editor.Control.DownloadFeature(this.editLayer, OpenLayers.Util.extend({}, this.DownloadFeature)));
                    break;
                case "UploadFeature":
                    b.push(new OpenLayers.Editor.Control.UploadFeature(this.editLayer, OpenLayers.Util.extend({}, this.UploadFeature)));
                    break;
                default:
                    -1 == OpenLayers.Util.indexOf(this.editorControls,
                        a) && OpenLayers.Editor.Control[a] && b.push(new OpenLayers.Editor.Control[a](this.editLayer, OpenLayers.Util.extend({}, this.options[a])))
            }
            this.controls[a] = b[b.length - 1]
        }
        this.editorPanel = this.createEditorPanel(b);
        this.map.addControl(this.editorPanel)
    },
    addEditorControl: function(a) {
        this.controls[a.CLASS_NAME] = a;
        this.editorPanel.addControls([a]);
        this.map.addControl(a)
    },
    createEditorPanel: function(a) {
        var b = new OpenLayers.Editor.Control.EditorPanel(this);
        b.addControls(a);
        return b
    },
    status: function(a) {
        "error" ==
        a.type && alert(a.content)
    },
    loadFeatures: function(a) {
        this.editLayer.destroyFeatures();
        a && (this.editLayer.addFeatures(a), this.map.zoomToExtent(this.editLayer.getDataExtent()))
    },
    requestComplete: function(a) {
        a = (new OpenLayers.Format.JSON).read(a.responseText);
        this.map.editor.stopWaiting();
        a ? a.error ? this.showStatus("error", a.message) : (a.params && OpenLayers.Util.extend(this.params, a.params), a.geo && (a = this.geoJSON.read(a.geo), this.editLayer.removeFeatures(this.editLayer.selectedFeatures), this.editLayer.addFeatures(this.toFeatures(a)),
            this.editLayer.events.triggerEvent("featureselected"))) : this.showStatus("error", OpenLayers.i18n("oleNoJSON"))
    },
    toFeatures: function(a) {
        if (null === a || "object" !== typeof a) throw Error("Parameter does not match expected type.");
        var b = [];
        a instanceof Array || (a = [a]);
        for (var c = 0, d = a.length; c < d; c++)
            if ("OpenLayers.Geometry.MultiPolygon" === a[c].geometry.CLASS_NAME || "OpenLayers.Geometry.Collection" === a[c].geometry.CLASS_NAME)
                for (var e = 0, f = a[c].geometry.components.length; e < f; e++) b.push(new OpenLayers.Feature.Vector(a[c].geometry.components[e]));
            else "OpenLayers.Geometry.Polygon" === a[c].geometry.CLASS_NAME && b.push(new OpenLayers.Feature.Vector(a[c].geometry));
        return b
    },
    toMultiPolygon: function(a) {
        for (var b = [], c = 0, d = a.length; c < d; c++) "OpenLayers.Geometry.Polygon" === a[c].geometry.CLASS_NAME && b.push(a[c].geometry);
        return new OpenLayers.Geometry.MultiPolygon(b)
    },
    startWaiting: function(a) {
        OpenLayers.Element.addClass(a, "olEditorWaiting");
        OpenLayers.Element.addClass(this.map.div, "olEditorWaiting");
        this.waitingDiv = a
    },
    stopWaiting: function() {
        OpenLayers.Element.removeClass(this.waitingDiv,
            "olEditorWaiting");
        OpenLayers.Element.removeClass(this.map.div, "olEditorWaiting")
    },
    CLASS_NAME: "OpenLayers.Editor"
});
OpenLayers.Editor.Control = OpenLayers.Class(OpenLayers.Control, {
    initialize: function(a) {
        OpenLayers.Control.prototype.initialize.apply(this, [a])
    },
    CLASS_NAME: "OpenLayers.Editor.Control"
});
OpenLayers.Editor.VERSION_NUMBER = "1.0-beta4";
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.CleanFeature = OpenLayers.Class(OpenLayers.Control.Button, {
    proxy: null,
    title: OpenLayers.i18n("oleCleanFeature"),
    initialize: function(a, b) {
        this.layer = a;
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = this.cleanFeature;
        this.title = OpenLayers.i18n("oleCleanFeature");
        this.displayClass = "oleControlDisabled " + this.displayClass
    },
    cleanFeature: function() {
        if (0 < this.layer.selectedFeatures.length) {
            var a = (new OpenLayers.Format.WKT).write(this.layer.selectedFeatures);
            this.map.editor.startWaiting(this.panel_div);
            OpenLayers.Request.POST({
                url: this.map.editor.oleUrl + "process/clean",
                data: OpenLayers.Util.getParameterString({
                    geo: a
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                callback: this.map.editor.requestComplete,
                proxy: this.proxy,
                scope: this.map.editor
            })
        }
    },
    CLASS_NAME: "OpenLayers.Editor.Control.CleanFeature"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DragFeature = OpenLayers.Class(OpenLayers.Control.DragFeature, {
    title: OpenLayers.i18n("oleDragFeature"),
    EVENT_TYPES: "activate deactivate dragstart dragdrag dragcomplete dragenter dragleave".split(" "),
    initialize: function(a, b) {
        OpenLayers.Control.DragFeature.prototype.initialize.apply(this, [a, b]);
        this.title = OpenLayers.i18n("oleDragFeature")
    },
    onStart: function(a, b) {
        this.events.triggerEvent("dragstart", {
            feature: a,
            pixel: b
        })
    },
    onDrag: function(a, b) {
        this.events.triggerEvent("dragdrag", {
            feature: a,
            pixel: b
        })
    },
    onComplete: function(a, b) {
        this.events.triggerEvent("dragcomplete", {
            feature: a,
            pixel: b
        });
        this.layer.events.triggerEvent("afterfeaturemodified", {
            feature: a
        })
    },
    onEnter: function(a) {
        this.events.triggerEvent("dragenter", {
            feature: a
        })
    },
    onLeave: function(a) {
        this.events.triggerEvent("dragleave", {
            feature: a
        })
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DragFeature"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DeleteFeature = OpenLayers.Class(OpenLayers.Control.Button, {
    layer: null,
    title: OpenLayers.i18n("oleDeleteFeature"),
    initialize: function(a, b) {
        this.layer = a;
        this.title = OpenLayers.i18n("oleDeleteFeature");
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = this.deleteFeature;
        this.displayClass = "oleControlDisabled " + this.displayClass
    },
    deleteFeature: function() {
        0 < this.layer.selectedFeatures.length && (this.layer.destroyFeatures(this.layer.selectedFeatures), this.layer.events.triggerEvent("featureunselected"))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DeleteFeature"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.Dialog = OpenLayers.Class(OpenLayers.Control, {
    dialogDiv: null,
    buttonClass: null,
    inputTextClass: null,
    modal: !0,
    initialize: function(a) {
        OpenLayers.Control.prototype.initialize.apply(this, [a])
    },
    show: function(a) {
        var b, c; - 1 < OpenLayers.Util.indexOf(this.map.viewPortDiv.childNodes, this.dialogDiv) && this.map.viewPortDiv.removeChild(this.dialogDiv);
        a || (a = {});
        this.dialogDiv = document.createElement("div");
        OpenLayers.Element.addClass(this.dialogDiv, "oleDialog");
        a.toolbox ? OpenLayers.Element.addClass(this.dialogDiv,
            "oleDialogToolbar") : OpenLayers.Element.addClass(this.div, "oleFadeMap");
        a.title && (b = document.createElement("h3"), b.innerHTML = a.title, this.dialogDiv.appendChild(b));
        "string" === typeof a.content ? (b = document.createElement("div"), b.innerHTML = a.content, this.dialogDiv.appendChild(b)) : OpenLayers.Util.isElement(a.content) && this.dialogDiv.appendChild(a.content);
        a.save ? (b = this.getButton(OpenLayers.i18n("oleDialogCancelButton")), this.dialogDiv.appendChild(b), c = this.getButton(OpenLayers.i18n(a.saveButtonText ? a.saveButtonText :
            "oleDialogSaveButton")), this.dialogDiv.appendChild(c), OpenLayers.Event.observe(b, "click", OpenLayers.Function.bind(this.hide, this)), a.noHideOnSave || OpenLayers.Event.observe(c, "click", OpenLayers.Function.bind(this.hide, this)), OpenLayers.Event.observe(c, "click", a.save), a.cancel && OpenLayers.Event.observe(b, "click", a.cancel)) : a.toolbox || (b = this.getButton(OpenLayers.i18n("oleDialogOkButton")), this.dialogDiv.appendChild(b), OpenLayers.Event.observe(b, "click", OpenLayers.Function.bind(this.hide, this)), a.close &&
            OpenLayers.Event.observe(b, "click", a.close));
        a = this.dialogDiv.getElementsByTagName("input");
        for (b = 0; b < a.length; b++) "text" == a[b].getAttribute("type") && OpenLayers.Element.addClass(a[b], this.inputTextClass);
        this.map.viewPortDiv.appendChild(this.dialogDiv);
        OpenLayers.Event.observe(this.div, "click", this.ignoreEvent);
        OpenLayers.Event.observe(this.div, "mousedown", this.ignoreEvent);
        OpenLayers.Event.observe(this.div, "dblclick", this.ignoreEvent);
        OpenLayers.Event.observe(this.dialogDiv, "mousedown", this.ignoreEvent);
        OpenLayers.Event.observe(this.dialogDiv, "dblclick", this.ignoreEvent)
    },
    hide: function() {
        this.dialogDiv && (this.map.viewPortDiv.removeChild(this.dialogDiv), OpenLayers.Element.removeClass(this.div, "oleFadeMap"), this.dialogDiv = null)
    },
    ignoreEvent: function(a) {
        OpenLayers.Event.stop(a, !0)
    },
    getButton: function(a) {
        var b = document.createElement("input");
        b.value = a;
        b.type = "button";
        OpenLayers.Element.addClass(b, this.buttonClass);
        return b
    },
    CLASS_NAME: "OpenLayers.Editor.Control.Dialog"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DrawHole = OpenLayers.Class(OpenLayers.Control.DrawFeature, {
    minArea: 0,
    title: OpenLayers.i18n("oleDrawHole"),
    initialize: function(a, b) {
        this.callbacks = OpenLayers.Util.extend(this.callbacks, {
            point: function(a) {
                this.layer.events.triggerEvent("pointadded", {
                    point: a
                })
            }
        });
        OpenLayers.Control.DrawFeature.prototype.initialize.apply(this, [a, OpenLayers.Handler.Polygon, b]);
        this.title = OpenLayers.i18n("oleDrawHole")
    },
    drawFeature: function(a) {
        var b = new OpenLayers.Feature.Vector(a);
        b.state = OpenLayers.State.INSERT;
        if (!1 !== this.layer.events.triggerEvent("sketchcomplete", {
                feature: b
            }) && a.getArea() >= this.minArea) {
            var b = a.getVertices(),
                c, d = 0,
                e = this.layer.features.length;
            a: for (; d < e; d++) {
                var f = this.layer.features[d];
                c = !0;
                for (var g = 0, h = b.length; g < h; g++) f.geometry.intersects(b[g]) || (c = !1);
                if (c) {
                    f.state = OpenLayers.State.UPDATE;
                    this.layer.events.triggerEvent("beforefeaturemodified", {
                        feature: f
                    });
                    f.geometry.components.push(a.components[0]);
                    this.layer.drawFeature(f);
                    this.layer.events.triggerEvent("featuremodified", {
                        feature: f
                    });
                    this.layer.events.triggerEvent("afterfeaturemodified", {
                        feature: f
                    });
                    break a
                }
            }
        }
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DrawHole"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DrawPolygon = OpenLayers.Class(OpenLayers.Control.DrawFeature, {
    minArea: 0,
    title: OpenLayers.i18n("oleDrawPolygon"),
    initialize: function(a, b) {
        this.callbacks = OpenLayers.Util.extend(this.callbacks, {
            point: function(a) {
                this.layer.events.triggerEvent("pointadded", {
                    point: a
                })
            }
        });
        OpenLayers.Control.DrawFeature.prototype.initialize.apply(this, [a, OpenLayers.Handler.Polygon, b]);
        this.title = OpenLayers.i18n("oleDrawPolygon")
    },
    drawFeature: function(a) {
        var b = new OpenLayers.Feature.Vector(a);
        !1 !==
            this.layer.events.triggerEvent("sketchcomplete", {
                feature: b
            }) && a.getArea() >= this.minArea && (b.state = OpenLayers.State.INSERT, this.layer.addFeatures([b]), this.featureAdded(b), this.events.triggerEvent("featureadded", {
                feature: b
            }))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DrawPolygon"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DrawPath = OpenLayers.Class(OpenLayers.Control.DrawFeature, {
    minLength: 0,
    title: OpenLayers.i18n("oleDrawPath"),
    initialize: function(a, b) {
        this.callbacks = OpenLayers.Util.extend(this.callbacks, {
            point: function(a) {
                this.layer.events.triggerEvent("pointadded", {
                    point: a
                })
            }
        });
        OpenLayers.Control.DrawFeature.prototype.initialize.apply(this, [a, OpenLayers.Handler.Path, b]);
        this.title = OpenLayers.i18n("oleDrawPath")
    },
    drawFeature: function(a) {
        var b = new OpenLayers.Feature.Vector(a);
        !1 !== this.layer.events.triggerEvent("sketchcomplete", {
            feature: b
        }) && a.getLength() >= this.minLength && (b.state = OpenLayers.State.INSERT, this.layer.addFeatures([b]), this.featureAdded(b), this.events.triggerEvent("featureadded", {
            feature: b
        }))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DrawPath"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DrawPoint = OpenLayers.Class(OpenLayers.Control.DrawFeature, {
    title: OpenLayers.i18n("oleDrawPoint"),
    featureType: "point",
    initialize: function(a, b) {
        this.callbacks = OpenLayers.Util.extend(this.callbacks, {
            point: function(a) {
                this.layer.events.triggerEvent("pointadded", {
                    point: a
                })
            }
        });
        OpenLayers.Control.DrawFeature.prototype.initialize.apply(this, [a, OpenLayers.Handler.Point, b]);
        this.title = OpenLayers.i18n("oleDrawPoint")
    },
    drawFeature: function(a) {
        a = new OpenLayers.Feature.Vector(a);
        var b =
            this.layer.events.triggerEvent("sketchcomplete", {
                feature: a
            });
        a.featureType = this.featureType;
        !1 !== b && (this.events.triggerEvent("beforefeatureadded", {
            feature: a
        }), a.state = OpenLayers.State.INSERT, this.layer.addFeatures([a]), this.featureAdded(a), this.events.triggerEvent("featureadded", {
            feature: a
        }))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DrawPoint"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DrawRegular = OpenLayers.Class(OpenLayers.Control.DrawFeature, {
    minArea: 0,
    title: OpenLayers.i18n("oleDrawRegular"),
    sides: [3, 4, 5, 6, 40],
    initialize: function(a, b) {
        this.callbacks = OpenLayers.Util.extend(this.callbacks, {
            point: function(a) {
                this.layer.events.triggerEvent("pointadded", {
                    point: a
                })
            }
        });
        OpenLayers.Control.DrawFeature.prototype.initialize.apply(this, [a, OpenLayers.Handler.RegularPolygon, b]);
        this.title = OpenLayers.i18n("oleDrawRegular")
    },
    activate: function() {
        var a = OpenLayers.Control.Button.prototype.activate.call(this),
            b, c, d;
        b = document.createElement("div");
        c = document.createElement("div");
        OpenLayers.Element.addClass(c, "oleDrawRegularIrregular");
        d = document.createElement("input");
        d.type = "checkbox";
        d.id = "oleCADToolsDialogIrregular";
        d.value = "true";
        OpenLayers.Event.observe(d, "change", OpenLayers.Function.bind(function(a) {
            this.handler.setOptions({
                irregular: a.target.checked
            })
        }, this));
        c.appendChild(d);
        d = document.createElement("label");
        d.htmlFor = "oleCADToolsDialogIrregular";
        d.appendChild(document.createTextNode(OpenLayers.i18n("oleDrawRegularIrregular")));
        c.appendChild(d);
        b.appendChild(c);
        c = document.createElement("div");
        d = document.createElement("select");
        d.id = "oleCADToolsDialogSides";
        for (var e = 0; e < this.sides.length; ++e) {
            var f = 20 > this.sides[e] ? OpenLayers.i18n("oleDrawRegularSides" + this.sides[e]) : OpenLayers.i18n("oleDrawRegularCircle");
            d.options.add(new Option(f, this.sides[e]))
        }
        OpenLayers.Event.observe(d, "change", OpenLayers.Function.bind(function(a) {
            this.handler.setOptions({
                sides: parseInt(a.target.value)
            })
        }, this));
        this.handler.setOptions({
            sides: parseInt(d.value)
        });
        c.appendChild(d);
        d = document.createElement("label");
        d.htmlFor = "oleCADToolsDialogSides";
        d.appendChild(document.createTextNode(OpenLayers.i18n("oleDrawRegularShape")));
        c.appendChild(d);
        b.appendChild(c);
        this.map.editor.dialog.show({
            content: b,
            toolbox: !0
        });
        return a
    },
    deactivate: function() {
        var a = OpenLayers.Control.Button.prototype.deactivate.call(this);
        a && "function" == typeof this.map.editor.dialog.hide && this.map.editor.dialog.hide();
        return a
    },
    drawFeature: function(a) {
        var b = new OpenLayers.Feature.Vector(a);
        !1 !== this.layer.events.triggerEvent("sketchcomplete", {
            feature: b
        }) && a.getArea() >= this.minArea && (b.state = OpenLayers.State.INSERT, this.layer.addFeatures([b]), this.featureAdded(b), this.events.triggerEvent("featureadded", {
            feature: b
        }))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DrawRegular"
});
/*
  2011 geOps
 @author     Just van den Broecke
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DeleteAllFeatures = OpenLayers.Class(OpenLayers.Control.Button, {
    layer: null,
    title: OpenLayers.i18n("oleDeleteAllFeatures"),
    initialize: function(a, b) {
        this.layer = a;
        this.title = OpenLayers.i18n("oleDeleteAllFeatures");
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = this.deleteAllFeatures;
        this.displayClass = "oleControlEnabled " + this.displayClass
    },
    deleteAllFeatures: function() {
        0 < this.layer.features.length && this.layer.destroyFeatures();
        this.map.editor.editLayer &&
            this.map.editor.editLayer.destroyFeatures()
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DeleteAllFeatures"
});
/*
  2011 geOps
 @author     Just van den Broecke
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DownloadFeature = OpenLayers.Class(OpenLayers.Control, {
    EVENT_TYPES: ["featuredownloaded"],
    layer: null,
    title: OpenLayers.i18n("oleDownloadFeature"),
    url: "",
    params: {
        action: "download",
        mime: "text/plain",
        filename: "editor",
        encoding: "none"
    },
    formats: [{
        name: "GeoJSON",
        fileExt: ".json",
        mimeType: "text/plain",
        formatter: "OpenLayers.Format.GeoJSON"
    }],
    fileProjection: null,
    formatters: {},
    initialize: function(a, b) {
        this.layer = a;
        this.title = OpenLayers.i18n("oleDownloadFeature");
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b])
    },
    activate: function() {
        var a = OpenLayers.Control.prototype.activate.call(this);
        a && this.openDialog();
        return a
    },
    deactivate: function() {
        var a = OpenLayers.Control.prototype.deactivate.call(this);
        a && this.dialog && (this.dialog.hide(), this.dialog = null);
        return a
    },
    cancelDialog: function() {
        this.dialog = null;
        this.deactivate()
    },
    openDialog: function() {
        if (!this.layer.features || 0 >= this.layer.features.length) this.showMessage(OpenLayers.i18n("oleDownloadFeatureEmpty")), this.deactivate();
        else {
            var a = document.createElement("div"),
                b = document.createElement("p");
            b.innerHTML = OpenLayers.i18n("oleDownloadFeatureFileFormat");
            a.appendChild(b);
            b = document.createElement("form");
            b.setAttribute("id", "download_form");
            b.setAttribute("method", "POST");
            b.setAttribute("action", this.url);
            var c = document.createElement("select");
            c.setAttribute("name", "format_select");
            c.setAttribute("id", "format_select");
            for (var d, e = 0; e < this.formats.length; ++e) {
                d = document.createElement("option");
                var f = this.formats[e],
                    g = f.formatter;
                "string" == typeof g && (g = eval("new " +
                    g + "()"));
                g.fileProjection = f.fileProjection;
                this.formatters[f.name] = g;
                d.setAttribute("value", f.name);
                d.innerHTML = f.name;
                d.fileExt = f.fileExt;
                d.mimeType = f.mimeType;
                d.sourceFormat = g.CLASS_NAME.split(".")[2];
                d.targetFormat = f.targetFormat;
                d.assignSrs = f.fileProjection ? f.fileProjection.getCode() : void 0;
                d.sourceSrs = f.sourceSrs ? d.sourceSrs : d.assignSrs;
                d.targetSrs = f.targetSrs;
                c.appendChild(d)
            }
            b.appendChild(c);
            a.appendChild(b);
            this.dialog = this.map.editor.dialog;
            this.dialog.show({
                title: OpenLayers.i18n("oleDownloadFeature"),
                content: a,
                save: OpenLayers.Function.bind(this.downloadFeature, this),
                cancel: OpenLayers.Function.bind(this.cancelDialog, this),
                noHideOnSave: !0
            })
        }
    },
    downloadFeature: function() {
        var a = document.getElementById("format_select"),
            a = a.options[a.selectedIndex],
            b = this.formatters[a.value];
        if (!b) return null;
        this.fileProjection && (b.internalProjection = this.layer.map.baseLayer.projection, b.externalProjection = b.fileProjection ? b.fileProjection : this.fileProjection);
        b.srsName = b.externalProjection ? b.externalProjection.getCode() :
            this.layer.map.projection;
        var b = b.write(this.layer.features),
            c = document.getElementById("download_form"),
            d = this.params.filename;
        this.params.filename = d + a.fileExt;
        this.params.mime = a.mimeType;
        this.params.data = b;
        this.params.source_format = a.sourceFormat;
        this.params.target_format = a.targetFormat;
        this.params.assign_srs = a.assignSrs;
        this.params.source_srs = a.sourceSrs;
        this.params.target_srs = a.targetSrs;
        for (var e in this.params) this.params[e] && (c = this.createInputElm(e, "hidden", this.params[e], c));
        this.params.filename =
            d;
        c.submit();
        var f = this;
        setTimeout(function() {
            f.deactivate()
        }, 2E3)
    },
    showMessage: function(a) {
        this.map.editor.dialog.show({
            title: OpenLayers.i18n("oleDownloadFeature"),
            content: a
        })
    },
    createInputElm: function(a, b, c, d) {
        var e = document.createElement("input");
        e.setAttribute("type", b);
        e.name = a;
        e.value = c ? c : null;
        d && d.appendChild(e);
        return d
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DownloadFeature"
});
/*
  2011 geOps
 @author     Just van den Broecke
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.DrawText = OpenLayers.Class(OpenLayers.Editor.Control.DrawPoint, {
    title: null,
    featureType: "text",
    defaultStyle: "defaultLabel",
    selectStyle: "selectLabel",
    modal: !0,
    initialize: function(a, b) {
        OpenLayers.Editor.Control.DrawPoint.prototype.initialize.apply(this, [a, OpenLayers.Handler.Point, b]);
        this.title = OpenLayers.i18n("oleDrawText");
        a.events.on({
            beforefeatureadded: this.onBeforeFeatureAdded,
            featureselected: this.onFeatureSelected,
            featureunselected: this.onFeatureUnselected,
            scope: this
        })
    },
    deactivate: function() {
        OpenLayers.Control.Button.prototype.deactivate.call(this);
        if (this.popup && this.popup.feature) {
            var a = this.popup.feature;
            a.layer && (a.layer.map.removePopup(a.popup), a.layer.removeFeatures([a]));
            a.popup.destroy();
            this.popup = a.popup = null
        }
    },
    setLabelText: function(a, b) {
        a.attributes.label = b;
        a.layer.drawFeature(a, this.defaultStyle)
    },
    removePopup: function(a) {
        this.popup = null;
        a.popup && (a.layer.map.removePopup(a.popup), a.popup.destroy(), a.popup = null, (a = a.editControl) && a.activate())
    },
    onPopupClose: function(a) {
        this.popup =
            null;
        a = this.feature;
        if (!a) return !1;
        var b = a.editControl;
        if (!b) return !1;
        var c = document.getElementById("olLabelInput");
        b.setLabelText(a, c.value);
        b.removePopup(a);
        c.value || a.layer.removeFeatures([a])
    },
    isTextFeature: function(a) {
        return a ? "text" === a.featureType : !1
    },
    onFeatureSelected: function(a) {
        a = a.feature;
        this.isTextFeature(a) && a.layer.drawFeature(a, this.selectStyle)
    },
    onFeatureUnselected: function(a) {
        a = a.feature;
        this.isTextFeature(a) && a.layer.drawFeature(a, this.defaultStyle)
    },
    onBeforeFeatureAdded: function(a) {
        var b =
            a.feature;
        if (!this.isTextFeature(b)) return b.attributes.label && (b.editControl = this, b.featureType = "text", b.layer.drawFeature(b, this.defaultStyle)), !0;
        a = new OpenLayers.Popup.FramedCloud("featurePopup", b.geometry.getBounds().getCenterLonLat(), new OpenLayers.Size(100, 100), '<div class="oleDrawTextPopup"><input type="text" size="32" id="olLabelInput"/><p>' + OpenLayers.i18n("oleDrawTextEdit") + "</p></div>", null, !0, this.onPopupClose);
        b.popup = a;
        b.editControl = this;
        a.feature = b;
        this.layer.map.addPopup(a, !0);
        this.deactivate();
        var c = document.getElementById("olLabelInput"),
            d = this;
        c.onkeypress = function(a) {
            if (13 == (window.event ? window.event.keyCode : a.keyCode)) d.setLabelText(b, c.value), d.removePopup(b)
        };
        c.focus();
        this.popup = a
    },
    CLASS_NAME: "OpenLayers.Editor.Control.DrawText"
});
/*
  2011 geOps
 @author     Just van den Broecke
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.UploadFeature = OpenLayers.Class(OpenLayers.Control, {
    EVENT_TYPES: ["featureuploaded"],
    layer: null,
    title: OpenLayers.i18n("oleUploadFeature"),
    url: "",
    params: {
        action: "upload",
        mime: "text/html",
        encoding: "escape"
    },
    formats: [{
        name: "GeoJSON",
        fileExt: ".json",
        mimeType: "text/plain",
        formatter: "OpenLayers.Format.GeoJSON"
    }],
    fileProjection: null,
    visibleOnUpload: !0,
    formatters: {},
    replaceFeatures: !1,
    initialize: function(a, b) {
        this.layer = a;
        this.title = OpenLayers.i18n("oleUploadFeature");
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b])
    },
    activate: function() {
        var a = OpenLayers.Control.prototype.activate.call(this);
        a && this.openDialog();
        return a
    },
    deactivate: function() {
        var a = OpenLayers.Control.prototype.deactivate.call(this);
        a && this.cleanUp(this);
        return a
    },
    cleanUp: function(a) {
        this.getDialog().hide();
        a.iframe && a.removeIFrame()
    },
    delayedOpenDialog: function() {
        var a = this;
        setTimeout(function() {
            a.openDialog()
        }, 200)
    },
    getDialog: function() {
        if (this.map && this.map.editor && this.map.editor.dialog) return this.map.editor.dialog;
        this.dialog || (this.dialog =
            new OpenLayers.Editor.Control.Dialog, this.map.addControl(this.dialog));
        return this.dialog
    },
    openDialog: function() {
        var a = document.createElement("div");
        a.appendChild(document.createElement("p"));
        var b = document.createElement("form");
        b.setAttribute("id", "upload_form");
        b.setAttribute("method", "POST");
        b.setAttribute("action", this.url);
        b.setAttribute("target", "upload_iframe");
        b.setAttribute("enctype", "multipart/form-data");
        b.setAttribute("encoding", "multipart/form-data");
        var b = this.createInputElm("oleFile",
                "file", "file", null, b),
            c = document.createElement("select");
        c.setAttribute("name", "format_select");
        c.setAttribute("id", "format_select");
        for (var d, e = 0; e < this.formats.length; ++e) {
            d = document.createElement("option");
            var f = this.formats[e],
                g = f.formatter;
            "string" == typeof g && (g = eval("new " + g + "()"));
            g.fileProjection = f.fileProjection;
            this.formatters[f.name] = g;
            d.setAttribute("value", f.name);
            d.innerHTML = f.name;
            d.fileExt = f.fileExt;
            d.mimeType = f.mimeType;
            d.params = {};
            f.targetSrs && (d.params.target_srs = f.targetSrs);
            f.sourceSrs &&
                (d.params.source_srs = f.sourceSrs);
            c.appendChild(d)
        }
        b.appendChild(c);
        var c = document.createElement("p"),
            h = document.createElement("input");
        h.type = "checkbox";
        h.id = "oleUploadFeatureReplace";
        h.name = "uploadFeatureReplace";
        h.value = "true";
        h.checked = !0;
        h.defaultChecked = !0;
        this.setReplaceFeatures(h.checked);
        c.appendChild(h);
        OpenLayers.Event.observe(c, "click", OpenLayers.Function.bind(function(a) {
            OpenLayers.Event.stop(a, !0);
            this.setReplaceFeatures(h.checked)
        }, this));
        d = document.createElement("label");
        d.htmlFor =
            "oleUploadFeatureReplace";
        d.appendChild(document.createTextNode(OpenLayers.i18n("oleUploadFeatureReplace")));
        c.appendChild(d);
        b.appendChild(c);
        for (var k in this.params) b = this.createInputElm(null, k, "hidden", this.params[k], b);
        a.appendChild(b);
        this.showUploadDialog(a);
        var n = this;
        document.getElementById("oleFile").onchange = function(a) {
            if (a = n.fileInputValue(this))
                if (a = a.split("."), 1 < a.length) {
                    a = "." + a[a.length - 1].toLowerCase();
                    for (var b = document.getElementById("format_select"), c = b.options, d = 0; d < c.length; ++d)
                        if (a ==
                            c[d].fileExt) {
                            b.selectedIndex = d;
                            break
                        }
                }
        }
    },
    showMessage: function(a, b) {
        this.getDialog().show({
            title: OpenLayers.i18n("oleUploadFeature"),
            content: a,
            close: b
        })
    },
    showUploadDialog: function(a) {
        this.getDialog().show({
            title: OpenLayers.i18n("oleUploadFeature"),
            content: a,
            save: OpenLayers.Function.bind(this.uploadFeature, this),
            cancel: OpenLayers.Function.bind(this.cancel, this),
            saveButtonText: "oleDialogOkButton",
            noHideOnSave: !0
        })
    },
    createIFrame: function(a) {
        var b = document.createElement("iframe");
        b.setAttribute("id",
            a);
        b.setAttribute("name", a);
        b.setAttribute("width", "0");
        b.setAttribute("height", "0");
        b.setAttribute("border", "0");
        b.setAttribute("style", "width: 0; height: 0; border: none;");
        b.src = "about:blank";
        return b
    },
    removeIFrame: function() {
        var a = document.getElementById("upload_iframe");
        a && a.parentNode.removeChild(a);
        this.iframe = null
    },
    cancel: function() {
        this.deactivate()
    },
    parseFeatures: function(a) {
        var b = document.getElementById("format_select"),
            b = this.formatters[b.options[b.selectedIndex].value];
        if (!b) return null;
        this.fileProjection && (b.internalProjection = this.layer.map.baseLayer.projection, b.externalProjection = b.fileProjection ? b.fileProjection : this.fileProjection);
        a = b.read(a);
        if (!a || 1 > a.length) return null;
        var c;
        a.constructor != Array && (a = [a]);
        for (b = 0; b < a.length; ++b) c ? c.extend(a[b].geometry.getBounds()) : c = a[b].geometry.getBounds();
        this.bounds = c;
        return a
    },
    uploadFeature: function() {
        var a = document.getElementById("oleFile");
        if (this.fileInputValue(a)) {
            this.iframe = this.createIFrame("upload_iframe");
            document.body.appendChild(this.iframe);
            var b = this,
                c = b.iframe,
                d = function() {
                    c.detachEvent ? c.detachEvent("onload", d) : c.removeEventListener("load", d, !1);
                    var a;
                    c.contentDocument ? a = c.contentDocument.body.innerHTML : c.contentWindow ? a = c.contentWindow.document.body.innerHTML : c.document && (a = c.document.body.innerHTML);
                    a && "escape" == b.params.encoding && (a = a.replace(/&quot;/g, '"').replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/&amp;/g, "&"));
                    a = b.parseFeatures(a);
                    b.replaceFeatures && b.layer.destroyFeatures();
                    a ? (b.layer.addFeatures(a), b.layer.map.zoomToExtent(b.bounds),
                        b.visibleOnUpload && b.layer.setVisibility(!0), setTimeout(function() {
                            b.deactivate()
                        }, 250)) : (b.deactivate(), b.showMessage(OpenLayers.i18n("oleUploadFeatureNone")))
                };
            c.addEventListener && c.addEventListener("load", d, !0);
            c.attachEvent && c.attachEvent("onload", d);
            var a = document.getElementById("upload_form"),
                e = document.getElementById("format_select"),
                e = e.options[e.selectedIndex],
                f;
            for (f in e.params) a = this.createInputElm(null, f, "hidden", e.params[f], a);
            a.submit()
        } else this.cleanUp(this), this.showMessage(OpenLayers.i18n("oleUploadFeatureNoFile"),
            OpenLayers.Function.bind(this.delayedOpenDialog, this))
    },
    createInputElm: function(a, b, c, d, e) {
        var f = document.createElement("input");
        f.setAttribute("type", c);
        f.id = a;
        f.name = b;
        f.value = d ? d : null;
        e && e.appendChild(f);
        return e
    },
    fileInputValue: function(a) {
        return a.files ? 1 == a.files.length ? a.files[0].name : null : a.value
    },
    setReplaceFeatures: function(a) {
        this.replaceFeatures = a
    },
    CLASS_NAME: "OpenLayers.Editor.Control.UploadFeature"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.EditorPanel = OpenLayers.Class(OpenLayers.Control.Panel, {
    autoActivate: !1,
    initialize: function(a, b) {
        OpenLayers.Control.Panel.prototype.initialize.apply(this, [b])
    },
    draw: function() {
        OpenLayers.Control.Panel.prototype.draw.apply(this, arguments);
        this.active || (this.div.style.display = "none");
        return this.div
    },
    redraw: function() {
        this.active || (this.div.style.display = "none");
        OpenLayers.Control.Panel.prototype.redraw.apply(this, arguments);
        this.active && (this.div.style.display = "")
    },
    CLASS_NAME: "OpenLayers.Editor.Control.EditorPanel"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.ImportFeature = OpenLayers.Class(OpenLayers.Control.Button, {
    layer: null,
    title: OpenLayers.i18n("oleImportFeature"),
    initialize: function(a, b) {
        this.layer = a;
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = this.importFeature;
        this.title = OpenLayers.i18n("oleImportFeature");
        this.displayClass = "oleControlDisabled " + this.displayClass
    },
    importFeature: function() {
        var a = [];
        if (0 < this.map.editor.sourceLayers.length) {
            for (var b = 0, c = this.map.editor.sourceLayers.length; b <
                c; b++) {
                for (var d = 0, e = this.map.editor.sourceLayers[b].selectedFeatures.length; d < e; d++) this.map.editor.sourceLayers[b].selectedFeatures[d].renderIntent = "default", a.push(this.map.editor.sourceLayers[b].selectedFeatures[d]);
                this.map.editor.sourceLayers[b].removeFeatures(this.map.editor.sourceLayers[b].selectedFeatures);
                this.map.editor.sourceLayers[b].events.triggerEvent("featureunselected")
            }
            if (0 < a.length) this.layer.addFeatures(a);
            else return this.map.editor.showStatus("error", OpenLayers.i18n("oleImportFeatureSourceFeature"))
        } else return this.map.editor.showStatus("error",
            OpenLayers.i18n("oleImportFeatureSourceLayer"))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.ImportFeature"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.LayerSettings = OpenLayers.Class(OpenLayers.Control, {
    currentLayer: null,
    layerSwitcher: null,
    initialize: function(a, b) {
        OpenLayers.Control.prototype.initialize.apply(this, [b]);
        this.layerSwitcher = a.map.getControlsByClass("OpenLayers.Control.LayerSwitcher")[0];
        this.layerSwitcher instanceof OpenLayers.Control.LayerSwitcher && OpenLayers.Event.observe(this.layerSwitcher.maximizeDiv, "click", OpenLayers.Function.bind(this.redraw, this))
    },
    redraw: function() {
        var a, b;
        this.layerSwitcher.dataLayersDiv.innerHTML =
            "";
        for (var c = 0, d = this.layerSwitcher.dataLayers.length; c < d; c++) {
            var e = this.layerSwitcher.dataLayers[c];
            a = document.createElement("input");
            a.type = "checkbox";
            a.id = "list" + e.layer.name;
            a.name = e.layer.name;
            e.layer.visibility && (a.checked = "checked", a.defaultChecked = "selected");
            this.layerSwitcher.dataLayersDiv.appendChild(a);
            b = document.createElement("span");
            b.innerHTML = e.layer.name;
            OpenLayers.Element.addClass(b, "labelSpan");
            this.layerSwitcher.dataLayersDiv.appendChild(b);
            this.layerSwitcher.dataLayersDiv.appendChild(document.createElement("br"));
            OpenLayers.Event.observe(a, "click", OpenLayers.Function.bind(this.toggleLayerVisibility, this, e.layer.name));
            OpenLayers.Event.observe(b, "click", OpenLayers.Function.bind(this.showLayerSettings, this, e.layer.name))
        }
    },
    showLayerSettings: function(a) {
        var b, c, d, e;
        this.currentLayer = this.map.getLayersByName(a)[0];
        b = document.createElement("div");
        c = document.createElement("h4");
        c.innerHTML = OpenLayers.i18n("oleLayerSettingsOpacityHeader");
        b.appendChild(c);
        e = this.currentLayer.opacity ? this.currentLayer.opacity : 1;
        c =
            document.createElement("input");
        c.type = "text";
        c.size = "2";
        c.value = (100 * e).toFixed(0);
        OpenLayers.Event.observe(c, "change", OpenLayers.Function.bind(this.changeLayerOpacity, this, c));
        b.appendChild(c);
        if (this.currentLayer instanceof OpenLayers.Layer.Vector) {
            c = document.createElement("h4");
            c.innerHTML = OpenLayers.i18n("oleLayerSettingsImportHeader");
            c.style.marginTop = "10px";
            b.appendChild(c);
            e = document.createElement("input");
            e.type = "checkbox";
            e.name = "import" + this.currentLayer.name;
            b.appendChild(e);
            c = document.createElement("label");
            c.htmlFor = "import" + this.currentLayer.name;
            c.innerHTML = OpenLayers.i18n("oleLayerSettingsImportLabel");
            b.appendChild(c);
            b.appendChild(document.createElement("p"));
            c = 0;
            for (d = this.map.editor.sourceLayers.length; c < d; c++)
                if (this.currentLayer.id == this.map.editor.sourceLayers[c].id) {
                    e.writeAttribute("checked", "checked");
                    e.defaultChecked = "selected";
                    break
                }
            OpenLayers.Event.observe(e, "click", OpenLayers.Function.bind(this.toggleExportFeature, this))
        }
        e = this.getLegendGraphics(this.currentLayer);
        if (0 < e.length) {
            c =
                document.createElement("h4");
            c.innerHTML = OpenLayers.i18n("oleLayerSettingsLegendHeader");
            c.style.marginTop = "10px";
            b.appendChild(c);
            for (c = 0; c < e.length; c++) d = document.createElement("img"), d.src = e[c], b.appendChild(d)
        }
        this.map.editor.dialog.show({
            content: b,
            title: a
        })
    },
    toggleExportFeature: function() {
        for (var a = !0, b = 0, c = this.map.editor.sourceLayers.length; b < c; b++)
            if (this.currentLayer.id == this.map.editor.sourceLayers[b].id) {
                this.map.editor.sourceLayers.splice(b, 1);
                a = !1;
                break
            }
        a && this.map.editor.sourceLayers.push(this.currentLayer)
    },
    toggleLayerVisibility: function(a) {
        a = this.map.getLayersByName(a)[0];
        a.visibility ? a.setVisibility(!1) : a.setVisibility(!0);
        this.redraw()
    },
    changeLayerOpacity: function(a) {
        this.currentLayer.setOpacity(a.value / 100)
    },
    getLegendGraphics: function(a) {
        var b = [];
        if (a.legendGraphics) b = a.legendGraphics;
        else if (a instanceof OpenLayers.Layer.WMS)
            for (var c = a.params.LAYERS.split(","), d = 0; d < c.length; d++) {
                var e = c[d],
                    f = a.url,
                    f = f + (-1 === f.indexOf("?") ? "?" : ""),
                    f = f + "&SERVICE=WMS",
                    f = f + "&VERSION=1.1.1",
                    f = f + "&REQUEST=GetLegendGraphic",
                    f = f + "&FORMAT=image/png",
                    f = f + ("&LAYER=" + e);
                b.push(f)
            }
        return b
    },
    CLASS_NAME: "OpenLayers.Editor.Control.LayerSettings"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.MergeFeature = OpenLayers.Class(OpenLayers.Control.Button, {
    proxy: null,
    title: OpenLayers.i18n("oleMergeFeature"),
    initialize: function(a, b) {
        this.layer = a;
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = this.mergeFeature;
        this.title = OpenLayers.i18n("oleMergeFeature");
        this.displayClass = "oleControlDisabled " + this.displayClass
    },
    mergeFeature: function() {
        if (2 > this.layer.selectedFeatures.length) this.map.editor.showStatus("error", OpenLayers.i18n("oleMergeFeatureSelectFeature"));
        else {
            var a = (new OpenLayers.Format.WKT).write(this.layer.selectedFeatures);
            this.map.editor.startWaiting(this.panel_div);
            OpenLayers.Request.POST({
                url: this.map.editor.oleUrl + "process/merge",
                data: OpenLayers.Util.getParameterString({
                    geo: a
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                callback: this.map.editor.requestComplete,
                proxy: this.proxy,
                scope: this.map.editor
            })
        }
    },
    CLASS_NAME: "OpenLayers.Editor.Control.MergeFeature"
});
OpenLayers.Editor.Control.TransformFeature = OpenLayers.Class(OpenLayers.Control.TransformFeature, {
    CLASS_NAME: "OpenLayers.Editor.Control.TransformFeature",
    editLayer: null,
    strategiesOnHold: null,
    drawOriginalsFeature: null,
    drawOriginalsRenderIntent: null,
    initialize: function(a) {
        this.strategiesOnHold = [];
        OpenLayers.Control.TransformFeature.prototype.initialize.call(this, a, {
            renderIntent: "transform",
            rotationHandleSymbolizer: "rotate"
        });
        this.editLayer = a;
        this.addStyles();
        this.events.on({
            transformcomplete: function(a) {
                a.feature.state =
                    OpenLayers.State.UPDATE;
                this.editLayer.events.triggerEvent("afterfeaturemodified", {
                    feature: a.feature
                })
            },
            scope: this
        });
        this.title = OpenLayers.i18n("oleTransformFeature")
    },
    addStyles: function() {
        var a = this;
        this.editLayer.styleMap.styles.transform = new OpenLayers.Style({
            display: "${getDisplay}",
            cursor: "${role}",
            pointRadius: 5,
            fillColor: "#07f",
            strokeOpacity: "${getStrokeOpacity}",
            fillOpacity: 1,
            strokeColor: "${getStrokeColor}",
            strokeWidth: "${getStrokeWidth}",
            strokeDashstyle: "${getStrokeDashstyle}"
        }, {
            context: {
                getDisplay: function(b) {
                    return null ===
                        a.feature || a.feature.geometry instanceof OpenLayers.Geometry.Point ? "none" : "se-resize" === b.attributes.role ? "none" : ""
                },
                getStrokeColor: function(a) {
                    return a.geometry instanceof OpenLayers.Geometry.Point ? "#037" : "#ff00ff"
                },
                getStrokeOpacity: function(a) {
                    return a.geometry instanceof OpenLayers.Geometry.Point ? 0.8 : 0.5
                },
                getStrokeWidth: function(a) {
                    return a.geometry instanceof OpenLayers.Geometry.Point ? 2 : 1
                },
                getStrokeDashstyle: function(a) {
                    return a.geometry instanceof OpenLayers.Geometry.Point ? "solid" : "longdash"
                }
            }
        });
        this.editLayer.styleMap.styles.rotate = new OpenLayers.Style({
            display: "${getDisplay}",
            pointRadius: 10,
            fillColor: "#ddd",
            fillOpacity: 1,
            strokeColor: "black",
            externalGraphic: "msie" === OpenLayers.Util.getBrowserName() ? void 0 : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAWCAYAAAArdgcFAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOnAAADnUBiCgbeAAAAAd0SU1FB9wIAgsPAyGVVyoAAAQFSURBVDjLjZVfTJNnFMZ//aQ0UVMgIi11Kngx1KUGBo0XU+bmmFnmErzRkBK2RBMUyfaV4cQ4t5GNm8UMTJTMbDSj4YI5GFmcMxvyZ4yIJJUbY5GNJv7ZQtGJNBoTL+yzC+NnugJykpO8Oe85z/u85z3vOUhiPj13tsfcX71PGzesV0ZGhgA5nU5tWF+gfXvf0089Z8yF4uc0XvjtnOkrKRbwXC1+uUjnzvaYiwL/4vNPtWTJEgHKyclRTU2Nurq6FA6HFY1GdfnyZXV3d+vgwYPKyckRIMMw9MnHR7Qg+Id1HwiQzWZTdXW1rly5omg0Oq9evXpVtbW1MgxDgGpr9mtO8OC3X5s2m01paWk6derUgqD/19OnT8tutwtQ68kTVopskgDIzl6hu3dnaGxspLKykvnk4cOHRCKRJJvD4eDatWs0NDSQkeFkdjZuA54wP1QfEKDNmzc/l6Xf70951DVr1igajaq0tFSA3q+tkSQMgO/PdAFgmmYSo4mJiRTm9+/ft9Z1dXWEQiGOHz8OQCAQAOCHrh8BMEaGB8ybN2/hcrnw+XxWYDgcZufOnfT29qYckJmZSV5eHu3t7Xi9XoqLiwHYtGkTq1evZioWY7D/V9P486/JZoDCwkJsNpsF0NLSgsfjobS0NAV86dKltLa2MjMzQygUStorKSkBYHx8otmYmooBkJubazk8evSI0dFRdu3ahcPhmPNhCwoKKCoqYmhoKMm+cuVKAGKxGGlP2SYSCcshHo+TSCRwu90poKZp8uDBAwBcLhfj4+NJ+0+rzzAM0jyeJ4ynpqYsh6ysLNLT07l+/XoK+Nq1a631jRs3Ugjcvn0bALfbhVFQ8GIAYGxsjMePHwNgt9vZtm0b3d3d3Lt3b860XLx4kUgkQllZWRLrS5cuAfDSxg0BJJGfnydA7e3tVj2fP39eDodDXq9Xg4ODSbXe0dGhrKws5efnKxKJWPbOzk4BWrXKI+v7HzvaIECFhYWanJy0nNva2rRs2TLZ7XZt3bpV5eXl8nq9ArRu3ToNDAwkHerz+QToUH1ASd8/1+1WbHqa+vp6Dhw4YF11enqaYDDIyMgI8Xgct9vNjh078Pv9SZUUDAZpamoiO3sFd+78awOegZ/p7DAr/O82AzQ1NbF7924WKz09PRw+fJhEIkHou2+orNr7rLc81cbPjln9Ys+ePVYPn0/D4bCqqqqsmKNHPtKCw6L15Ak5HOkCtHz5clVUVKitrU19fX0aGxtTf3+/gsGg/H6/nE6nANntdrV89aUWNeZGR4bMN8u2L2rMbX/9NQ3/fmHOMWflfC4ZGR4wz/78S/PQH8Pc+vsfZmfjZGZm8MIqD1u2vMI7b78V2PLqGy3zxf8Hbd5G4wGXKsEAAAAASUVORK5CYII=",
            graphicWidth: 23,
            graphicHeight: 22
        }, {
            context: {
                getDisplay: function(b) {
                    return null === a.feature || a.feature.geometry instanceof OpenLayers.Geometry.Point ? "none" : "se-rotate" === b.attributes.role ? "" : "none"
                }
            }
        })
    },
    activate: function() {
        for (var a = 0; OpenLayers.Util.isArray(this.layer.strategies) && a < this.layer.strategies.length; a++) this.layer.strategies[a] instanceof OpenLayers.Strategy.BBOX && (this.strategiesOnHold.push(this.layer.strategies[a]), this.layer.strategies[a].deactivate());
        a = OpenLayers.Control.TransformFeature.prototype.activate.call(this);
        if (null === this.feature || this.feature.geometry instanceof OpenLayers.Geometry.Point) {
            this.editLayer.drawFeature(this.box, this.renderIntent);
            var b, c;
            for (c = 0; c < this.rotationHandles.length; c++) b = this.rotationHandles[c], this.editLayer.drawFeature(b, this.renderIntent);
            for (c = 0; c < this.handles.length; c++) b = this.handles[c], this.editLayer.drawFeature(b, this.renderIntent)
        }
        this.events.on({
            setfeature: this.highlightTransformedFeature,
            scope: this
        });
        return a
    },
    deactivate: function() {
        this._moving = !0;
        this.box.geometry.rotate(-this.rotation,
            this.center);
        delete this._moving;
        for (var a = 0; a < this.strategiesOnHold.length; a++) this.strategiesOnHold[a].activate();
        a = OpenLayers.Control.TransformFeature.prototype.deactivate.apply(this, arguments);
        this.unsetFeature();
        this.events.un({
            setfeature: this.highlightTransformedFeature,
            scope: this
        });
        this.drawOriginalsFeature && (this.layer.drawFeature(this.drawOriginalsFeature, this.drawOriginalsRenderIntent), this.drawOriginalsRenderIntent = this.drawOriginalsFeature = null);
        return a
    },
    highlightTransformedFeature: function(a) {
        this.drawOriginalsFeature &&
            this.layer.drawFeature(this.drawOriginalsFeature, this.drawOriginalsRenderIntent);
        this.drawOriginalsFeature = a.feature;
        this.drawOriginalsRenderIntent = a.feature.renderIntent;
        this.layer.drawFeature(a.feature, "select")
    },
    createBox: function() {
        var a = this;
        this.center = new OpenLayers.Geometry.Point(0, 0);
        this.box = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString([new OpenLayers.Geometry.Point(-1, -1), new OpenLayers.Geometry.Point(0, -1), new OpenLayers.Geometry.Point(1, -1), new OpenLayers.Geometry.Point(1,
            0), new OpenLayers.Geometry.Point(1, 1), new OpenLayers.Geometry.Point(0, 1), new OpenLayers.Geometry.Point(-1, 1), new OpenLayers.Geometry.Point(-1, 0), new OpenLayers.Geometry.Point(-1, -1)]), null, "string" == typeof this.renderIntent ? null : this.renderIntent);
        this.box.geometry.move = function(b, c) {
            a._moving = !0;
            OpenLayers.Geometry.LineString.prototype.move.apply(this, arguments);
            a.center.move(b, c);
            delete a._moving
        };
        for (var b = function(a, b) {
                OpenLayers.Geometry.Point.prototype.move.apply(this, arguments);
                this._rotationHandle &&
                    this._rotationHandle.geometry.move(a, b);
                this._handle.geometry.move(a, b)
            }, c = function(a, b, c) {
                OpenLayers.Geometry.Point.prototype.resize.apply(this, arguments);
                this._rotationHandle && this._rotationHandle.geometry.resize(a, b, c);
                this._handle.geometry.resize(a, b, c)
            }, d = function(a, b) {
                OpenLayers.Geometry.Point.prototype.rotate.apply(this, arguments);
                this._rotationHandle && this._rotationHandle.geometry.rotate(a, b);
                this._handle.geometry.rotate(a, b)
            }, e = function(b, c) {
                var d = this.x,
                    e = this.y;
                OpenLayers.Geometry.Point.prototype.move.call(this,
                    b, c);
                if (!a._moving) {
                    var f = a.dragControl.handlers.drag.evt,
                        g = !(!a._setfeature && a.preserveAspectRatio) && !(f && f.shiftKey),
                        h = new OpenLayers.Geometry.Point(d, e),
                        f = a.center;
                    this.rotate(-a.rotation, f);
                    h.rotate(-a.rotation, f);
                    var k = this.x - f.x,
                        m = this.y - f.y,
                        l = k - (this.x - h.x),
                        n = m - (this.y - h.y);
                    a.irregular && !a._setfeature && (k -= (this.x - h.x) / 2, m -= (this.y - h.y) / 2);
                    this.x = d;
                    this.y = e;
                    h = 1;
                    a.feature.geometry instanceof OpenLayers.Geometry.Point ? m = 1 : g ? (m = 1E-5 > Math.abs(n) ? 1 : m / n, h = (1E-5 > Math.abs(l) ? 1 : k / l) / m) : (l = Math.sqrt(l *
                        l + n * n), m = Math.sqrt(k * k + m * m) / l);
                    a._moving = !0;
                    a.box.geometry.rotate(-a.rotation, f);
                    delete a._moving;
                    a.box.geometry.resize(m, f, h);
                    a.box.geometry.rotate(a.rotation, f);
                    a.transformFeature({
                        scale: m,
                        ratio: h
                    });
                    a.irregular && !a._setfeature && (k = f.clone(), k.x += 1E-5 > Math.abs(d - f.x) ? 0 : this.x - d, k.y += 1E-5 > Math.abs(e - f.y) ? 0 : this.y - e, a.box.geometry.move(this.x - d, this.y - e), a.transformFeature({
                        center: k
                    }))
                }
            }, f = function(b, c) {
                var d = this.x,
                    e = this.y;
                OpenLayers.Geometry.Point.prototype.move.call(this, b, c);
                if (!a._moving) {
                    var f =
                        a.dragControl.handlers.drag.evt,
                        f = f && f.shiftKey ? 45 : 1,
                        g = a.center,
                        h = this.x - g.x,
                        k = this.y - g.y;
                    this.x = d;
                    this.y = e;
                    d = Math.atan2(k - c, h - b);
                    d = Math.atan2(k, h) - d;
                    d *= 180 / Math.PI;
                    a._angle = (a._angle + d) % 360;
                    d = a.rotation % f;
                    if (Math.abs(a._angle) >= f || 0 !== d) d = Math.round(a._angle / f) * f - d, a._angle = 0, a.box.geometry.rotate(d, g), a.transformFeature({
                        rotation: d
                    })
                }
            }, g = Array(8), h = Array(4), k, n, p, q = "sw s se e ne n nw w".split(" "), l = 0; 8 > l; ++l) k = this.box.geometry.components[l], n = new OpenLayers.Feature.Vector(k.clone(), {
            role: q[l] +
                "-resize"
        }, "string" == typeof this.renderIntent ? null : this.renderIntent), 0 == l % 2 && (p = new OpenLayers.Feature.Vector(k.clone(), {
            role: q[l] + "-rotate"
        }, "string" == typeof this.rotationHandleSymbolizer ? null : this.rotationHandleSymbolizer), p.geometry.move = f, k._rotationHandle = p, h[l / 2] = p), k.move = b, k.resize = c, k.rotate = d, n.geometry.move = e, k._handle = n, g[l] = n;
        this.rotationHandles = h;
        this.handles = g
    }
});
OpenLayers.Editor.Control.FixedAngleDrawing = OpenLayers.Class(OpenLayers.Control, {
    CLASS_NAME: "OpenLayers.Editor.Control.FixedAngleDrawing",
    active: !1,
    sketchVerticesAmount: null,
    guides: null,
    initialize: function(a) {
        this.guides = [];
        OpenLayers.Control.prototype.initialize.call(this);
        this.layer = a
    },
    activate: function() {
        var a = OpenLayers.Control.prototype.activate.call(this);
        if (a) this.layer.events.on({
            sketchstarted: this.onSketchStarted,
            sketchmodified: this.onSketchModified,
            sketchcomplete: this.onSketchComplete,
            scope: this
        });
        return a
    },
    deactivate: function() {
        var a = OpenLayers.Control.prototype.deactivate.call(this);
        a && this.layer.events.un({
            sketchstarted: this.onSketchStarted,
            sketchmodified: this.onSketchModified,
            sketchcomplete: this.onSketchComplete,
            scope: this
        });
        return a
    },
    onSketchModified: function(a) {
        a = a.feature.geometry.getVertices();
        if (2 < a.length && this.sketchVerticesAmount !== a.length) {
            this.removeGuides();
            this.sketchVerticesAmount = a.length;
            this.updateGuideLines(a[a.length - 3], a[a.length - 2]);
            var b = this.getSnappingGuideLayer(),
                c = -1 / b.getLine({
                    x1: a[0].x,
                    y1: a[0].y,
                    x2: a[1].x,
                    y2: a[1].y
                }).m;
            this.guides.push(b.addLine({
                m: c,
                b: a[0].y - c * a[0].x
            }))
        }
    },
    onSketchComplete: function() {
        this.removeGuides()
    },
    removeGuides: function() {
        this.getSnappingGuideLayer().removeFeatures(this.guides);
        this.guides = []
    },
    onSketchStarted: function(a) {
        var b = a.feature,
            c;
        if (b.geometry instanceof OpenLayers.Geometry.LineString || b.geometry instanceof OpenLayers.Geometry.Polygon) {
            for (a = 0; a < this.map.controls.length; a++) {
                var d = this.map.controls[a];
                if (d.active && d.handler instanceof OpenLayers.Handler.Path) {
                    c = d.handler.layer;
                    break
                }
            }
            c.events.on({
                featureremoved: function(a) {
                    a.feature.id === b.id && (this.sketchVerticesAmount = null, this.getSnappingGuideLayer().destroyFeatures())
                },
                scope: this
            })
        }
    },
    getSnappingGuideLayer: function() {
        return this.map.getLayersByClass("OpenLayers.Editor.Layer.Snapping")[0]
    },
    updateGuideLines: function(a, b) {
        var c = this.getSnappingGuideLayer(),
            d = -1 / ((b.y - a.y) / (b.x - a.x));
        this.guides.push(c.addLine({
            m: d,
            b: b.y - d * b.x,
            x: b.x
        }))
    }
});
OpenLayers.Editor.Layer = OpenLayers.Class(OpenLayers.Layer, {
    initialize: function(a) {
        OpenLayers.Control.prototype.initialize.apply(this, [a])
    },
    CLASS_NAME: "OpenLayers.Editor.Layer"
});
OpenLayers.Editor.Layer.Snapping = OpenLayers.Class(OpenLayers.Layer.Vector, {
    CLASS_NAME: "OpenLayers.Editor.Layer.Snapping",
    intersectionPoints: null,
    initialize: function(a, b) {
        this.intersectionPoints = [];
        void 0 === b.styleMap && (b.styleMap = new OpenLayers.StyleMap({
            "default": new OpenLayers.Style({
                strokeColor: "#ff00ff",
                strokeOpacity: 0.5,
                strokeWidth: 1,
                strokeDashstyle: "solid",
                fillColor: "#ff00ff"
            }, {
                rules: [new OpenLayers.Rule({
                        evaluate: function(a) {
                            return a.geometry instanceof OpenLayers.Geometry.LineString
                        },
                        symbolizer: {
                            strokeDashstyle: "longdash"
                        }
                    }),
                    new OpenLayers.Rule({
                        evaluate: function(a) {
                            return a.geometry instanceof OpenLayers.Geometry.Point
                        },
                        symbolizer: {
                            graphicName: "cross",
                            pointRadius: 3,
                            strokeWidth: 0
                        }
                    }), new OpenLayers.Rule
                ]
            })
        }));
        OpenLayers.Layer.Vector.prototype.initialize.call(this, a, b)
    },
    addGuides: function(a, b) {
        for (var c = [], d = 0; d < a.length; d++) c[d] = a[d] instanceof OpenLayers.Feature.Vector ? a[d] : new OpenLayers.Feature.Vector(a[d]);
        OpenLayers.Layer.Vector.prototype.addFeatures.call(this, c, b);
        return c
    },
    getLine: function(a) {
        if (a.x1 === a.x2) return {
            m: Infinity,
            x: a.x1
        };
        var b = (a.y2 - a.y1) / (a.x2 - a.x1);
        return {
            m: b,
            b: a.y2 - b * a.x2
        }
    },
    addLine: function(a) {
        var b = this.map.getMaxExtent();
        a = Infinity === a.m ? new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString([new OpenLayers.Geometry.Point(a.x, b.top), new OpenLayers.Geometry.Point(a.x, b.bottom)])) : new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString([this.createWorldBoundaryPoint(a.m, b.left, a.b, b), this.createWorldBoundaryPoint(a.m, b.right, a.b, b)]));
        this.addFeatures([a]);
        this.rebuildIntersectionPoints();
        return a
    },
    createWorldBoundaryPoint: function(a, b, c, d) {
        var e = a * b + c;
        b = e > d.top ? (d.top - c) / a : e < d.bottom ? (d.bottom - c) / a : b;
        return new OpenLayers.Geometry.Point(b, a * b + c)
    },
    rebuildIntersectionPoints: function() {
        var a = this.map.getMaxExtent();
        this.removeFeatures(this.intersectionPoints);
        this.intersectionPoints = [];
        this.features.forEach(function(b) {
            b.geometry instanceof OpenLayers.Geometry.Curve && b.geometry.getSortedSegments().forEach(function(b) {
                var d = this.getLine(b);
                this.features.forEach(function(b) {
                    b.geometry instanceof
                    OpenLayers.Geometry.Curve && b.geometry.getSortedSegments().forEach(function(b) {
                        b = this.getLine(b);
                        if (d.m !== b.m) {
                            b = (b.b - d.b) / (d.m - b.m);
                            var c = d.m * b + d.b;
                            b >= a.left && (b <= a.right && c >= a.bottom && c <= a.top) && this.intersectionPoints.push(new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(b, c)))
                        }
                    }, this)
                }, this)
            }, this)
        }, this);
        this.addFeatures(this.intersectionPoints)
    },
    removeFeatures: function(a, b) {
        OpenLayers.Layer.Vector.prototype.removeFeatures.apply(this, arguments);
        a !== this.intersectionPoints && this.rebuildIntersectionPoints()
    },
    drawFeature: function(a, b) {
        var c = OpenLayers.Layer.Vector.prototype.drawFeature.apply(this, arguments);
        if (this.unrenderedFeatures[a.id] === a) {
            var d = this.map.getExtent();
            if (a.geometry.intersects(d.toGeometry()))
                if (a.geometry instanceof OpenLayers.Geometry.LineString && 2 === a.geometry.components.length) {
                    var e = a.geometry.getSortedSegments()[0],
                        f = this.getLine(e);
                    Infinity === f.m ? (c = new OpenLayers.Geometry.Point(f.x, d.top), f = new OpenLayers.Geometry.Point(f.x, d.bottom)) : (c = this.createWorldBoundaryPoint(f.m, d.left,
                        f.b, d), f = this.createWorldBoundaryPoint(f.m, d.right, f.b, d));
                    d = a.geometry.components[0];
                    d.x = c.x;
                    d.y = c.y;
                    var g = a.geometry.components[1];
                    g.x = f.x;
                    g.y = f.y;
                    c = OpenLayers.Layer.Vector.prototype.drawFeature.apply(this, arguments);
                    d.x = e.x1;
                    d.y = e.y1;
                    g.x = e.x2;
                    g.y = e.y2
                } else console.warn("Failed to render a feature", a)
        }
        return c
    },
    moveTo: function(a, b, c) {
        OpenLayers.Layer.Vector.prototype.moveTo.apply(this, arguments);
        this.features.forEach(function(a) {
            this.drawFeature(a)
        }, this)
    }
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.SnappingSettings = OpenLayers.Class(OpenLayers.Control.Button, {
    title: OpenLayers.i18n("oleSnappingSettings"),
    layer: null,
    snapping: new OpenLayers.Control.Snapping,
    tolerance: 10,
    snappingLayers: null,
    snappingGuideLayer: null,
    layerListDiv: null,
    toleranceInput: null,
    initialize: function(a, b) {
        this.snappingLayers = [];
        this.layer = a;
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = OpenLayers.Function.bind(this.openSnappingDialog, this);
        this.events.register("deactivate",
            this, this.onDeactivate);
        this.title = OpenLayers.i18n("oleSnappingSettings")
    },
    deactivate: function() {
        OpenLayers.Control.Button.prototype.deactivate.call(this);
        this.map && (this.map.editor && this.map.editor.dialog) && this.map.editor.dialog.hide()
    },
    onDeactivate: function() {
        this.snapping.active && this.activate()
    },
    openSnappingDialog: function() {
        var a, b;
        this.activate();
        this.layerListDiv = document.createElement("div");
        a = document.createElement("div");
        b = document.createElement("h4");
        b.innerHTML = OpenLayers.i18n("oleSnappingSettingsTolerance");
        a.appendChild(b);
        this.toleranceInput = document.createElement("input");
        this.toleranceInput.type = "text";
        this.toleranceInput.size = 4;
        this.toleranceInput.value = this.tolerance;
        a.appendChild(this.toleranceInput);
        a.appendChild(document.createTextNode(OpenLayers.i18n("olePixelUnit")));
        b = document.createElement("h4");
        b.innerHTML = OpenLayers.i18n("oleSnappingSettingsLayer");
        a.appendChild(b);
        a.appendChild(this.layerListDiv);
        this.map.editor.dialog.show({
            content: a,
            title: OpenLayers.i18n("oleSnappingSettings"),
            close: OpenLayers.Function.bind(this.changeSnapping,
                this)
        });
        this.redraw()
    },
    redraw: function() {
        var a, b, c;
        this.layerListDiv.innerHTML = "";
        for (var d = 0; d < this.map.layers.length; d++) a = this.map.layers[d], !(a instanceof OpenLayers.Layer.Vector.RootContainer) && (a instanceof OpenLayers.Layer.Vector && !(a instanceof OpenLayers.Editor.Layer.Snapping) && -1 == a.name.search(/OpenLayers.Handler.+/)) && (c = document.createElement("div"), b = document.createElement("input"), b.type = "checkbox", b.name = "snappingLayer", b.id = "Snapping." + a.id, b.value = "true", 0 <= this.snappingLayers.indexOf(a) &&
            (b.checked = "checked", b.defaultChecked = "selected"), c.appendChild(b), OpenLayers.Event.observe(b, "click", OpenLayers.Function.bind(this.setLayerSnapping, this, a, b.checked)), b = document.createElement("label"), b.setAttribute("for", "Snapping." + a.id), b.innerHTML = a.name, OpenLayers.Event.observe(b, "click", OpenLayers.Function.bind(function(a) {
                OpenLayers.Event.stop(a, !0)
            }, this)), c.appendChild(b), this.layerListDiv.appendChild(c))
    },
    setLayerSnapping: function(a, b) {
        b ? this.snappingLayers.splice(this.snappingLayers.indexOf(a),
            1) : this.snappingLayers.push(a);
        this.redraw()
    },
    changeSnapping: function() {
        this.tolerance = parseInt(this.toleranceInput.value, 10);
        if (0 < this.snappingLayers.length) {
            this.snapping.deactivate();
            for (var a = [], b = 0; b < this.snappingLayers.length; b++) a.push({
                layer: this.snappingLayers[b],
                tolerance: this.tolerance
            });
            this.snapping = new OpenLayers.Control.Snapping({
                layer: this.layer,
                targets: a
            });
            for (b = 0; b < a.length; b++) {
                var c = a[b].layer;
                if (!1 === c.visibility)
                    for (var d = 0, e = c.strategies.length; d < e; d++) "OpenLayers.Strategy.BBOX" ===
                        c.strategies[d].CLASS_NAME && c.strategies[d].update({
                            force: !0
                        })
            }
            this.snapping.activate()
        } else this.snapping.active && (this.snapping.deactivate(), this.snapping.targets = null);
        this.snapping.active || this.deactivate()
    },
    setMap: function(a) {
        OpenLayers.Control.Button.prototype.setMap.apply(this, arguments);
        null === this.snappingGuideLayer && (this.snappingGuideLayer = this.createSnappingGuideLayer())
    },
    createSnappingGuideLayer: function() {
        var a = new OpenLayers.Editor.Layer.Snapping(OpenLayers.i18n("Snapping Layer"), {
            visibility: !1
        });
        this.map.addLayer(a);
        return a
    },
    CLASS_NAME: "OpenLayers.Editor.Control.SnappingSettings"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.SplitFeature = OpenLayers.Class(OpenLayers.Control.DrawFeature, {
    proxy: null,
    title: OpenLayers.i18n("oleSplitFeature"),
    initialize: function(a, b) {
        OpenLayers.Control.DrawFeature.prototype.initialize.apply(this, [a, OpenLayers.Handler.Path, b]);
        this.events.register("activate", this, this.test);
        this.title = OpenLayers.i18n("oleSplitFeature");
        this.displayClass = "oleControlDisabled " + this.displayClass
    },
    test: function() {
        1 > this.layer.selectedFeatures.length && this.deactivate()
    },
    drawFeature: function(a) {
        a =
            new OpenLayers.Feature.Vector(a);
        var b = new OpenLayers.Format.WKT,
            c = this.layer.events.triggerEvent("sketchcomplete", {
                feature: a
            });
        this.deactivate();
        !1 !== c && 0 < this.layer.selectedFeatures.length && (c = b.write(this.layer.selectedFeatures), a = b.write(a), this.map.editor.startWaiting(this.panel_div), OpenLayers.Request.POST({
            url: this.map.editor.oleUrl + "process/split",
            data: OpenLayers.Util.getParameterString({
                cut: a,
                geo: c
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            callback: this.map.editor.requestComplete,
            proxy: this.proxy,
            scope: this.map.editor
        }))
    },
    CLASS_NAME: "OpenLayers.Editor.Control.SplitFeature"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.UndoRedo = OpenLayers.Class(OpenLayers.Control, {
    layer: null,
    handler: null,
    autoActivate: !0,
    KEY_Z: 90,
    KEY_Y: 89,
    onUndo: function() {},
    onRedo: function() {},
    onRemoveFeature: function() {},
    undoStack: null,
    redoStack: null,
    currentState: null,
    initialize: function(a, b) {
        this.layer = a;
        OpenLayers.Control.prototype.initialize.apply(this, [b]);
        this.layer.events.register("featureadded", this, this.register);
        this.layer.events.register("afterfeaturemodified", this, this.register);
        this.undoStack = [];
        this.redoStack = []
    },
    draw: function() {
        this.handler = new OpenLayers.Handler.Keyboard(this, {
            keydown: this.handleKeydown
        })
    },
    handleKeydown: function(a) {
        a.keyCode === this.KEY_Z && !0 === a.ctrlKey && !1 === a.shiftKey ? this.undo() : !0 === a.ctrlKey && (a.keyCode === this.KEY_Y || a.keyCode === this.KEY_Z && !0 === a.shiftKey) && this.redo()
    },
    undo: function() {
        var a = this.moveBetweenStacks(this.undoStack, this.redoStack, !0);
        if (a) this.onUndo(a)
    },
    redo: function() {
        var a = this.moveBetweenStacks(this.redoStack, this.undoStack, !1);
        if (a) this.onRedo(a)
    },
    moveBetweenStacks: function(a,
        b, c) {
        if (0 < a.length)
            if (this.map.editor.editLayer.removeAllFeatures(), a = a.pop(), b.push(this.currentState), a) {
                b = Array(d);
                var d = a.length;
                for (c = 0; c < d; ++c) b[c] = a[c].clone();
                this.currentState = b;
                this.map.editor.editLayer.addFeatures(a, {
                    silent: !0
                })
            } else this.currentState = null;
        else this.currentState && c && (b.push(this.currentState), this.map.editor.editLayer.removeAllFeatures(), this.currentState = null)
    },
    register: function() {
        for (var a = this.map.editor.editLayer.features, b = a.length, c = Array(b), d = 0; d < b; ++d) c[d] = a[d].clone();
        this.currentState && this.undoStack.push(this.currentState);
        this.currentState = c;
        this.redoStack = []
    },
    CLASS_NAME: "OpenLayers.Editor.Control.UndoRedo"
});
/*
  2011 geOps
 @license    https://github.com/geops/ole/blob/master/license.txt
 @link       https://github.com/geops/ole
*/
OpenLayers.Editor.Control.CADTools = OpenLayers.Class(OpenLayers.Control.Button, {
    title: OpenLayers.i18n("oleCADTools"),
    layer: null,
    parallelDrawingButton: null,
    guidedDrawingButton: null,
    tolerance: 10,
    fixedAngleDrawingControl: null,
    parallelDrawingControl: null,
    snappingControl: null,
    initialize: function(a, b) {
        this.layer = a;
        this.fixedAngleDrawingControl = new OpenLayers.Editor.Control.FixedAngleDrawing(a);
        this.parallelDrawingControl = new OpenLayers.Editor.Control.ParallelDrawing(a);
        OpenLayers.Control.Button.prototype.initialize.apply(this, [b]);
        this.trigger = OpenLayers.Function.bind(this.openCADToolsDialog, this);
        this.events.register("deactivate", this, this.onDeactivate);
        this.title = OpenLayers.i18n("oleCADTools")
    },
    activate: function() {
        var a = OpenLayers.Control.Button.prototype.activate.call(this);
        a && this.snappingControl.activate();
        return a
    },
    deactivate: function() {
        var a = OpenLayers.Control.Button.prototype.deactivate.call(this);
        a && this.snappingControl.deactivate();
        return a
    },
    onDeactivate: function() {
        this.deactivate();
        this.map.editor.dialog.hide()
    },
    setMap: function(a) {
        OpenLayers.Control.Button.prototype.setMap.call(this, a);
        this.map.addControl(this.fixedAngleDrawingControl);
        this.map.addControl(this.parallelDrawingControl);
        this.snappingControl = new OpenLayers.Control.Snapping({
            layer: this.layer,
            targets: [{
                layer: this.map.getLayersByClass("OpenLayers.Editor.Layer.Snapping")[0],
                tolerance: this.tolerance
            }]
        })
    },
    openCADToolsDialog: function() {
        if (this.active) this.deactivate(), this.map.editor.dialog.hide();
        else {
            this.activate();
            var a, b;
            a = document.createElement("div");
            b = document.createElement("div");
            b.className = "olEditorControlEditorPanel olEditorCADToolsToolbar";
            b.style.top = "10px";
            b.style.right = "10px";
            this.parallelDrawingButton = document.createElement("div");
            this.parallelDrawingButton.title = OpenLayers.i18n("oleCADToolsDialogParallelDrawing");
            this.parallelDrawingButton.className = this.parallelDrawingControl.active ? "olEditorParallelDrawingActive" : "olEditorParallelDrawingInactive";
            OpenLayers.Event.observe(this.parallelDrawingButton, "click", OpenLayers.Function.bind(function() {
                this.parallelDrawingControl.active ?
                    (this.parallelDrawingControl.deactivate(), this.parallelDrawingButton.className = "olEditorParallelDrawingInactive") : (this.parallelDrawingControl.activate(), this.parallelDrawingButton.className = "olEditorParallelDrawingActive")
            }, this, this.parallelDrawingButton));
            b.appendChild(this.parallelDrawingButton);
            this.guidedDrawingButton = document.createElement("div");
            this.guidedDrawingButton.title = OpenLayers.i18n("oleCADToolsDialogGuidedDrawing");
            this.guidedDrawingButton.className = this.fixedAngleDrawingControl.active ?
                "olEditorGuidedDrawingActive" : "olEditorGuidedDrawingInactive";
            OpenLayers.Event.observe(this.guidedDrawingButton, "click", OpenLayers.Function.bind(function() {
                this.fixedAngleDrawingControl.active ? (this.fixedAngleDrawingControl.deactivate(), this.guidedDrawingButton.className = "olEditorGuidedDrawingInactive") : (this.fixedAngleDrawingControl.activate(), this.guidedDrawingButton.className = "olEditorGuidedDrawingActive")
            }, this, this.guidedDrawingButton));
            b.appendChild(this.guidedDrawingButton);
            a.appendChild(b);
            var c = document.createElement("div"),
                d = document.createElement("p"),
                e = document.createElement("input");
            e.type = "checkbox";
            e.id = "oleCADToolsDialogShowLayer";
            e.name = "guidedDrawing";
            e.value = "true";
            e.checked = !0;
            e.defaultChecked = !0;
            this.setShowGuides(e.checked);
            d.appendChild(e);
            OpenLayers.Event.observe(d, "click", OpenLayers.Function.bind(function(a) {
                OpenLayers.Event.stop(a, !0);
                this.setShowGuides(e.checked)
            }, this));
            b = document.createElement("label");
            b.htmlFor = "oleCADToolsDialogShowLayer";
            b.appendChild(document.createTextNode(OpenLayers.i18n("oleCADToolsDialogShowLayer")));
            d.appendChild(b);
            c.appendChild(d);
            d = document.createElement("p");
            b = document.createElement("input");
            b.type = "text";
            b.id = "oleCADToolsDialogTolerance";
            b.size = 4;
            b.value = this.tolerance;
            OpenLayers.Event.observe(b, "change", OpenLayers.Function.bind(function(a) {
                this.setTolerance(a.target.value)
            }, this));
            d.appendChild(b);
            b = document.createElement("label");
            b.htmlFor = "oleCADToolsDialogTolerance";
            b.appendChild(document.createTextNode(OpenLayers.i18n("oleCADToolsDialogTolerance")));
            d.appendChild(b);
            c.appendChild(d);
            a.appendChild(c);
            this.map.editor.dialog.show({
                content: a,
                toolbox: !0
            })
        }
    },
    setTolerance: function(a) {
        this.tolerance = a;
        this.snappingControl.setTargets([{
            layer: this.map.getLayersByClass("OpenLayers.Editor.Layer.Snapping")[0],
            tolerance: this.tolerance
        }])
    },
    setShowGuides: function(a) {
        this.map.getLayersByClass("OpenLayers.Editor.Layer.Snapping")[0].setVisibility(a)
    },
    CLASS_NAME: "OpenLayers.Editor.Control.CADTools"
});
OpenLayers.Editor.Control.ParallelDrawing = OpenLayers.Class(OpenLayers.Control, {
    CLASS_NAME: "OpenLayers.Editor.Control.ParallelDrawing",
    active: !1,
    guideLine: null,
    guideLineSegment: null,
    initialize: function(a) {
        OpenLayers.Control.prototype.initialize.call(this);
        this.layer = a
    },
    activate: function() {
        var a = OpenLayers.Control.prototype.activate.call(this);
        if (a) this.layer.events.on({
            pointadded: this.closestSegment,
            sketchcomplete: this.onSketchComplete,
            scope: this
        });
        return a
    },
    deactivate: function() {
        var a = OpenLayers.Control.prototype.deactivate.call(this);
        a && this.layer.events.un({
            pointadded: this.closestSegment,
            sketchcomplete: this.onSketchComplete,
            scope: this
        });
        return a
    },
    closestSegment: function(a) {
        var b = null,
            c = Number.MAX_VALUE;
        this.layer.features.forEach(function(d) {
            var e = [];
            d.geometry instanceof OpenLayers.Geometry.Curve ? e = d.geometry.getSortedSegments() : d.geometry instanceof OpenLayers.Geometry.Polygon && d.geometry.components.forEach(function(a) {
                a.getSortedSegments().forEach(function(a) {
                    e.push(a)
                })
            });
            e.forEach(function(d) {
                if (!(null !== this.guideLineSegment &&
                        this.guideLineSegment.x1 === d.x1 && this.guideLineSegment.y1 === d.y1 && this.guideLineSegment.x2 === d.x2 && this.guideLineSegment.y2 === d.y2)) {
                    var e = (new OpenLayers.Geometry.LineString([new OpenLayers.Geometry.Point(d.x1, d.y1), new OpenLayers.Geometry.Point(d.x2, d.y2)])).distanceTo(new OpenLayers.Geometry.Point(a.point.x, a.point.y));
                    e < c && (c = e, b = d)
                }
            }, this)
        }, this);
        if (b) {
            this.guideLineSegment = b;
            this.removeGuides();
            var d = this.getSnappingGuideLayer(),
                e = d.getLine(b);
            e.b += a.point.y - (e.m * a.point.x + e.b);
            this.guideLine =
                d.addLine(e)
        }
    },
    getSnappingGuideLayer: function() {
        return this.map.getLayersByClass("OpenLayers.Editor.Layer.Snapping")[0]
    },
    onSketchComplete: function() {
        this.removeGuides()
    },
    removeGuides: function() {
        null !== this.guideLine && this.getSnappingGuideLayer().removeFeatures([this.guideLine]);
        this.guideLine = null
    }
});
OpenLayers.Lang.ca = OpenLayers.Util.extend(OpenLayers.Lang.ca, {
    oleCleanFeature: "Netejar la geometria seleccionada",
    oleDeleteFeature: "Esborrar la geometria seleccionada",
    oleDragFeature: "Moure geometria",
    oleDrawHole: "Dibuixar forat",
    oleDrawPolygon: "Dibuixar polígon",
    oleDrawPath: "Dibuixar línia",
    oleDrawPoint: "Dibuixar punt",
    oleImportFeature: "Importar la geometria seleccionada",
    oleImportFeatureSourceLayer: "No s'ha trobat la capa origen.",
    oleImportFeatureSourceFeature: "Si us plau seleccioneu una geometria abans.",
    oleLayerSettingsImportHeader: "Importar",
    oleLayerSettingsImportLabel: "Fer servir com a capa origen",
    oleLayerSettingsLegendHeader: "Llegenda",
    oleLayerSettingsOpacityHeader: "Opacitat (%)",
    oleMergeFeature: "Barrejar les geometries seleccionades",
    oleMergeFeatureSelectFeature: "Si us plau seleccioneu com a mínim 2 geometries.",
    oleModifyFeature: "Modificar geometria",
    oleNavigation: "Navegació",
    olePixelUnit: "px",
    oleSelectFeature: "Seleccionar geometria",
    oleSnappingSettings: "Configuració de l'ajust automàtic",
    oleSnappingSettingsLayer: "Capa d'ajust automàtic",
    oleSnappingSettingsTolerance: "Tolerancia de l'ajust automàtic",
    oleSplitFeature: "Partir la geometria seleccionada"
});
OpenLayers.Lang.de = OpenLayers.Util.extend(OpenLayers.Lang.de, {
    oleCleanFeature: "Selektierte Geometrien bereinigen",
    oleDeleteFeature: "Selektierte Geometrien löschen",
    oleDeleteAllFeatures: "Alle Geometrien löschen",
    oleDownloadFeature: "Geometrien herunterladen",
    oleDownloadFeatureEmpty: "Keine Geometrie zum herunterladen",
    oleDownloadFeatureFileFormat: "Dateiformat wählen",
    oleUploadFeature: "Geometrien aus lokaler Datei hochladen",
    oleUploadFeatureNoFile: "Keine Datei angegeben. Bitte Datei wählen und erneut ausführen.",
    oleUploadFeatureNone: "Keine lesbaren Geometrien in der Datei gefunden",
    oleUploadFeatureReplace: "Geometrien im Layer ersetzen",
    oleDragFeature: "Geometrie verschieben",
    oleDrawHole: "Loch schneiden",
    oleDrawPolygon: "Fläche erstellen",
    oleDrawPath: "Linie erstellen",
    oleDrawPoint: "Punkt erstellen",
    oleDrawText: "Bezeichnung einfügen",
    oleDrawTextEdit: "Text in Eingabefeld schreiben,<br>dann mit Enter oder Schließen des Popups bestätigen",
    oleDrawRegular: "Gleichseitige Form erstellen",
    oleDrawRegularShape: "Form",
    oleDrawRegularIrregular: "nicht gleichseitig",
    oleDrawRegularSides3: "Dreieck",
    oleDrawRegularSides4: "Viereck",
    oleDrawRegularSides5: "Fünfeck",
    oleDrawRegularSides6: "Sechseck",
    oleDrawRegularCircle: "Kreis",
    oleImportFeature: "Selektierte Geometrien importieren",
    oleImportFeatureSourceLayer: "Keine Ebenen für den Import gefunden",
    oleImportFeatureSourceFeature: "Keine selektierten Geometrien für den Import gefunden.",
    oleLayerSettingsImportHeader: "Import",
    oleLayerSettingsImportLabel: "Layer als Quelle für Import verwenden",
    oleLayerSettingsLegendHeader: "Legende",
    oleLayerSettingsOpacityHeader: "Opazität in %",
    oleMergeFeature: "Selektierte Geometrien verschmelzen",
    oleMergeFeatureSelectFeature: "Bitte mindestens 2 Flächen auswählen.",
    oleModifyFeature: "Geometrien bearbeiten",
    oleNavigation: "Navigation",
    olePixelUnit: "px",
    oleSelectFeature: "Geometrien selektieren",
    oleSnappingSettings: "Snapping Einstellungen",
    oleSnappingSettingsLayer: "Snapping Layer",
    oleSnappingSettingsTolerance: "Snapping Toleranz in px",
    oleSplitFeature: "Selektierte Geometrien teilen",
    oleTransformFeature: "Geometrie skalieren, drehen und verschieben",
    oleCADTools: "CAD Funktionen",
    oleCADToolsDialogParallelDrawing: "Paralleles Zeichnen aktivieren",
    oleCADToolsDialogGuidedDrawing: "Geführtes Zeichnen aktivieren",
    oleCADToolsDialogShowLayer: "Hilfslinien anzeigen",
    oleCADToolsDialogTolerance: "px Toleranz",
    oleDialogCancelButton: "Abbrechen",
    oleDialogSaveButton: "Speichern",
    oleDialogOkButton: "Okay"
});
OpenLayers.Lang.en = OpenLayers.Util.extend(OpenLayers.Lang.en, {
    oleCleanFeature: "Clean selected geometry",
    oleDeleteFeature: "Delete selected geometry",
    oleDeleteAllFeatures: "Delete all geometries",
    oleDownloadFeature: "Download geometries",
    oleDownloadFeatureEmpty: "No geometries to download",
    oleDownloadFeatureFileFormat: "Select a file format",
    oleUploadFeature: "Upload geometries from local file",
    oleUploadFeatureNoFile: "No file specified. Please choose a file and try again.",
    oleUploadFeatureNone: "No or unreadable geometries found in file",
    oleUploadFeatureReplace: "Replace current geometries in layer",
    oleDragFeature: "Drag geometry",
    oleDrawHole: "Draw hole",
    oleDrawPolygon: "Draw polygon",
    oleDrawPath: "Draw path",
    oleDrawPoint: "Draw point",
    oleDrawText: "Draw text label",
    oleDrawTextEdit: "Add label text in box,<br>then press enter or close popup",
    oleDrawRegular: "Draw regular polygon",
    oleDrawRegularShape: "Shape",
    oleDrawRegularIrregular: "Irregular",
    oleDrawRegularSides3: "triangle",
    oleDrawRegularSides4: "square",
    oleDrawRegularSides5: "pentagon",
    oleDrawRegularSides6: "hexagon",
    oleDrawRegularCircle: "circle",
    oleImportFeature: "Import selected geometry",
    oleImportFeatureSourceLayer: "Found no source layer.",
    oleImportFeatureSourceFeature: "Please select a geometry first.",
    oleLayerSettingsImportHeader: "Import",
    oleLayerSettingsImportLabel: "Use as source layer",
    oleLayerSettingsLegendHeader: "Legend",
    oleLayerSettingsOpacityHeader: "Opacity (%)",
    oleMergeFeature: "Merge selected geometry",
    oleMergeFeatureSelectFeature: "Please select at least 2 geometries.",
    oleModifyFeature: "Modify geometry",
    oleNavigation: "Navigation",
    olePixelUnit: "px",
    oleSelectFeature: "Select geometry",
    oleSnappingSettings: "Snapping settings",
    oleSnappingSettingsLayer: "Snapping layer",
    oleSnappingSettingsTolerance: "Snapping tolerance",
    oleSplitFeature: "Split selected geometry",
    oleTransformFeature: "Scale, rotate and move geometry",
    oleCADTools: "CAD Tools",
    oleCADToolsDialogParallelDrawing: "Parallel Drawing",
    oleCADToolsDialogGuidedDrawing: "Guided Drawing",
    oleCADToolsDialogShowLayer: "Show Guide Lines",
    oleCADToolsDialogTolerance: "px tolerance",
    oleDialogCancelButton: "Cancel",
    oleDialogSaveButton: "Save",
    oleDialogOkButton: "Okay"
});
OpenLayers.Lang.tr = OpenLayers.Util.extend(OpenLayers.Lang.tr, {
    oleCleanFeature: "Clean selected geometry",
    oleDeleteFeature: "Delete selected geometry",
    oleDeleteAllFeatures: "Delete all geometries",
    oleDownloadFeature: "Download geometries",
    oleDownloadFeatureEmpty: "No geometries to download",
    oleDownloadFeatureFileFormat: "Select a file format",
    oleUploadFeature: "Upload geometries from local file",
    oleUploadFeatureNoFile: "No file specified. Please choose a file and try again.",
    oleUploadFeatureNone: "No or unreadable geometries found in file",
    oleUploadFeatureReplace: "Replace current geometries in layer",
    "oleDragFeature": "Geometri Sürükle",
    "oleDrawHole": "Boşluk Çiz",
    "oleDrawPolygon": "Poligon Çiz",
    "oleDrawPath": "Yol Çiz",
    "oleDrawPoint": "Nokta Çiz",
    "oleDrawText": "Yazı İşaretleme Alanı",
    oleDrawTextEdit: "Add label text in box,<br>then press enter or close popup",
    "oleDrawRegular": "Düz Açılı Poligon Çiz",
    oleDrawRegularShape: "Shape",
    oleDrawRegularIrregular: "Irregular",
    oleDrawRegularSides3: "triangle",
    oleDrawRegularSides4: "square",
    oleDrawRegularSides5: "pentagon",
    oleDrawRegularSides6: "hexagon",
    oleDrawRegularCircle: "circle",
    oleImportFeature: "Import selected geometry",
    oleImportFeatureSourceLayer: "Found no source layer.",
    oleImportFeatureSourceFeature: "Please select a geometry first.",
    oleLayerSettingsImportHeader: "Import",
    oleLayerSettingsImportLabel: "Use as source layer",
    oleLayerSettingsLegendHeader: "Legend",
    oleLayerSettingsOpacityHeader: "Opacity (%)",
    oleMergeFeature: "Merge selected geometry",
    oleMergeFeatureSelectFeature: "Please select at least 2 geometries.",
    oleModifyFeature: "Modify geometry",
    oleNavigation: "Navigation",
    olePixelUnit: "px",
    oleSelectFeature: "Select geometry",
    oleSnappingSettings: "Snapping settings",
    oleSnappingSettingsLayer: "Snapping layer",
    oleSnappingSettingsTolerance: "Snapping tolerance",
    oleSplitFeature: "Split selected geometry",
    oleTransformFeature: "Scale, rotate and move geometry",
    oleCADTools: "CAD Tools",
    oleCADToolsDialogParallelDrawing: "Parallel Drawing",
    oleCADToolsDialogGuidedDrawing: "Guided Drawing",
    oleCADToolsDialogShowLayer: "Show Guide Lines",
    oleCADToolsDialogTolerance: "px tolerance",
    oleDialogCancelButton: "Cancel",
    oleDialogSaveButton: "Save",
    oleDialogOkButton: "Okay"
});
OpenLayers.Lang.hu = OpenLayers.Util.extend(OpenLayers.Lang.hu, {
    oleCleanFeature: "Kijelölt geometria javítása",
    oleDeleteFeature: "Kijelölt geometria törlése",
    oleDeleteAllFeatures: "Az összes geometria törlése",
    oleDownloadFeature: "Geometriák letöltése",
    oleDownloadFeatureEmpty: "Nincs letölthető geometria",
    oleDownloadFeatureFileFormat: "Fájl formátum kiválasztása",
    oleUploadFeature: "Geometriák feltöltése fájlból",
    oleUploadFeatureNoFile: "Nincs meghatározott fájl. Kérem válasszon újra egy fájlt.",
    oleUploadFeatureNone: "Nincsenek vagy csak olvashatatlan geometriák találhatóak a fájlban",
    oleUploadFeatureReplace: "A jelenlegi geometriák cseréje a rétegen",
    oleDragFeature: "Geometria mozgatása",
    oleDrawHole: "Lyuk rajzolása",
    oleDrawPolygon: "Poligon rajzolása",
    oleDrawPath: "Vonal rajzolása",
    oleDrawPoint: "Pont rajzolása",
    oleDrawText: "Szöveges felirat rajzolása",
    oleDrawTextEdit: "Szöveges felirat hozzáadása a dobozhoz, azután Enter-rel zárja be az ablakot",
    oleDrawRegular: "Szabályos poligon rajzolása",
    oleDrawRegularShape: "Alakzat",
    oleDrawRegularIrregular: "Szabálytalan",
    oleDrawRegularSides3: "háromszög",
    oleDrawRegularSides4: "négyzet",
    oleDrawRegularSides5: "ötszög",
    oleDrawRegularSides6: "hatszög",
    oleDrawRegularCircle: "kör",
    oleImportFeature: "Kijelölt geometriák importálása",
    oleImportFeatureSourceLayer: "Nem található forrásréteg.",
    oleImportFeatureSourceFeature: "Kérem, előbb válasszon ki egy geometriát!",
    oleLayerSettingsImportHeader: "Importálás",
    oleLayerSettingsImportLabel: "Használat forrásrétegként",
    oleLayerSettingsLegendHeader: "Jelmagyarázat",
    oleLayerSettingsOpacityHeader: "Átlátszóság (%)",
    oleMergeFeature: "Kijelölt geometriák összevonása",
    oleMergeFeatureSelectFeature: "Kérem, válasszon ki legalább két geometriát!",
    oleModifyFeature: "Geometria módosítása",
    oleNavigation: "Navigáció",
    olePixelUnit: "px",
    oleSelectFeature: "Geometria kiválasztása",
    oleSnappingSettings: "Illesztés beállításai",
    oleSnappingSettingsLayer: "Illesztő réteg",
    oleSnappingSettingsTolerance: "Illesztés toleranciája",
    oleSplitFeature: "Kijelölt geometria szétvágása",
    oleTransformFeature: "Geometria átméretezése, forgatása és mozgatása",
    oleCADTools: "CAD Eszközök",
    oleCADToolsDialogParallelDrawing: "Párhuzamos rajzolás",
    oleCADToolsDialogGuidedDrawing: "Segédvonalas rajzolás",
    oleCADToolsDialogShowLayer: "Segédvonalak megjelenítése",
    oleCADToolsDialogTolerance: "px tolerancia",
    oleDialogCancelButton: "Mégse",
    oleDialogSaveButton: "Mentés",
    oleDialogOkButton: "Ok"
});
OpenLayers.Lang.nl = OpenLayers.Util.extend(OpenLayers.Lang.nl, {
    oleCleanFeature: "Geselecteerde geometrie opschonen",
    oleDeleteFeature: "Geselecteerde geometrie verwijderen",
    oleDeleteAllFeatures: "Alle geometrieën verwijderen",
    oleDownloadFeature: "Download geometrieën",
    oleDownloadFeatureEmpty: "Geen geometrieën om te downloaden",
    oleDownloadFeatureFileFormat: "Selecteer een file formaat",
    oleUploadFeature: "Upload geometrieën vanuit lokaal bestand",
    oleUploadFeatureNoFile: "Geen bestand geselecteerd. Probeer opnieuw en kies een bestand.",
    oleUploadFeatureNone: "Geen of onleesbare geometrieën in bestand",
    oleUploadFeatureReplace: "Vervang huidige geometrieën in laag",
    oleDragFeature: "Geometrie verschuiven",
    oleDrawHole: "Gat knippen in geometrie",
    oleDrawPolygon: "Teken vlak",
    oleDrawPath: "Teken lijn",
    oleDrawPoint: "Teken punt",
    oleDrawText: "Teken tekst label",
    oleDrawTextEdit: "Voer tekst hierboven in,<br>doe dan return of sluit dit venster",
    oleDrawRegular: "Teken regelmatig polygoon",
    oleDrawRegularShape: "Vorm",
    oleDrawRegularIrregular: "Niet gelijkzijdig",
    oleDrawRegularSides3: "driehoek",
    oleDrawRegularSides4: "vierkant",
    oleDrawRegularSides5: "vijfhoek",
    oleDrawRegularSides6: "zeshoek",
    oleDrawRegularCircle: "cirkel",
    oleImportFeature: "Importeer geselecteerde geometrie",
    oleImportFeatureSourceLayer: "Geen bron-laag.",
    oleImportFeatureSourceFeature: "Selecteer eerst een geometrie.",
    oleLayerSettingsImportHeader: "Importeer",
    oleLayerSettingsImportLabel: "Gebruik als bron-laag",
    olelayerSettingsLegendHeader: "Legenda",
    olelayerSettingsOpacityHeader: "Ondoorzichtigheid (%)",
    oleMergeFeature: "Combineer geselecteerde geometrie",
    oleMergeFeatureSelectFeature: "Selecteer tenminste 2 geometrieën.",
    oleModifyFeature: "Geometrie wijzigen",
    oleNavigation: "Navigatie",
    olePixelUnit: "px",
    oleSelectFeature: "Selecteer geometrie",
    oleSnappingSettings: "Uitlijn-instellingen",
    oleSnappingSettingsLayer: "Uitlijnen laag",
    oleSnappingSettingsTolerance: "Uitlijn-tolerantie",
    oleSplitFeature: "Splits geselecteerde geometrie",
    oleTransformFeature: "Geometrie schalen, roteren en verschuiven",
    oleCADTools: "CAD Functies",
    oleCADToolsDialogParallelDrawing: "Parallel tekenen aktiveren",
    oleCADToolsDialogGuidedDrawing: "Geleid tekenen aktiveren",
    oleCADToolsDialogShowLayer: "Toon hulplijnen",
    oleCADToolsDialogTolerance: "px tolerantie",
    oleDialogCancelButton: "Annuleren",
    oleDialogSaveButton: "Bewaren",
    oleDialogOkButton: "Oke"
});