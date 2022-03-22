/**
 * Create Date/Time Picker (for PHPMaker 2022)
 * @license Copyright (c) e.World Technology Limited. All rights reserved.
 */

// Global options
ew.dateTimePickerOptions = {
    keepInvalid: true
};

// Create date/time picker
ew.createDateTimePicker = function(formid, id, options) {
    if (id.includes("$rowindex$"))
        return;
    var $ = jQuery,
        el = ew.getElement(id, formid),
        sv = ew.getElement("sv_" + id, formid), // AutoSuggest
        $input = $(sv || el),
        namespace = tempusDominus.Namespace.NAME,
        dataKey = "datetimepicker";
    if (!el || $input.data(dataKey) || $input.parent().data(dataKey))
        return;
    options = Object.assign({}, ew.dateTimePickerOptions, options);
    var inputGroup = $.isBoolean(options.inputGroup) ? options.inputGroup : true;
    delete(options.inputGroup);
    options.debug = options.debug || ew.DEBUG;
    var args = {"id": id, "form": formid, "enabled": true, "inputGroup": inputGroup, "options": options};
    $(document).trigger("datetimepicker", [args]);
    if (!args.enabled)
        return;
    if (args.inputGroup !== false) {
        // <div class="input-group date" id="{id}" data-td-target-input="nearest" data-td-target-toggle="nearest">
        // 	<input type="text" class="form-control td-input" data-target="#{id}"/>
        // 	<button class="btn btn-default" type="button" data-target="#{id}" data-td-toggle="datetimepicker"><i class="far fa-calendar-alt"></i></button>
        // </div>
        var $textbox = $input,
            isInvalid = $input.hasClass("is-invalid"),
            id = "datetimepicker_" + formid + "_" + $input.attr("id");
            $btn = $('<button class="btn btn-default" type="button"><i class="far fa-calendar-alt"></i></button>')
                .on("click." + dataKey, function() {
                    $textbox.removeClass("is-invalid");
                });
        $input.addClass(namespace + "-input").attr("data-target", "#" + id)
            .wrap(`<div class="input-group${isInvalid ? " is-invalid" : ""}" id="${id}" data-target-input="nearest" data-td-target-toggle="nearest"></div>`)
            .after($btn.attr("data-target", "#" + id).attr(`data-td-toggle`, dataKey))
            .on("focus." + dataKey, function() {
                $textbox.tooltip("hide").tooltip("disable");
            }).on("blur." + dataKey, function() {
                $textbox.tooltip("enable");
            });
        $input = $input.parent().on("change." + dataKey, function(e) {
            if (e.date)
                $textbox.trigger("change");
        });
    } else {
        // <input type="text" class="form-control td-input" id="{id}" data-td-toggle="datetimepicker" data-target="#{id}"/>
        $input.addClass(dataKey + "-input").attr(`data-td-toggle`, dataKey).attr("data-target", "#" + $input.attr("id"))
            .on("change." + dataKey, function(e) {
                if (e.date && $input[0] !== el)
                    $(el).val($input.val()).trigger("change");
            }).on("focus." + dataKey, function() {
                $input.tooltip("hide").tooltip("disable");
            }).on("blur." + dataKey, function() {
                $input.tooltip("enable");
            });
    }
    $input.tempusDominus(args.options);
}
