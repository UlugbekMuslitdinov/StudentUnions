/*!
 * JavaScript for PHPMaker v2022.0.0
 * Copyright (c) e.World Technology Limited. All rights reserved.
 */
(function (ew$1, $$1, luxon) {
  'use strict';

  function _interopDefaultLegacy (e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }

  var ew__default = /*#__PURE__*/_interopDefaultLegacy(ew$1);
  var $__default = /*#__PURE__*/_interopDefaultLegacy($$1);
  var luxon__default = /*#__PURE__*/_interopDefaultLegacy(luxon);

  function MultiPage(formid) {
    var self = this;
    this.$form = null;
    this.formID = formid;
    this.pageIndex = 1;
    this.maxPageIndex = 0;
    this.minPageIndex = 0;
    this.pageIndexes = [];
    this.$pages = null;
    this.$collapses = null;
    this.isTab = false; // Is tabs

    this.isCollapse = false; // Is collapses (accordion)

    this.lastPageSubmit = false; // Enable submit button for the last page only

    this.hideDisabledButton = false; // Hide disabled submit button

    this.hideInactivePages = false; // Hide inactive pages

    this.lockTabs = false; // Set inactive tabs as disabled

    this.hideTabs = false; // Hide all tabs

    this.showPagerTop = false; // Show pager at top

    this.showPagerBottom = false; // Show pager at bottom

    this.pagerTemplate = '<nav><ul class="pagination"><li class="page-item previous ew-prev"><a href="#" class="page-link"><span class="icon-prev"></span> {Prev}</a></li><li class="page-item next ew-next"><a href="#" class="page-link">{Next} <span class="icon-next"></span></a></li></ul></nav>'; // Pager template
    // "show" handler (for disabled tabs)

    var _show = function (e) {
      e.preventDefault();
    }; // Set properties

    var _properties = ["lastPageSubmit", "hideDisabledButton", "hideInactivePages", "lockTabs", "hideTabs", "showPagerTop", "showPagerBottom", "pagerTemplate"];

    this.set = function () {
      if (arguments.length == 1 && $__default['default'].isObject(arguments[0])) {
        var obj = arguments[0];

        for (var i in obj) {
          var p = i[0].toLowerCase() + i.substr(1); // Camel case

          if (_properties.includes(p)) this[p] = obj[i];
        }
      }
    }; // DOM loaded

    this.init = function () {
      var tpl = this.pagerTemplate.replace(/\{prev\}/i, ew.language.phrase("Prev")).replace(/\{next\}/i, ew.language.phrase("Next"));

      if (this.isTab) {
        if (this.showPagerTop) this.$pages.closest(".ew-nav").before(tpl);
        if (this.showPagerBottom) this.$pages.closest(".ew-nav").after(tpl);
        this.$form.find(".ew-prev").click(function (e) {
          self.$pages.off("show.bs.tab", _show).filter(".active").parent().prev(":has([data-bs-toggle=tab]:not(.ew-hidden):not(.ew-disabled))").find("[data-bs-toggle=tab]").toggleClass("disabled d-none", false).click();
          return false;
        });
        this.$form.find(".ew-next").click(function (e) {
          self.$pages.off("show.bs.tab", _show).filter(".active").parent().next(":has([data-bs-toggle=tab]:not(.ew-hidden):not(.ew-disabled))").find("[data-bs-toggle=tab]").toggleClass("disabled d-none", false).click();
          return false;
        });
        if (this.hideTabs) this.$form.find(".ew-multi-page > .ew-nav > .nav-tabs").hide();
      } else if (this.isCollapse) {
        if (this.showPagerTop) this.$collapses.closest(".ew-accordion").before(tpl);
        if (this.showPagerBottom) this.$collapses.closest(".ew-accordion").after(tpl);
        this.$form.find(".ew-prev").click(function (e) {
          self.$pages.closest(".card").filter(":has(.collapse.show)").prev(":has([data-bs-toggle=collapse]:not(.ew-hidden):not(.ew-disabled))").toggleClass("disabled d-none", false).find("[data-bs-toggle=collapse]").click();
          return false;
        });
        this.$form.find(".ew-next").click(function (e) {
          self.$pages.closest(".card").filter(":has(.collapse.show)").next(":has([data-bs-toggle=collapse]:not(.ew-hidden):not(.ew-disabled))").toggleClass("disabled d-none", false).find("[data-bs-toggle=collapse]").click();
          return false;
        });
      }

      this.pageShow();
    }; // Page show

    this.pageShow = function () {
      if (this.isTab) {
        if (this.lockTabs) this.$pages.on("show.bs.tab", _show);
        this.$pages.each(function () {
          var $this = $__default['default'](this);
          if (self.hideInactivePages) $this.toggleClass("d-none", !$this.hasClass("active"));
          if (self.lockTabs) $this.toggleClass("disabled", !$this.hasClass("active"));
        });
      } else if (this.isCollapse) {
        this.$pages.closest(".card").each(function () {
          var $this = $__default['default'](this);
          if (self.hideInactivePages) $this.toggleClass("d-none", !$this.find(".collapse.show")[0]);
        });
      }

      var disabled = this.lastPageSubmit && this.pageIndex != this.maxPageIndex;
      var $btn = this.$form.closest(".content, .modal-content").find("#btn-action, button.ew-submit").prop("disabled", disabled).toggle(!this.hideDisabledButton || !disabled);
      $__default['default'](".ew-captcha").toggle($btn.is(":visible:not(:disabled)")); // Re-captcha uses class "disabled", not "disabled" property.

      disabled = this.pageIndex <= this.minPageIndex;
      this.$form.find(".ew-prev").toggleClass("disabled", disabled);
      disabled = this.pageIndex >= this.maxPageIndex;
      this.$form.find(".ew-next").toggleClass("disabled", disabled);
    }; // Go to page by index

    this.gotoPage = function (i) {
      if (i <= 0 || i < this.minPageIndex || i > this.maxPageIndex) return;

      if (this.pageIndex != i) {
        var $page = this.$pages.eq(i - 1);

        if (this.isTab) {
          if ($page.is(":not(.d-none):not(.disabled)")) $page.click();else $page.parent().next(":has([data-bs-toggle=tab]):not(.d-none):not(.disabled)").find("[data-bs-toggle=tab]").toggleClass("disabled", false).click();
        } else if (this.isCollapse) {
          var $p = $page.closest(".card");
          if ($p.is(":not(.d-none)")) $page.click();else $p.next(":has([data-bs-toggle=collapse]):not(.d-none)").find("[data-bs-toggle=collapse]").click();
        }

        this.pageIndex = i;
      }
    };

    this.gotoPageByIndex = this.gotoPage; // Go to page by element

    this.gotoPageByElement = function (el) {
      this.gotoPage(parseInt($__default['default'](el).data("page"), 10) || -1);
    }; // Go to page by element's id or name or data-field attribute

    this.gotoPageByElementId = function (id) {
      var $el = this.$form.find("[data-page]").filter("[id='" + id + "'],[name='" + id + "'],[data-field='" + id + "']");
      this.gotoPageByElement($el);
    }; // Toggle page

    this.togglePage = function (i, show) {
      if (this.isTab) {
        this.$pages.eq(i - 1).toggleClass("d-none", !show);
      } else if (this.isCollapse) {
        this.$pages.eq(i - 1).closest(".card").toggle("d-none", !show);
      }
    }; // Render

    this.render = function () {
      this.$form = $__default['default']("#" + formid);
      this.pageIndexes = this.$form.find("[data-page]").map(function () {
        var index = parseInt(this.dataset.page, 10);
        return index > 0 ? index : null;
      }).get();
      this.pageIndexes.sort(function (a, b) {
        return a - b;
      });
      this.minPageIndex = this.pageIndexes[0];
      this.maxPageIndex = this.pageIndexes[this.pageIndexes.length - 1];
      var $tabs = this.$form.find("[data-bs-toggle=tab]");

      if ($tabs[0]) {
        this.$pages = $tabs;
        this.isTab = true;
        $tabs.on("shown.bs.tab", function (e) {
          self.pageIndex = $tabs.index(e.target) + 1;
          self.pageShow();
          $__default['default']($__default['default'](this).attr("href")).find(".ew-map").each(function () {
            var m = ew.maps[this.id];

            if (m != null && m["map"]) {
              google.maps.event.trigger(m["map"], "resize");
              m["map"].setCenter(m["latlng"]);
            }
          });
        });
        this.pageIndex = $tabs.index($tabs.parent(".active")) + 1;
      } else {
        this.$collapses = this.$form.find("[data-bs-toggle=collapse]");

        if (this.$collapses[0]) {
          this.$pages = this.$collapses;
          this.isCollapse = true;
          var $bodies = this.$collapses.closest(".card-header").next();
          $bodies.on("shown.bs.collapse", function (e) {
            self.pageIndex = $bodies.index(e.target) + 1;
            self.pageShow();
            $__default['default'](this).find(".ew-map").each(function () {
              var m = ew.maps[this.id];

              if (m != null && m["map"]) {
                google.maps.event.trigger(m["map"], "resize");
                m["map"].setCenter(m["latlng"]);
              }
            });
          });
          this.pageIndex = $bodies.index($bodies.hasClass("show")) + 1;
        }
      }

      $__default['default'](function () {
        self.init();
      });
    };
  }

  /**
   * User level ID validator
   */

  function userLevelId(el) {
    if (el && !ew.checkInteger(el.value)) return {
      userLevelId: ew.language.phrase("UserLevelIDInteger")
    };
    var level = parseInt(el.value, 10);
    if (level < 1) return {
      userLevelId: ew.language.phrase("UserLevelIDIncorrect")
    };
    return false;
  }
  /**
   * User level name validator
   * @param {string} id User ID Field input element ID
   */

  function userLevelName(id) {
    return function (el) {
      let elId = document.getElementById("x_" + id);

      if (elId && el) {
        let name = el.value.trim(),
            level = parseInt(elId.value.trim(), 10);

        if (level === 0 && !ew.sameText(name, "Default")) {
          return {
            userLevelName: ew.language.phrase("UserLevelDefaultName")
          };
        } else if (level === -1 && !ew.sameText(name, "Administrator")) {
          return {
            userLevelName: ew.language.phrase("UserLevelAdministratorName")
          };
        } else if (level === -2 && !ew.sameText(name, "Anonymous")) {
          return {
            userLevelName: ew.language.phrase("UserLevelAnonymousName")
          };
        } else if (level > 0 && ["anonymous", "administrator", "default"].includes(name.toLowerCase())) {
          return {
            userLevelName: ew.language.phrase("UserLevelNameIncorrect")
          };
        }
      }

      return false;
    };
  }
  /**
   * Required validator
   */

  function required(fieldName) {
    return function (el) {
      var _$el$data;

      let $el = $__default['default'](el),
          $p = $el.closest("#r_" + ((_$el$data = $el.data("field")) == null ? void 0 : _$el$data.substr(2))); // Find the row

      if (!$p[0]) $p = $el.closest("[id^=el]"); // Find the span

      if ($p.css("display") == "none") {
        // Hidden by .visible()
        return false;
      }

      if (el && !ew.hasValue(el)) {
        return {
          required: ew.language.phrase("EnterRequiredField").replace("%s", fieldName)
        };
      }

      return false;
    };
  }
  /**
   * File required validator
   */

  function fileRequired(fieldName) {
    return function (el) {
      let elFn = document.getElementById("fn_" + el.id);

      if (elFn && !ew.hasValue(elFn)) {
        return {
          fileRequired: ew.language.phrase("EnterRequiredField").replace("%s", fieldName)
        };
      }

      return false;
    };
  }
  /**
   * Mismatch password validator
   */

  function mismatchPassword(el) {
    let id;
    if (el.id.startsWith("c_")) // Confirm Password field in Register page
      id = el.id.replace(/^c_/, "x_");else if (el.id == "cpwd") // Change Password page
      id = "npwd";
    let elPwd = document.getElementById(id);

    if (el.value !== elPwd.value) {
      return {
        mismatchPassword: ew.language.phrase("MismatchPassword")
      };
    }

    return false;
  }
  /**
   * Between validator
   */

  function between(el) {
    let x, z;

    if (el.id.startsWith("y_")) {
      x = document.getElementById(el.id.replace(/^y_/, "x_"));
      z = document.getElementById(el.id.replace(/^y_/, "z_"));
    }

    if (ew.hasValue(x) && $__default['default'](z).val() == "BETWEEN" && !ew.hasValue(el)) {
      return {
        between: ew.language.phrase("EnterValue2")
      };
    }

    return false;
  }
  /**
   * Password strength validator
   */

  function passwordStrength(el) {
    let $el = $__default['default'](el);

    if (!ew.isMaskedPassword(el) && $el.hasClass("ew-password-strength") && !$el.data("validated")) {
      return {
        passwordStrength: ew.language.phrase("PasswordTooSimple")
      };
    }

    return false;
  }
  /**
   * User name validator
   */

  function username(raw) {
    return function (el) {
      if (!raw && el.value.match(new RegExp('[' + ew.escapeRegExChars(ew.INVALID_USERNAME_CHARACTERS) + ']'))) return {
        username: ew.language.phrase("InvalidUsernameChars")
      };
      return false;
    };
  }
  /**
   * Password validator
   */

  function password(raw) {
    return function (el) {
      if (!raw && !ew.ENCRYPTED_PASSWORD && el.value.match(new RegExp('[' + ew.escapeRegExChars(ew.INVALID_PASSWORD_CHARACTERS) + ']'))) return {
        password: ew.language.phrase("InvalidPasswordChars")
      };
      return false;
    };
  }
  /**
   * Email validator
   */

  function email(el) {
    let value = ew.getValue(el);

    if (!ew.checkEmail(value)) {
      return {
        email: ew.language.phrase("IncorrectEmail")
      };
    }

    return false;
  }
  /**
   * Emails validator
   */

  function emails(cnt, err) {
    return function (el) {
      let value = ew.getValue(el);

      if (!ew.checkEmails(value, cnt)) {
        return {
          email: err
        };
      }

      return false;
    };
  }
  /**
   * DateTime validator
   * @param {string} format DateTime format
   */

  function datetime(format) {
    return function (el) {
      let value = ew.getValue(el);

      if (!ew.checkDate(value, format)) {
        return {
          datetime: ew.language.phrase("IncorrectDate").replace(/%s/g, format)
        };
      }

      return false;
    };
  }
  /**
   * Time validator
   * @param {string} format Time format
   */

  function time(format) {
    return function (el) {
      let value = ew.getValue(el);

      if (!ew.checkTime(value, format)) {
        return {
          time: ew.language.phrase("IncorrectTime").replace(/%s/g, format)
        };
      }

      return false;
    };
  }
  /**
   * Float validator
   */

  function float(el) {
    let value = ew.getValue(el);

    if (!ew.checkNumber(value)) {
      return {
        time: ew.language.phrase("IncorrectFloat")
      };
    }

    return false;
  }
  /**
   * Range validator
   * @param {number} min Min value
   * @param {number} max Max value
   */

  function range(min, max) {
    return function (el) {
      let value = ew.getValue(el);

      if (!ew.checkRange(value, min, max)) {
        return {
          range: ew.language.phrase("IncorrectRange").replace("%1", min).replace("%2", max)
        };
      }

      return false;
    };
  }
  /**
   * Integer validator
   */

  function integer(el) {
    let value = ew.getValue(el);

    if (!ew.checkInteger(value)) {
      return {
        integer: ew.language.phrase("IncorrectInteger")
      };
    }

    return false;
  }
  /**
   * US phone validator
   */

  function phone(el) {
    let value = ew.getValue(el);

    if (!ew.checkPhone(value)) {
      return {
        phone: ew.language.phrase("IncorrectPhone")
      };
    }

    return false;
  }
  /**
   * US ZIP validator
   */

  function zip(el) {
    let value = ew.getValue(el);

    if (!ew.checkZip(value)) {
      return {
        zip: ew.language.phrase("IncorrectZip")
      };
    }

    return false;
  }
  /**
   * Credit card validator
   */

  function creditCard(el) {
    let value = ew.getValue(el);

    if (!ew.checkCreditCard(value)) {
      return {
        creditCard: ew.language.phrase("IncorrectCreditCard")
      };
    }

    return false;
  }
  /**
   * US SSN validator
   */

  function ssn(el) {
    let value = ew.getValue(el);

    if (!ew.checkSsn(value)) {
      return {
        ssn: ew.language.phrase("IncorrectSSN")
      };
    }

    return false;
  }
  /**
   * GUID validator
   */

  function guid(el) {
    let value = ew.getValue(el);

    if (!ew.checkGuid(value)) {
      return {
        guid: ew.language.phrase("IncorrectGUID")
      };
    }

    return false;
  }
  /**
   * Regular expression validator
   * @param {string} pattern Regular expression pattern
   */

  function regex(pattern) {
    return function (el) {
      let value = ew.getValue(el);

      if (!ew.checkByRegEx(value, pattern)) {
        return {
          regex: ew.language.phrase("IncorrectField")
        };
      }

      return false;
    };
  }
  /**
   * URL validator
   */

  function url(el) {
    let value = ew.getValue(el);

    if (!ew.checkUrl(value)) {
      return {
        url: ew.language.phrase("IncorrectUrl")
      };
    }

    return false;
  }
  /**
    * Custom validator
    * @param {*} fn Function(value, ...args)
    * @param  {...any} args Additional arguments for the function
    */

  function custom(fn, ...args) {
    return function (el) {
      if (typeof fn == "function") {
        let value = ew.getValue(el);
        if (fn(value, ...args)) return {
          custom: ew.language.phrase("IncorrectField")
        };
      }

      return false;
    };
  }
  /**
   * Captcha validator
   */

  function captcha(el) {
    if (el && !ew.hasValue(el)) {
      return {
        captcha: ew.language.phrase("EnterValidateCode")
      };
    }

    return false;
  }
  /**
   * reCaptcha validator
   * @param {number} id reCaptcha ID
   */

  function recaptcha(el) {
    var _grecaptcha;

    if (el && !ew.hasValue(el) && ((_grecaptcha = grecaptcha) == null ? void 0 : _grecaptcha.getResponse(el.dataset.id)) === "") {
      return {
        recaptcha: ew.language.phrase("ClickReCaptcha")
      };
    }

    return false;
  }

  var Validators = {
    __proto__: null,
    userLevelId: userLevelId,
    userLevelName: userLevelName,
    required: required,
    fileRequired: fileRequired,
    mismatchPassword: mismatchPassword,
    between: between,
    passwordStrength: passwordStrength,
    username: username,
    password: password,
    email: email,
    emails: emails,
    datetime: datetime,
    time: time,
    float: float,
    range: range,
    integer: integer,
    phone: phone,
    zip: zip,
    creditCard: creditCard,
    ssn: ssn,
    guid: guid,
    regex: regex,
    url: url,
    custom: custom,
    captcha: captcha,
    recaptcha: recaptcha
  };

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  function _assertThisInitialized(self) {
    if (self === void 0) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }

    return self;
  }

  function _setPrototypeOf(o, p) {
    _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
      o.__proto__ = p;
      return o;
    };

    return _setPrototypeOf(o, p);
  }

  function _inheritsLoose(subClass, superClass) {
    subClass.prototype = Object.create(superClass.prototype);
    subClass.prototype.constructor = subClass;
    _setPrototypeOf(subClass, superClass);
  }

  function _defineProperty(obj, key, value) {
    if (key in obj) {
      Object.defineProperty(obj, key, {
        value: value,
        enumerable: true,
        configurable: true,
        writable: true
      });
    } else {
      obj[key] = value;
    }

    return obj;
  }

  /*
   * Based on: jquery.batch v0.1.0
   * Copyright 2013, Matt Morgan (@mlmorg)
   * MIT license
   */
  // Global batch settings

  $__default['default'].batchSettings = {
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    dataType: 'json',
    toJSON: JSON.stringify,
    parse: data => data
  }; // Setup method

  $__default['default'].batchSetup = function (options) {
    return $__default['default'].extend($__default['default'].batchSettings, options);
  }; // $.batch class
  // -------------

  var Batch = $__default['default'].batch = function (func, options) {
    // Always instantiate a Batch class even if called without "new"
    if (!(this instanceof Batch)) {
      return new Batch(func, options);
    } // Shift arguments if func is an object

    if (typeof func === 'object') {
      options = func;
      func = undefined;
    } // Default options

    this.options = $__default['default'].extend({}, $__default['default'].batchSettings, options); // Find a parent batch object, if we're nested

    this.parent = $__default['default'].ajaxSetup()._batch; // Requests storage

    this.requests = []; // Add any requests

    if (func) {
      this.add(func);
    }

    return this;
  }; // Our methods

  $__default['default'].extend(Batch.prototype, {
    // Method for adding requests to the batch
    add: function (func) {
      var _func$name;

      // Set global _batch variable in jQuery.ajaxSettings
      $__default['default'].ajaxSetup({
        _batch: this.parent || this
      }); // Call the user's function

      if ((_func$name = func.name) != null && _func$name.startsWith('bound ')) {
        // Bound function
        func();
      } else {
        func.call($__default['default'].ajaxSetup()._batch);
      } // Remove the global _batch variable when we're not nested

      if (!this.parent) {
        $__default['default'].ajaxSetup({
          _batch: null
        });
      }

      return this;
    },
    // Clear requests storage
    clear: function () {
      this.requests = [];
    },
    // Method for running the batch request
    send: function (options) {
      options = options || {};
      var instance = this; // When we're handling a child batch object, wrap any success functions
      // and add them to the parent batch success

      if (this.parent && options.success) {
        var parentSuccess = this.parent.options.success;

        this.parent.options.success = function (data, status, xhr) {
          options.success(data, status, xhr);

          if (parentSuccess) {
            parentSuccess(data, status, xhr);
          }
        };
      } // When we're handling the top-most batch, send the request
      else if (this.requests.length) {
        // Map an array of requests
        var requests = $__default['default'].map(this.requests, function (request) {
          return request.settings.data;
        }); // Override the success callback

        var success = options.success;
        var childSuccess = this.options.success;

        options.success = function (data, statusText, xhr) {
          // Call our _deliver method to handle each individual batch request response
          instance._deliver.call(instance, data, statusText); // Child batch success functions

          if (childSuccess) {
            childSuccess(data, statusText, xhr);
          } // User's success function

          if (success) {
            success(data, statusText, xhr);
          }
        }; // Build the Ajax request options

        options = $__default['default'].extend({}, this.options, options); // Create hash of requests to pass as the data in the Ajax request

        if (!options.data) {
          options.data = $__default['default'].batchSettings.toJSON(requests);
        } // Call the request

        return $__default['default'].ajax(options);
      }
    },
    // Private method to add a request to the batch requests array
    _addRequest: function (xhr, settings) {
      this.requests.push({
        xhr: xhr,
        settings: settings
      });
    },
    // Delivers each batch request response to its intended xhr success/complete function
    _deliver: function (data, statusText) {
      var _responses$error;

      var instance = this; // Pass the response off to the user to parse out the responses

      var responses = $__default['default'].batchSettings.parse(data);

      if (responses != null && (_responses$error = responses.error) != null && _responses$error.description) {
        var _responses$error2;

        ew__default['default'].alert(responses == null ? void 0 : (_responses$error2 = responses.error) == null ? void 0 : _responses$error2.description);
        return;
      } // Loop through the responses

      $__default['default'].each(responses, function (i, response) {
        var _request$settings$com;

        // Only work with batch requests that we have stored
        if (!instance.requests[i]) {
          return;
        } // Grab the stored request data

        var request = instance.requests[i]; // Build statusText a la jQuery based on status code

        request.xhr.statusText = statusText; // Call the user/success function, if it exists. Pass the response body, status text and xhr.

        if (statusText === 'success') {
          var _request$settings$suc;

          (_request$settings$suc = request.settings.success) == null ? void 0 : _request$settings$suc.call(request.xhr, response, statusText);
        } // Call complete

        (_request$settings$com = request.settings.complete) == null ? void 0 : _request$settings$com.call(request.xhr, statusText);
      });
    }
  });
  // ---------------
  // Override jQuery.ajax to cancel any outgoing requests called within
  // a $.batch() function and add them to the batch requests array for
  // that batch instance

  var $ajax = $__default['default'].ajax;

  $__default['default'].ajax = function (url, options) {
    // Shift arguments when options are passed as first argument
    if (typeof url === 'object') {
      options = url;
      url = undefined;
    } // Set options object

    options = options || {}; // Override the jQuery beforeSend method

    var beforeSend = options.beforeSend;

    options.beforeSend = function (xhr, settings) {
      // Call the user's beforeSend function, if passed
      if (beforeSend) {
        var before = beforeSend(xhr, settings); // Cancel request if user's beforeSend function returns false

        if (before === false) {
          return before;
        }
      } // We're only worried about requests made within a $.batch function
      // (aka they have a _batch object)

      if (settings._batch) {
        // Add request to batch
        settings._batch._addRequest(xhr, settings); // Cancel this request

        return false;
      }
    }; // Run original $.ajax method for all other requests

    return $ajax.call(this, url, options);
  };

  function FormBase(id, pageId) {
    var self = this,
        $self = $__default['default'](self);
    this._initiated = false;
    this.id = id; // Same ID as the form

    this.element = document.getElementById(id); // HTML form or div

    this.$element = $__default['default'](this.element); // jQuery object of the form or div

    this.pageId = pageId;
    this.htmlForm = null; // HTML form element

    this.initSearchPanel = false; // Expanded by default

    this.modified = false;
    this.emptyRow = null; // Check empty row

    this.multiPage = null; // Multi-page

    this.autoSuggests = {}; // AutoSuggests

    this.lists = {}; // Dynamic selection lists

    this.batch = new Batch(); // For batch lookup

    this.formKeyCountName = ""; // For list/grid pages
    // Disable form

    this.disableForm = function () {
      var form = this.getForm();
      $__default['default'](form).find(":submit:not(.dropdown-toggle)").prop("disabled", true).addClass("disabled");
      this.trigger("disabled");
    }; // Enable form

    this.enableForm = function () {
      var form = this.getForm(),
          $form = $__default['default'](form);
      $form.find(".ew-disabled-element").removeClass("ew-disabled-element").prop("disabled", false);
      $form.find(".ew-enabled-element").removeClass("ew-enabled-element").prop("disabled", true);
      $form.find(":submit:not(.dropdown-toggle)").prop("disabled", false).removeClass("disabled");
      this.trigger("enabled");
    }; // Append hidden element with form name

    this.appendHidden = function (el) {
      var form = this.getForm(),
          $form = $__default['default'](form),
          $dp = $__default['default'](el).closest(".ew-form"),
          name = $dp.attr("id") + "$" + el.name;
      if ($form.find("input:hidden[name='" + name + "']")[0]) // Already appended
        return;
      var ar = $dp.find('[name="' + el.name + '"]').serializeArray();

      if (ar.length) {
        ar.forEach(function (o, i) {
          $__default['default']('<input type="hidden" name="' + name + '">').val(o.value).appendTo($form);
        });
      } else {
        $__default['default']('<input type="hidden" name="' + name + '">').val("").appendTo($form);
      }
    }; // Can submit

    this.canSubmit = async function () {
      var form = this.getForm(),
          $form = $__default['default'](form);
      this.disableForm();
      this.updateTextArea();

      if (!this.validate || this.validate() && !$form.find(".is-invalid")[0]) {
        $form.find("input[name^=sv_], input[name^=p_], .ew-template input, .ew-custom-option") // Do not submit these values
        .prop("disabled", true).addClass("ew-disabled-element");
        $form.find("[data-readonly=1][disabled]").prop("disabled", false).addClass("ew-enabled-element"); // Submit readonly values

        var $dps = $form.find("input[name=detailpage]").map(function (i, el) {
          return $form.find("#" + el.value)[0];
        });

        if ($dps.length > 1) {
          // Multiple Master/Detail, check element names
          $dps.each(function (i, dp) {
            $__default['default'](dp).find(":input").each(function (j, el) {
              if (/^(fn_)?(x|o)\d*_/.test(el.name)) {
                var $els = $dps.not(dp).find(":input[name='" + el.name + "']");

                if ($els.length) {
                  // Elements with same name found
                  self.appendHidden(el); // Append element with form name

                  $els.each(function () {
                    self.appendHidden(this); // Append elements with same name and form name
                  });
                }
              }
            });
          });
        }

        let args = {
          f: this,
          form: form,
          result: true
        },
            e = $__default['default'].Event("beforesubmit");
        $form.trigger(e, [args]);
        let result = await args.result; // Support Promise<boolean|Object>

        if (!e.isDefaultPrevented() && (result === true || $__default['default'].isObject(result) && result.value)) // Support Swal.fire()
          return true;
      } else {
        this.enableForm();
      }

      return false;
    }; // Submit

    this.submit = async function () {
      var form = this.getForm();

      if (await this.canSubmit()) {
        form.submit();
      } else {
        this.enableForm();
      }
    }; // Get dynamic selection list by element name or id

    this.getList = function (name) {
      name = name.replace(/^(sv_)?[xy](\d*|\$rowindex\$)_|\[\]$/g, ""); // Remove element name prefix/suffix

      return this.lists[name];
    }; // Compile templates

    this.compileTemplates = function () {
      let lists = Object.values(this.lists);

      for (let list of lists) {
        if (list.template && $__default['default'].isString(list.template)) list.template = $__default['default'].templates(list.template);
      }
    }; // Get the HTML form element

    this.getForm = function () {
      if (!this.htmlForm) {
        var _this$element, _this$element2;

        if (((_this$element = this.element) == null ? void 0 : _this$element.tagName) == "FORM") {
          // HTML form
          this.htmlForm = this.element;
        } else if (((_this$element2 = this.element) == null ? void 0 : _this$element2.tagName) == "DIV") {
          // HTML div => Grid page
          this.htmlForm = this.element.closest("form");
        }
      }

      return this.htmlForm;
    }; // Get form element as single element

    this.getElement = function (name) {
      return name ? ew.getElement(name, this.$element) : this.$element[0];
    }; // Get form element(s) as single element or array of radio/checkbox

    this.getElements = function (name) {
      var selector = "[name='" + name + "']";
      selector = "input" + selector + ",selection-list" + selector + ",select" + selector + ",textarea" + selector + ",button" + selector;
      var $els = this.$element.find(selector);
      return $els.length == 0 ? null : $els.length == 1 && $els.is(":not([type=checkbox]):not([type=radio])") ? $els[0] : $els.get();
    };
    /**
     * Update selection lists
     * @param {(null|undefined|number)*} rowindex - Row index
     * @param {bool} [immediate] - Send request immediately
     * @returns
     */

    this.updateLists = function (rowindex, immediate) {
      var _form$querySelector;

      if (rowindex === null) // rowindex == $rowindex$ == null
        return;
      if (this.pageId == "grid" && !$__default['default'].isNumber(rowindex) && !$__default['default'].isUndefined(rowindex)) return;
      var form = this.getForm(); // Set up $element and htmlForm

      if ((form == null ? void 0 : (_form$querySelector = form.querySelector("input#confirm")) == null ? void 0 : _form$querySelector.value) == "confirm") // Confirm page
        return;

      var fixId = (id, multiple) => {
        var t = "",
            i = rowindex,
            ar = id.split(" ");

        if (ar.length > 1) {
          t = ar[0];
          i = "";
          id = ar[1];
        }

        let prefix = $__default['default'].isNumber(i) ? "x" + i + "_" : "x_"; // Add row index

        if (id.startsWith("x_")) // Field element name
          id = id.replace(/^x_/, prefix);else // Field var
          id = prefix + id;
        if (multiple && !id.endsWith("[]")) // Add [] if select-multiple
          id += "[]";
        return t ? t + " " + id : id;
      };

      var selector = Object.entries(this.lists).map(([id, list]) => {
        return "[name='" + fixId(id, list.multiple) + "']";
      }).join();

      if (selector && form.querySelector(selector)) {
        // Lists found
        this.compileTemplates(); // For grid where updateList() called before init()

        var requests = [];

        for (let [id, list] of Object.entries(this.lists)) {
          let parents = list.parentFields.slice().map(parent => fixId(parent)),
              // Clone and fix index
          ajax = list.ajax && !list.lookupOptions.length; // Has link table and no lookup cache

          id = fixId(id, list.multiple);

          if (ajax) {
            // Ajax (async)
            let pvalues = parents.map(parent => ew.getOptionValues(parent, form));
            requests.push([id, pvalues, ajax, false]);
          } else {
            // Non-Ajax (lookup cache or user values)
            ew.updateOptions.call(this, id, parents, false, false);
          }
        }

        requests.forEach(request => this.batch.add(ew.updateOptions.bind(this, ...request)));
      } // Update the Ajax lists

      if (this.batch.requests.length) {
        var _this$batch$send;

        if (rowindex === undefined || immediate) // Called by form or update immediately (add blank row)
          (_this$batch$send = this.batch.send({
            url: ew.getApiUrl(ew.API_LOOKUP_ACTION)
          })) == null ? void 0 : _this$batch$send.then(() => $__default['default'](document).trigger("updatedone", [{
            source: self,
            target: form
          }])).fail(error => console.log(error)).always(() => this.batch.clear());
      } else {
        $__default['default'](document).trigger("updatedone", [{
          source: self,
          target: form
        }]);
      }
    }; // Create AutoSuggest

    this.createAutoSuggest = function (settings) {
      var options = Object.assign({
        limit: ew.AUTO_SUGGEST_MAX_ENTRIES,
        form: this
      }, ew.autoSuggestSettings, settings); // Global settings + field specific settings

      self.autoSuggests[settings.id] = new ew.AutoSuggest(options);
    }; // Init editors

    this.initEditors = function () {
      var form = this.getForm();
      $__default['default'](form.elements).filter("textarea.editor").each(function (i, el) {
        var ed = $__default['default'](el).data("editor");
        if (ed && !ed.active && !ed.name.includes("$rowindex$")) ed.create();
      });
    }; // Update textareas

    this.updateTextArea = function (name) {
      var form = this.getForm();
      $__default['default'](form.elements).filter("textarea.editor").each(function (i, el) {
        var ed = $__default['default'](el).data("editor");
        if (!ed || name && ed.name != name) return true; // Continue

        ed.save();
        if (name) return false; // Break
      });
    }; // Destroy editor(s)

    this.destroyEditor = function (name) {
      var form = this.getForm();
      $__default['default'](form.elements).filter("textarea.editor").each(function (i, el) {
        var ed = $__default['default'](el).data("editor");
        if (!ed || name && ed.name != name) return true; // Continue

        ed.destroy();
        if (name) return false; // Break
      });
    }; // Show error message

    this.onError = function (el, msg) {
      return ew.onError(this, el, msg);
    }; // Init file upload

    this.initUpload = function () {
      var form = this.getForm();
      $__default['default'](form.elements).filter("input:file:not([name*='$rowindex$'])").each(function (index) {
        $__default['default'].later(ew.AJAX_DELAY * index, null, ew.upload, this); // Delay a little in case of large number of upload fields
      });
    }; // Set up filters

    this.setupFilters = function (e, filters) {
      var id = this.id,
          data = this.filterList ? this.filterList.data : null,
          $sf = $__default['default'](".ew-save-filter[data-form=" + id + "]").toggleClass("disabled", !data),
          $df = $__default['default'](".ew-delete-filter[data-form=" + id + "]").toggleClass("disabled", !filters.length).toggleClass("dropdown-toggle", !!filters.length),
          $delete = $df.parent("li").toggleClass("dropdown-submenu dropdown-hover", !!filters.length).toggleClass("disabled", !filters.length),
          $save = $sf.parent("li").toggleClass("disabled", !data);

      var saveFilters = function (id, filters) {
        if (ew.SEARCH_FILTER_OPTION == "Client") {
          localStorage.setItem(ew.PROJECT_NAME + "_" + id + "_filters", JSON.stringify(filters));
        } else if (ew.SEARCH_FILTER_OPTION == "Server") {
          var $body = $__default['default']("body").css("cursor", "wait");
          $__default['default'].ajax(ew.currentPage(), {
            type: "POST",
            dataType: "json",
            data: {
              "ajax": "savefilters",
              "filters": JSON.stringify(filters)
            }
          }).done(function (result) {
            if (result[0] && result[0].success) self.filterList.filters = filters; // Save filters
          }).always(function () {
            $body.css("cursor", "default");
          });
        }
      };

      $save.off("click.ew").on("click.ew", function (e) {
        // Save filter
        if ($save.hasClass("disabled")) return false;
        ew.prompt({
          input: "text",
          html: ew.language.phrase("EnterFilterName")
        }, name => {
          name = ew.sanitize(name);

          if (name) {
            filters.push([name, data]);
            saveFilters(id, filters);
          }
        }, true);
      }).prevAll().remove();
      $df.next("ul.dropdown-menu").remove();

      if (filters.length) {
        var $submenu = $__default['default']("<ul class='dropdown-menu'></ul>");

        for (var i in filters) {
          if (!Array.isArray(filters[i])) continue;
          $__default['default']('<li><a class="dropdown-item" data-index="' + i + '" data-ew-action="none">' + filters[i][0] + '</a></li>').on("click", function (e) {
            // Delete
            var i = $__default['default'](this).find("a[data-index]").data("index");
            ew.prompt(ew.language.phrase("DeleteFilterConfirm").replace("%s", filters[i][0]), result => {
              if (result) {
                filters.splice(i, 1);
                saveFilters(id, filters);
              }
            });
          }).appendTo($submenu);
          $__default['default']('<li><a class="dropdown-item ew-filter-list" data-index="' + i + '" data-ew-action="none">' + filters[i][0] + '</a></li>').insertBefore($save).on("click", function (e) {
            var i = $__default['default'](this).find("a[data-index]").data("index");
            $__default['default']("<form>").attr({
              method: "post",
              action: ew.currentPage()
            }).append($__default['default']("<input type='hidden'>").attr({
              name: "cmd",
              value: "resetfilter"
            }), $__default['default']("<input type='hidden'>").attr({
              name: ew.TOKEN_NAME_KEY,
              value: ew.TOKEN_NAME
            }), // PHP
            $__default['default']("<input type='hidden'>").attr({
              name: ew.ANTIFORGERY_TOKEN_KEY,
              value: ew.ANTIFORGERY_TOKEN
            }), // PHP
            $__default['default']("<input type='hidden'>").attr({
              name: "filter",
              value: JSON.stringify(filters[i][1])
            })).appendTo("body").trigger("submit");
          });
        }

        $__default['default']("<li class='dropdown-divider'></li>").insertBefore($save);
        $delete.append($submenu);
      }
    }; // Add event handler

    this.on = function () {
      $self.on(...arguments);
    }; // Add event handler

    this.one = function () {
      $self.one(...arguments);
    }; // Remove event handler

    this.off = function () {
      $self.off(...arguments);
    }; // Trigger event

    this.trigger = function () {
      $self.trigger(...arguments);
    }; // Init form

    this.init = function () {
      if (this._initiated) return; // Check form

      var form = this.getForm();
      if (!form) return;
      var $form = $__default['default'](form); // Filters button

      if (ew.SEARCH_FILTER_OPTION == "Client" || ew.SEARCH_FILTER_OPTION == "Server" && ew.IS_LOGGEDIN && !ew.IS_SYS_ADMIN && ew.CURRENT_USER_NAME != "") {
        $__default['default'](".ew-filter-option .ew-btn-dropdown").on("show.bs.dropdown", function (e) {
          var _self$filterList$filt, _self$filterList;

          var filters = [];

          if (ew.SEARCH_FILTER_OPTION == "Client") {
            var item = localStorage.getItem(ew.PROJECT_NAME + "_" + self.id + "_filters");
            if (item) filters = ew.parseJson(item) || [];
          } else if (ew.SEARCH_FILTER_OPTION == "Server") filters = (_self$filterList$filt = (_self$filterList = self.filterList) == null ? void 0 : _self$filterList.filters) != null ? _self$filterList$filt : [];

          var ar = $__default['default'].grep(filters, function (val) {
            if (Array.isArray(val) && val.length == 2) return val;
          });
          self.setupFilters(e, ar);
        }).removeClass("d-none").show();
      } else {
        $__default['default'](".ew-filter-option").addClass("d-none").hide();
      } // Compile templates

      this.compileTemplates(); // Check if Search panel

      var isSearch = /s(ea)?rch$/.test(this.id); // Search panel

      if (isSearch && this.initSearchPanel && !ew.hasFormData(form)) $__default['default']("#" + this.id + "_search_panel").removeClass("show"); // Search panel toggle

      $__default['default'](".ew-search-toggle[data-form=" + this.id + "]").on("click.bs.button", function () {
        $__default['default']("#" + this.dataset.form + "_search_panel").collapse("toggle");
      }); // Hide search operator column

      if (!$__default['default'](".ew-table .ew-search-operator").text().trim()) $__default['default'](".ew-table .ew-search-operator").parent("td").hide(); // Highlight button

      if (isSearch) {
        $__default['default'](".ew-highlight[data-form=" + this.id + "]").on("click.bs.button", function () {
          $__default['default']("mark." + this.dataset.name).toggleClass("mark");
        });
      } // Search operators

      if (isSearch) {
        // Search form
        $form.find("select[id^=z_]").each(function () {
          var $this = $__default['default'](this).trigger("change");
          if ($this.val() != "BETWEEN") $form.find("#w_" + this.id.substr(2)).trigger("change");
        });
      } // Multi-page

      if (this.multiPage) this.multiPage.render(); // HTML editors

      loadjs.ready(["editor"], this.initEditors.bind(this)); // Dynamic selection lists

      this.updateLists(); // Init file upload

      this.initUpload(); // Submit/Cancel

      if (this.$element.is("form")) {
        // Not Grid page
        // Detail pages
        this.$element.find(".ew-detail-pages .ew-nav a[data-bs-toggle=tab]").on("shown.bs.tab", function (e) {
          var $tab = $__default['default'](e.target.getAttribute("href")),
              $panel = $tab.find(".table-responsive.ew-grid-middle-panel"),
              $container = $tab.closest(".container-fluid");
          if ($panel.width() >= $container.width()) $panel.width($container.width() + "px");else $panel.width("auto");
        });
        $form.on("submit", function () {
          // Bind submit event
          self.submit();
          return false; // Disable normal submission
        });
        $form.find("[data-field], .ew-priv").on("change", function () {
          if (ew.CONFIRM_CANCEL) self.modified = true;
        });
        $form.find("#btn-cancel[data-href]").on("click", function () {
          // Cancel
          self.updateTextArea();
          var href = this.dataset.href;

          if (self.modified && ew.hasFormData(form)) {
            ew.prompt(ew.language.phrase("ConfirmCancel"), result => {
              if (result) {
                $form.find("#btn-action").prop("disabled", true); // Disable the save button

                window.location = href;
              }
            });
          } else {
            $form.find("#btn-action").prop("disabled", true); // Disable the save button

            window.location = href;
          }
        });
      }

      this._initiated = true; // Store form object as data

      this.$element.data("form", this); // Trigger listeners

      this.trigger("initiated");
    }; // Add to the global forms object

    ew.forms.add(this);
  }

  /**
   * Class Field
   */
  let Field = /*#__PURE__*/function () {
    /**
     * Constructor
     * @param {string} fldvar Field variable name
     * @param {Function[]|Function} validators Validators
     * @param {bool} invalid Initial valid status (e.g. server side)
     */
    function Field(fldvar, validators, invalid) {
      _defineProperty(this, "name", "");

      _defineProperty(this, "validators", []);

      _defineProperty(this, "_validate", true);

      this.name = fldvar;

      if (Array.isArray(validators)) {
        for (let validator of validators) this.addValidator(validator);
      } else if (typeof validators === "function") {
        this.addValidator(validators);
      }

      this.invalid = invalid;
    }
    /**
     * Add validator
     * @param {Function} validator Validator function
     */

    var _proto = Field.prototype;

    _proto.addValidator = function addValidator(validator) {
      if (typeof validator === "function") this.validators.push(validator);
    }
    /**
     * Get error
     * @returns {Object}
     */
    ;

    /**
     * Add error
     * @param {Object} err Error
     */
    _proto.addError = function addError(err) {
      if (err) {
        var _this$_error;

        let error = (_this$_error = this._error) != null ? _this$_error : {};
        this._error = { ...error,
          ...err
        };
        this.invalid = true;
      }
    }
    /**
     * Clear all errors
     */
    ;

    _proto.clearErrors = function clearErrors() {
      this._error = null;
      this.invalid = false;
    }
    /**
     * Clear all validators
     */
    ;

    _proto.clearValidators = function clearValidators() {
      this.validators = [];
    }
    /**
     * Get error message
     * @returns {string} HTML
     */
    ;

    /**
     * Validate field value
     * @returns {boolean}
     */
    _proto.validate = function validate() {
      let result = true;
      this.clearErrors(); // Reset error

      if (this._element && this.shouldValidate) {
        if (Array.isArray(this.validators)) {
          for (let validator of this.validators) {
            let err = validator(this._element);

            if (err !== false) {
              this.addError(err);
              result = false;
            }
          }

          this.updateFeedback();
        }
      }

      return result;
    }
    /**
     * Reset invalid property (on page load for Grid-Add/Edit)
     */
    ;

    _proto.resetInvalid = function resetInvalid() {
      var _this$_element, _this$_element$closes, _this$_element$closes2;

      this.clearErrors();
      if ((_this$_element = this._element) != null && _this$_element.classList.contains("is-invalid") && !this._error) this.addError({
        server: (_this$_element$closes = this._element.closest(ew.fieldContainerSelector)) == null ? void 0 : (_this$_element$closes2 = _this$_element$closes.querySelector(".invalid-feedback")) == null ? void 0 : _this$_element$closes2.innerHTML
      }); // Server side error
    }
    /**
     * Update the error message to feedback element
     */
    ;

    _proto.updateFeedback = function updateFeedback() {
      let err = this.errorMessage;

      if (this._element && err) {
        var _this$_element$closes3;

        let feedback = (_this$_element$closes3 = this._element.closest(ew.fieldContainerSelector)) == null ? void 0 : _this$_element$closes3.querySelector(".invalid-feedback");
        if (feedback) feedback.innerHTML = err;
        ew.setInvalid(this._element);
      }
    }
    /**
     * Set focus
     * @param {Object} options - Focus options
     */
    ;

    _proto.focus = function focus(options) {
      if (this._element) ew.setFocus(this._element, options);
    }
    /**
     * Check if the field can be focused
     */
    ;

    _proto.canFocus = function canFocus() {
      var _el$style, _el$classList;

      let el = this._element;
      return el && !(el.hidden && !el.tagName == "SELECTION-LIST" || el.readonly || el.disabled || el.type == "hidden" || ((_el$style = el.style) == null ? void 0 : _el$style.display) == "none" || (_el$classList = el.classList) != null && _el$classList.contains("d-none"));
    }
    /**
     * Check if focused
     */
    ;

    _createClass(Field, [{
      key: "error",
      get: function () {
        return this._error;
      }
    }, {
      key: "errorMessage",
      get: function () {
        if (this._error) {
          return Array.from(Object.values(this._error)).join("<br>");
        }

        return "";
      }
      /**
       * Check if the field should be validated
       */

    }, {
      key: "shouldValidate",
      get: function () {
        return !this._checkbox || this._checkbox.checked;
      }
      /**
       * Set form element
       */

    }, {
      key: "element",
      get:
      /**
       * Get form element
       * @returns {HTMLElement|HTMLElement[]}
       */
      function () {
        return this._element;
      }
      /**
       * Get field value from form element
       * @returns {string|Array}
       */
      ,
      set: function (el) {
        var _this$_element2, _this$_element2$id;

        this._element = el;
        this._checkbox = (_this$_element2 = this._element) != null && (_this$_element2$id = _this$_element2.id) != null && _this$_element2$id.match(/^[xy]_/) ? document.getElementById(this._element.id.replace(/^[xy]_/, "u_")) : null; // Find the checkbox for the field in Update page
      }
    }, {
      key: "value",
      get: function () {
        return this._element ? ew.getValue(this._element) : "";
      }
    }, {
      key: "focused",
      get: function () {
        return this._element && this._element == document.activeElement;
      }
    }]);

    return Field;
  }();

  /**
   * Class Form
   */

  let Form = /*#__PURE__*/function (_FormBase) {
    _inheritsLoose(Form, _FormBase);

    /**
     * Constructor
     * @param {string} id Form ID
     * @param {string} pageId Page ID
     */
    function Form(id, pageId) {
      var _this;

      _this = _FormBase.call(this, id, pageId) || this;

      _defineProperty(_assertThisInitialized(_this), "row", {});

      _defineProperty(_assertThisInitialized(_this), "fields", {});

      _defineProperty(_assertThisInitialized(_this), "validateRequired", true);

      _defineProperty(_assertThisInitialized(_this), "autoFocus", true);

      _defineProperty(_assertThisInitialized(_this), "autoFocusPreventScroll", true);

      _this.on("initiated", function () {
        let form = this.getForm();

        if (form.classList.contains("ew-wait")) {
          this.one("enabled", function () {
            this.setInvalid();
            this.tryFocus();
          });
          return;
        }

        this.setInvalid();
        this.tryFocus();
      });

      return _this;
    }
    /**
     * Add field
     * @param {string} fldvar Field variable name
     * @param {Function[]} validators Validators
     * @param {bool} invalid Invalid
     */

    var _proto = Form.prototype;

    _proto.addField = function addField(fldvar, validators, invalid) {
      if (!(fldvar in this.fields)) this.fields[fldvar] = new Field(fldvar, validators, invalid);
    }
    /**
     * Get field
     * @param {string} fldvar Field variable name
     * @returns Field
     */
    ;

    _proto.getField = function getField(fldvar) {
      return this.fields[fldvar];
    }
    /**
     * Add fields by field definitions
     * @param {Array} fields
     */
    ;

    _proto.addFields = function addFields(fields) {
      if (Array.isArray(fields)) {
        for (let field of fields) {
          if (Array.isArray(field)) {
            this.addField.apply(this, field);
          }
        }
      }
    }
    /**
     * Add error
     * @param {string} fldvar Field variable name
     * @param {Object} err Error
     */
    ;

    _proto.addError = function addError(fldvar, err) {
      if (err) {
        var _this$_error;

        this._error = (_this$_error = this._error) != null ? _this$_error : {};
        this._error[fldvar] = err;
      }
    }
    /**
     * Add custom error
     * @param {string} fldvar Field variable name
     * @param {string} msg Error message
     */
    ;

    _proto.addCustomError = function addCustomError(fldvar, msg) {
      if (fldvar in this.fields) {
        let field = this.fields[fldvar],
            err = {
          custom: msg
        };
        field.addError(err);
        field.updateFeedback();
        this.addError(fldvar, err);
      }

      return false;
    }
    /**
     * Get error
     */
    ;

    /**
     * Get HTML elements for a field
     * @param {string} name - Field name
     * @param {number} rowIndex [undefined] - Row index
     * @returns HTMLElement|HTMLElement[]|null
     */
    _proto.getFieldElements = function getFieldElements(name, rowIndex) {
      return this.getElements("x" + (rowIndex != null ? rowIndex : "") + "_" + name) || // Set element
      this.getElements("x" + (rowIndex != null ? rowIndex : "") + "_" + name + "[]") || // Field with []
      this.getElements(name); // Field by name directly (e.g. email form)
    }
    /**
     * Set focus to a HTML element
     * @param {HTMLElement} el - HTML element to be focused
     */
    ;

    _proto.setFocus = function setFocus(el) {
      let delay = this.makeVisible(el) ? Form.focusDelay : 0;

      if (el != document.activeElement && el.focus) {
        let preventScroll = !el.closest(".modal-body") && Form.autoFocusPreventScroll && this.autoFocusPreventScroll;
        setTimeout(() => {
          el.focus({
            preventScroll
          });
        }, delay); // Focus after tab transition

        this._focused = true;
      }
    }
    /**
     * Set focus to the first field with error
     */
    ;

    _proto.focus = function focus() {
      if (!this.canFocus()) return;

      for (let [fldvar, field] of Object.entries(this.fields)) {
        var _this$_error2;

        if (field.invalid || (_this$_error2 = this._error) != null && _this$_error2[fldvar]) {
          this.getFocusable(field);

          if (field.canFocus()) {
            this.setFocus(field.element);
            break;
          }
        }
      }
    }
    /**
     * Get focuable field element
     * @param {Field} field - Field object
     */
    ;

    _proto.getFocusable = function getFocusable(field) {
      var _field$element;

      (_field$element = field.element) != null ? _field$element : field.element = this.getFieldElements(field.name);
      if (!field.canFocus()) field.element = this.getFieldElements(field.name, 0); // Inline-Add

      if (!field.canFocus()) field.element = this.getFieldElements(field.name, 1); // Inline-Edit or Grid-Add/Edit
    }
    /**
     * Try set focus to a field
     * @param {string|undefined|true} fieldName [undefined] - Field variable name. If undefined, find the first field. If true, always try to focus.
     */
    ;

    _proto.tryFocus = function tryFocus(fieldName) {
      if (!this.canFocus()) return;
      if (!fieldName && (!Form.autoFocus || !this.autoFocus || this._focused)) return;

      if (!fieldName && this.invalid) {
        // Has error
        this.focus();
        return;
      }

      if (["add", "edit"].includes(this.pageId)) {
        // Process detail forms
        let form = this.getForm(),
            detailpage = Array.from(form.querySelectorAll("input[name=detailpage]")).find(dp => {
          var _ew$forms$get;

          return (_ew$forms$get = ew.forms.get(dp.value)) == null ? void 0 : _ew$forms$get.invalid;
        });

        if (detailpage) {
          detailpage.focus();
          return;
        }
      }

      for (let [fldvar, field] of Object.entries(this.fields)) {
        if (fieldName && fieldName !== fldvar) continue;
        field.element = null; // Reset field element first so that it will get the first element

        this.getFocusable(field);

        if (field.canFocus()) {
          this.setFocus(field.element);
          return;
        }
      }

      if (this.id.endsWith("srch") && this.element.psearch && this.element.psearch != document.activeElement) {
        // Extended Search
        this.element.psearch.focus({
          preventScroll: Form.autoFocusPreventScroll && this.autoFocusPreventScroll
        }); // Focus the Quick Search input

        this._focused = true;
      }
    }
    /**
     * Check if the form can be focused
     */
    ;

    _proto.canFocus = function canFocus() {
      var _el$style, _el$classList;

      let el = this.element;
      return el && !(el.hidden || el.type == "hidden" || ((_el$style = el.style) == null ? void 0 : _el$style.display) == "none" || (_el$classList = el.classList) != null && _el$classList.contains("d-none"));
    }
    /**
     * Make the form visible
     * @param {HTMLElement} el - Focused element
     */
    ;

    _proto.makeVisible = function makeVisible(el) {
      if (this.multiPage) {
        // Multi-page
        this.multiPage.gotoPageByElement(el);
        return true;
      } else if (this.$element.is("div")) {
        // Multiple Master/Detail
        let $pane = this.$element.closest(".tab-pane");

        if ($pane[0] && !$pane.hasClass("active")) {
          $pane.closest(".ew-nav").find("a[data-bs-toggle=tab][href='#" + $pane.attr("id") + "']").trigger("click");
          return true;
        }
      }

      return false;
    }
    /**
     * Validate all fields of the specified row
     * @param {number} rowIndex - Row index
     */
    ;

    _proto.validateFields = function validateFields(rowIndex) {
      var _rowIndex;

      rowIndex = (_rowIndex = rowIndex) != null ? _rowIndex : "";
      this.row = {};
      this._error = null; // Reset

      let result = true;

      for (let field of Object.values(this.fields)) {
        field.element = this.getFieldElements(field.name, rowIndex);
        this.row[field.name] = field.value; // Get field value

        if (field.element && !field.validate()) {
          // Invalid field value
          this.addError(field.name, field.error);
          result = false;
        }
      } // Save the field values of the row

      if (!this.value) {
        this.value = { ...this.row
        };
      } else {
        if (!Array.isArray(this.value)) this.value = [this.value];
        let index = parseInt(rowIndex, 10) || 0;
        index = index > 1 ? index - 1 : 0;
        this.value[index] = { ...this.row
        };
      }

      this.focus();
      return result;
    } // Validate
    ;

    _proto.validate = function validate() {
      var _form$querySelector, _form$querySelector2, _form$querySelector3;

      if (!this.validateRequired) return true; // Ignore validation

      let form = this.getForm();
      if (((_form$querySelector = form.querySelector("#confirm")) == null ? void 0 : _form$querySelector.value) == "confirm") return true;

      if (this.pageId == "update" && !ew.updateSelected(form)) {
        ew.alert(ew.language.phrase("NoFieldSelected"));
        return false;
      }

      let addcnt = 0,
          action = (_form$querySelector2 = form.querySelector("#action")) == null ? void 0 : _form$querySelector2.value,
          keycnt = this.formKeyCountName ? (_form$querySelector3 = form.querySelector("#" + this.formKeyCountName)) == null ? void 0 : _form$querySelector3.value : null,
          // Get key_count
      detailpages = form.querySelectorAll("input[name=detailpage]"),
          gridinsert = action == "gridinsert" || action == "insert" && Array.from(detailpages).some(dp => dp.value == this.id),
          // Master/Detail-Add or Grid-Add
      insert = action == "insert" && !gridinsert,
          // Inline-Add
      startcnt = insert ? 0 : 1,
          rowcnt = insert ? 0 : parseInt(keycnt, 10) || 1;

      for (let i = startcnt; i <= rowcnt; i++) {
        let rowIndex = keycnt ? String(i) : "";
        form.dataset.rowindex = rowIndex;

        if (["list", "grid"].includes(this.pageId)) {
          if (gridinsert ? !this.emptyRow(rowIndex) : true) addcnt++;else continue;
        } // Validate fields

        if (!this.validateFields(rowIndex)) return false; // Call customValidate event

        if (this.customValidate && !this.customValidate(form)) {
          this.focus();
          return false;
        }
      }

      if (this.pageId == "list" && gridinsert && addcnt == 0) {
        // No row added
        ew.alert(ew.language.phrase("NoAddRecord"));
        return false;
      } // Process detail forms

      if (["add", "edit"].includes(this.pageId)) {
        detailpages.forEach(dp => {
          let frm = ew.forms.get(dp.value);
          if (frm && !frm.validate()) return false;
        });
      }

      return true;
    }
    /**
     * Get field values of the specified row
     * @param {number} rowIndex - Row index
     */
    ;

    _proto.getValue = function getValue(rowIndex) {
      var _rowIndex2;

      rowIndex = (_rowIndex2 = rowIndex) != null ? _rowIndex2 : "";
      let value = {};

      for (let field of Object.values(this.fields)) {
        var _field$element2;

        (_field$element2 = field.element) != null ? _field$element2 : field.element = this.getFieldElements(field.name, rowIndex);
        value[field.name] = field.value; // Get field value
      }

      return value;
    }
    /**
     * Set invalid fields of the specified row
     * @param {number} rowIndex - Row index. If undefined, set for the whole form.
     */
    ;

    _proto.setInvalid = function setInvalid(rowIndex) {
      let form = this.getForm(); // Get HTML form

      if (typeof rowIndex === "undefined" && this.formKeyCountName) {
        let k = form.querySelector("#" + this.formKeyCountName),
            // Get key_count
        rowcnt = parseInt(k == null ? void 0 : k.value, 10) || 1,
            startcnt = rowcnt === 0 ? 0 : 1; // Check rowcnt === 0 => Inline-Add

        for (let i = startcnt; i <= rowcnt; i++) {
          let rowIndex = k ? String(i) : "";
          this.setInvalid(rowIndex);
        }
      } else {
        var _rowIndex3;

        rowIndex = (_rowIndex3 = rowIndex) != null ? _rowIndex3 : "";

        for (let field of Object.values(this.fields)) {
          field.element = this.getFieldElements(field.name, rowIndex); // Always get element in case Grid-Add/Edit

          if (rowIndex) field.resetInvalid(); // For Grid-Add/Edit

          if (field.invalid) {
            this.addError(field.name, field.error);
            if (!this._focused) this.focus(); // Focus at the current row
          } else {
            continue;
          }

          ew.setInvalid(field.element);
        } // Process detail forms

        if (["add", "edit"].includes(this.pageId)) form.querySelectorAll("input[name=detailpage]").forEach(dp => {
          var _ew$forms$get2;

          return (_ew$forms$get2 = ew.forms.get(dp.value)) == null ? void 0 : _ew$forms$get2.setInvalid();
        });
      }
    };

    _createClass(Form, [{
      key: "error",
      get: function () {
        return this._error;
      }
      /**
       * Check if invalid
       */

    }, {
      key: "invalid",
      get: function () {
        return this._error || Object.values(this.fields).some(field => field.invalid);
      }
    }]);

    return Form;
  }(FormBase);

  _defineProperty(Form, "autoFocus", true);

  _defineProperty(Form, "autoFocusPreventScroll", true);

  _defineProperty(Form, "focusDelay", 200);

  let AjaxLookup = /*#__PURE__*/function () {
    /**
     * Constructor
     * @param {Object} settings Settings
     * @param {string} settings.id - Input element ID
     * @param {string|Form} settings.form - Form of the input element
     * @param {Number} settings.limit - Options per page
     * @param {Object} settings.data - Data submitted by Ajax
     * @param {string} settings.action - Ajax action: "autosuggest" or "modal"
     */
    function AjaxLookup(settings) {
      _defineProperty(this, "_isAutoSuggest", null);

      this.elementId = settings.id; // Id

      this.form = settings.form; // Form

      if ($__default['default'].isString(this.form)) // Form is string => Form id
        this.form = ew.forms.get(this.form);
      this.element = this.form.getElement(this.elementId); // Actual HTML element

      this.formElement = this.form.getElement(); // HTML form or DIV

      this.list = this.form.getList(this.elementId);
      let m = this.elementId.match(/^[xy](\d*|\$rowindex\$)_/),
          rowindex = m ? m[1] : "";
      this.parentFields = this.list.parentFields.slice() // Clone
      .map(pf => pf.split(" ").length == 1 ? pf.replace(/^x_/, "x" + rowindex + "_") : pf); // Parent field in the same table, add row index

      this.limit = settings.limit;
      this.debounce = settings.debounce;
      this.data = settings.data;
      this.recordCount = 0;
      this.action = settings.action || "autosuggest";
    }
    /**
     * Is AutoSuggest
     */

    var _proto = AjaxLookup.prototype;

    /**
     * Format display value
     * @param {Array} opt Option
     */
    _proto.formatResult = function formatResult(opt) {
      this.form.compileTemplates();

      if (this.list.template && !this.isAutoSuggest) {
        return this.list.template.render(opt, ew.jsRenderHelpers);
      } else {
        return ew.displayValue(opt, this.element) || opt[0];
      }
    }
    /**
     * Generate request
     */
    ;

    _proto.generateRequest = function generateRequest() {
      var _data$ajax;

      var data = Object.assign({}, this.data, {
        name: this.element.name,
        page: this.list.page,
        field: this.list.field,
        language: ew.LANGUAGE_ID
      }, ew.getUserParams("#p_" + this.elementId, this.formElement));
      (_data$ajax = data.ajax) != null ? _data$ajax : data.ajax = this.action;

      if (this.parentFields.length > 0) {
        this.parentFields.forEach((pf, i) => {
          let arp = ew.getOptionValues(pf, this.formElement);
          data["v" + (i + 1)] = arp.join(ew.MULTIPLE_OPTION_SEPARATOR);
        });
      }

      return data;
    }
    /**
     * Get URL
     */
    ;

    _proto.getUrl = function getUrl(query, start) {
      let params = new URLSearchParams({
        q: query || "",
        n: this.limit,
        rnd: ew.random(),
        start: $__default['default'].isNumber(start) ? start : -1
      });
      return ew.getApiUrl(ew.API_LOOKUP_ACTION, params.toString());
    }
    /**
     * Prepare URL and data for sending request
     * @param {string} query Search term
     * @param {Number} start Start page
     */
    ;

    _proto.prepare = function prepare(query, start) {
      return {
        url: this.getUrl(query, start),
        type: "POST",
        dataType: "json",
        data: this.generateRequest()
      };
    }
    /**
     * Transform options (virtual)
     * @param {Object[]} data Data from server
     */
    ;

    _proto.transform = function transform(data) {
      let results = [];

      if ((data == null ? void 0 : data.result) == "OK") {
        this.recordCount = data.totalRecordCount;
        results = data.records;
      }

      return results;
    };

    _createClass(AjaxLookup, [{
      key: "isAutoSuggest",
      get: function () {
        if (this._isAutoSuggest === null) this._isAutoSuggest = ew.isAutoSuggest(this.element);
        return this._isAutoSuggest;
      }
      /**
       * Lookup options
       */

    }, {
      key: "options",
      get: function () {
        return this.list.lookupOptions;
      }
    }]);

    return AjaxLookup;
  }();

  /**
   * Class selection list option
   */
  let SelectionListOption =
  /**
   * Constructor
   */
  function SelectionListOption(value, text, selected) {
    this.value = String(value);
    this.text = String(text);
    this.selected = !!selected;
  };

  let AutoSuggest = /*#__PURE__*/function (_AjaxLookup) {
    _inheritsLoose(AutoSuggest, _AjaxLookup);

    function AutoSuggest(settings) {
      var _this;

      _this = _AjaxLookup.call(this, settings) || this;
      _this.input = _this.form.getElement("sv_" + _this.elementId); // User input

      if (!_this.input || _this.elementId.includes("$rowindex$")) return _assertThisInitialized(_this);

      let self = _assertThisInitialized(_this),
          $input = $__default['default'](_this.input),
          $element = $__default['default'](_this.element); // Properties

      _this.minWidth = settings.minWidth;
      _this.maxHeight = settings.maxHeight;
      _this.highlight = settings.highlight;
      _this.hint = settings.hint;
      _this.minLength = settings.minLength;
      _this.templates = Object.assign({}, settings.templates);
      _this.classNames = Object.assign({}, settings.classNames);
      _this.delay = settings.delay; // For loading more results

      _this.debounce = settings.debounce;
      _this.display = settings.display || "text";
      _this.forceSelection = settings.forceSelect;
      _this.lineHeight = settings.lineHeight;
      _this.paddingY = settings.paddingY;
      _this.$input = $input;
      _this.$element = $element; // Save instance

      $element.data("autosuggest", _assertThisInitialized(_this)); // Save initial option

      if ($input.val() && $element.val()) _this.element.add($element.val(), $input.val(), true); // Add events

      $input.on("typeahead:select", (e, d) => {
        self.setValue(d[self.display]);
      }).on("change", () => {
        let ta = $input.data("tt-typeahead");

        if (ta != null && ta.isOpen() && !ta.menu.empty()) {
          let $item = ta.menu.getActiveSelectable();

          if ($item) {
            // A suggestion is highlighted
            let i = $item.index(),
                val = self.element.options[i].text;
            $input.typeahead("val", val);
          }
        }

        self.setValue();
      }).on("blur", () => {
        // "change" fires before blur
        let ta = $input.data("tt-typeahead");
        if (ta != null && ta.isOpen()) ta.menu.close();
      }).on("focus", () => {
        $input.attr("placeholder", $input.data("placeholder")).removeClass("is-invalid");
        $element.removeClass("is-invalid");
      }); // Get suggestions

      let async = !_this.options.length,
          loadingMore = false,
          timer; // Option template ("suggestion" template)

      let tpl = self.list.template || self.templates.suggestion;
      if (tpl && $__default['default'].isString(tpl)) tpl = $__default['default'].templates(tpl);
      if (tpl) self.templates.suggestion = tpl.render.bind(tpl);
      if (async && !self.templates.footer) self.templates.footer = '<div class="tt-footer dropdown-item">' + ew.language.phrase("LoadingMore") + '</div>'; // "footer" template

      let source = (query, syncResults, asyncResults) => {
        if (async) {
          if (timer) timer.cancel();
          timer = $__default['default'].later(_this.debounce, null, () => {
            _this.recordCount = 0; // Reset

            $__default['default'].ajax(_this.prepare(query)).done(data => asyncResults(_this.transform(data)));
          });
        } else {
          let records = _this.getSyncResults(query);

          syncResults(_this.transform({
            result: "OK",
            totalRecordCount: records.length,
            records
          }));
        }
      }; // Create Typeahead

      $__default['default'](function () {
        // Typeahead options and dataset
        let options = {
          highlight: self.highlight,
          minLength: self.minLength,
          hint: self.hint,
          classNames: self.classNames
        };
        let dataset = {
          name: self.form.id + "-" + self.elementId,
          source,
          async,
          templates: self.templates,
          display: self.display,
          limit: async ? self.limit : Infinity
        };
        let args = [options, dataset]; // Trigger "typeahead" event

        $element.trigger("typeahead", [args]); // Create Typeahead

        self.typeahead = $input.typeahead.apply($input, args).off("blur.tt").data("tt-typeahead");

        let menu = self.typeahead.menu,
            $menu = menu.$node,
            $dataset = $menu.find(".tt-dataset"),
            suggestionHeight = () => $menu.find(".tt-suggestion").outerHeight(false);

        if (self.minWidth) $menu.css("min-width", self.minWidth);
        $input.on("typeahead:rendered", (e, suggestions) => {
          let rendered = suggestions.length,
              count = self.count;

          if (count >= self.limit) {
            let h = suggestionHeight();
            if (h) $dataset.css("max-height", h * self.limit);
          }

          if (rendered > 0) $dataset.scrollTop(suggestionHeight() * (count - rendered)); // Scroll to the first suggestion

          if (async) $menu.find(".tt-footer").toggle(self.recordCount > count);
        });

        if (async) {
          let loadingMoreTimer;
          $dataset.on("scroll", () => {
            var _loadingMoreTimer;

            (_loadingMoreTimer = loadingMoreTimer) == null ? void 0 : _loadingMoreTimer.cancel();
            loadingMoreTimer = $__default['default'].later(self.delay, null, () => {
              let $footer = $menu.find(".tt-footer");

              if (!$footer.is(":hidden") && !loadingMore) {
                let currentOffset = $dataset.offset().top + $dataset.outerHeight(false),
                    loadingMoreOffset = $footer.offset().top + $footer.outerHeight(false);

                if (currentOffset + 20 > loadingMoreOffset) {
                  // $footer shows more than 20px
                  loadingMore = true;
                  self.getMore().always(() => loadingMore = false);
                } else {
                  var _loadingMoreTimer2;

                  (_loadingMoreTimer2 = loadingMoreTimer) == null ? void 0 : _loadingMoreTimer2.cancel();
                }
              }
            });
          });
        }
      });
      return _this;
    } // Set the selected item to the actual field

    var _proto = AutoSuggest.prototype;

    _proto.setValue = function setValue(v) {
      v || (v = this.$input.val());
      let index = this.element.options.findIndex(option => option.text == v);

      if (index < 0) {
        // Not found in results
        if (this.forceSelection && v) {
          // Force selection and query not empty => error
          this.$input.typeahead("val", "").addClass("is-invalid");
          this.$element.next(".invalid-feedback").html(ew.language.phrase("ValueNotExist"));
          this.$element.addClass("is-invalid").val("").trigger("change");
          return;
        }
      } else {
        // Found in results
        this.element.options[index].selected = true;
        if (!/s(ea)?rch$/.test(this.formElement.id) || this.forceSelection) // Force selection or not search form
          v = this.element.options[index].value; // Replace the display value by Link Field value
      }

      if (v !== this.$element.attr("value")) this.$element.attr("value", v).trigger("change"); // Set value to the actual field
    } // Transform suggestion
    ;

    _proto.transform = function transform(data) {
      let results = _AjaxLookup.prototype.transform.call(this, data).map(item => Object.assign({}, item, {
        text: _AjaxLookup.prototype.formatResult.call(this, item)
      }));

      this.element.options = results.map(item => new SelectionListOption(item.lf || item[0], item.text));
      return results;
    } // Get current suggestion count
    ;

    // Get suggestions from lookup cache
    _proto.getSyncResults = function getSyncResults(query) {
      if (this.options.length) {
        let results = this.options.filter(item => {
          if (ew.LOOKUP_ALL_DISPLAY_FIELDS) {
            let v = [item.df, item.df2, item.df3, item.df4].map(df => String(df).toLowerCase()).join(" ");
            return query.toLowerCase().split(" ").filter(q => q !== "").every(q => v.includes(q));
          } else {
            return String(item.df).toLowerCase().startsWith(q);
          }
        });
        this.recordCount = results.length;
        return results;
      }

      return [];
    } // Get more suggestions by Ajax
    ;

    _proto.getMore = function getMore() {
      let menu = this.typeahead.menu,
          start = this.count,
          settings = this.prepare(menu.query, start);
      return $__default['default'].ajax(settings).done(data => menu.datasets[0]._append(menu.query, this.transform(data)));
    };

    _createClass(AutoSuggest, [{
      key: "count",
      get: function () {
        return this.typeahead.menu.$node.find(".tt-suggestion.tt-selectable").length || 0;
      }
    }]);

    return AutoSuggest;
  }(AjaxLookup);

  /**
   * Class Forms
   */

  let Forms = /*#__PURE__*/function () {
    function Forms() {
      _defineProperty(this, "_forms", {});
    }

    var _proto = Forms.prototype;

    /**
     * Get form by element or id
     * @param {HTMLElement|string} el Element or id
     */
    _proto.get = function get(el) {
      var _ew$getForm;

      if (!el) return null;
      let id = $__default['default'].isString(el) ? el : (_ew$getForm = ew.getForm(el)) == null ? void 0 : _ew$getForm.id;
      return this._forms[id];
    }
    /**
     * Add form
     * @param {Form} f Form
     */
    ;

    _proto.add = function add(f) {
      if (this._forms[f.id] && this._forms[f.id] !== f) delete this._forms[f.id];
      this._forms[f.id] = f;
    }
    /**
     * Get all ids
     * @returns {string[]}
     */
    ;

    _proto.ids = function ids() {
      return Object.keys(this._forms);
    };

    return Forms;
  }();

  var Select2Language = {
    errorLoading: function () {
      return ew.language.phrase("ErrorLoading");
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;
      return ew.language.phrase("InputTooLong").replace("%s", overChars);
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;
      return ew.language.phrase("InputTooShort").replace("%s", remainingChars);
    },
    loadingMore: function () {
      return ew.language.phrase("LoadingMore");
    },
    maximumSelected: function (args) {
      return ew.language.phrase("MaximumSelected").replace("%s", args.maximum);
    },
    noResults: function () {
      return ew.language.phrase("NoResults");
    },
    searching: function () {
      return ew.language.phrase("Searching");
    },
    removeAllItems: function () {
      return ew.language.phrase("RemoveAllItems");
    },
    removeItem: function () {
      return ew.language.phrase("RemoveItem");
    },
    search: function () {
      return ew.language.phrase("Search");
    }
  };

  let _defined$3 = $__default['default'].fn.select2.amd.require._defined,
      Utils$3 = _defined$3['select2/utils'];
  /**
   * Select2 decorator for Results
   */

  let Select2ResultsDecorator = /*#__PURE__*/function () {
    function Select2ResultsDecorator() {}

    var _proto = Select2ResultsDecorator.prototype;

    _proto.render = function render(decorated) {
      var $results = $__default['default']('<div class="select2-results__options ' + this.options.get('containerClass') + '" role="listbox"></div>'); //***

      if (this.options.get('multiple')) {
        $results.attr('aria-multiselectable', 'true');
      }

      this.$results = $results;
      return $results;
    };

    _proto.displayMessage = function displayMessage(decorated, params) {
      var escapeMarkup = this.options.get('escapeMarkup');
      this.clear();
      this.hideLoading();
      var $message = $__default['default']('<div role="alert" aria-live="assertive"' + ' class="select2-results__option"></div>'); //***

      if (params.message.includes("<") && params.message.includes(">")) {
        // HTML //***
        $message.append(params.message);
      } else {
        var message = this.options.get('translations').get(params.message);
        $message.append(escapeMarkup(message(params.args)));
      }

      $message[0].className += ' select2-results__message';
      this.$results.append($message);
    };

    _proto.append = function append(decorated, data) {
      this.hideLoading();

      if (data.results == null || data.results.length === 0) {
        if (this.$results.children().length === 0) {
          if (this.$element.data("updating") && data.pagination.more) {
            this.trigger('results:message', {
              message: '<div class="spinner-border spinner-border-sm text-primary ew-select-spinner" role="status"><span class="visually-hidden">' + ew.language.phrase('Loading') + '</span></div> ' + ew.language.phrase('Loading')
            });
            this.$element.one("updated", () => this.$element.select2("close").select2("open"));
          } else {
            this.trigger('results:message', {
              message: 'noResults'
            });
          }
        }

        return;
      }

      data.results = this.sort(data.results); //***

      var cols = this.options.get('columns'),
          len = data.results.length,
          $row = this.$results.find("." + this.options.get('rowClass')).last();

      for (var d = 0; d < data.results.length; d++) {
        var item = data.results[d];
        var $option = this.option(item);

        if (!$row.length || $row.children().length == cols) {
          // Add new row
          $row = $__default['default']('<div class="' + this.options.get('rowClass') + '"></div>');
          this.$results.append($row);
        }

        $row.append($option);

        if (d == len - 1) {
          // Last
          var cnt = cols - $row.children().length;

          for (var i = 0; i < cnt; i++) $row.append('<div class="' + this.options.get('cellClass') + '"></div>');
        }
      }
    };

    _proto.option = function option(decorated, data) {
      // var option = document.createElement('li');
      var option = document.createElement('div'); //***

      option.classList.add('select2-results__option');
      option.classList.add('select2-results__option--selectable');
      this.options.get('cellClass').split(" ").forEach(c => option.classList.add(c)); //***

      var attrs = {
        'role': 'option',
        'aria-selected': 'false'
      };
      var matches = window.Element.prototype.matches || window.Element.prototype.msMatchesSelector || window.Element.prototype.webkitMatchesSelector;

      if (data.element != null && matches.call(data.element, ':disabled') || data.element == null && data.disabled) {
        attrs['aria-disabled'] = 'true';
        option.classList.remove('select2-results__option--selectable');
        option.classList.add('select2-results__option--disabled');
      }

      if (data.id == null) {
        option.classList.remove('select2-results__option--selectable');
      }

      if (data._resultId != null) {
        option.id = data._resultId;
      }

      if (data.title) {
        option.title = data.title;
      } // if (data.children) { //***
      //   attrs.role = 'group';
      //   attrs['aria-label'] = data.text;
      //   option.classList.remove('select2-results__option--selectable');
      //   option.classList.add('select2-results__option--group');
      // }

      for (var attr in attrs) {
        var val = attrs[attr];
        option.setAttribute(attr, val);
      } // if (data.children) { //***
      //   var $option = $(option);
      //   var label = document.createElement('strong');
      //   label.className = 'select2-results__group';
      //   this.template(data, label);
      //   var $children = [];
      //   for (var c = 0; c < data.children.length; c++) {
      //     var child = data.children[c];
      //     var $child = this.option(child);
      //     $children.push($child);
      //   }
      //   var $childrenContainer = $('<ul></ul>', {
      //     'class': 'select2-results__options select2-results__options--nested',
      //     'role': 'none'
      //   });
      //   $childrenContainer.append($children);
      //   $option.append(label);
      //   $option.append($childrenContainer);
      // } else {

      this.template(data, option); // }

      Utils$3.StoreData(option, 'data', data);
      return option;
    };

    return Select2ResultsDecorator;
  }();

  let _defined$2 = $__default['default'].fn.select2.amd.require._defined,
      Utils$2 = _defined$2['select2/utils'];
  /**
   * Results for modal lookup
   */

  let ModalResults = /*#__PURE__*/function () {
    function ModalResults() {}

    var _proto = ModalResults.prototype;

    _proto.bind = function bind(decorated, container, $container) {
      var _container$listeners$;

      var self = this;
      decorated.call(this, container, $container); // Remove handlers

      (_container$listeners$ = container.listeners['results:select']) == null ? void 0 : _container$listeners$.pop();
      this.$results.off('mouseup');
      container.on('results:select', function (evt) {
        var $highlighted = self.getHighlightedResults();

        if ($highlighted.length === 0) {
          return;
        }

        var data = Utils$2.GetData($highlighted[0], 'data');

        if ($highlighted.hasClass('select2-results__option--selected')) {
          self.trigger('unselect', {
            originalEvent: evt,
            data: data
          });
        } else {
          self.trigger('select', {
            originalEvent: evt,
            data: data
          });
        }
      });
      this.$results.on('mousedown', '.select2-results__option--selectable', function (evt) {
        this._mousedown = true;
      });
      this.$results.on('mouseup', '.select2-results__option--selectable', function (evt) {
        if (!this._mousedown) return;
        var $this = $__default['default'](this);
        var data = Utils$2.GetData(this, 'data');

        if ($this.hasClass('select2-results__option--selected')) {
          self.trigger('unselect', {
            originalEvent: evt,
            data: data
          });
          return;
        }

        self.trigger('select', {
          originalEvent: evt,
          data: data
        });
      });
    };

    return ModalResults;
  }();

  /**
   * Search box for modal lookup
   */
  let ModalSearch = /*#__PURE__*/function () {
    function ModalSearch() {}

    var _proto = ModalSearch.prototype;

    _proto.bind = function bind(decorated, container, $container) {
      var _container$listeners$;

      var self = this;
      decorated.call(this, container, $container);
      (_container$listeners$ = container.listeners['close']) == null ? void 0 : _container$listeners$.pop(); // Remove handler from Search

      container.on('close', function () {
        self.$search.attr('tabindex', -1).removeAttr('aria-controls').removeAttr('aria-activedescendant');
      });
    };

    return ModalSearch;
  }();

  /**
   * Dropdown search decorator
   */
  let KEYS = $.fn.select2.amd.require._defined['select2/keys'];
  KEYS.PRINT_SCREEN = 44;

  let DropdownSearchDecorator = /*#__PURE__*/function () {
    function DropdownSearchDecorator() {}

    var _proto = DropdownSearchDecorator.prototype;

    _proto.handleSearch = function handleSearch(decorated, evt) {
      var key = evt.which; // Ignore events from modifier keys

      if ([KEYS.TAB, KEYS.SHIFT, KEYS.CTRL, KEYS.ALT, KEYS.PRINT_SCREEN].includes(key)) {
        return;
      }

      if (!this._keyUpPrevented) {
        var input = this.$search.val();
        this.trigger('query', {
          term: input
        });
      }

      this._keyUpPrevented = false;
    };

    return DropdownSearchDecorator;
  }();

  /**
   * Select2 AttachBody decorator for modal lookup
   */

  let ModalAttachBody = /*#__PURE__*/function () {
    function ModalAttachBody(decorated, $element, options) {
      _defineProperty(this, "$modal", null);

      options.set('dropdownParent', $__default['default'](document.body));
      decorated.call(this, $element, options);
    }

    var _proto = ModalAttachBody.prototype;

    _proto.bind = function bind(decorated, container, $container) {
      let self = this;
      decorated.call(this, container, $container);
      container.on('open', function () {
        self._showDropdown(); // Must bind after the results handlers to ensure correct sizing

        self._bindContainerResultHandlers(container);
      });
      this.$dropdownContainer.on('mousedown', function (evt) {
        evt.stopPropagation();
      });
    };

    _proto.position = function position(decorated, $dropdown, $container) {
      // Clone all of the container classes
      $dropdown.attr('class', $container.attr('class'));
      $dropdown.removeClass('select2');
      this.$container = $container;
    };

    _proto.render = function render(decorated) {
      let $container = $__default['default']('<span></span>');
      let $dropdown = decorated.call(this);
      $container.append($dropdown);
      this.$dropdownContainer = $container;
      return $container;
    };

    _proto._bindContainerResultHandlers = function _bindContainerResultHandlers(decorated, container) {
      // These should only be bound once
      if (this._containerResultsHandlersBound) {
        return;
      }

      let self = this;
      container.$modal = this.$modal;
      container.on('results:all', function () {
        var _self$$search$;

        self._updateDropdown();

        (_self$$search$ = self.$search[0]) == null ? void 0 : _self$$search$.focus();
      });
      container.on('results:append', function () {
        self._updateDropdown();
      });
      container.on('results:message', function () {
        self._updateDropdown();
      });
      container.on('select', function (e) {
        var _e$originalEvent;

        let target = (_e$originalEvent = e.originalEvent) == null ? void 0 : _e$originalEvent.currentTarget;
        target == null ? void 0 : target.classList.add('select2-results__option--selected');

        self._updateDropdown();
      });
      container.on('unselect', function (e) {
        var _e$originalEvent2;

        let target = (_e$originalEvent2 = e.originalEvent) == null ? void 0 : _e$originalEvent2.currentTarget;
        target == null ? void 0 : target.classList.remove('select2-results__option--selected');

        self._updateDropdown();
      });
      this._containerResultsHandlersBound = true;
    };

    _proto._updateDropdown = function _updateDropdown() {
      if (!this.$modal.find(this.$dropdownContainer)[0]) this.$modal.find('.modal-body').children().detach().end().append(this.$dropdownContainer);
    };

    _proto._showDropdown = function _showDropdown(decorated) {
      var _this$$modal;

      let self = this,
          oldValue = this.$element.val();
      this.$dropdownContainer.appendTo(this.options.get('dropdownParent'));
      (_this$$modal = this.$modal) != null ? _this$$modal : this.$modal = $__default['default']('#ew-modal-lookup-dialog');

      this._updateDropdown();

      this.$modal.find('.modal-title').empty().append(ew.language.phrase('LookupTitle').replace('%s', this.$element.data('caption')));
      this.$modal.find('.modal-footer button[data-value]').off().on('click', function () {
        if (!$__default['default'](this).data('value')) // Cancel
          self.$element.val(oldValue).trigger('change');
      });
      this.$modal.modal('show').on('hidden.bs.modal', function (event) {
        self.$container.removeClass('select2-container--open');
      }).draggable(this.options.get('draggableOptions'));
    };

    return ModalAttachBody;
  }();

  let AttachBody$2 = $__default['default'].fn.select2.amd.require._defined['select2/dropdown/attachBody'];
  /**
   * Select2 AttachBody for table header filter
   */

  let FilterAttachBody = /*#__PURE__*/function (_AttachBody) {
    _inheritsLoose(FilterAttachBody, _AttachBody);

    // Constructor
    function FilterAttachBody(decorated, $element, options) {
      return _AttachBody.call(this, decorated, $element, options) || this;
    } // Override bind()

    var _proto = FilterAttachBody.prototype;

    _proto.bind = function bind(decorated, container, $container) {
      var self = this;
      decorated.call(this, container, $container);
      container.on('open', function () {
        self._showDropdown(); // Must bind after the results handlers to ensure correct sizing

        self._bindContainerResultHandlers(container);
      });
      container.on('close', function () {
        self._hideDropdown();
      });
      this.$dropdownContainer.on('mousedown', function (evt) {
        evt.stopPropagation();
      });
    } // Override _positionDropdown()
    ;

    _proto._positionDropdown = function _positionDropdown() {
      var _this$_popper;

      (_this$_popper = this._popper) == null ? void 0 : _this$_popper.update();
    } // Override _resizeDropdown()
    ;

    _proto._resizeDropdown = function _resizeDropdown() {
      var css = {
        width: this.$container.outerWidth(false) + 'px'
      };

      if (this.options.get('dropdownAutoWidth')) {
        css.minWidth = css.width;
        css.position = 'relative';
        css.width = 'auto';
      }

      this.$dropdown.css(css);
    } // Override _showDropdown()
    ;

    _proto._showDropdown = function _showDropdown(decorated) {
      var _dropdownButton$close, _this$_popper2;

      this.$dropdownContainer.appendTo(this.$dropdownParent); // Footer

      let self = this,
          oldValue = this.$element.val(),
          $footer = $__default['default']('#ew-filter-dropdown-footer').contents().clone();
      $footer.find('.ew-filter-btn[data-value]').off().on('click', function (e) {
        let value = $__default['default'](this).data('value');

        if (value) {
          // OK
          ew.forms.get(self.$element[0].form).submit();
        } else {
          // Cancel
          self.$element.val(oldValue).trigger('change');
        }

        self.$element.select2('close');
      });
      $footer.find('.ew-filter-clear').off().on('click', e => self.$element.data('select2').selection._handleClear(e));
      let $filterDropdown = this.$dropdownContainer.find('.ew-filter-dropdown');
      if (!$filterDropdown.find('.ew-filter-btn')[0]) $filterDropdown.append($footer); // Popper

      var dropdownButton = document.querySelector('.ew-filter-dropdown-btn[data-table=' + this.$element.data('table') + '][data-field=' + this.$element.data('field') + ']'),
          reference = (_dropdownButton$close = dropdownButton.closest(".ew-table-header-cell")) != null ? _dropdownButton$close : dropdownButton.closest(".ew-table-header-btn");
      (_this$_popper2 = this._popper) != null ? _this$_popper2 : this._popper = Popper.createPopper(reference, this.$dropdownContainer[0], {
        placement: ew.IS_RTL ? 'bottom-end' : 'bottom-start'
      });

      this._positionDropdown();

      this._resizeDropdown();
    } // Override position()
    ;

    _proto.position = function position(decorated, $dropdown, $container) {
      // Clone all of the container classes
      $dropdown.attr('class', $container.attr('class'));
      $dropdown[0].classList.remove('select2');
      $dropdown[0].classList.add('select2-container--open');
      this.$container = $container;
    };

    // Override destroy()
    _proto.destroy = function destroy(decorated) {
      var _this$_popper3;

      _AttachBody.prototype.destroy.call(this, decorated);

      (_this$_popper3 = this._popper) == null ? void 0 : _this$_popper3.destroy();
      this._popper = null;
    };

    return FilterAttachBody;
  }(AttachBody$2);

  let AttachBody$1 = $__default['default'].fn.select2.amd.require._defined['select2/dropdown/attachBody'];
  /**
   * Select2 AttachBody for dropdown
   */

  let DropdownAttachBody = /*#__PURE__*/function (_AttachBody) {
    _inheritsLoose(DropdownAttachBody, _AttachBody);

    // Constructor
    function DropdownAttachBody(decorated, $element, options) {
      return _AttachBody.call(this, decorated, $element, options) || this;
    } // Override bind()

    var _proto = DropdownAttachBody.prototype;

    _proto.bind = function bind(decorated, container, $container) {
      var self = this;
      decorated.call(this, container, $container);
      container.on('open', function () {
        self._showDropdown(); // Must bind after the results handlers to ensure correct sizing

        self._bindContainerResultHandlers(container);
      });
      container.on('close', function () {
        self._hideDropdown();
      });
      this.$dropdownContainer.on('mousedown', function (evt) {
        evt.stopPropagation();
      });
    } // Override _showDropdown()
    ;

    _proto._showDropdown = function _showDropdown(decorated) {
      var _this$_popper;

      this.$dropdownContainer.appendTo(this.$dropdownParent);
      (_this$_popper = this._popper) != null ? _this$_popper : this._popper = Popper.createPopper(this.$element.parent().find('.select2-container')[0], this.$dropdownContainer[0], {
        placement: ew.IS_RTL ? 'bottom-end' : 'bottom-start'
      });

      this._positionDropdown();

      this._resizeDropdown();
    } // Override _positionDropdown()
    ;

    _proto._positionDropdown = function _positionDropdown() {
      var _this$_popper2;

      (_this$_popper2 = this._popper) == null ? void 0 : _this$_popper2.update();
    } // Override position()
    ;

    _proto.position = function position(decorated, $dropdown, $container) {
      // Clone all of the container classes
      $dropdown.attr('class', $container.attr('class'));
      $dropdown[0].classList.remove('select2');
      $dropdown[0].classList.add('select2-container--open');
      this.$container = $container;
    };

    // Override destroy()
    _proto.destroy = function destroy(decorated) {
      var _this$_popper3;

      _AttachBody.prototype.destroy.call(this, decorated);

      (_this$_popper3 = this._popper) == null ? void 0 : _this$_popper3.destroy();
      this._popper = null;
    };

    return DropdownAttachBody;
  }(AttachBody$1);

  let _defined$1 = $__default['default'].fn.select2.amd.require._defined,
      AllowClear$1 = _defined$1['select2/selection/allowClear'],
      Utils$1 = _defined$1['select2/utils'];
  /**
   * Select2 AttachBody for table header filter
   */

  let FilterAllowClear = /*#__PURE__*/function (_AllowClear) {
    _inheritsLoose(FilterAllowClear, _AllowClear);

    function FilterAllowClear() {
      return _AllowClear.apply(this, arguments) || this;
    }

    var _proto = FilterAllowClear.prototype;

    // Override _handleClear
    _proto._handleClear = function _handleClear(_, evt) {
      // Ignore the event if it is disabled
      if (this.isDisabled()) {
        return;
      }

      var $clear = this.$selection.find('.select2-selection__clear'); // Ignore the event if nothing has been selected

      if ($clear.length === 0) {
        return;
      }

      evt.stopPropagation();
      var data = Utils$1.GetData($clear[0], 'data');
      var previousVal = this.$element.val();
      this.$element.val(this.placeholder.id);
      var unselectData = {
        data: data
      };
      this.trigger('clear', unselectData);

      if (unselectData.prevented) {
        this.$element.val(previousVal);
        return;
      }

      for (var d = 0; d < data.length; d++) {
        unselectData = {
          data: data[d]
        }; // Trigger the `unselect` event, so people can prevent it from being
        // cleared.

        this.trigger('unselect', unselectData); // If the event was prevented, don't clear it out.

        if (unselectData.prevented) {
          this.$element.val(previousVal);
          return;
        }
      }

      this.$element.trigger('input').trigger('change'); //***this.trigger('toggle', {});
    };

    return FilterAllowClear;
  }(AllowClear$1);

  /**
   * Select2 decorator for MultipleSelection
   */
  let Select2MultipleSelectionDecorator = /*#__PURE__*/function () {
    function Select2MultipleSelectionDecorator() {}

    var _proto = Select2MultipleSelectionDecorator.prototype;

    _proto.bind = function bind(decorated, container, $container) {
      decorated.call(this, container, $container);
      this.$selection.on('click', '.select2-selection__choice__remove', function (evt) {
        evt.stopPropagation();
      });
    };

    return Select2MultipleSelectionDecorator;
  }();

  /**
   * Select2 decorator for SelectAdapter
   */
  let Select2DataAdapterDecorator = /*#__PURE__*/function () {
    function Select2DataAdapterDecorator() {}

    var _proto = Select2DataAdapterDecorator.prototype;

    _proto.option = function option(decorated, data) {
      var _data$element;

      var text = data.text,
          html = (_data$element = data.element) == null ? void 0 : _data$element.innerHTML,
          $option = decorated.call(this, data); // Check HTML

      if (text.startsWith('<') && text.endsWith('>')) $option.html(text);else if (html && html != text) $option.html(html);
      return $option;
    };

    return Select2DataAdapterDecorator;
  }();

  let _defined = $.fn.select2.amd.require._defined,
      ResultsList = _defined['select2/results'],
      SingleSelection = _defined['select2/selection/single'],
      MultipleSelection = _defined['select2/selection/multiple'],
      Placeholder = _defined['select2/selection/placeholder'],
      AllowClear = _defined['select2/selection/allowClear'],
      SelectionSearch = _defined['select2/selection/search'],
      EventRelay = _defined['select2/selection/eventRelay'],
      Utils = _defined['select2/utils'],
      Translation = _defined['select2/translation'],
      SelectData = _defined['select2/data/select'],
      ArrayData = _defined['select2/data/array'],
      AjaxData = _defined['select2/data/ajax'],
      Tags = _defined['select2/data/tags'],
      Tokenizer = _defined['select2/data/tokenizer'],
      MinimumInputLength = _defined['select2/data/minimumInputLength'],
      MaximumInputLength = _defined['select2/data/maximumInputLength'],
      MaximumSelectionLength = _defined['select2/data/maximumSelectionLength'],
      Dropdown = _defined['select2/dropdown'],
      DropdownSearch = _defined['select2/dropdown/search'],
      HidePlaceholder = _defined['select2/dropdown/hidePlaceholder'],
      InfiniteScroll = _defined['select2/dropdown/infiniteScroll'],
      AttachBody = _defined['select2/dropdown/attachBody'],
      MinimumResultsForSearch = _defined['select2/dropdown/minimumResultsForSearch'],
      SelectOnClose = _defined['select2/dropdown/selectOnClose'],
      CloseOnSelect = _defined['select2/dropdown/closeOnSelect'],
      DropdownCSS = _defined['select2/dropdown/dropdownCss'],
      TagsSearchHighlight = _defined['select2/dropdown/tagsSearchHighlight'],
      Defaults = _defined['select2/defaults']; // Override select2 Defaults

  Defaults.apply = function (options) {
    options = $.extend(true, {}, this.defaults, options);

    if (options.dataAdapter == null) {
      if (options.ajax != null) {
        options.dataAdapter = AjaxData;
      } else if (options.data != null) {
        options.dataAdapter = ArrayData;
      } else {
        options.dataAdapter = SelectData;
      }

      options.dataAdapter = Utils.Decorate( // Override
      options.dataAdapter, Select2DataAdapterDecorator);

      if (options.minimumInputLength > 0) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, MinimumInputLength);
      }

      if (options.maximumInputLength > 0) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, MaximumInputLength);
      }

      if (options.maximumSelectionLength > 0) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, MaximumSelectionLength);
      }

      if (options.tags) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, Tags);
      }

      if (options.tokenSeparators != null || options.tokenizer != null) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, Tokenizer);
      }
    }

    if (options.resultsAdapter == null) {
      options.resultsAdapter = ResultsList; // Override

      if (options.columns > 0 && options.customOption) {
        options.resultsAdapter = Utils.Decorate(options.resultsAdapter, Select2ResultsDecorator);

        if (options.iconClass && options.multiple && options.templateResult == ew.selectOptions.templateResult) {
          options._templateResult = options.templateResult;

          options.templateResult = result => result.loading ? result.text : '<div class="form-check-input ew-dropdown-check-input"></div><label class="' + options.iconClass + ' ew-dropdown-check-label">' + options._templateResult(result) + '</label>';
        }
      } else if (options.modal || options.filter) {
        options.resultsAdapter = Utils.Decorate(options.resultsAdapter, ModalResults);
      }

      if (options.ajax != null) {
        options.resultsAdapter = Utils.Decorate(options.resultsAdapter, InfiniteScroll);
      }

      if (options.placeholder != null) {
        options.resultsAdapter = Utils.Decorate(options.resultsAdapter, HidePlaceholder);
      }

      if (options.selectOnClose) {
        options.resultsAdapter = Utils.Decorate(options.resultsAdapter, SelectOnClose);
      }

      if (options.tags) {
        options.resultsAdapter = Utils.Decorate(options.resultsAdapter, TagsSearchHighlight);
      }
    }

    if (options.dropdownAdapter == null) {
      if (options.modal || options.filter) {
        options.dropdownAdapter = Utils.Decorate(Dropdown, DropdownSearch);
        options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, DropdownSearchDecorator);
        options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, ModalSearch);
      } else {
        options.dropdownAdapter = Dropdown;

        if (!options.multiple) {
          options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, DropdownSearch);
          options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, DropdownSearchDecorator);
        }
      }

      if (options.minimumResultsForSearch !== 0) {
        options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, MinimumResultsForSearch);
      }

      if (options.closeOnSelect) {
        options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, CloseOnSelect);
      }

      if (options.dropdownCssClass != null) {
        options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, DropdownCSS);
      }

      options.dropdownAdapter = Utils.Decorate(options.dropdownAdapter, options.modal ? ModalAttachBody : options.filter ? FilterAttachBody : options.dropdown ? DropdownAttachBody : AttachBody // Override
      );
    }

    if (options.selectionAdapter == null) {
      if (options.multiple) {
        options.selectionAdapter = MultipleSelection;
        options.selectionAdapter = Utils.Decorate( // Override
        options.selectionAdapter, Select2MultipleSelectionDecorator);
      } else {
        options.selectionAdapter = SingleSelection;
      } // Add the placeholder mixin if a placeholder was specified

      if (options.placeholder != null) {
        options.selectionAdapter = Utils.Decorate(options.selectionAdapter, Placeholder);
      }

      if (options.allowClear) {
        options.selectionAdapter = Utils.Decorate(options.selectionAdapter, options.filter ? FilterAllowClear : AllowClear);
      }

      if (options.multiple) {
        options.selectionAdapter = Utils.Decorate(options.selectionAdapter, SelectionSearch);
      }

      options.selectionAdapter = Utils.Decorate(options.selectionAdapter, EventRelay);
    }

    options.translations = new Translation(Select2Language);
    options.dir = ew.IS_RTL ? "rtl" : "ltr";
    return options;
  };

  let currentUrl = new URL(window.location);
  let forms = new Forms();
  let $document$1 = $__default['default'](document),
      $body = $__default['default']("body");
  let fieldContainerSelector = ".row, [id^=el_], [class^=el_]"; // Set focus

  Pace.on("done", () => {
    var _forms$get;

    let form = document.querySelector(".modal.show form.ew-form") || document.querySelector("form.ew-form");
    if (form) (_forms$get = forms.get(form.id)) == null ? void 0 : _forms$get.tryFocus();
  }); // Create select2

  function createSelect(options) {
    if (options.selectId.includes("$rowindex$")) return;

    if ($__default['default'].isObject(options.data)) {
      let lookup = new ew.AjaxLookup(options.data);
      options.data = lookup.options.map(item => {
        return {
          id: item.lf,
          text: lookup.formatResult({
            lf: item.lf,
            df: item.df,
            df2: item.df2,
            df3: item.df3,
            df4: item.df4
          })
        };
      });
    }

    if ($__default['default'].isObject(options.ajax)) {
      let limit = options.ajax.limit,
          lookup = new ew.AjaxLookup({ ...options.ajax,
        ...{
          action: "modal"
        }
      });
      options.ajax = {
        url: params => {
          let start = params.page ? (params.page - 1) * limit : -1;
          return lookup.getUrl(params.term, start);
        },
        type: "POST",
        dataType: "json",
        data: lookup.generateRequest.bind(lookup),
        delay: options.debounce,
        processResults: function (data) {
          var _data$records$length, _data$records;

          let self = this;
          return {
            results: lookup.transform(data).map(item => {
              return {
                id: item.lf,
                text: lookup.formatResult({
                  lf: item.lf,
                  df: item.df,
                  df2: item.df2,
                  df3: item.df3,
                  df4: item.df4
                })
              };
            }),
            pagination: {
              more: self.container.$results.find(".select2-results__option:not(.select2-results__option--load-more)").length + ((_data$records$length = (_data$records = data.records) == null ? void 0 : _data$records.length) != null ? _data$records$length : 0) < lookup.recordCount
            }
          };
        }
      };
    }

    let $select = $__default['default']("select[data-select2-id='" + options.selectId + "']").select2(options);
    $select.on("select2:open", function () {
      var _$$data$$dropdown$fin;

      (_$$data$$dropdown$fin = $__default['default'](this).data("select2").$dropdown.find(".select2-search__field")[0]) == null ? void 0 : _$$data$$dropdown$fin.focus();
    });

    if ($__default['default'].isObject(options.ajax)) {
      $select.on("select2:opening", function () {
        $__default['default'](this).data("select2").$results.find(".select2-results__option:not(.loading-results)").remove();
      });
    }

    if (options.minimumResultsForSearch === Infinity) {
      $select.on("select2:opening select2:closing", function () {
        $__default['default'](this).data("select2").$dropdown.find(".select2-search--dropdown").addClass("select2-search--hide");
      });
    }
  } // Create modal lookup

  function createModalLookup(options) {
    if (options.selectId.includes("$rowindex$")) return;

    if ($__default['default'].isObject(options.data)) {
      let lookup = new ew.AjaxLookup(options.data);
      options.data = lookup.options.map(item => {
        return {
          id: item.lf,
          text: lookup.formatResult({
            lf: item.lf,
            df: item.df,
            df2: item.df2,
            df3: item.df3,
            df4: item.df4
          })
        };
      });
    }

    if ($__default['default'].isObject(options.ajax)) {
      let limit = options.ajax.limit,
          lookup = new ew.AjaxLookup({ ...options.ajax,
        ...{
          action: "modal"
        }
      });
      options.ajax = {
        url: params => {
          let start = params.page ? (params.page - 1) * limit : -1;
          return lookup.getUrl(params.term, start);
        },
        type: "POST",
        dataType: "json",
        data: lookup.generateRequest.bind(lookup),
        delay: options.debounce,
        processResults: function (data) {
          var _data$records$length2, _data$records2;

          let self = this;
          return {
            results: lookup.transform(data).map(item => {
              return {
                id: item.lf,
                text: lookup.formatResult({
                  lf: item.lf,
                  df: item.df,
                  df2: item.df2,
                  df3: item.df3,
                  df4: item.df4
                })
              };
            }),
            pagination: {
              more: self.container.$results.find(".select2-results__option:not(.select2-results__option--load-more)").length + ((_data$records$length2 = (_data$records2 = data.records) == null ? void 0 : _data$records2.length) != null ? _data$records$length2 : 0) < lookup.recordCount
            }
          };
        }
      };
    }

    let $select = $__default['default']("select[data-select2-id='" + options.selectId + "']").select2(options);
    $select.on("select2:open", function () {
      var _$$data$$dropdown$fin2;

      (_$$data$$dropdown$fin2 = $__default['default'](this).data("select2").$dropdown.find(".select2-search__field").addClass("form-control")[0]) == null ? void 0 : _$$data$$dropdown$fin2.focus();
    });

    if ($__default['default'].isObject(options.ajax)) {
      $select.on("select2:opening", function () {
        $__default['default'](this).data("select2").$results.find(".select2-results__option:not(.loading-results)").remove();
      });
    }
  } // Create table header filter

  function createFilter(options) {
    if (options.selectId.includes("$rowindex$")) return;

    if ($__default['default'].isObject(options.data)) {
      let lookup = new ew.AjaxLookup(options.data);
      options.data = lookup.options.map(item => {
        return {
          id: item.lf,
          text: lookup.formatResult({
            lf: item.lf,
            df: item.df,
            df2: item.df2,
            df3: item.df3,
            df4: item.df4
          })
        };
      });
    }

    if ($__default['default'].isObject(options.ajax)) {
      let limit = options.ajax.limit,
          lookup = new ew.AjaxLookup({ ...options.ajax,
        ...{
          action: "modal"
        }
      });
      options.ajax = {
        url: params => {
          let start = params.page ? (params.page - 1) * limit : -1;
          return lookup.getUrl(params.term, start);
        },
        type: "POST",
        dataType: "json",
        data: lookup.generateRequest.bind(lookup),
        delay: options.debounce,
        processResults: function (data) {
          var _data$records$length3, _data$records3;

          let self = this;
          return {
            results: lookup.transform(data).map(item => {
              return {
                id: item.lf,
                text: lookup.formatResult({
                  lf: item.lf,
                  df: item.df,
                  df2: item.df2,
                  df3: item.df3,
                  df4: item.df4
                })
              };
            }),
            pagination: {
              more: self.container.$results.find(".select2-results__option:not(.select2-results__option--load-more)").length + ((_data$records$length3 = (_data$records3 = data.records) == null ? void 0 : _data$records3.length) != null ? _data$records$length3 : 0) < lookup.recordCount
            }
          };
        }
      };
    }

    let $select = $__default['default']("select[data-select2-id='" + options.selectId + "']").select2(options);
    $select.on("select2:open", function () {
      var _$$data$$dropdown$fin3;

      (_$$data$$dropdown$fin3 = $__default['default'](this).data("select2").$dropdown.find(".select2-search__field").addClass("form-control")[0]) == null ? void 0 : _$$data$$dropdown$fin3.focus({
        preventScroll: options.preventScroll
      }); // Do not scroll on focus by default
    });

    if ($__default['default'].isObject(options.ajax)) {
      $select.on("select2:opening", function () {
        $__default['default'](this).data("select2").$results.find(".select2-results__option:not(.loading-results)").remove();
      });
    }
  } // Init icon tooltip

  function initIcons(e) {
    var _e$target;

    let el = (_e$target = e == null ? void 0 : e.target) != null ? _e$target : document,
        tooltipOptions = {
      container: "body",
      trigger: ew.IS_MOBILE ? "manual" : "hover",
      placement: "bottom",
      sanitizeFn: ew.sanitizeFn
    };
    $__default['default'](el).find(".ew-icon").closest(".btn").each(function () {
      let $this = $__default['default'](this);

      if ($this.hasClass("dropdown-toggle")) {
        let $p = $this.closest(".btn-group");

        if ($p.children(".btn").length == 1) {
          $p.tooltip({
            title: this.title,
            ...tooltipOptions
          }).on("mouseleave", e => {
            var _bootstrap$Tooltip$ge;

            return (_bootstrap$Tooltip$ge = bootstrap.Tooltip.getInstance(e.currentTarget)) == null ? void 0 : _bootstrap$Tooltip$ge.hide();
          });
          $this.next(".dropdown-menu").on("mouseover", e => e.stopPropagation());
        }
      } else {
        $this.tooltip(tooltipOptions);
      }
    });
  } // Init password options

  function initPasswordOptions(e) {
    var _e$target2;

    var el = (_e$target2 = e == null ? void 0 : e.target) != null ? _e$target2 : document;

    if ($__default['default'].fn.pStrength && typeof ew.MIN_PASSWORD_STRENGTH != "undefined") {
      $__default['default'](el).find(".ew-password-strength").each(function () {
        var $this = $__default['default'](this);
        if (!$this.data("pStrength")) $this.pStrength({
          "changeBackground": false,
          "backgrounds": [],
          "passwordValidFrom": ew.MIN_PASSWORD_STRENGTH,
          "onPasswordStrengthChanged": function (strength, percentage) {
            var $pst = $__default['default']("[id='" + this.attr("data-password-strength") + "']"),
                // Do not use #
            $pb = $pst.find(".progress-bar");

            if (this.val() && !ew.isMaskedPassword(this)) {
              var pct = percentage + "%",
                  min = ew.MIN_PASSWORD_STRENGTH,
                  valid = percentage >= min;

              if (percentage < min * 0.25) {
                $pb.addClass("bg-danger").removeClass("bg-warning bg-info bg-success");
              } else if (percentage < min * 0.5) {
                $pb.addClass("bg-warning").removeClass("bg-danger bg-info bg-success");
              } else if (percentage < min * 0.75) {
                $pb.addClass("bg-primary").removeClass("bg-danger bg-warning bg-success");
              } else {
                $pb.addClass("bg-success").removeClass("bg-danger bg-warning bg-info");
              }

              $pb.css("width", pct);
              if (percentage > min * 0.5) pct = ew.language.phrase("PasswordStrength").replace("%p", pct);
              $pb.html(pct);
              $pst.removeClass("d-none");
              this.data("validated", valid);
              if (valid) setValid(this[0]);
            } else {
              $pst.addClass("d-none");
              this.data("validated", null);
            }

            $pst.width(this.outerWidth());
          }
        });
      });
    }

    if ($__default['default'].fn.pGenerator) {
      $__default['default'](el).find(".ew-password-generator").each(function () {
        var $this = $__default['default'](this);
        if (!$this.data("pGenerator")) $this.pGenerator({
          "passwordLength": ew.GENERATE_PASSWORD_LENGTH,
          "uppercase": ew.GENERATE_PASSWORD_UPPERCASE,
          "lowercase": ew.GENERATE_PASSWORD_LOWERCASE,
          "numbers": ew.GENERATE_PASSWORD_NUMBER,
          "specialChars": ew.GENERATE_PASSWORD_SPECIALCHARS,
          "onPasswordGenerated": function (pwd) {
            $__default['default']("#" + this.attr("data-password-confirm")).val(pwd);
            $__default['default']("#" + this.attr("data-password-field")).val(pwd).trigger("change").trigger("focus").triggerHandler("click"); // Trigger click to remove "is-invalid" class (Do not use $this.data)
          }
        });
      });
    }
  }
  /**
   * Get API action URL
   * @param {string|string[]} action - Route as string or array, e.g. "foo", ["foo", "1"]
   * @param {string|string[]|object} query - Search params, e.g. "foo=1&bar=2", [["foo", "1"], ["bar", "2"]], {"foo": "1", "bar": "2"}
   */

  function getApiUrl(action, query) {
    var url = ew.PATH_BASE + ew.API_URL,
        params = new URLSearchParams(query),
        qs = params.toString();

    if ($__default['default'].isString(action)) {
      // Route as string
      url += action ? action : "";
    } else if (Array.isArray(action)) {
      // Route as array
      var route = action.map(function (v) {
        return encodeURIComponent(v);
      }).join("/");
      url += route ? route : "";
    }

    return url + (qs ? "?" + qs : "");
  } // Sanitize URL

  function sanitizeUrl(url) {
    var ar = url.split("?"),
        search = ar[1];

    if (search) {
      var searchParams = new URLSearchParams(search);
      searchParams.forEach((value, key) => {
        value = decodeURIComponent(value);
        if (["<>", "<=", ">=", ">", "<"].includes(value)) searchParams.set(key, value);else searchParams.set(key, ew.sanitize(value));
      });
      search = searchParams.toString();
    }

    return ar[0] + (search ? "?" + search : "");
  } // Set session timer

  function setSessionTimer() {
    var timeoutTime,
        timer,
        keepAliveTimer,
        counter,
        useKeepAlive = ew.SESSION_KEEP_ALIVE_INTERVAL > 0 || ew.IS_LOGGEDIN && ew.IS_AUTOLOGIN; // Keep alive

    var keepAlive = () => {
      $__default['default'].get(getApiUrl(ew.API_SESSION_ACTION), {
        "rnd": random()
      }, token => {
        if (token && $__default['default'].isObject(token)) {
          // PHP
          ew.TOKEN_NAME = token[ew.TOKEN_NAME_KEY];
          ew.ANTIFORGERY_TOKEN = token[ew.ANTIFORGERY_TOKEN_KEY];
          if (token["JWT"]) ew.API_JWT_TOKEN = token["JWT"];
        }
      });
    }; // Reset timer

    var resetTimer = () => {
      counter = ew.SESSION_TIMEOUT_COUNTDOWN;
      timeoutTime = ew.SESSION_TIMEOUT - ew.SESSION_TIMEOUT_COUNTDOWN;

      if (timeoutTime < 0) {
        // Timeout now
        timeoutTime = 0;
        counter = ew.SESSION_TIMEOUT;
      }

      if (timer) timer.cancel(); // Clear timer
    }; // Timeout

    var timeout = () => {
      if (keepAliveTimer) keepAliveTimer.cancel(); // Stop keep alive

      if (counter > 0) {
        let timerInterval;
        let message = '<p class="text-danger">' + ew.language.phrase("SessionWillExpire") + '</p>';

        if (message.includes("%m") && message.includes("%s")) {
          message = message.replace("%m", '<span class="ew-session-counter-minute">' + Math.floor(counter / 60) + '</span>');
          message = message.replace("%s", '<span class="ew-session-counter-second">' + counter % 60 + '</span>');
        } else if (message.includes("%s")) {
          message = message.replace("%s", '<span class="ew-session-counter-second">' + counter + '</span>');
        }

        Swal.fire({ ...ew.sweetAlertSettings,
          html: message,
          showConfirmButton: true,
          confirmButtonText: ew.language.phrase("OKBtn"),
          timer: counter * 1000,
          timerProgressBar: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          willOpen: () => {
            timerInterval = setInterval(() => {
              let content = Swal.getHtmlContainer(),
                  min = content.querySelector(".ew-session-counter-minute"),
                  sec = content.querySelector(".ew-session-counter-second"),
                  timeleft = Math.round(Swal.getTimerLeft() / 1000);

              if (min && sec) {
                min.textContent = Math.floor(timeleft / 60);
                sec.textContent = timeleft % 60;
              } else if (sec) {
                sec.textContent = timeleft;
              }
            }, 1000);
          },
          willClose: () => {
            clearInterval(timerInterval);
          }
        }).then(result => {
          if (result.value) {
            // OK button pressed
            keepAlive();
            if (!useKeepAlive && ew.SESSION_TIMEOUT > 0) setTimer();
          } else if (result.dismiss === Swal.DismissReason.timer) {
            // Timeout
            resetTimer();
            window.location = sanitizeUrl(ew.TIMEOUT_URL + "?expired=1");
          }
        });
      }
    }; // Set timer

    var setTimer = () => {
      resetTimer(); // Reset timer first

      timer = $__default['default'].later(timeoutTime * 1000, null, timeout);
    };

    if (useKeepAlive) {
      // Keep alive
      var keepAliveInterval = ew.SESSION_KEEP_ALIVE_INTERVAL > 0 ? ew.SESSION_KEEP_ALIVE_INTERVAL : ew.SESSION_TIMEOUT - ew.SESSION_TIMEOUT_COUNTDOWN;
      if (keepAliveInterval <= 0) keepAliveInterval = 60;
      keepAliveTimer = $__default['default'].later(keepAliveInterval * 1000, null, keepAlive, null, true); // Periodic
    } else {
      if (ew.SESSION_TIMEOUT > 0) // Set session timeout
        setTimer();
    }
  } // Init export links

  function initExportLinks(e) {
    var _e$target3;

    var el = (_e$target3 = e == null ? void 0 : e.target) != null ? _e$target3 : document;
    $__default['default'](el).find("a.ew-export-link[href]:not(.ew-email):not(.ew-print):not(.ew-xml)").on("click", function (e) {
      var href = this.href;
      if (href && href != "#") fileDownload(href);
      e.preventDefault();
    });
  } // Init multi-select checkboxes

  function initMultiSelectCheckboxes(e) {
    var _e$target4;

    var el = (_e$target4 = e == null ? void 0 : e.target) != null ? _e$target4 : document,
        $el = $__default['default'](el),
        $cbs = $el.find("input[type=checkbox].ew-multi-select");

    var _update = function (id) {
      var $els = $cbs.filter("[name^='" + id + "_']"),
          cnt = $els.length,
          len = $els.filter(":checked").length;
      $__default['default']("input[type=checkbox]#" + id).prop("checked", len == cnt).prop("indeterminate", len != cnt && len != 0);
    };

    $cbs.on("click", e => _update(e.target.name.split("_")[0]));
    $el.find("input[type=checkbox].ew-priv:not(.ew-multi-select)").each((i, el) => _update(el.id)); // Init
  } // Download file

  function fileDownload(href, data) {
    let isHtml = href.includes("export=html");
    return Swal.fire({ ...ew.sweetAlertSettings,
      showConfirmButton: false,
      html: "<p>" + ew.language.phrase("Exporting") + "</p>",
      allowOutsideClick: false,
      allowEscapeKey: false,
      willOpen: () => {
        Swal.showLoading();
        $__default['default'].ajax({
          url: href,
          type: data ? "POST" : "GET",
          cache: false,
          data: data || null,
          xhrFields: {
            responseType: isHtml ? "text" : "blob"
          }
        }).done((data, textStatus, jqXHR) => {
          var url = URL.createObjectURL(isHtml ? new Blob([data], {
            type: "text/html"
          }) : data),
              a = document.createElement("a"),
              cd = jqXHR.getResponseHeader("Content-Disposition"),
              m = cd.match(/\bfilename=((['"])(.+)\2|([^;]+))/i);
          a.style.display = "none";
          a.href = url;
          if (m) a.download = m[3] || m[4];
          document.body.appendChild(a);
          a.click();
          $document$1.trigger("export", [{
            "type": "done",
            "url": href,
            "objectUrl": url
          }]);
          URL.revokeObjectURL(url);
          Swal.close();
        }).fail((jqXHR, textStatus, errorThrown) => {
          var _Swal$getActions;

          Swal.hideLoading();
          Swal.update({
            showConfirmButton: true
          });
          (_Swal$getActions = Swal.getActions()) == null ? void 0 : _Swal$getActions.classList.add("d-flex");
          Swal.showValidationMessage("<div class='text-danger'>" + (errorThrown || ew.language.phrase("FailedToExport")) + "</div>");
          $document$1.trigger("export", [{
            "type": "fail",
            "url": href
          }]);
        }).always(() => {
          $document$1.trigger("export", [{
            "type": "always",
            "url": href
          }]);
        });
      }
    });
  } // Lazy load images

  function lazyLoad(e) {
    var _e$target5;

    if (!ew.LAZY_LOAD) return;
    var el = (_e$target5 = e == null ? void 0 : e.target) != null ? _e$target5 : document;
    el.querySelectorAll("img.ew-lazy").forEach((img, i) => {
      if (ew.LAZY_LOAD_DELAY > 0) setTimeout(() => img.src = img.dataset.src, i * ew.LAZY_LOAD_DELAY);else img.src = img.dataset.src;
    });
    $document$1.trigger("lazyload"); // All images loaded
  } // Update select2 dropdown position

  function updateDropdownPosition() {
    var select = $__default['default'](".select2-container--open").prev(".ew-select").data("select2");

    if (select) {
      select.dropdown._positionDropdown();

      select.dropdown._resizeDropdown();
    }
  } // Colorboxes

  function initLightboxes(e) {
    var _e$target6;

    if (!ew.USE_COLORBOX) return;
    var el = (_e$target6 = e == null ? void 0 : e.target) != null ? _e$target6 : document;
    var settings = Object.assign({}, ew.lightboxSettings, {
      title: ew.language.phrase("LightboxTitle"),
      current: ew.language.phrase("LightboxCurrent"),
      previous: ew.language.phrase("LightboxPrevious"),
      next: ew.language.phrase("LightboxNext"),
      close: ew.language.phrase("LightboxClose"),
      xhrError: ew.language.phrase("LightboxXhrError"),
      imgError: ew.language.phrase("LightboxImgError")
    });
    $__default['default'](el).find(".ew-lightbox").each(function () {
      var $this = $__default['default'](this);
      $this.colorbox(Object.assign({
        rel: $this.data("rel")
      }, settings));
    });
  } // PDFObjects

  function initPdfObjects(e) {
    var _e$target7;

    if (!ew.EMBED_PDF) return;
    var el = (_e$target7 = e == null ? void 0 : e.target) != null ? _e$target7 : document,
        options = Object.assign({}, ew.PDFObjectOptions);
    $__default['default'](el).find(".ew-pdfobject").not(":has(.pdfobject)").each(function () {
      // Not already embedded
      var $this = $__default['default'](this),
          url = $this.data("url"),
          html = $this.html();
      if (url) PDFObject.embed(url, this, Object.assign(options, {
        fallbackLink: html
      }));
    });
  } // Tooltips and popovers

  function initTooltips(e) {
    var _e$target8;

    var el = (_e$target8 = e == null ? void 0 : e.target) != null ? _e$target8 : document,
        $el = $__default['default'](el);
    $el.find("input[data-bs-toggle=tooltip],textarea[data-bs-toggle=tooltip],select[data-bs-toggle=tooltip]").each(function () {
      var $this = $__default['default'](this);
      $this.tooltip(Object.assign({
        html: true,
        placement: "bottom",
        sanitizeFn: ew.sanitizeFn
      }, $this.data()));
    });
    $el.find("a.ew-tooltip-link").each(tooltip); // Init tooltips

    $el.find(".ew-tooltip").tooltip({
      placement: "bottom",
      sanitizeFn: ew.sanitizeFn
    });
    $el.find(".ew-popover").popover({
      sanitizeFn: ew.sanitizeFn
    });
  } // Parse JSON

  function parseJson(data) {
    if ($__default['default'].isString(data)) {
      try {
        return JSON.parse(data);
      } catch (e) {
        return undefined;
      }
    }

    return data;
  } // Change search operator

  function searchOperatorChanged(el) {
    var $el = $__default['default'](el),
        $p = $el.closest("[id^=r_], [id^=xs_]"),
        parm = el.id.substr(2),
        $fld = $p.find(".ew-search-field"),
        $fld2 = $p.find(".ew-search-field2"),
        $y = $fld2.find("[name='y_" + parm + "'], [name='y_" + parm + "[]']"),
        hasY = $y.length,
        $cond = $p.find(".ew-search-cond"),
        hasCond = $cond.length,
        // Has condition and operator 2
    $and = $p.find(".ew-search-and"),
        $opr = $p.find(".ew-search-operator"),
        opr = $opr.find("[name='z_" + parm + "']").val(),
        $opr2 = $p.find(".ew-search-operator2"),
        opr2 = $opr2.find("[name='w_" + parm + "']").val(),
        isBetween = opr == "BETWEEN",
        // Can only be operator 1
    isNullOpr = ["IS NULL", "IS NOT NULL"].includes(opr),
        isNullOpr2 = ["IS NULL", "IS NOT NULL"].includes(opr2),
        hideOpr2 = !hasY || isBetween,
        hideX = isNullOpr,
        hideY = !isBetween && (!hasCond || isNullOpr2);
    $cond.toggleClass("d-none", hideOpr2).find(":input").prop("disabled", hideOpr2);
    $and.toggleClass("d-none", !isBetween);
    $opr2.toggleClass("d-none", hideOpr2).find(":input").prop("disabled", hideOpr2);
    $fld.toggleClass("d-none", hideX).find(":input").prop("disabled", hideX);
    $fld2.toggleClass("d-none", hideY).find(":input").prop("disabled", hideY);
  } // Init forms

  function initForms(e) {
    var _e$target9;

    let el = (_e$target9 = e == null ? void 0 : e.target) != null ? _e$target9 : document,
        $el = $__default['default'](el),
        ids = ew.forms.ids();

    for (let id of ids) {
      if ($el.find("#" + id)) forms.get(id).init();
    }
  } // Is function

  function isFunction$2(x) {
    return typeof x === "function";
  }
  /**
   * Alert (OK button only)
   *
   * @param {string} msg - Message
   * @param {callback} [cb] - Callback function
   * @param {string} [type] - CSS class (see https://getbootstrap.com/docs/5.0/utilities/colors/#color)
   * @returns {Promise}
   */

  function _alert(msg, cb, type) {
    let config = $__default['default'].isObject(msg) ? msg : {};
    msg = $__default['default'].isString(msg) ? msg : "";
    type = $__default['default'].isString(cb) ? cb : type;
    config = $__default['default'].extend(true, {}, ew.sweetAlertSettings, {
      html: msg,
      confirmButtonText: ew.language.phrase("OKBtn"),
      customClass: {
        htmlContainer: "ew-swal2-html-container text-" + (type || "danger")
      }
    }, config);
    let args = {
      config,
      type,
      show: true
    };
    $document$1.trigger("alert", [args]);
    if (args.show) return Swal.fire(args.config).then(result => isFunction$2(cb) ? cb(result.isConfirmed) : result);
  }
  /**
   * Prompt/Confirm/Alert
   *
   * @param {string|Object} cfg - Message or config object
   * @param {callback} [cb] - Callback function
   * @returns {Promise}
   */

  function _prompt(cfg, cb) {
    var _config, _config$inputValidato;

    let config = $__default['default'].isObject(cfg) ? cfg : {};
    config = $__default['default'].extend(true, {}, ew.sweetAlertSettings, {
      html: $__default['default'].isString(cfg) ? cfg : "",
      showCancelButton: true,
      confirmButtonText: ew.language.phrase("OKBtn"),
      cancelButtonText: ew.language.phrase("CancelBtn")
    }, config); // Confirm/Alert

    if (config.input) // Prompt
      (_config$inputValidato = (_config = config).inputValidator) != null ? _config$inputValidato : _config.inputValidator = value => {
        if (!value) return ew.language.phrase("EnterValue");
      };
    return Swal.fire(config).then(result => isFunction$2(cb) ? cb(result.value) : result);
  }

  function toast(options) {
    options = Object.assign({}, ew.toastOptions, options);
    $document$1.Toasts("create", options);
    var position = options.position,
        $container = $__default['default']("#toastsContainer" + position[0].toUpperCase() + position.substring(1));
    return $container.children().first();
  }
  /**
   * Show toast
   *
   * @param {string} message - Message
   * @param {string} type - CSS class: "muted|primary|success|info|warning|danger"
   */

  function showToast(message, type) {
    if (!message) return;
    type = type || "danger";
    let args = {
      message,
      type,
      show: true
    };
    $document$1.trigger("toast", [args]);
    if (!args.show) return;
    ({
      message,
      type
    } = args);
    return toast({
      class: "ew-toast bg-" + type,
      title: ew.language.phrase(type),
      body: message,
      autohide: type == "success" ? ew.autoHideSuccessMessage : false,
      // Autohide for success message
      delay: type == "success" ? ew.autoHideSuccessMessageDelay : 500
    });
  } // Get form.ew-form or div.ew-form HTML element

  function getForm(el) {
    if (el instanceof Form) return el.$element[0];
    var $el = $__default['default'](el),
        $f = $el.closest(".ew-form");
    if (!$f[0]) // Element not inside form
      $f = $el.closest(".ew-grid, .ew-multi-column-grid").find(".ew-form").not(".ew-pager-form");
    return $f[0];
  } // Check form data

  function hasFormData(form) {
    var selector = "[name^=x_],[name^=y_],[name^=z_],[name^=w_],[name=psearch]",
        els = $__default['default'](form).find(selector).filter(":enabled").get();

    for (var i = 0, len = els.length; i < len; i++) {
      var el = els[i];

      if (/^(z|w)_/.test(el.name)) {
        if (/^IS/.test($__default['default'](el).val())) return true;
      } else if (el.type == "checkbox" || el.type == "radio") {
        if (el.checked) return true;
      } else if (el.type == "select-one" || el.type == "select-multiple") {
        if (!!$__default['default'](el).val()) return true;
      } else if (el.type == "text" || el.type == "hidden" || el.type == "textarea") {
        if (el.value) return true;
      }
    }

    return false;
  }
  /**
   * Set search type
   *
   * @param {HTMLElement} el - HTML element
   * @returns false
   */

  function setSearchType(el) {
    var val = el.dataset.searchType,
        phraseId = "Auto";
    if (val == "=") phraseId = "Exact";else if (val == "AND") phraseId = "All";else if (val == "OR") phraseId = "Any";
    el.closest(".ew-basic-search").querySelector("input.ew-basic-search-type").value = val || "";
    el.closest(".dropdown-menu").querySelectorAll(".dropdown-item").forEach(item => item.classList.remove("active"));
    el.closest(".dropdown-item").classList.add("active");
    var searchType = el.closest(".input-group").querySelector("#searchtype"),
        text = ew.language.phrase("QuickSearch" + phraseId + "Short");
    searchType.innerHTML = text;
    searchType.classList.toggle("me-2", !!text);
    return false;
  }
  /**
   * Update a dynamic selection list
   *
   * @this {Form|HTMLElement} Form or parent element
   * @param {(HTMLElement|HTMLElement[]|string|string[])} obj - Target HTML element(s) or the ID of the element(s)
   * @param {(string[]|array[])} parentId - Parent field element names or data
   * @param {(boolean|null)} async - async(true) or sync(false) or non-Ajax(null)
   * @param {boolean} change - Trigger onchange event
   * @returns {Promise}
   */

  function updateOptions(obj, parentId, async, change) {
    var _batch$send;

    var f = this.$element ? this.$element[0] : this.form ? this.form : null; // Get form/div element from this

    if (!f) return;
    var frm = this.htmlForm ? this : forms.get(f.id); // Get Form object

    if (!frm) return;
    if (this.form && $__default['default'].isUndefined(obj)) // Target unspecified
      obj = forms.get(this).getList(this.name || this.id).childFields.slice(); // Clone
    else if ($__default['default'].isString(obj)) obj = getElements(obj, f);
    if (!obj || Array.isArray(obj) && obj.length == 0) return;
    var self = this,
        batch = new Batch();

    if (Array.isArray(obj) && $__default['default'].isString(obj[0])) {
      // Array of id
      var els = [];

      for (var i = 0, len = obj.length; i < len; i++) {
        var ar = obj[i].split(" ");

        if (ar.length == 1 && self.form) {
          // Parent/Child fields in the same table
          var m = getId(self, false).match(/^([xy]\d*_)/);
          if (m) obj[i] = obj[i].replace(/^([xy]\d*_)/, m[1]);
        }

        var el = getElements(obj[i], f),
            names = [];
        if (isTextbox(el) || isFilter(el)) // Search text box or filter
          continue;
        els.push(el);

        if (ar.length == 2 && Array.isArray(el)) {
          // Check if id is "tblvar fldvar" and multiple inputs
          var $el = $__default['default'](el);
          $el.each(function () {
            if (!names.includes(this.name)) {
              names.push(this.name);
              var $elf = $el.filter("[name='" + this.name + "']"),
                  typ = $elf.attr("type"),
                  elf = ["radio", "checkbox"].includes(typ) ? $elf.get() : $elf[0];
              batch.add(_updateOptions.bind(self, elf, parentId, async, change));
            }
          });
        } else {
          batch.add(_updateOptions.bind(self, el, parentId, async, change));
        }
      }

      obj = els;
      var list = forms.get(self).getList(self.name || self.id);
      if (Array.isArray(list == null ? void 0 : list.autoFillTargetFields) && list.autoFillTargetFields[0]) // AutoFill
        batch.add(autoFill.bind(null, self));
    } else {
      if (isTextbox(obj) || isFilter(obj)) // Search text box or filter
        return;
      batch.add(_updateOptions.bind(self, obj, parentId, async, change));
    }

    return (_batch$send = batch.send({
      url: ew.getApiUrl(ew.API_LOOKUP_ACTION)
    })) == null ? void 0 : _batch$send.then(function () {
      $document$1.trigger("updatedone", [{
        source: self,
        target: obj
      }]); // Document "updatedone" event fired after all the target elements are updated
    });
  }
  /**
   * Update a dynamic selection list
   *
   * @param {(HTMLElement|HTMLElement[]} obj - Target HTML element(s) or the ID of the element(s)
   * @param {(string[]|array[])} parentId - Parent field element names or data
   * @param {(boolean|null)} async - async(true) or sync(false) or non-Ajax(null)
   * @param {boolean} change - Trigger onchange event
   * @returns {Promise}
   */

  function _updateOptions(obj, parentId, async, change) {
    var id = getId(obj, false);
    if (!id) return;
    var fo = getForm(obj); // Get form/div element from obj

    if (!fo || !fo.id) return;
    var frmo = forms.get(fo.id);
    if (!frmo) return;
    var self = this,
        args = Array.from(arguments),
        ar = getOptionValues(obj),
        m = id.match(/^([xy])(\d*)_/),
        prefix = m ? m[1] : "",
        rowindex = m ? m[2] : "",
        arp = [],
        list = frmo.getList(id),
        $obj = $__default['default'](obj).data("updating", true);
    if ($obj.data("hidden")) // Skip data-hidden field, e.g. detail key
      return;

    if ($__default['default'].isUndefined(parentId)) {
      // Parent IDs not specified, use default
      parentId = list.parentFields.slice(); // Clone

      if (rowindex != "") {
        for (var i = 0, len = parentId.length; i < len; i++) {
          var arr = parentId[i].split(" ");
          if (arr.length == 1) // Parent field in the same table, add row index
            parentId[i] = parentId[i].replace(/^x_/, "x" + rowindex + "_");
        }
      }
    }

    if (Array.isArray(parentId) && parentId.length > 0) {
      if (Array.isArray(parentId[0])) {
        // Array of array => data
        arp = parentId;
      } else if ($__default['default'].isString(parentId[0])) {
        // Array of string => Parent IDs
        for (var i = 0, len = parentId.length; i < len; i++) arp.push(getOptionValues(parentId[i], fo));
      }
    }

    if (!isAutoSuggest(obj)) // Do not clear Auto-Suggest
      clearOptions(obj);

    var addOpt = function (results) {
      var name = getId(obj);
      results.forEach(function (result) {
        let args = {
          "data": result,
          "parents": arp,
          "valid": true,
          "name": name,
          "form": fo
        };
        $document$1.trigger("addoption", [args]);
        if (args.valid) newOption(obj, result, fo);
      });
      if (obj.list) obj.render();
      selectOption(obj, ar);

      if (change !== false) {
        if (!obj.options && obj.length) $obj.first().triggerHandler("click");else $obj.first().trigger("change");
      }
    };

    if ($__default['default'].isUndefined(async)) // Async not specified, use default
      async = list.ajax;

    var _updateSibling = function () {
      // Update the y_* element
      if (/(s(ea)?rch|summary|crosstab)$/.test(fo.id) && prefix == "x" && !rowindex) {
        // Search form
        args[0] = id.replace(/^x_/, "y_");
        updateOptions.apply(self, args); // args[0] is string, use updateOptions()
      }
    };

    if (!$__default['default'].isBoolean(async) || Array.isArray(list.lookupOptions) && list.lookupOptions.length > 0) {
      // Non-Ajax or Options loaded
      var ds = list.lookupOptions;
      addOpt(ds);

      _updateSibling();

      return ds;
    } else {
      // Ajax
      var name = getId(obj),
          data = Object.assign({
        page: list.page,
        field: list.field,
        ajax: "updateoption",
        language: ew.LANGUAGE_ID,
        name: name // Name of the target element

      }, getUserParams("#p_" + id, fo)); // Add user parameters

      if (isAutoSuggest(obj) && self.htmlForm) // Auto-Suggest (init form or auto-fill)
        data["v0"] = ar[0] || random(); // Filter by the current value
      else if (obj.options && obj.tagName != "SELECTION-LIST" && !obj.classList.contains("form-select") || // Not <selection-list> or native <select>
      isModalLookup(obj)) // Lookup
        data["v0"] = ar[0] ? obj.multiple ? ar.join(ew.MULTIPLE_OPTION_SEPARATOR) : ar[0] : random(); // Filter by the current value

      for (var i = 0, cnt = arp.length; i < cnt; i++) // Filter by parent fields
      data["v" + (i + 1)] = arp[i].join(ew.MULTIPLE_OPTION_SEPARATOR);

      return $__default['default'].ajax(getApiUrl(ew.API_LOOKUP_ACTION), {
        method: "POST",
        dataType: "json",
        data: data,
        async: async,
        processData: false,
        success: result => {
          var ds = result.records || [];
          addOpt(ds);

          _updateSibling();

          $obj.first().trigger("updated", [Object.assign({}, result, {
            target: obj
          })]); // Object "updated" event fired after the object is updated

          return ds;
        },
        complete: () => $obj.data("updating", false)
      });
    }
  } // Get user parameters from id

  function getUserParams(id, root) {
    var id = id.replace(/\[\]$/, ""),
        o = {};
    var root = !$__default['default'].isString(root) ? root : /^#/.test(root) ? root : "#" + root;
    var $els = root ? $__default['default'](root).find(id) : $__default['default'](id);
    var val = $els.val();

    if (val) {
      var params = new URLSearchParams(val);
      params.forEach(function (value, key) {
        o[key] = value;
      });
    }

    return o;
  } // Apply client side template to a DIV

  function applyTemplate(divId, tmplId, classId, exportType, data) {
    // Note: classId = fileName
    var args = {
      "data": data || {},
      "id": divId,
      "template": tmplId,
      "class": classId,
      "export": exportType,
      "enabled": true
    };
    $document$1.trigger("rendertemplate", [args]);

    if (args.enabled) {
      var _document$getElementB;

      var template = (_document$getElementB = document.getElementById(tmplId)) == null ? void 0 : _document$getElementB.content;
      if (!template) return;
      template.querySelectorAll(".ew-slot").forEach(el => {
        var subtmpl = document.getElementById(el.name || el.id);

        if (subtmpl != null && subtmpl.content) {
          if (el.dataset.rowspan > 1) Array.prototype.slice.call(subtmpl.content.childNodes).forEach(node => node.rowSpan = el.dataset.rowspan);
          el.replaceWith(subtmpl.content);
        } else {
          el.remove();
        }
      });

      if ($__default['default'].views) {
        var textContent = template.textContent,
            hasTag = textContent.includes("{{") && textContent.includes("}}");

        if (!hasTag) {
          var selector = ew.jsRenderAttributes.map(attr => "[" + attr + "*='{{'][" + attr + "*='}}']").join(",");
          hasTag = template.querySelector(selector);
        }

        if (hasTag) {
          // Includes JsRender template
          var scripts = Array.prototype.slice.call(template.querySelectorAll("script")); // Extract scripts

          scripts.forEach(item => item.remove());
          var div = document.createElement("div");
          div.appendChild(template);
          var html = div.innerHTML,
              tmpl = $__default['default'].templates(html);
          document.getElementById(divId).innerHTML = tmpl.render(args.data, ew.jsRenderHelpers);
          scripts.forEach(item => document.body.appendChild(item)); // Add scripts
        } else {
          document.getElementById(divId).appendChild(template);
        }
      } else {
        document.getElementById(divId).appendChild(template);
      }
    }

    if (exportType && exportType != "print") {
      // Export custom
      $__default['default'](function () {
        var $meta = $__default['default']("meta[http-equiv='Content-Type']"),
            html = "<html><head>",
            $div = $__default['default']("#" + divId);
        if ($div.children(0).is("div[id^=ct_]")) // Remove first div tag
          $div = $div.children(0);
        if ($meta[0]) html += "<meta http-equiv='Content-Type' content='" + $meta.attr("content") + "'>";

        if (exportType == "pdf") {
          html += "<link rel='stylesheet' href='" + ew.PDF_STYLESHEET_FILENAME + "'>";
        } else {
          html += "<style>" + $__default['default'].ajax({
            async: false,
            type: "GET",
            url: ew.PROJECT_STYLESHEET_FILENAME
          }).responseText + "</style>";
        }

        html += "</" + "head><body>";
        $__default['default'](".ew-chart-top").each(function () {
          html += $__default['default'](this).html();
        });
        html += $div.html();
        $__default['default'](".ew-chart-bottom").each(function () {
          html += $__default['default'](this).html();
        });
        html += "</body></html>";
        var url = currentPage(),
            data = {
          "customexport": exportType,
          "data": html,
          "filename": args.class
        };
        data[ew.TOKEN_NAME] = ew.ANTIFORGERY_TOKEN;

        if (exportType == "email") {
          var str = currentUrl.searchParams.toString() + "&" + $__default['default'].param(data); // Add data

          $__default['default'].post(url, str, function (result) {
            showMessage(result);
          });
        } else {
          fileDownload(url, data);
        }

        window.parent.jQuery("body").css("cursor", "default"); // Use window.parent in case in iframe
      });
    }
  } // Toggle group

  function toggleGroup(el) {
    var $el = $__default['default'](el),
        $tr = $el.closest("tr"),
        selector = "tr",
        level;

    for (var i = 1; i <= 6; i++) {
      var idx = i == 1 ? "" : "-" + i;
      var data = $tr.data("group" + idx);

      if ($__default['default'].isValue(data)) {
        level = i;
        if (data != "") selector += "[data-group" + idx + "='" + String(data).replace(/'/g, "\\'") + "']";
      }
    }

    if ($el.hasClass("ew-rpt-grp-hide")) {
      // Show
      $__default['default'](selector).slice(1).removeClass("ew-rpt-grp-hide-" + level);
      $el.removeClass("ew-rpt-grp-hide");
    } else {
      // Hide
      $__default['default'](selector).slice(1).addClass("ew-rpt-grp-hide-" + level);
      $el.addClass("ew-rpt-grp-hide");
    }
  } // Check if boolean value is true

  function convertToBool(value) {
    return value && ["1", "y", "t", "true"].includes(value.toLowerCase());
  } // Check if element value changed

  function valueChanged(fobj, infix, fld, bool) {
    var nelm = getElements("x" + infix + "_" + fld, fobj);
    var oelm = getElement("o" + infix + "_" + fld, fobj); // Hidden element

    var fnelm = getElement("fn_x" + infix + "_" + fld, fobj); // Hidden element

    if ((nelm == null ? void 0 : nelm.type) == "hidden" && !oelm) // For example, detail key
      return false;
    if (!oelm && (!nelm || Array.isArray(nelm) && nelm.length == 0)) return false;

    var getValue = obj => getOptionValues(obj).join();

    if (oelm && nelm) {
      if (bool) {
        if (convertToBool(getValue(oelm)) === convertToBool(getValue(nelm))) return false;
      } else {
        var oldvalue = getValue(oelm);
        var newvalue = fnelm ? getValue(fnelm) : getValue(nelm);
        if (oldvalue == newvalue) return false;
      }
    }

    return true;
  } // Set language

  function setLanguage(el) {
    var $el = $__default['default'](el),
        val = $el.val() || $el.data("language");
    if (!val) return false;
    currentUrl.searchParams.set("language", val);
    window.location = sanitizeUrl(currentUrl.toString());
    return false;
  }
  /**
   * Submit action
   *
   * @param {MouseEvent} e - Mouse event
   * @param {Object} args - Arguments
   * @param {HTMLElement} args.f - HTML form (default is the form of the source element) (for backward compatibility only)
   * @param {string} args.url - URL to which the request is sent (default is current page) (for backward compatibility only)
   * @param {Object} args.key - Key as object (for single record only)
   * @param {string|Object} args.msg - Message or Swal config
   * @param {string} args.action - Custom action name
   * @param {string} args.select - "single"|"s" (single record) or "multiple"|"m" (multiple records, default)
   * @param {string} args.method - "ajax"|"a" (Ajax by HTTP POST) or "post"|"p" (HTTP POST by HTML form, default)
   * @param {Object} args.data - Object of user data that is sent to the server
   * @param {string|callback|Object} success - Function to be called if the request succeeds, or settings for jQuery.ajax() (for Ajax only)
   * @returns
   */

  function submitAction(e, args) {
    var _window$msg;

    var el = e.currentTarget,
        f = args.f || el.form || el.closest("form"),
        $f = $__default['default'](f),
        key = args.key,
        action = args.action,
        url = args.url || currentPage(),
        msg = args.msg,
        data = args.data,
        success = args.success,
        isPost = !args.method || sameText(args.method[0], "p"),
        isMultiple = !args.select && !args.key || args.select && sameText(args.select[0], "m");

    if ((isMultiple || isPost) && !f) {
      _alert(ew.language.phrase("NoHtmlForm"));

      return false;
    }

    if (isMultiple && !keySelected(f)) {
      _alert(ew.language.phrase("NoRecordSelected"));

      return false;
    }

    var _success = function (result) {
      showMessage(result);
    };

    var _submit = function (value) {
      if (isPost && f) {
        // Post back by form
        if (action) // Action
          $__default['default']("<input>").attr({
            type: "hidden",
            name: "useraction",
            value: action
          }).appendTo($f);
        if (!$__default['default'].isUndefined(value)) $__default['default']("<input>").attr({
          type: "hidden",
          name: "actionvalue",
          value: value
        }).appendTo($f);

        if ($__default['default'].isObject(data)) {
          // User data
          for (var k in data) {
            var $input = $f.find("input[type=hidden][name='" + k + "']");
            if ($input[0]) $input.val(data[k]);else $__default['default']("<input>").attr({
              type: "hidden",
              name: k,
              value: data[k]
            }).appendTo($f);
          }
        }

        if (!isMultiple && $__default['default'].isObject(key)) {
          // Key
          for (var k in key) $__default['default']("<input>").attr({
            type: "hidden",
            name: k,
            value: key[k]
          }).appendTo($f);
        }

        $f.prop({
          action: url,
          method: "post"
        }).trigger("submit"); // if (action) // Action
        //     $f.find("input[type=hidden][name=useraction]").remove(); // Remove the "useraction" element
      } else {
        // Ajax
        data = $__default['default'].isObject(data) ? $__default['default'].param(data) : $__default['default'].isString(data) ? data : ""; // User data

        if (action) data += "&useraction=" + action + "&ajax=" + action; // Action

        if (!$__default['default'].isUndefined(value)) data += "&actionvalue=" + encodeURIComponent(value); // User input value

        if (isMultiple) // Multiple records
          data += "&" + $f.find("input[name='key_m[]']:checked").serialize(); // Keys
        else if (key) // Single record
          data += "&" + ($__default['default'].isObject(key) ? $__default['default'].param(key) : key); // Key

        if (success && $__default['default'].isString(success)) success = window[success];

        if (isFunction$2(success)) {
          $__default['default'].post(url, data, success);
        } else if ($__default['default'].isObject(success)) {
          // "success" is Ajax settings
          success.data = data;
          success.method = success.method || "POST";
          success.success = success.success || _success;
          $__default['default'].ajax(url, success);
        } else {
          $__default['default'].post(url, data, _success);
        }
      }
    };

    msg = $__default['default'].isString(msg) ? (_window$msg = window[msg]) != null ? _window$msg : msg : msg; // Get config object if available

    if (msg) {
      _prompt(msg, value => {
        if (value) _submit(value);
      });
    } else {
      _submit();
    }

    return false;
  }
  /**
   * Export with selected records and/or Custom Template
   *
   * @param {MouseEvent|HTMLFormElement} e - Event or HTML form
   * @param {string} url - Form action
   * @param {string} type - Export type
   * @param {boolean} custom - Using Custom Template
   * @param {boolean} sel - Selected records only
   * @param {HTMLFormElement} fobj - email form object
   * @returns false
   */

  function _export(e, url, type, custom, sel, fobj) {
    var f = e.currentTarget.form;
    if (!f) return false;
    var $f = $__default['default'](f),
        target = $f.attr("target"),
        action = $f.attr("action"),
        cb = sel && f.querySelector("input[type=checkbox][name='key_m[]']");

    if (cb && !keySelected(f)) {
      _alert(ew.language.phrase("NoRecordSelected"));

      return false;
    }

    if (custom) {
      // Use Custom Template
      $__default['default']("iframe.ew-export").remove();
      if (type == "email" && fobj) url += "&" + $__default['default'](fobj).serialize().replace(/&export=email/, ""); // Remove duplicate export=email

      if (cb) {
        $__default['default']("<iframe>").attr("name", "ew-export-frame").addClass("ew-export d-none").appendTo($body);

        try {
          $f.append($__default['default']("<input type='hidden'>").attr({
            name: "custom",
            value: "1"
          })).attr({
            action: url,
            target: "ew-export-frame"
          }).find("input[name=exporttype]").val(type).end().trigger("submit");
        } finally {
          // Reset
          $f.attr({
            "target": target || "",
            "action": action
          }).find("input[name=custom]").remove();
        }
      } else {
        $__default['default']("<iframe>").attr({
          name: "ew-export-frame",
          src: url
        }).addClass("ew-export d-none").appendTo($body);
      }
    } else {
      // No Custom Template
      $f.find("input[name=exporttype]").val(type);
      if (["xml", "print"].includes(type)) $f.trigger("submit"); // Submit the form directly
      else fileDownload(action, $f.serialize());
    }

    return false;
  }
  /**
   * Remove spaces
   * @param {string} value - Value
   * @returns {string}
   */

  function removeSpaces(value) {
    return /^(<(p|br)\/?>(&nbsp;)?(<\/p>)?)?$/i.test(value.replace(/\s/g, "")) ? "" : value;
  }
  /**
   * Check if hidden text area (HTML editor)
   * @param {HTMLElement|jQuery} el - HTML element or jQuery object
   * @returns {boolean}
   */

  function isHiddenTextArea(el) {
    var $el = $__default['default'](el);
    return $el.is(":hidden") && $el.data("editor");
  }
  /**
   * Check if modal lookup
   * @param {HTMLElement|jQuery} el - HTML element or jQuery object
   * @returns {boolean}
   */

  function isModalLookup(el) {
    var _el$dataset;

    return el == null ? void 0 : (_el$dataset = el.dataset) == null ? void 0 : _el$dataset.modalLookup;
  }
  /**
   * Check if filter
   * @param {HTMLElement|jQuery} el - HTML element or jQuery object
   * @returns {boolean}
   */

  function isFilter(el) {
    var _el$dataset2;

    return el == null ? void 0 : (_el$dataset2 = el.dataset) == null ? void 0 : _el$dataset2.filter;
  }
  /**
   * Check if hidden textbox (Auto-Suggest)
   * @param {HTMLElement|jQuery} el - HTML element or jQuery object
   * @returns {boolean}
   */

  function isAutoSuggest(el) {
    var $el = $__default['default'](el);
    return $el.is(":hidden") && $el.data("autosuggest");
  }
  /**
   * Check if textbox
   * @param {HTMLElement|jQuery} el - HTML element or jQuery object
   * @returns {boolean}
   */

  function isTextbox(el) {
    var $el = $__default['default'](el);
    return $el.is("input[type!=checkbox][type!=radio]") && !isAutoSuggest($el);
  }
  /**
   * Clear error message
   * @param {HTMLElement|HTMLElement[]|jQuery} el - HTML element(s) or jQuery
   */

  function clearError(el) {
    if (el.jquery) {
      // el is jQuery object
      let typ = el.attr("type");
      el = typ == "checkbox" || typ == "radio" ? el.get() : el[0];
    }

    $__default['default'](el).closest(fieldContainerSelector).find(".invalid-feedback").html("");
  }
  /**
   * Show error message
   * @param {Form} frm Form object
   * @param {HTMLElement|HTMLElement[]|jQuery} el - HTML element(s) or jQuery
   * @param {string} msg - Error message
   * @param {boolean} focus - Set focus
   */

  function onError(frm, el, msg, focus) {
    if (el.jquery) {
      // el is jQuery object
      let typ = el.attr("type");
      el = typ == "checkbox" || typ == "radio" ? el.get() : el[0];
    } else if (el instanceof Field) {
      // el is Field object
      el = el.element;
    }

    $__default['default'](el).closest(fieldContainerSelector).find(".invalid-feedback").append("<p>" + msg + "</p>");
    if (focus) setFocus(el);
    frm == null ? void 0 : frm.makeVisible(el);
    return false;
  }
  /**
   * Set focus
   * @param {HTMLElement|HTMLElement[]} obj - HTML element(s)
   * @param {Object} options - Focus options
   */

  function setFocus(obj, options) {
    if (!obj) return;
    var $obj = $__default['default'](obj);
    if (isHidden($obj)) return;

    if (isHiddenTextArea(obj)) {
      // HTML editor
      return $obj.data("editor").focus();
    } else if (!obj.options && obj.length) {
      // Radio/Checkbox list
      obj = $obj[0];
    } else if (isAutoSuggest(obj)) {
      // Auto-Suggest
      obj = obj.input;
    }

    obj.focus(options);
  }
  /**
   * Set invalid
   * @param {HTMLElement|HTMLElement[]} obj - HTML element(s)
   */

  function setInvalid(obj) {
    if (!obj) return;
    var $obj = $__default['default'](obj);
    if (isHidden($obj)) return;
    if (!obj.options && obj.length) // Radio/Checkbox list
      obj = $obj[0];
    var $p = $obj.closest(fieldContainerSelector);

    if (isAutoSuggest(obj)) {
      $p.find(".ew-auto-suggest").removeClass("is-valid").addClass("is-invalid").one("click keydown", function () {
        $p.find(".is-invalid").removeClass("is-invalid");
      });
    } else {
      if (obj.type == "checkbox" || obj.type == "radio") {
        $obj.removeClass("is-valid").addClass("is-invalid").one("click keydown", function () {
          $p.find(".is-invalid").removeClass("is-invalid");
        });
      } else {
        $obj.removeClass("is-valid").addClass("is-invalid").parent().one("click keydown", function () {
          $p.find(".is-invalid").removeClass("is-invalid");
        });
        $obj.closest(".input-group").removeClass("is-valid").addClass("is-invalid");
      }
    }
  }
  /**
   * Set valid
   * @param {HTMLElement|HTMLElement[]} obj - HTML element(s)
   */

  function setValid(obj) {
    if (!obj) return;
    var $obj = $__default['default'](obj);
    if (isHidden($obj)) return;
    if (!obj.options && obj.length) // Radio/Checkbox list
      obj = $obj[0];
    var $p = $obj.closest(fieldContainerSelector);

    if (isAutoSuggest(obj)) {
      $p.find(".ew-auto-suggest").removeClass("is-invalid").addClass("is-valid").one("click keydown", function () {
        $p.find(".is-valid").removeClass("is-valid");
      });
    } else {
      if (obj.type == "checkbox" || obj.type == "radio") {
        $obj.removeClass("is-invalid").addClass("is-valid").one("click keydown", function () {
          $p.find(".is-valid").removeClass("is-valid");
        });
      } else {
        $obj.removeClass("is-invalid").addClass("is-valid").parent().one("click keydown", function () {
          $p.find(".is-valid").removeClass("is-valid");
        });
        $obj.closest(".input-group").removeClass("is-invalid").addClass("is-valid");
      }
    }
  } // Check if object has value

  function hasValue(obj) {
    return getOptionValues(obj).join("") != "";
  } // Check if object value is a masked password

  function isMaskedPassword(obj) {
    var val = $__default['default'](obj).val();
    return val == null ? void 0 : val.match(/^\*+$/);
  } // Sort by field

  function sort(e, url, type) {
    if (e.shiftKey && !e.ctrlKey) url = url.split("?")[0] + "?cmd=resetsort";else if (type == 2 && e.ctrlKey) url += "&ctrl=1";
    window.location = sanitizeUrl(url);
    return true;
  } // Open table header filter by field

  function filter(e) {
    let data = e.currentTarget.dataset;
    $__default['default']("select[data-select2-id='f" + data.table + "srch_" + data.field + "']").select2("open");
  } // Confirm Delete Message

  function confirmDelete(el) {
    clickDelete(el);

    _prompt(ew.language.phrase("DeleteConfirmMsg"), result => {
      result && el.href ? window.location = sanitizeUrl(el.href) : clearDelete(el);
    });

    return false;
  } // Check if any key selected // PHP

  function keySelected(f) {
    return $__default['default'](f).find("input[type=checkbox][name='key_m[]']:checked", f).length > 0;
  } // Select all keys

  function selectAllKeys(cb) {
    selectAll(cb);
    var tbl = $__default['default'](cb).closest(".ew-table")[0];
    if (!tbl) return;
    $__default['default'](tbl.tBodies).each(function () {
      $__default['default'](this.rows).each(function (i, r) {
        var $r = $__default['default'](r);
        if ($r.is(":not(.ew-template):not(.ew-table-preview-row)")) $r.toggleClass("table-active ew-table-selected-row", cb.checked).triggerHandler("change");
      });
    });
  } // Select all related checkboxes in the form

  function selectAll(cb) {
    if (!cb || !cb.form) return;
    $__default['default'](cb.form.elements).filter("input[type=checkbox][name^=" + cb.name + "_], [type=checkbox][name=" + cb.name + "]").not(cb).not(":disabled").prop("checked", cb.checked);
  } // Update selected checkbox

  function updateSelected(f) {
    return $__default['default'](f).find("input[type=checkbox][name^=u_]:checked,input:hidden[name^=u_][value=1]").length > 0;
  } // Clear selected rows color

  function clearSelected(tbl) {
    let rowIndexes = $__default['default'](tbl).find("input[type=checkbox][name='key_m[]']:checked").closest("[data-rowindex]").map((i, r) => r.dataset.rowindex).get();
    $__default['default'](tbl == null ? void 0 : tbl.rows).filter((i, r) => r.classList.contains("table-active") && !rowIndexes.includes(r.dataset.rowindex)).removeClass("table-active ew-table-selected-row").triggerHandler("change");
  } // Clear all row delete status

  function clearDelete(el) {
    var $el = $__default['default'](el),
        tbl = $el.closest(".ew-table")[0];
    if (!tbl) return;
    var $tr = $el.closest(".ew-table > tbody > tr");
    $tr.siblings("[data-rowindex='" + $tr.data("rowindex") + "']").addBack().removeClass("table-active").triggerHandler("change");
  } // Click single delete link

  function clickDelete(el) {
    var $el = $__default['default'](el),
        tbl = $el.closest(".ew-table")[0];
    if (!tbl) return;
    clearSelected(tbl);
    var $tr = $el.closest(".ew-table > tbody > tr");
    $tr.siblings("[data-rowindex='" + $tr.data("rowindex") + "']").addBack().addClass("table-active").triggerHandler("change");
  } // Select a row

  function selectKey(e) {
    var cb = e.target,
        $cb = $__default['default'](cb),
        tbl = $cb.closest(".ew-table")[0];
    if (!tbl) return;
    clearSelected(tbl);
    var $tr = $cb.closest(".ew-table > tbody > tr");
    $tr.siblings("[data-rowindex='" + $tr.data("rowindex") + "']").addBack().each(function (i, r) {
      $__default['default'](r).toggleClass("table-active ew-table-selected-row", cb.checked).triggerHandler("change");
    });
    e.stopPropagation();
  } // Setup table

  function setupTable(index, tbl, force) {
    var $tbl = $__default['default'](tbl),
        $rows = $__default['default'](tbl.rows);
    if (!tbl || !tbl.rows || !force && $tbl.data("isset") || tbl.tBodies.length == 0) return; // Set selected row color

    var click = function (e) {
      var $this = $__default['default'](this),
          $tbl = $this.closest(".ew-table"),
          tbl = $tbl[0],
          $target = $__default['default'](e.target);
      if (!tbl || $target.hasClass("btn") || $target.hasClass("ew-preview-btn") || $target.is(":input")) return;
      clearSelected(tbl); // Clear all other selected rows

      $this.siblings("[data-rowindex='" + $this.data("rowindex") + "']").addBack().toggleClass("table-active").triggerHandler("change");
    };

    var n = $rows.filter("[data-rowindex=1]").length || $rows.filter("[data-rowindex=0]").length || 1; // Alternate color every n rows

    var rows = $rows.filter(":not(.ew-template)").each(function () {
      $__default['default'](this.cells).removeClass("ew-table-last-row").last().addClass("ew-table-last-col"); // Cell of last column
    }).get();
    var div = $tbl.parentsUntil(".ew-grid", "." + ew.RESPONSIVE_TABLE_CLASS)[0];

    if (rows.length) {
      for (var i = 1; i <= n; i++) {
        var r = rows[rows.length - i]; // Last rows

        $__default['default'](r.cells).each(function () {
          if (this.rowSpan == i) // Cell of last row
            $__default['default'](this).addClass("ew-table-last-row").toggleClass("ew-table-border-bottom", (div == null ? void 0 : div.clientHeight) > tbl.offsetHeight);
        });
      }
    }

    var form = $tbl.closest("form")[0];
    var attach = form && $__default['default'](form.elements).filter("input#action:not([value^=grid])").length > 0;
    $__default['default'](tbl.tBodies[tbl.tBodies.length - 1].rows) // Use last TBODY (avoid Opera bug)
    .filter(":not(.ew-template):not(.ew-table-preview-row)").each(function () {
      var $r = $__default['default'](this);
      if (attach && !$r.data("isset")) $r.on("click", click).data("isset", true);
    });
    setupGrid(index, $tbl.closest(".ew-grid")[0], force);
    $tbl.data("isset", true);
  } // Setup grid

  function setupGrid(index, grid, force) {
    var $grid = $__default['default'](grid);
    if (!grid || !force && $grid.data("isset")) return;
    var rowcnt = $grid.find("table.ew-table > tbody").first().children("tr:not(.ew-table-preview-row, .ew-template)").length;
    if (rowcnt == 0 && !$grid.find(".ew-grid-upper-panel, .ew-grid-lower-panel")[0]) $grid.hide();

    if ($grid.find(".ew-grid-middle-panel:visible").hasClass(ew.RESPONSIVE_TABLE_CLASS) && $grid.width() > $__default['default'](".content").width()) {
      $grid.addClass("d-flex");
      $grid.closest(".ew-detail-pages").addClass("d-block");
      $grid.closest(".ew-form").addClass("w-100");
      if (ew.USE_OVERLAY_SCROLLBARS) $grid.find(".ew-grid-middle-panel:not(.ew-preview-middle-panel)").overlayScrollbars(ew.overlayScrollbarsOptions);
    }

    $grid.data("isset", true);
  } // Add a row to grid

  function addGridRow(el) {
    var _bootstrap$Tooltip$ge2;

    var $grid = $__default['default'](el).closest(".ew-grid"),
        $tbl = $grid.find("table.ew-table").last(),
        $p = $tbl.parent("div"),
        $tpl = $tbl.find("tr.ew-template");
    if (!el || !$grid[0] || !$tbl[0] || !$tpl[0]) return false;
    var $lastrow = $__default['default']($tbl[0].rows).last();
    $tbl.find("td.ew-table-last-row").removeClass("ew-table-last-row");
    var $row = $tpl.clone(true, true).removeClass("ew-template");
    var $form = $grid.find("div.ew-form[id^=f][id$=grid]");
    if (!$form[0]) $form = $grid.find("form.ew-form[id^=f][id$=list]");
    var suffix = $form.is("div") ? "_" + $form.attr("id") : "";
    var $elkeycnt = $form.find("#key_count" + suffix);
    var keycnt = parseInt($elkeycnt.val(), 10) + 1;
    $row.attr({
      "id": "r" + keycnt + $row.attr("id").substring(2),
      "data-rowindex": keycnt
    });
    var $els = $tpl.find("script:contains('$rowindex$')"); // Get scripts with rowindex

    $row.children("td").each(function () {
      $__default['default'](this).find("*").each(function () {
        $__default['default'].each(this.attributes, function (i, attr) {
          attr.value = attr.value.replace(/\$rowindex\$/g, keycnt); // Replace row index
        });
      });
    });
    var $btn = $row.find(".ew-icon").closest("a, button");
    (_bootstrap$Tooltip$ge2 = bootstrap.Tooltip.getInstance($btn[0])) == null ? void 0 : _bootstrap$Tooltip$ge2.dispose();
    $btn.tooltip({
      container: "body",
      placement: "bottom",
      trigger: "hover",
      sanitizeFn: ew.sanitizeFn
    });
    $elkeycnt.val(keycnt).after($__default['default']("<input>").attr({
      type: "hidden",
      id: "k" + keycnt + "_action" + suffix,
      name: "k" + keycnt + "_action" + suffix,
      value: "insert"
    }));
    $lastrow.after($row);
    $els.each(function () {
      addScript(this.text.replace(/\$rowindex\$/g, keycnt));
    });
    var frm = $form.data("form");
    frm == null ? void 0 : frm.initEditors();
    frm == null ? void 0 : frm.initUpload();
    setupTable(-1, $tbl[0], true);
    $p.scrollTop($p[0].scrollHeight);
    return false;
  } // Delete a row from grid

  function deleteGridRow(el, infix) {
    var _bootstrap$Tooltip$ge3;

    (_bootstrap$Tooltip$ge3 = bootstrap.Tooltip.getInstance(el)) == null ? void 0 : _bootstrap$Tooltip$ge3.dispose();
    var $el = $__default['default'](el),
        $grid = $el.closest(".ew-grid, .ew-multi-column-grid"),
        $row = $el.closest("tr, div[data-rowindex]"),
        $tbl = $row.closest(".ew-table");
    if (!el || !$grid[0] || !$row[0]) return false;
    var rowidx = parseInt($row.data("rowindex"), 10);
    var $form = $grid.find("div.ew-form[id^=f][id$=grid]");
    if (!$form[0]) $form = $grid.find("form.ew-form[id^=f][id$=list]");
    var frm = $form.data("form");
    if (!$form[0] || !frm) return false;
    var suffix = $form.is("div") ? "_" + $form.attr("id") : "";
    var keycntname = "#key_count" + suffix;

    var _delete = function () {
      $row.remove();
      if ($grid.is(".ew-grid")) setupTable(-1, $tbl[0], true);

      if (rowidx > 0) {
        var $keyact = $form.find("#k" + rowidx + "_action" + suffix);

        if ($keyact[0]) {
          $keyact.val($keyact.val() == "insert" ? "insertdelete" : "delete");
        } else {
          $form.find(keycntname).after($__default['default']("<input>").attr({
            type: "hidden",
            id: "k" + rowidx + "_action" + suffix,
            name: "k" + rowidx + "_action" + suffix,
            value: "delete"
          }));
        }
      }
    };

    if (isFunction$2(frm.emptyRow) && frm.emptyRow(infix)) {
      // Empty row
      _delete();
    } else {
      // Confirm
      _prompt(ew.language.phrase("DeleteConfirmMsg"), result => {
        if (result) _delete();
      });
    }

    return false;
  } // HTML encode text

  function htmlEncode(text) {
    var str = String(text);
    return str.replace(/&/g, '&amp;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  } // Get form element(s) as single element or array of radio/checkbox

  function getElements(el, root) {
    var selector;

    if ($__default['default'].isObject(el) && el.dataset) {
      // HTML element (e.g. radio/checkbox)
      selector = "[data-table='" + el.dataset.table + "'][data-field='" + el.dataset.field + "']:not([name^=o]):not([name^='x$'])";
    } else if ($__default['default'].isString(el)) {
      selector = "[name='" + el + "']";
      var ar = el.split(" "); // Check if "#id name"

      if (ar.length == 2) selector = "[data-table='" + ar[0] + "'][data-field='" + getId(ar[1]) + "']:not([name^=o]):not([name^='x$'])"; // Remove []
    }

    var root = !$__default['default'].isString(root) ? root : /^#/.test(root) ? root : "#" + root;
    selector = "input" + selector + ",select" + selector + ",textarea" + selector + ",button" + selector + ",selection-list" + selector;
    var $els = root ? $__default['default'](root).find(selector) : $__default['default'](selector);
    if ($els.length == 1 && $els.is(":not([type=checkbox]):not([type=radio])")) return $els[0];
    if ($els.length == 2 && $els.eq(0).is("selection-list") && $els.eq(1).is("input[type=hidden]")) // Polyfill for the ElementInternals
      return $els[0];
    return $els.get();
  } // Get first element (not necessarily form element)

  function getElement(name, root) {
    var root = $__default['default'].isString(root) ? "#" + root : root,
        selector = "#" + name.replace(/([\$\[\]])/g, "\\$1") + ",[name='" + name + "']";
    return root ? $__default['default'](root).find(selector)[0] : $__default['default'](selector).first()[0];
  } // Get ancestor by function

  function getAncestorBy(node, fn) {
    while (node = node.parentNode) {
      var _node;

      if (((_node = node) == null ? void 0 : _node.nodeType) == 1 && (!fn || fn(node))) return node;
    }

    return null;
  } // Check if an element is hidden

  function isHidden(el) {
    var $el = $__default['default'](el);
    return $el.css("display") == "none" && !$el.closest(".dropdown-menu")[0] && !isModalLookup(el) && !isAutoSuggest(el) && !isHiddenTextArea(el) || getAncestorBy(el, node => node.style.display == "none" && !node.classList.contains("tab-pane") && !node.classList.contains("collapse")) != null;
  } // Check if same text

  function sameText(o1, o2) {
    return String(o1).toLowerCase() == String(o2).toLowerCase();
  } // Check if same string

  function sameString(o1, o2) {
    return String(o1) == String(o2);
  } // Get element value

  function getValue(el, form) {
    if (!el) return "";
    let obj;

    if ($__default['default'].isString(el)) {
      let ar = el.split(" ");

      if (ar.length == 2) {
        // Parent field in master table
        obj = getElements(el);
      } else {
        obj = getElements(el, form);
      }
    } else if (el.type == "radio" || el.type == "checkbox") {
      // Single radio/checkbox
      obj = getElements(el);
    } else {
      obj = el;
    }

    if (obj.options) {
      // Selection list
      if (obj.list) {
        let val = obj.values;
        return obj.multiple ? val : val[0] || "";
      } else {
        let val = Array.prototype.filter.call(obj.options, option => option.selected && option.value !== "").map(option => option.value);
        return obj.type == "select-multiple" ? val : val[0] || "";
      }
    } else if ($__default['default'].isNumber(obj.length)) {
      // Radio/Checkbox list, or element not found
      let val = $__default['default'](obj).filter(":checked").map(function () {
        return this.value;
      }).get();
      return obj.length == 1 ? val[0] : val;
    } else if (ew.isHiddenTextArea(obj)) {
      $__default['default'](obj).data("editor").save();
      return obj.value;
    } else {
      // text/hidden
      let data = $__default['default'](obj).data();
      if (data.lookup && data.multiple) // Modal-Lookup
        return obj.value.split(ew.MULTIPLE_OPTION_SEPARATOR);else return obj.value;
    }
  } // Get existing selected values as an array

  function getOptionValues(el, form) {
    var obj;

    if ($__default['default'].isString(el)) {
      var ar = el.split(" ");

      if (ar.length == 2) {
        // Parent field in master table
        obj = getElements(el);
      } else {
        obj = getElements(el, form);
      }
    } else if (el.type == "radio" || el.type == "checkbox") {
      // Single radio/checkbox
      obj = getElements(el);
    } else {
      obj = el;
    }

    if (obj.options) {
      // Selection list
      if (obj.list) return obj.values;else return Array.prototype.filter.call(obj.options, option => option.selected && option.value !== "").map(option => option.value);
    } else if ($__default['default'].isNumber(obj.length)) {
      // Radio/Checkbox list, or element not found
      return $__default['default'](obj).filter(":checked").map(function () {
        return this.value;
      }).get();
    } else if (ew.isHiddenTextArea(obj)) {
      $__default['default'](obj).data("editor").save();
      return [obj.value];
    } else {
      // text/hidden
      var data = $__default['default'](obj).data();
      if (data.lookup && data.multiple) // Modal-Lookup
        return obj.value.split(ew.MULTIPLE_OPTION_SEPARATOR);else return [obj.value];
    }
  } // Get existing text of selected values as an array

  function getOptionTexts(el, form) {
    var obj;

    if ($__default['default'].isString(el)) {
      var ar = el.split(" ");

      if (ar.length == 2) {
        // Parent field in master table
        obj = getElements(el);
      } else {
        obj = getElements(el, form);
      }
    } else {
      obj = el;
    }

    if (isAutoSuggest(obj)) {
      // AutoSuggest (before obj.options)
      return [obj.input.value];
    } else if (obj.options) {
      // Selection list
      return Array.prototype.filter.call(obj.options, option => option.selected && option.value !== "").map(option => option.text);
    } else if ($__default['default'].isNumber(obj.length)) {
      // Radio/Checkbox list, or element not found
      return $__default['default'](obj).filter(":checked").map(function () {
        return $__default['default'](this).parent().text();
      }).get();
    } else if (ew.isHiddenTextArea(obj)) {
      $__default['default'](obj).data("editor").save();
      return [obj.value];
    } else {
      return [obj.value];
    }
  } // Clear existing options

  function clearOptions(obj) {
    if (obj.options) {
      // Selection list
      var lo = obj.type == "select-multiple" || // multiple
      obj.hasAttribute("data-dropdown") || // dropdown
      convertToBool(obj.getAttribute("data-pleaseselect")) === false || // data-pleaseselect="false"
      obj.length > 0 && obj.options[0].value != "" ? 0 : 1;

      if (obj.list) {
        obj.removeAll();
      } else {
        for (var i = obj.length - 1; i >= lo; i--) obj.remove(i);
      }

      if (isAutoSuggest(obj)) {
        obj.input.value = "";
        obj.value = "";
      }
    }
  }
  /**
   * Get the name or id of an element
   *
   * @param {HTMLElement} el - HTML element
   * @param {boolean} [remove=true] - Remove square brackets
   * @returns
   */

  function getId(el, remove) {
    var id = $__default['default'].isString(el) ? el : $__default['default'](el).attr("name") || $__default['default'](el).attr("id"); // Use name first (id may have suffix)

    return remove !== false ? id.replace(/\[\]$/, "") : id;
  } // Get display value separator

  function valueSeparator(index, obj) {
    var sep = $__default['default'](obj).data("value-separator");
    return Array.isArray(sep) ? sep[index - 1] : sep || ", ";
  }
  /**
   * Get display value
   *
   * @param {Object} opt - Option being displayed
   * @param {HTMLElment} obj - HTML element
   * @returns {string} Display value
   */

  function displayValue(opt, obj) {
    var text = opt.df;

    for (var i = 2; i <= 4; i++) {
      if (opt["df" + i] && opt["df" + i] != "") {
        var sep = valueSeparator(i - 1, obj);
        if ($__default['default'].isUndefined(sep)) break;
        if ($__default['default'].isValue(text)) text += sep;
        text += opt["df" + i];
      }
    }

    return text;
  }
  /**
   * Get HTML for a single option
   *
   * @param {*} val - Value of the option
   * @returns {string} HTML
   */

  function optionHtml(val) {
    return ew.OPTION_HTML_TEMPLATE.replace(/\{value\}/g, val);
  }
  /**
   * Get HTML for diplaying all options
   *
   * @param {string[]} options - Array of all options (HTML)
   * @param {number} max - Maximum number of options to show
   * @returns {string} HTML
   */

  function optionsHtml(options, max) {
    if (options.length > (max || ew.MAX_OPTION_COUNT)) {
      // More than max option count
      return ew.language.phrase("CountSelected").replace("%s", options.length);
    } else if (options.length) {
      // Some options
      var html = "";

      for (var i = 0; i < options.length; i++) html += optionHtml(options[i]);

      return html;
    } else {
      // No options
      return ew.language.phrase("PleaseSelect");
    }
  }
  /**
   * Create new option
   *
   * @param {(HTMLElement|array)} obj - Selection list
   * @param {Object} opt - Object for the new option
   * @param {form} f - form object of obj
   * @returns
   */

  function newOption(obj, opt, f) {
    var frm = forms.get(f.id),
        id = getId(obj),
        list = frm.getList(id),
        value = opt.lf,
        item = {
      lf: opt.lf,
      df: opt.df,
      df2: opt.df2,
      df3: opt.df3,
      df4: opt.df4
    },
        text;

    if (list.template && !isAutoSuggest(obj)) {
      text = list.template.render(item, ew.jsRenderHelpers);
    } else {
      text = displayValue(opt, obj) || value;
    }

    var args = {
      "data": item,
      "name": id,
      "form": f.$element,
      "value": value,
      "text": text
    };

    if (obj.options) {
      // Selection list
      let option;

      if (obj.list) {
        option = new SelectionListOption(args.value, args.text);
      } else {
        option = document.createElement("option");
        option.value = args.value;
        option.innerHTML = args.text;
      }

      args = { ...args,
        option
      };
      $document$1.trigger("newoption", [args]); // Fire "newoption" event for selection list

      if (obj.list) {
        obj.add(args.option.value, args.option.text);
      } else {
        obj.add(args.option);
      }
    }

    return args.text;
  } // Select combobox option

  function selectOption(obj, values) {
    if (!obj || !values) return;
    var $obj = $__default['default'](obj);

    if (Array.isArray(values)) {
      if (obj.options) {
        // Selection list
        if (obj.list) {
          obj.value = values;
        } else {
          var _obj$options$;

          $obj.val(values);
          if (obj.type == "select-one" && obj.selectedIndex == -1 && !((_obj$options$ = obj.options[0]) != null && _obj$options$.value)) obj.selectedIndex = 0; // Make sure an option is selected
        }

        if (isAutoSuggest(obj) && values.length == 1) {
          let opts = obj.options || [];

          for (let opt of opts) {
            if (opt.value == values[0]) {
              obj.value = opt.value;
              obj.input.value = opt.text;
              break;
            }
          }
        }
      } else if (obj.type) {
        obj.value = values.join(ew.MULTIPLE_OPTION_SEPARATOR);
      }
    } // Auto-select if only one option

    function isAutoSelect(el) {
      if (!$__default['default'](el).data("autoselect")) // data-autoselect="false"
        return false;
      var form = getForm(el);

      if (form) {
        if (/s(ea)?rch$/.test(form.id)) // Search forms
          return false;
        var list = forms.get(form.id).getList(el.id);
        if ((list == null ? void 0 : list.parentFields.length) === 0) // No parent fields
          return false;
        return true;
      }

      return false;
    }

    if (!isAutoSelect(obj)) return;

    if (obj.options) {
      // Selection List
      if (!obj.list && obj.type == "select-one" && obj.options.length == 2 && !obj.options[1].selected) {
        obj.options[1].selected = true;
        $obj.trigger("change");
      } else if (obj.options.length == 1 && !obj.options[0].selected) {
        obj.options[0].selected = true;
        $obj.trigger("change");
      }

      if (obj.list) obj.render();

      if (isAutoSuggest(obj)) {
        let opts = obj.options || [];

        if (opts.length == 1) {
          obj.value = opts[0].value;
          obj.input.value = opts[0].text;
        }
      }
    }
  } // Fetch API

  function _fetch(url, init) {
    var _init;

    (_init = init) != null ? _init : init = {};
    let apiUrl = getApiUrl(),
        isApi = url.startsWith(apiUrl); // Is API request

    if (isApi && ew.API_JWT_TOKEN && !ew.IS_WINDOWS_AUTHENTICATION) {
      // Do NOT set JWT authorization header if Windows Authentication
      init.headers = new Headers(init.headers || {});
      init.headers.set(ew.API_JWT_AUTHORIZATION_HEADER, "Bearer " + ew.API_JWT_TOKEN);
    }

    if (!init.method || init.method == "GET") {
      // GET
      var ar = url.split("?"),
          params = new URLSearchParams(ar[1]);
      params.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name // PHP

      params.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token // PHP

      ar[1] = params.toString();
      url = ar[0] + (ar[1] ? "?" + ar[1] : "");
    } else {
      // POST
      if (init.body instanceof FormData) {
        // FormData
        init.body.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name // PHP

        init.body.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token // PHP
      } else if ($__default['default'].isString(init.body) || $__default['default'].isObject(init.body) || Array.isArray(init.body) && init.body.every(item => Array.isArray(item) && item.length == 2)) {
        // String, object or array of array
        init.body = new URLSearchParams(init.body);
        init.body.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name // PHP

        init.body.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token // PHP
      }
    }

    return fetch(url, init);
  }

  $document$1.ajaxSend(function (event, jqxhr, settings) {
    var url = settings.url,
        apiUrl = getApiUrl(),
        isApi = url.startsWith(apiUrl),
        // Is API request
    allowed = isApi || url.startsWith(ew.PATH_BASE) || url.startsWith(currentPage());

    if (!allowed && url.match(/^http/i)) {
      var objUrl = new URL(url);
      allowed = objUrl.hostname == currentUrl.hostname; // Same host name
    }

    if (allowed) {
      if (isApi && ew.API_JWT_TOKEN && !ew.IS_WINDOWS_AUTHENTICATION) // Do NOT set JWT authorization header if Windows Authentication
        jqxhr.setRequestHeader(ew.API_JWT_AUTHORIZATION_HEADER, "Bearer " + ew.API_JWT_TOKEN);

      if (settings.type == "GET" || settings.contentType == "application/json") {
        // GET or sending JSON data
        var ar = settings.url.split("?"),
            params = new URLSearchParams(ar[1]);
        params.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name // PHP

        params.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token // PHP

        ar[1] = params.toString();
        settings.url = ar[0] + (ar[1] ? "?" + ar[1] : "");
      } else {
        // POST
        if (settings.data instanceof FormData) {
          // FormData
          settings.data.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name // PHP

          settings.data.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token // PHP
        } else {
          var params = new URLSearchParams(settings.data);
          params.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name // PHP

          params.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token // PHP

          settings.data = params.toString();
        }
      }
    }
  }); // Ajax start

  $document$1.ajaxStart(function () {
    $document$1.data("_ajax", true);
    $__default['default']("form.ew-form").addClass("ew-wait").each(function () {
      var frm = forms.get(this.id);

      if (frm) {
        if (!frm.multiPage || !frm.multiPage.lastPageSubmit) frm.disableForm();
      }
    });
  }); // Ajax stop (internal)

  function _ajaxStop() {
    $__default['default']("form.ew-form.ew-wait").removeClass("ew-wait").each(function () {
      var frm = forms.get(this.id);

      if (frm) {
        if (!frm.multiPage || !frm.multiPage.lastPageSubmit) {
          frm.enableForm();
        }
      }
    });
    $document$1.data("_ajax", false);
  } // Ajax stop/error

  $document$1.ajaxStop(_ajaxStop).ajaxError(_ajaxStop); // Execute JavaScript in HTML loaded by Ajax

  function executeScript(html, id) {
    let matches = html.replace(/<head>[\s\S]*<\/head>/, "").matchAll(/<script([^>]*)>([\s\S]*?)<\/script\s*>/ig);
    Array.from(document.createRange().createContextualFragment(Array.from(matches).map(m => m[0]).join("")).querySelectorAll("script:not([type]), script[type='text/javascript']")).sort((s1, s2) => s2.classList.contains("ew-apply-template") ? 1 : s1.classList.contains("ew-apply-template") ? -1 : 0) // Execute custom template first
    .forEach((s, i) => addScript(s, "scr_" + id + "_" + i));
  } // Strip JavaScript in HTML loaded by Ajax

  function stripScript(html) {
    let matches = html.matchAll(/<script([^>]*)>([\s\S]*?)<\/script\s*>/ig);
    return Array.from(matches).filter(m => document.createRange().createContextualFragment(m[0]).querySelector("script:not([type]), script[type='text/javascript']")).reduce((html, m) => html.replace(m[0], ""), html);
  } // Add SCRIPT tag

  function addScript(text, id) {
    let scr = text instanceof HTMLScriptElement ? text : document.createElement("SCRIPT");
    if ($__default['default'].isString(text)) scr.text = text;
    if (id) scr.id = id;
    return document.body.appendChild(scr); // Do not use jQuery so it can be removed
  } // Remove JavaScript added by Ajax

  function removeScript(id) {
    if (id) $__default['default']("script[id^='scr_" + id + "_']").remove();
  } // Clean HTML loaded by Ajax for modal dialog

  function getContent(html) {
    let body = stripScript(html),
        m = body.match(/<body[\s\S]*>[\s\S]*<\/body>/i);
    body = m ? m[0] : body;
    let $content = $__default['default'](body).find("section.content");
    return $content[0] ? $content : $__default['default'](body);
  } // Get all options of Selection list or Radio/Checkbox list as array

  function getOptions(obj) {
    return obj.options ? Array.prototype.map.call(obj.options, opt => [opt.value, opt.text]) : [];
  }
  /**
   * Show dialog for enabling two factor authentication
   */

  function enable2FA() {
    let url = ew.getApiUrl([ew.API_2FA_ACTION, ew.API_2FA_SHOW]); // Show QR Code

    $body.css("cursor", "wait");
    $__default['default'].get(url, result => {
      var _result$error2;

      if (result != null && result.url) {
        _prompt({
          imageUrl: result.url,
          html: ew.language.phrase("Scan2FAQrCode"),
          input: "text",
          confirmButtonText: ew.language.phrase("Verify"),
          showLoaderOnConfirm: true,
          allowEscapeKey: false,
          allowOutsideClick: () => !Swal.isLoading(),
          willOpen: () => {
            Swal.showLoading(Swal.getConfirmButton());
            Swal.disableInput();

            Swal.getImage().onload = () => {
              Swal.enableInput();
              Swal.hideLoading();
              Swal.getInput().focus();
            };
          },
          preConfirm: value => {
            return $__default['default'].get(ew.getApiUrl([ew.API_2FA_ACTION, ew.API_2FA_VERIFY, value])).then(result => {
              if ((result == null ? void 0 : result.success) !== true) Swal.showValidationMessage(ew.language.phrase("2FAVerificationFailed"));
              return result;
            }).catch(error => Swal.showValidationMessage(error));
          }
        }, result => {
          var _result$error;

          if (result != null && (_result$error = result.error) != null && _result$error.description) {
            showToast(result.error.description);
          } else if (result != null && result.success) {
            showToast(ew.language.phrase("2FAEnabled"), "success");
            $__default['default']("#enable-2fa").addClass("d-none");
            $__default['default']("#disable-2fa, #backup-codes").removeClass("d-none");
          }
        }).catch(err => showToast(err == null ? void 0 : err.message));
      } else if (result != null && (_result$error2 = result.error) != null && _result$error2.description) {
        _alert(result.error.description);
      }
    }).fail((jqXHR, textStatus, errorThrown) => showToast(errorThrown)).always(() => $body.css("cursor", "default"));
    return false;
  }
  /**
   * Show dialog for disabling two factor authentication
   */

  function disable2FA() {
    _prompt({
      html: ew.language.phrase("Disable2FAMsg"),
      preConfirm: value => {
        if (value) return $__default['default'].get(ew.getApiUrl([ew.API_2FA_ACTION, ew.API_2FA_RESET])).then(result => {
          var _result$error3;

          if (result != null && (_result$error3 = result.error) != null && _result$error3.description) showToast(result.error.description);else if ((result == null ? void 0 : result.success) !== true) showToast(ew.language.phrase("2FAResetFailed"));
          return result;
        }).fail((jqXHR, textStatus, errorThrown) => showToast(errorThrown));
      }
    }, result => {
      var _result$error4;

      if (result != null && (_result$error4 = result.error) != null && _result$error4.description) {
        showToast(result.error.description);
      } else if (result != null && result.success) {
        showToast(ew.language.phrase("2FADisabled"), "success");
        $__default['default']("#enable-2fa").removeClass("d-none");
        $__default['default']("#disable-2fa, #backup-codes").addClass("d-none");
      }
    }).catch(err => showToast(err == null ? void 0 : err.message));
  }
  /**
   * Show backup codes for two factor authentication
   */

  function showBackupCodes() {
    let html = "<p>" + ew.language.phrase("BackupCodesMsg") + "</p>";
    return _alert({
      title: ew.language.phrase("BackupCodes"),
      html: html,
      showDenyButton: true,
      showLoaderOnDeny: true,
      showCancelButton: true,
      confirmButtonText: ew.language.phrase("CopyToClipboard"),
      denyButtonText: ew.language.phrase("GetNewCodes"),
      customClass: {
        denyButton: "btn btn-primary ew-swal2-deny-button"
      },
      willOpen: () => {
        Swal.showLoading();
        Swal.disableButtons();
        $__default['default'].get(ew.getApiUrl([ew.API_2FA_ACTION, ew.API_2FA_BACKUP_CODES])).then(result => {
          if (result.success && Array.isArray(result.codes)) {
            Swal.update({
              html: html + "<textarea class=\"form-control ew-backup-codes\" readonly>" + result.codes.join("\n") + "</textarea>"
            });
            Swal.enableButtons();
            Swal.getConfirmButton().focus();
          }
        }).fail((jqXHR, textStatus, errorThrown) => showToast(errorThrown)).always(() => Swal.hideLoading());
      },
      preConfirm: () => {
        let codes = copyToClipboard(Swal.getHtmlContainer().querySelector("textarea"));
        if (codes) showToast(ew.language.phrase("CopiedToClipboard"), "success");
        return false; // Keep the alert open
      },
      preDeny: async () => {
        Swal.showLoading(Swal.getDenyButton());
        await $__default['default'].get(ew.getApiUrl([ew.API_2FA_ACTION, ew.API_2FA_NEW_BACKUP_CODES])).then(result => {
          if (result.success && Array.isArray(result.codes)) {
            Swal.update({
              html: html + "<textarea class=\"form-control ew-backup-codes\" readonly>" + result.codes.join("\n") + "</textarea>"
            });
            Swal.getConfirmButton().focus();
          }
        }).fail((jqXHR, textStatus, errorThrown) => showToast(errorThrown)).always(() => Swal.hideLoading());
        return false; // Keep the alert open
      }
    });
  }
  /**
   * Show Add Option dialog
   *
   * @param {Object} args - Arguments
   * @param {MouseEvent} args.evt - Event
   * @param {HTMLElement} args.lnk - Add option anchor element
   * @param {string} args.el - Form element name
   * @param {string} args.url - URL of the Add form
   * @returns
   */

  function addOptionDialogShow(args) {
    var _args$evt;

    args.lnk = args.lnk || ((_args$evt = args.evt) == null ? void 0 : _args$evt.currentTarget); // Hide dialog

    var _hide = function () {
      removeScript($dlg.data("args").el);
      var frm = $dlg.removeData("args").find(".modal-body form").data("form");
      if (frm) frm.destroyEditor();
      $dlg.find(".modal-body").html("");
      $dlg.find(".modal-footer .btn-primary").off();
      $dlg.data("showing", false);
    };

    var $dlg = ew.addOptionDialog || $__default['default']("#ew-add-opt-dialog").on("hidden.bs.modal", _hide);

    if (!$dlg[0]) {
      _alert("DIV #ew-add-opt-dialog not found.");

      return;
    }

    if ($dlg.data("showing")) return;
    $dlg.data("showing", true); // Submission success

    var _submitSuccess = function (data) {
      var _results;

      var results = data,
          args = $dlg.data("args"),
          frm = forms.get(args.lnk),
          // form object
      objName = $dlg.find(".modal-body form input[name='" + ew.API_OBJECT_NAME + "']").val(),
          // Get object name from form
      el = args.el,
          // HTML element name
      re = /^x(\d+)_/,
          m = el.match(re),
          // Check row index
      prefix = m ? m[0] : "x_",
          index = m ? m[1] : -1,
          name = el.replace(re, "x_"),
          list = frm.getList(el);
      if ($__default['default'].isString(data)) results = parseJson(data);

      if ((_results = results) != null && _results.success && results[objName]) {
        // Success
        $dlg.modal("hide");
        var result = results[objName],
            form = frm.$element[0],
            // HTML form or DIV
        obj = getElements(el, form);

        if (obj) {
          var lf = list.linkField,
              dfs = list.displayFields.slice(),
              // Clone
          ffs = list.filterFields.slice(),
              // Clone
          pfs = list.parentFields.slice(); // Clone

          pfs.forEach((pf, i) => {
            if (pf.split(" ").length == 1) // Parent field in the same table, add row index
              pfs[i] = pfs[i].replace(/^x_/, prefix);
          });
          var lfv = lf != "" ? result[lf] : "",
              row = {
            lf: lfv
          };
          dfs.forEach((df, i) => {
            if (df in result) row["df" + (i || "")] = result[df];
          });
          ffs.forEach((ff, i) => {
            if (ff in result) row["ff" + (i || "")] = result[ff];
          });

          if (lfv && dfs.length > 0 && row["df"]) {
            if (list.ajax === null) // Non-Ajax
              list.lookupOptions.push(row);
            var arp = pfs.map(pf => getOptionValues(pf, form)),
                // Get the parent field values
            args = {
              "data": row,
              "parents": arp,
              "valid": true,
              "name": getId(obj),
              "form": form
            };
            $document$1.trigger("addoption", [args]);

            if (args.valid) {
              // Add the new option
              var ar = getOptions(obj),
                  txt = newOption(obj, row, form);

              if (obj.options) {
                obj.options[obj.options.length - 1].selected = true;

                if (obj.list) {
                  // Radio/Checkbox list
                  obj.render();
                  $__default['default'](obj.target).find("input").last().trigger("focus");
                }

                if (isAutoSuggest(obj)) {
                  $__default['default'](obj).val(lfv).trigger("change");
                  $__default['default'](obj.input).val(txt).trigger("focus");
                } else {
                  $__default['default'](obj).trigger("change").trigger("focus");
                }
              }

              var $form = $__default['default'](form),
                  suffix = $form.is("div") ? "_" + $form.attr("id") : "";
              var cnt = $form.find("#key_count" + suffix).val();

              if (cnt > 0) {
                // Grid-Add/Edit, update other rows
                for (var i = 1; i <= cnt; i++) {
                  if (i == index) continue;
                  var obj2 = getElements(name.replace(/^x/, "x" + i), form),
                      ar2 = getOptions(obj2);
                  if (JSON.stringify(ar) != JSON.stringify(ar2)) // Not same options
                    continue;
                  newOption(obj2, row, form);
                  if (obj2.options && obj.list) // Radio/Checkbox list
                    obj2.render();
                }
              }
            }
          }
        }
      } else {
        var _results2;

        // Failure
        if ((_results2 = results) != null && _results2.error) {
          var _results$error;

          if ($__default['default'].isString(results.error)) showToast(results.error);else if ($__default['default'].isString((_results$error = results.error) == null ? void 0 : _results$error.description)) showToast(results.error.description);
        } else {
          var msg,
              $div = $__default['default']("<div></div>").html(data).find("div.ew-message-dialog");

          if ($div[0]) {
            msg = $div.html();
          } else {
            var _results3;

            msg = ((_results3 = results) == null ? void 0 : _results3.failureMessage) || data;
            if (!msg || String(msg).trim() == "") msg = ew.language.phrase("InsertFailed");
          }

          showToast(msg);
        }
      }
    }; // Fail

    var _fail = function (o) {
      $dlg.modal("hide");

      _alert("Server Error " + o.status + ": " + o.statusText);
    }; // Submit

    var _submit = async function (e) {
      let $dlg = ew.addOptionDialog,
          form = $dlg.find(".modal-body form")[0],
          frm = forms.get(form.id),
          btn = e ? e.target : null,
          $btn = $__default['default'](btn);

      if (await frm.canSubmit()) {
        $btn.prop("disabled", false).removeClass("disabled");
        $body.css("cursor", "wait");
        $__default['default'].post(getApiUrl([ew.API_ADD_ACTION, form.elements[ew.API_OBJECT_NAME].value]), $__default['default'](form).serialize(), _submitSuccess).fail(_fail).always(function () {
          frm.enableForm();
          $btn.prop("disabled", false).removeClass("disabled");
          $body.css("cursor", "default");
        });
      }

      return false;
    };

    $dlg.modal("hide");
    $dlg.data("args", args); // Get form HTML

    var success = function (data) {
      var frm = forms.get(args.lnk),
          prefix = "x_",
          m = args.el.match(/^(x\d+_)/);
      if (m) // Contains row index
        prefix = m[1];
      var list = frm.getList(args.el),
          pfs = list.parentFields.slice() // Clone
      .map(pf => pf.split(" ").length == 1 ? pf.replace(/^x_/, prefix) : pf),
          // Parent field in the same table, add row index
      form = frm.htmlForm,
          ar = pfs.map(pf => getOptionValues(pf, form)),
          ar2 = pfs.map(pf => getOptionTexts(pf, form)),
          ffs = list.filterFieldVars.slice(); // Clone

      $dlg.find(".modal-title").html($__default['default'](args.lnk).closest(".ew-add-opt-btn").data("title"));
      $dlg.find(".modal-body").html(stripScript(data));
      var form = $dlg.find(".modal-body form")[0];

      if (form) {
        // Set the filter field value
        $__default['default'](form).on("keydown", function (e) {
          if (e.key == "Enter" && e.target.nodeName != "TEXTAREA") return _submit();
        });
        ar.forEach((v, i) => {
          (function () {
            var obj = getElements(ffs[i], form);

            if (obj) {
              if (obj.options || obj.length) {
                // Selection list
                $__default['default'](obj).first().one("updated", () => selectOption(obj, v));
              } else {
                selectOption(obj, v);
              }
            }
          })();
        });
      }

      ew.addOptionDialog = $dlg.modal("show");
      $dlg.find(".modal-footer .btn-primary").click(_submit).focus();
      executeScript(data, args.el);

      if (form) {
        // Set the filter field value
        ar.forEach((v, i) => {
          var obj = getElements(ffs[i], form);

          if (obj) {
            if (isAutoSuggest(obj)) {
              // AutoSuggest
              obj.value = v[0];
              obj.input.value = ar2[i][0];
              obj.add(v[0], ar2[i][0], true);
            } else if (obj.options || obj.length) ; else {
              // Text
              obj.value = v[0];
            }
          }
        });
      }

      $dlg.trigger("load.ew");
    };

    $__default['default'].get(args.url, success).fail(_fail);
    return false;
  } // Hide Modal dialog

  function modalDialogHide(e) {
    var $dlg = $__default['default'](this),
        args = $dlg.data("args");
    removeScript("modal_dialog");
    var frm = $dlg.removeData("args").find(".modal-body form").data("form");
    frm == null ? void 0 : frm.destroyEditor();
    $dlg.find(".modal-footer .btn-primary").off();
    $dlg.find(".modal-dialog").removeClass((i, className) => {
      var m = className.match(/table\-\w+/);
      return m ? m[0] : "";
    });
    $dlg.data({
      showing: false,
      url: null
    });
    if (args != null && args.reload) window.location.reload();
  }
  /**
   * Show modal dialog
   *
   * @param {Object} args - Arguments
   * @param {MouseEvent} args.evt - Event
   * @param {HTMLFormElement} args.f - Form of List page
   * @param {HTMLElement} args.lnk - Anchor element
   * @param {string} args.url - URL of the form
   * @param {string|null} args.btn - Button phrase ID
   * @param {boolean} args.footer - Show footer (default true)
   * @param {string} args.caption - Caption in dialog header
   * @param {boolean} args.reload - Reload page after hiding dialog or not
   * @param {string} args.size - Class name of modal dialog 'modal-sm'|'modal-md'|modal-lg'|'modal-xl' (default)
   * @returns false
   */

  function modalDialogShow(args) {
    var _args$evt2, _args$evt3, _args$evt3$currentTar, _args$evt4, _args$evt4$currentTar;

    args.lnk = args.lnk || ((_args$evt2 = args.evt) == null ? void 0 : _args$evt2.currentTarget);
    $__default['default'](args.lnk).tooltip("hide");
    var f = args.f || ((_args$evt3 = args.evt) == null ? void 0 : (_args$evt3$currentTar = _args$evt3.currentTarget) == null ? void 0 : _args$evt3$currentTar.form);

    if (f && !keySelected(f)) {
      _prompt("<p class=\"text-danger\">" + ew.language.phrase("NoRecordSelected") + "</p>");

      return false;
    }

    var url = args.url || ((_args$evt4 = args.evt) == null ? void 0 : (_args$evt4$currentTar = _args$evt4.currentTarget) == null ? void 0 : _args$evt4$currentTar.dataset.url),
        $dlg = ew.modalDialog || $__default['default']("#ew-modal-dialog").on("hidden.bs.modal", modalDialogHide); // div#ew-modal-dialog always exists

    if ($dlg.data("showing") && $dlg.data("url") == url) return false;
    $dlg.data({
      showing: true,
      url: url
    });
    args.reload = false; // size

    var size = args.size || "modal-xl";
    $dlg.find(".modal-dialog").removeClass("modal-sm modal-md modal-lg modal-xl").addClass(size); // caption

    var _caption = function () {
      var args = $dlg.data("args"),
          $lnk = $__default['default'](args.lnk);
      return args.caption || $lnk.data("caption") || $lnk.data("original-title") || "";
    }; // button text

    var _button = function () {
      var args = $dlg.data("args");
      if ($__default['default'].isNull(args.btn)) return "";else if (args.btn && args.btn != "") return ew.language.phrase(args.btn);else return _caption();
    }; // fail

    var _fail = function (o) {
      $dlg.modal("hide");
      if (o.status) _alert("Server Error " + o.status + ": " + o.statusText);
    }; // always

    var _always = function (o) {
      $body.css("cursor", "default");
    }; // check if current page

    var _current = function (url) {
      var a = $__default['default']("<a>", {
        href: url
      })[0];
      return window.location.pathname.endsWith(a.pathname);
    };
    /**
     * handle result
     *
     * @param {Object} result - Result object
     * @param {string|Object} result.error - Error message or object
     * @param {string} result.error.message - Error message
     * @param {string} result.error.description - Error message
     * @param {string} result.failureMessage - Failure message
     * @param {string} result.successMessage - Success message
     * @param {string} result.warningMessage - Warning message
     * @param {string} result.message - Message
     * @param {string} result.url - Redirection URL
     * @param {string} result.modal - Redirect to result.url in current modal dialog
     * @param {boolean} result.view - result.url is View page => No primary button
     * @param {string} result.caption - Caption of modal dialog for result.url
     * @param {boolean} result.reload - Reload current page
     */

    var handleResult = function (result) {
      var cb = null,
          url = result.url,
          reload = result.reload;

      if (url || reload) {
        cb = function () {
          if (url) {
            if (result.modal && !_current(url)) {
              var args = $dlg.data("args");
              args.reload = true;
              if (result.caption) args.caption = result.caption;
              args.btn = result.view ? null : "";
              $dlg.data("args", args);
              url += (url.split("?").length > 1 ? "&" : "?") + "modal=1&rnd=" + random();
              $body.css("cursor", "wait");
              $__default['default'].get(url).done(success).fail(_fail).always(_always);
            } else {
              $dlg.modal("hide");
              window.location = sanitizeUrl(url);
            }
          } else if (reload) {
            $dlg.modal("hide");
            window.location.reload();
          }
        };
      }

      if ($__default['default'].isString(result.failureMessage)) {
        _alert(result.failureMessage);
      } else if ($__default['default'].isString(result.warningMessage)) {
        _alert(result.warningMessage, cb, "warning");
      } else if ($__default['default'].isString(result.message)) {
        _alert(result.message, cb, "body");
      } else if ($__default['default'].isString(result.successMessage)) {
        _alert(result.successMessage, cb, "success");
      } else if (result.error) {
        var _result$error5, _result$error6;

        if ($__default['default'].isString(result.error)) _alert(result.error);else if ($__default['default'].isString((_result$error5 = result.error) == null ? void 0 : _result$error5.message)) _alert(result.error.message);else if ($__default['default'].isString((_result$error6 = result.error) == null ? void 0 : _result$error6.description)) _alert(result.error.description);
      } else if (cb) {
        cb();
      }
    }; // submit success

    var _submitSuccess = function (data) {
      var result = parseJson(data);

      if ($__default['default'].isObject(result)) {
        handleResult(result);
      } else {
        var body = getContent(data);

        if (body.length) {
          // Has HTML elements
          var $bd = $dlg.find(".modal-body").html(body);
          var footer = "";
          var cf = $bd.find("#confirm");
          var ct = $bd.find("#conflict");

          if ((ct == null ? void 0 : ct.val()) == "1") {
            // Conflict page
            footer += "<button type=\"button\" id=\"btn-overwrite\" class=\"btn btn-primary ew-btn\">" + ew.language.phrase("OverwriteBtn") + "</button>";
            footer += "<button type=\"button\" id=\"btn-reload\" class=\"btn btn-default ew-btn\">" + ew.language.phrase("ReloadBtn") + "</button>";
            footer += "<button type=\"button\" class=\"btn btn-default ew-btn\" data-bs-dismiss=\"modal\">" + ew.language.phrase("CancelBtn") + "</button>";
            $dlg.find(".modal-footer").html(footer);
            $dlg.find(".modal-footer #btn-overwrite").on('click', {
              action: 'overwrite'
            }, _submit);
            $dlg.find(".modal-footer #btn-reload").on('click', {
              action: 'show'
            }, _submit);
          } else if ((cf == null ? void 0 : cf.val()) == "confirm") {
            // Confirm page
            footer += "<button type=\"button\" class=\"btn btn-primary ew-btn\">" + ew.language.phrase("ConfirmBtn") + "</button>";
            footer += "<button type=\"button\" class=\"btn btn-default ew-btn\">" + ew.language.phrase("CancelBtn") + "</button>";
            $dlg.find(".modal-footer").html(footer);
            $dlg.find(".modal-footer .btn-primary").click(_submit).focus();
            $dlg.find(".modal-footer .btn-default").on("click", {
              action: "cancel"
            }, _submit);
          } else {
            // Normal page
            var btn = _button();

            if (btn) footer += "<button type=\"button\" class=\"btn btn-primary ew-btn\">" + btn + "</button>";
            footer += "<button type=\"button\" class=\"btn btn-default ew-btn\" data-bs-dismiss=\"modal\">" + ew.language.phrase("CancelBtn") + "</button>";
            $dlg.find(".modal-footer").html(footer);
            $dlg.find(".modal-footer .btn-primary").addClass("ew-submit").click(_submit).focus();
          }

          executeScript(data, "modal_dialog");
          $dlg.trigger("load.ew"); // Trigger load event for, e.g. Use JavaScript popup message
        } else if (data) {
          $dlg.modal("hide");

          _alert(data);
        }
      }
    }; // submit

    var _submit = async function (e) {
      var form = $dlg.find(".modal-body form")[0],
          $form = $__default['default'](form),
          frm = forms.get(form.id),
          action = e != null && e.data ? e.data.action : null,
          btn = e ? e.target : null;

      if (btn) {
        if (btn.classList.contains("disabled")) return false;

        frm.enableForm = function () {
          $__default['default'](btn).prop("disabled", false).removeClass("disabled");
        };

        frm.disableForm = function () {
          $__default['default'](btn).prop("disabled", true).addClass("disabled");
        };
      }

      var input = form.elements["action"];
      if (action && input) input.value = action; // Update action

      if (action == "cancel") {
        // Cancel
        $__default['default'].post($form.attr("action"), $form.serialize(), success).fail(_fail).always(_always);
      } else if (await frm.canSubmit()) {
        $body.css("cursor", "wait");
        $__default['default'].post($form.attr("action"), $form.serialize(), _submitSuccess).fail(_fail).always(function () {
          frm.enableForm();

          _always();
        });
      }

      return false;
    };

    $dlg.modal("hide");
    $dlg.data("args", args);

    var success = function (data) {
      var result = parseJson(data);

      if ($__default['default'].isObject(result)) {
        handleResult(result);
      } else {
        var args = $dlg.data("args");
        var $lnk = $__default['default'](args.lnk);
        $dlg.find(".modal-title").html(_caption());
        var footer = "";

        var btn = _button();

        if (btn) footer += "<button type=\"button\" class=\"btn btn-primary ew-btn\">" + btn + "</button>";
        if (footer != "") footer += "<button type=\"button\" class=\"btn btn-default ew-btn\" data-bs-dismiss=\"modal\">" + ew.language.phrase("CancelBtn") + "</button>";else footer = "<button type=\"button\" class=\"btn btn-default ew-btn\" data-bs-dismiss=\"modal\">" + ew.language.phrase("CloseBtn") + "</button>";
        $dlg.find(".modal-footer").html(footer).toggle(args.footer !== false);
        var body = getContent(data);
        $dlg.find(".modal-body").html(body);
        var table = $lnk.data("table");
        if (table) $dlg.find(".modal-dialog").addClass("table-" + table);
        var $btn = $dlg.find(".modal-footer .btn-primary").addClass("ew-submit").click(_submit);
        $dlg.find(".modal-body form").on("keydown", function (e) {
          if (e.key == "Enter" && e.target.nodeName != "TEXTAREA") {
            $btn.click();
            return false;
          }
        });
        ew.modalDialog = $dlg.modal("show");
        executeScript(data, "modal_dialog");
        $dlg.trigger("load.ew"); // Trigger load event for, e.g. YouTube videos, ReCAPTCHA and Google maps

        $btn.focus();
      }
    };

    $body.css("cursor", "wait");

    if (f) {
      // Post form
      var $f = $__default['default'](f);
      if (!f.elements.modal) $__default['default']("<input>").attr({
        type: "hidden",
        name: "modal",
        value: "1"
      }).appendTo($f);
      $__default['default'].post(url, $f.serialize(), success).fail(_fail).always(_always);
    } else {
      url += (url.split("?").length > 1 ? "&" : "?") + "modal=1&rnd=" + random();
      $__default['default'].get(url, success).fail(_fail).always(_always);
    }

    return false;
  }
  /**
   * Show dialog for import
   *
   * @param {Object} args - Arguments
   * @param {string} args.hdr - Dialog header
   * @param {HTMLElement} args.lnk - Anchor element
   * @returns
   */

  function importDialogShow(args) {
    var _args$evt5;

    args.lnk = args.lnk || ((_args$evt5 = args.evt) == null ? void 0 : _args$evt5.currentTarget);
    $__default['default'](args.lnk).tooltip("hide");
    var $dlg = ew.importDialog || $__default['default']("#ew-import-dialog");

    if (!$dlg[0]) {
      _alert("DIV #ew-import-dialog not found.");

      return false;
    }

    var $input = $dlg.find("#importfiles"),
        $dropzone = $input.closest(".ew-file-drop-zone"),
        $bd = $dlg.find(".modal-body"),
        $data = $bd.find(":input[id!=importfiles]"),
        $message = $bd.find(".message"),
        $progress = $bd.find(".progress"),
        timer; // Disable buttons

    var enableButtons = function () {
      $dlg.find(".modal-footer .btn").prop("disabled", false);
    }; // Show message

    var showMessage = function (msg, classname) {
      var $msg = $__default['default']("<div>" + msg + "</div>");
      if (classname) $msg.addClass(classname);
      $message.removeClass("d-none").html($msg);
      if (classname == "text-danger") enableButtons();
    }; // Hide message

    var hideMessage = function () {
      $message.addClass("d-none").html("");
    }; // Show progress

    var showProgress = function (pc, classname) {
      $progress.removeClass("d-none").find(".progress-bar").removeClass("bg-success bg-info").addClass(classname || "bg-success").attr("aria-valuenow", pc).css("width", pc + "%").html(pc + "%");
    }; // Hide progress

    var hideProgress = function () {
      $progress.addClass("d-none").find(".progress-bar").attr("aria-valuenow", 0).css("width", "0%").html("0%");
    }; // Upload progress

    var uploadProgress = function (data) {
      var pc = parseInt(100 * data.loaded / data.total);
      showProgress(pc, "bg-primary");

      if (pc === 100) {
        showMessage(ew.language.phrase("ImportMessageUploadComplete"), "text-primary");
      } else {
        showMessage(ew.language.phrase("ImportMessageUploadProgress").replace("%p", pc), "text-primary");
      }
    }; // Update progress (import)

    var updateProgress = function (result) {
      try {
        var cnt = parseInt(result.count),
            tcnt = parseInt(result.totalCount),
            filename = result.file;

        if (tcnt > 0 && $dlg.find(".modal-footer .ew-close-btn").data("import-progress")) {
          // Show progress
          var pc = parseInt(100 * cnt / tcnt);
          showProgress(pc);
          showMessage(ew.language.phrase("ImportMessageProgress").replace("%t", tcnt).replace("%c", cnt).replace("%f", filename), "text-primary");
        }
      } catch (e) {}
    }; // Import progress

    var importProgress = function () {
      var url = getApiUrl(ew.API_PROGRESS_ACTION),
          data = {
        "rnd": random()
      };
      data[ew.API_FILE_TOKEN_NAME] = $input.data(ew.API_FILE_TOKEN_NAME);
      $__default['default'].get(url, data, updateProgress, "json");
    }; // Import complete

    var importComplete = function (result) {
      var maxErrorCount = 5;
      var msg = "";
      showProgress(100);
      var fileResults = result.files;
      $dlg.find(".modal-footer .ew-close-btn").data("import-progress", false); // Stop import progress

      if (Array.isArray(fileResults)) {
        for (var i = 0, len = fileResults.length; i < len; i++) {
          var fileResult = fileResults[i],
              tcnt = fileResult.totalCount || 0,
              cnt = fileResult.count || 0,
              scnt = fileResult.successCount || 0,
              fcnt = fileResult.failCount || 0;
          if (msg != "") msg += "<br>";

          if (fileResult.success) {
            msg += ew.language.phrase("ImportMessageSuccess").replace("%t", tcnt).replace("%c", cnt).replace("%f", fileResult.file);
          } else {
            msg += ew.language.phrase("ImportMessageError1").replace("%t", tcnt).replace("%c", cnt).replace("%f", fileResult.file).replace("%s", scnt).replace("%e", fcnt);
            if (fileResult.error) msg += ew.language.phrase("ImportMessageError2").replace("%e", fileResult.error);
            var showLog = true;

            if (fileResult.failList) {
              var ecnt = 0;

              for (var i = 1; i <= cnt; i++) {
                if (fileResult.failList["row" + i]) {
                  ecnt += 1;
                  msg += "<br>" + ew.language.phrase("ImportMessageError3").replace("%i", i).replace("%d", fileResult.failList["row" + i]);
                }

                if (ecnt >= maxErrorCount) break;
              }

              if (fcnt > maxErrorCount) msg += "<br>" + ew.language.phrase("ImportMessageMore").replace("%s", fcnt - maxErrorCount);else showLog = false;
            }

            if (fileResult.log && showLog) msg += "<br>" + ew.language.phrase("ImportMessageError4").replace("%l", fileResult.log);
            showMessage(msg, "text-danger"); // Show error message
          }
        }
      }

      if (result.success) {
        showMessage(msg, "text-success");
        $dlg.find(".modal-footer .ew-close-btn").data("imported", true);
      } else {
        if (result.error) msg = result.error;
        showMessage(msg, "text-danger"); // Show error message
      }

      hideProgress();
    }; // Import fail

    var importFail = function (o) {
      $dlg.find(".modal-footer .ew-close-btn").data("import-progress", false); // Stop import progress

      showMessage(ew.language.phrase("ImportMessageServerError").replace("%s", o.status).replace("%t", o.statusText), "text-danger");
    }; // Import file

    var importFiles = function (filetoken) {
      $body.css("cursor", "wait");
      $input.data(ew.API_FILE_TOKEN_NAME, filetoken);
      $dlg.find(".modal-footer .ew-close-btn").data("import-progress", true); // Show import progress

      var data = ew.API_ACTION_NAME + "=import&" + ew.API_FILE_TOKEN_NAME + "=" + encodeURIComponent(filetoken);
      if ($data.length) data += "&" + $data.serialize();
      $__default['default'].ajax(currentPage(), {
        "data": data,
        "method": "POST",
        "dataType": "json",
        "beforeSend": function (xhr, settings) {
          timer = $__default['default'].later(100, null, importProgress, null, true); // Use time to show progress periodically
        }
      }).done(importComplete).fail(importFail).always(function () {
        $body.css("cursor", "default");
        if (timer) timer.cancel(); // Clear timer
      });
    };

    var options = ew.importUploadOptions;
    if (!options.acceptFileTypes) options.acceptFileTypes = new RegExp('\\.(' + ew.IMPORT_FILE_ALLOWED_EXT.replace(/,/g, '|') + ')$', 'i');

    if (!$input.data("blueimpFileupload")) {
      $input.fileupload(Object.assign({
        url: getApiUrl(ew.API_UPLOAD_ACTION),
        dataType: "json",
        autoUpload: true,
        singleFileUploads: false,
        dropZone: $dropzone,
        messages: {
          acceptFileTypes: ew.language.phrase("UploadErrMsgAcceptFileTypes"),
          maxFileSize: ew.language.phrase("UploadErrMsgMaxFileSize"),
          maxNumberOfFiles: ew.language.phrase("UploadErrMsgMaxNumberOfFiles"),
          minFileSize: ew.language.phrase("UploadErrMsgMinFileSize")
        },
        beforeSend: function (jqxhr, settings) {
          settings.data.set("session", ew.SESSION_ID);
          settings.data.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME); // Add token name for $.ajax() sent by jQuery File Upload (not by ajaxSend) // PHP

          settings.data.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN); // Add antiforgery token for $.ajax() sent by jQuery File Upload (not by ajaxSend) // PHP

          if (ew.API_JWT_TOKEN && !ew.IS_WINDOWS_AUTHENTICATION) // Do NOT set JWT authorization header if Windows Authentication
            jqxhr.setRequestHeader(ew.API_JWT_AUTHORIZATION_HEADER, "Bearer " + ew.API_JWT_TOKEN);
        },
        done: function (e, data) {
          var _data$result, _data$result$files;

          if (Array.isArray(data == null ? void 0 : (_data$result = data.result) == null ? void 0 : (_data$result$files = _data$result.files) == null ? void 0 : _data$result$files.importfiles)) {
            var ok = true;
            data.result.files.importfiles.forEach(function (file, index) {
              if (file.error) {
                showMessage(ew.language.phrase("ImportMessageUploadError").replace("%f", file.name).replace("%s", file.error), "text-danger");
                ok = false;
              }
            }); // Show upload errors for each file

            if (ok) importFiles(data.result[ew.API_FILE_TOKEN_NAME]); // Import uploaded files
          }
        },
        change: function (e, data) {
          hideMessage();
        },
        processfail: function (e, data) {
          data.files.forEach(function (file, index) {
            if (file.error) showMessage(ew.language.phrase("ImportMessageUploadError").replace("%f", file.name).replace("%s", file.error), "text-danger");
          }); // Show process errors for each file
        },
        fail: function (e, data) {
          showMessage(ew.language.phrase("ImportMessageServerError").replace("%s", data.textStatus).replace("%t", data.errorThrown), "text-danger");
        },
        progressall: function (e, data) {
          uploadProgress(data);
        }
      }, options));
    }

    $dlg.modal("hide").find(".modal-title").html(args.hdr);
    $dlg.find(".modal-footer .ew-close-btn").off("click.ew").on("click.ew", function () {
      var $this = $__default['default'](this);

      if ($this.data("imported")) {
        $this.data("imported", false);
        window.location.reload();
      }
    });
    hideMessage();
    ew.importDialog = $dlg.modal("show");
    return false;
  } // Auto-fill

  function autoFill(el) {
    var f = forms.get(el).$element[0];
    if (!f) return;
    var ar = getOptionValues(el),
        id = getId(el),
        m = id.match(/^([xy])(\d*)_/),
        rowindex = m ? m[2] : "",
        list = forms.get(el).getList(id),
        dest_array = list.autoFillTargetFields;

    var success = function (data) {
      var results = (data == null ? void 0 : data.records) || "";
      var result = results ? results[0] : [];

      for (var j = 0; j < dest_array.length; j++) {
        var destEl = getElements(dest_array[j].replace(/^x_/, "x" + rowindex + "_"), f);

        if (destEl) {
          var val = $__default['default'].isValue(result["af" + j]) ? String(result["af" + j]) : "";
          var args = {
            results: results,
            result: result,
            data: val,
            form: f,
            name: id,
            target: dest_array[j],
            cancel: false,
            trigger: true
          };
          $__default['default'](el).trigger("autofill", [args]); // Fire event

          if (args.cancel) continue;
          val = args.data; // Process the value

          if (destEl.options) {
            // Selection list
            selectOption(destEl, val.split(","));

            if (isAutoSuggest(destEl)) {
              // Auto-Suggest
              destEl.input.value = val;
              updateOptions.call(forms.get(f.id), destEl);
            }
          } else if (isHiddenTextArea(destEl)) {
            // HTML editor
            destEl.value = val;
            $__default['default'](destEl).data("editor").set();
          } else {
            destEl.value = val;
          }

          if (args.trigger) $__default['default'](destEl).trigger("change");
        }
      }

      return result;
    };

    if (ar.length > 0 && ar[0] != "") {
      var data = Object.assign({
        page: list.page,
        field: list.field,
        ajax: "autofill",
        v0: ar[0],
        language: ew.LANGUAGE_ID
      }, getUserParams('#p_' + id, f)); // Add parent field values

      var parentId = list.parentFields.slice(); // Clone

      if (rowindex != "") {
        for (var i = 0, len = parentId.length; i < len; i++) {
          var ar = parentId[i].split(" ");
          if (ar.length == 1) // Parent field in the same table, add row index
            parentId[i] = parentId[i].replace(/^x_/, "x" + rowindex + "_");
        }
      }

      var arp = parentId.map(function (pid) {
        return getOptionValues(pid, f);
      });

      for (var i = 0, cnt = arp.length; i < cnt; i++) // Filter by parent fields
      data["v" + (i + 1)] = arp[i].join(ew.MULTIPLE_OPTION_SEPARATOR);

      return $__default['default'].post(getApiUrl(ew.API_LOOKUP_ACTION), data, success, "json");
    }

    return success();
  } // Setup tooltip links

  function tooltip(i, el) {
    var $this = $__default['default'](el),
        $tt = $__default['default']("#" + $this.data("tooltip-id")),
        trig = $this.data("trigger") || "hover",
        dir = $this.data("placement") || "auto";
    if (!$tt[0] || $tt.text().trim() == "" && !$tt.find("img[src!='']")[0]) return;

    if (!bootstrap.Popover.getInstance(el)) {
      $this.popover({
        html: true,
        placement: dir,
        trigger: trig,
        delay: 100,
        container: document.getElementById("ew-tooltip"),
        content: $tt.html(),
        sanitizeFn: ew.sanitizeFn
      }).on("show.bs.popover", function (e) {
        var wd = $this.data("tooltip-width");
        if (wd) // Set width before show
          $__default['default'](bootstrap.Popover.getInstance(el).getTipElement()).css("max-width", parseInt(wd, 10) + "px");
      });
    }
  }
  /**
   * Show dialog for email sending
   *
   * @param {Object} args - Arguments
   * @param {MouseEvent} args.evt - Event
   * @param {string} args.hdr - Dialog header
   * @param {Object} args.key - Key as object
   * @param {boolean} args.sel - Exported selected only
   * @param {string} args.url - URL of content (for Custom Template)
   * @param {string} args.exportid - Export ID (for Custom Template)
   * @returns false
   */

  function emailDialogShow(args) {
    var $dlg = ew.emailDialog || $__default['default']("#ew-email-dialog").on("shown.bs.modal", e => setTimeout(() => {
      var _e$target$querySelect;

      return (_e$target$querySelect = e.target.querySelector(".modal-body .form-control")) == null ? void 0 : _e$target$querySelect.focus();
    }, 200)).on("click", ".modal-footer .btn-primary", function (e) {
      var _$$closest$find$data;

      e.preventDefault();
      if ((_$$closest$find$data = $__default['default'](this).closest(".modal").find(".modal-body form").data("form")) != null && _$$closest$find$data.submit()) $dlg.modal("hide");
    });

    if (!$dlg[0]) {
      _alert("DIV #ew-email-dialog not found.");

      return false;
    }

    var form = args.evt.currentTarget.form;

    if (args.sel && !keySelected(form)) {
      _alert(ew.language.phrase("NoRecordSelected"));

      return false;
    }

    var $f = $dlg.find(".modal-body form"),
        frm = $f.data("form");

    if (!frm) {
      frm = new Form($f.attr("id"));
      frm.addFields([["sender", [ew.Validators.required(ew.language.phrase("Sender")), ew.Validators.email]], ["recipient", [ew.Validators.required(ew.language.phrase("Recipient")), ew.Validators.emails(ew.MAX_EMAIL_RECIPIENT, ew.language.phrase("EnterProperRecipientEmail"))]], ["cc", ew.Validators.emails(ew.MAX_EMAIL_RECIPIENT, ew.language.phrase("EnterProperCcEmail"))], ["bcc", ew.Validators.emails(ew.MAX_EMAIL_RECIPIENT, ew.language.phrase("EnterProperBccEmail"))], ["subject", ew.Validators.required(ew.language.phrase("Subject"))]]);

      frm.validate = function () {
        return this.validateFields();
      };

      frm.submit = function () {
        if (!this.validate()) return false;
        var data = [$f.serialize()];
        if (form && args.sel) // Export selected
          data.push($__default['default'](form).find("input[type=checkbox][name='key_m[]']:checked").serialize());
        if (args.key) data.push($__default['default'].param(args.key));
        var fobj = this.getForm();

        if (args.url) {
          // Custom Template
          $dlg.modal("hide");
          if (args.exportid) ew.exportWithCharts(args.url, args.exportid, fobj);else _export(args.evt, args.url, "email", true, args.sel, fobj);
        } else {
          $__default['default'].post(form.getAttribute("action"), data.join("&"), result => showMessage(result)); // Do not use form.action
        }

        return true;
      };

      $f.data("form", frm);
    }

    ew.emailDialog = $dlg.modal("hide").find(".modal-title").html(args.hdr).end().modal("show");
    return false;
  } // Show drill down

  function showDrillDown(e, obj, url, id, hdr) {
    if (e != null && e.ctrlKey) {
      var arUrl = url.split("?"),
          params = new URLSearchParams(arUrl[1]);
      params.set("d", "2"); // Change d parameter to 2

      return redirect(arUrl[0] + "?" + params.toString());
    }

    var $obj = $__default['default'](obj);
    var pos = $obj.data("drilldown-placement") || "auto";
    var args = {
      obj: $obj[0],
      placement: pos,
      id,
      url,
      hdr
    };
    $document$1.trigger("drilldown", [args]);
    var ar = args.url.split("?");
    args.file = ar[0] || "";
    args.data = ar[1] || "";

    if (!bootstrap.Popover.getInstance(obj)) {
      $obj.popover({
        html: true,
        placement: args.placement,
        trigger: "manual",
        title: args.hdr,
        template: '<div class="popover" role="tooltip"><h3 class="popover-header d-none" style="cursor: move;"></h3><div class="popover-body"></div></div>',
        // No .popover-arrow
        content: '<div class="' + ew.spinnerClass + ' m-3 ew-loading" role="status"><span class="visually-hidden">' + ew.language.phrase("Loading") + '</span></div>',
        container: $__default['default']("#ew-drilldown-panel").draggable(ew.draggableOptions),
        sanitizeFn: ew.sanitizeFn,
        boundary: "viewport"
      }).on("show.bs.popover", function (e) {
        $obj.attr("data-original-title", "");
      }).on("shown.bs.popover", function (e) {
        if (!$obj.data("args")) return;
        var data = $obj.data("args").data;
        $__default['default'].ajax({
          cache: false,
          dataType: "html",
          type: "POST",
          data: data,
          url: $obj.data("args").file,
          success: function (data) {
            var $tip = $__default['default'](bootstrap.Popover.getInstance(obj).getTipElement());
            if (args.hdr) $tip.find(".popover-header").empty().removeClass("d-none").append('<button type="button" class="btn-close" aria-label="' + ew.language.phrase("CloseBtn") + '"></button>' + args.hdr).find(".btn-close").on("click", function () {
              $obj.popover("hide");
            });
            var m = data.match(/<body[^>]*>([\s\S]*?)<\/body\s*>/i); // Use HTML in document body only

            data = m ? m[0] : data;
            var html = ew.stripScript(data);
            $tip.find(".popover-body").html($__default['default']("<div></div>").html(html).find("#ew-report")) // Insert the container table only
            .find(".ew-table").each(ew.setupTable);
            ew.executeScript(data, id);
            $obj.popover("update");
          },
          error: function (o) {
            if (o.responseText) {
              if ($__default['default'].isString(o.responseText) && o.responseText.startsWith("{") && o.responseText.endsWith("}")) {
                var _result$error7, _result$error8;

                var result = parseJson(o.responseText);

                if (result != null && (_result$error7 = result.error) != null && _result$error7.type && result != null && (_result$error8 = result.error) != null && _result$error8.description) {
                  bootstrap.Popover.getInstance(obj).hide();
                  return _alert({
                    title: result.error.type,
                    html: result.error.description,
                    customClass: {
                      title: "ew-swal2-title text-danger",
                      htmlContainer: "ew-swal2-html-container text-danger"
                    }
                  });
                }
              }

              var $tip = $__default['default'](bootstrap.Popover.getInstance(obj).getTipElement());
              $tip.find(".popover-body").empty().append('<p class="text-danger">' + o.responseText + '</p>');
            }
          }
        });
      }).on("hidden.bs.popover", function (e) {
        ew.removeScript(id);
      });
    }

    $obj.data("args", args).popover("show");
  }
  /**
   * Ajax query
   * @param {Object} data - Object to passed to API
   * @param {callback} callback - Callback function for async request (see http://api.jquery.com/jQuery.post/), empty for sync request
   * @returns {string|string[]}
   */

  function ajax(data, callback) {
    if (!$__default['default'].isObject(data) || !data.url && !data.action) return undefined;
    var action;

    if (data.url) {
      if (data.url.startsWith(getApiUrl())) action = data.url.replace(getApiUrl(), "").split("/")[0];else if (data.url.startsWith(ew.API_URL)) action = data.url.replace(ew.API_URL, "").split("/")[0];
    } else {
      action = data.action;
      delete data.action;
    }

    var obj = Object.assign({}, data);

    var _convert = response => {
      if ($__default['default'].isObject(response) && response.result == "OK") {
        var results = response.records;

        if (Array.isArray(results) && results.length == 1) {
          // Single row
          results = results[0];
          if (Array.isArray(results) && results.length == 1) // Single column
            return results[0]; // Return a value
          else return results; // Return a row
        }

        return results;
      }

      return response;
    };

    var url = obj.url || getApiUrl(action),
        // URL
    type = obj.type || ([ew.API_LIST_ACTION, ew.API_VIEW_ACTION, ew.API_DELETE_ACTION].includes(action) ? "GET" : "POST");
    delete obj.url;
    delete obj.type;
    obj.dataType = "json";

    if (isFunction$2(callback)) {
      // Async
      $__default['default'].ajax({
        url: url,
        type: type,
        data: obj,
        success: function (response) {
          callback(_convert(response));
        }
      });
    } else {
      // Sync
      var response = $__default['default'].ajax({
        url: url,
        async: false,
        type: type,
        data: obj
      });
      return _convert(response.responseJSON);
    }
  } // Get URL of current page

  function currentPage() {
    return location.href.split("#")[0].split("?")[0];
  } // Toggle search operator

  function toggleSearchOperator(e, id, value) {
    var el = e.currentTarget.form.elements[id];
    if (!el) return;
    el.value = el.value != value ? value : "=";
  } // Toggle multi-column layout

  function toggleLayout(el) {
    var _bootstrap$Tooltip$ge4;

    (_bootstrap$Tooltip$ge4 = bootstrap.Tooltip.getInstance(el)) == null ? void 0 : _bootstrap$Tooltip$ge4.hide();
    $body.css("cursor", "wait");
    let layout = el.dataset.layout,
        grid = document.querySelector(".ew-multi-column-grid"),
        $grid = $__default['default'](grid);
    $grid.load(sanitizeUrl(el.dataset.url + ew.PAGE_LAYOUT + "=" + layout) + " .ew-multi-column-grid", (response, status, xhr) => {
      if (status == "error") {
        _alert(xhr.status + " " + xhr.statusText);
      } else {
        var _document$createRange, _document$createRange2;

        removeScript(layout);
        executeScript((_document$createRange = (_document$createRange2 = document.createRange().createContextualFragment(response).querySelector(".ew-multi-column-grid")) == null ? void 0 : _document$createRange2.innerHTML) != null ? _document$createRange : "", layout);
        ew.initPage({
          target: grid
        });
        $body.css("cursor", "default");
        $grid.trigger("layout");
      }
    });
  } // Copy inner text to clipboard

  function copyToClipboard(source) {
    var _source, _source2;

    source = $__default['default'].isString(source) ? document.querySelector(source) : source;
    const str = ((_source = source) == null ? void 0 : _source.value) || ((_source2 = source) == null ? void 0 : _source2.innerText);

    if (str) {
      const el = document.createElement("textarea");
      el.value = str;
      el.setAttribute("readonly", "");
      el.style.position = "absolute";
      el.style.left = "-9999px";
      document.body.appendChild(el);
      el.select();
      document.execCommand("copy");
      document.body.removeChild(el);
    }

    return str;
  }
  /**
   * Validators
   */
  // Check integer

  function checkInteger(object_value) {
    if (!object_value || object_value.length == 0) return true;
    if (object_value.includes(ew.DECIMAL_SEPARATOR)) return false;
    return checkNumber(object_value);
  } // Check number

  function checkNumber(object_value) {
    object_value = String(object_value);
    if (!object_value || object_value.length == 0) return true;
    object_value = object_value.trim(); // let re = new RegExp("^[+\-\d\s%" + escapeRegExChars(ew.DECIMAL_SEPARATOR) + escapeRegExChars(ew.GROUPING_SEPARATOR) + ew.CURRENCY_SYMBOL + "]+$");
    // return re.test(object_value) && ew.parseNumber(object_value) !== null;

    return ew.parseNumber(object_value) !== null;
  } // Escape regular expression chars

  function escapeRegExChars(str) {
    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
  } // Check range

  function checkRange(object_value, min_value, max_value) {
    if (!object_value || object_value.length == 0) return true;

    if ($__default['default'].isNumber(min_value) || $__default['default'].isNumber(max_value)) {
      // Number
      if (checkNumber(object_value)) object_value = ew.parseNumber(object_value);
    }

    if (!$__default['default'].isNull(min_value) && object_value < min_value) return false;
    if (!$__default['default'].isNull(max_value) && object_value > max_value) return false;
    return true;
  } // Check phone

  function checkPhone(object_value) {
    if (!object_value || object_value.length == 0) return true;
    return /^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}$/.test(object_value.trim());
  } // Check zip

  function checkZip(object_value) {
    if (!object_value || object_value.length == 0) return true;
    return /^\d{5}$|^\d{5}-\d{4}$/.test(object_value.trim());
  } // Check credit card

  function checkCreditCard(object_value) {
    if (!object_value || object_value.length == 0) return true;
    var creditcard_string = object_value.replace(/\D/g, "");
    if (creditcard_string.length == 0) return false;
    var doubledigit = creditcard_string.length % 2 == 1 ? false : true;
    var tempdigit,
        checkdigit = 0;

    for (var i = 0, len = creditcard_string.length; i < len; i++) {
      tempdigit = parseInt(creditcard_string.charAt(i), 10);

      if (doubledigit) {
        tempdigit *= 2;
        checkdigit += tempdigit % 10;
        if (tempdigit / 10 >= 1.0) checkdigit++;
        doubledigit = false;
      } else {
        checkdigit += tempdigit;
        doubledigit = true;
      }
    }

    return checkdigit % 10 == 0;
  } // Check social security number

  function checkSsn(object_value) {
    if (!object_value || object_value.length == 0) return true;
    return /^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$/.test(object_value.trim());
  } // Check emails

  function checkEmails(object_value, email_cnt) {
    if (!object_value || object_value.length == 0) return true;
    var arEmails = object_value.replace(/,/g, ";").split(";");

    for (var i = 0, len = arEmails.length; i < len; i++) {
      if (email_cnt > 0 && len > email_cnt) return false;
      if (!checkEmail(arEmails[i])) return false;
    }

    return true;
  } // Check email

  function checkEmail(object_value) {
    if (!object_value || object_value.length == 0) return true;
    return /^[\w.%+-]+@[\w.-]+\.[A-Z]{2,18}$/i.test(object_value.trim());
  } // Check GUID {xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx}

  function checkGuid(object_value) {
    if (!object_value || object_value.length == 0) return true;
    return /^(\{\w{8}-\w{4}-\w{4}-\w{4}-\w{12}\}|\w{8}-\w{4}-\w{4}-\w{4}-\w{12})$/.test(object_value.trim());
  } // Check URL

  function checkUrl(object_value) {
    if (!object_value || object_value.length == 0) return true;

    try {
      new URL(object_value);
    } catch (e) {
      return false;
    }

    return true;
  } // Check by regular expression

  function checkByRegEx(object_value, pattern) {
    if (!object_value || object_value.length == 0) return true;
    return !!object_value.match(pattern);
  }
  /**
   * Show message dialog
   *
   * @param {Event|string} arg - Event or message
   * @returns
   */

  function showMessage(arg) {
    var _arg$target;

    let doc, swal;

    try {
      let win = window.parent; // Note: If a window does not have a parent, its parent property is a reference to itself.

      doc = win.document;
      swal = win.Swal;
    } catch (e) {
      // In case win.document cannot be accessed
      doc = window.document;
      swal = window.Swal;
    }

    let p = (_arg$target = arg == null ? void 0 : arg.target) != null ? _arg$target : doc,
        $div = $__default['default'](p).find("div.ew-message-dialog:hidden").first(),
        msg = $div.length ? $div.text() : ""; // Text only

    if ($__default['default'].isString(arg)) msg = $__default['default']("<div>" + arg.trim() + "</div>").text();
    if (msg.trim() == "") return;

    if ($div.length) {
      ["success", "info", "warning", "danger"].forEach(function (value, index) {
        let $alert = $div.find(".alert-" + value).toggleClass("alert-" + value),
            $heading = $alert.find(".alert-heading").detach(),
            $content = $alert.children(":not(.icon)");
        $alert.find(".icon").remove();

        if ($alert[0]) {
          let w = parseInt($content.css("width"), 10); // Width specified

          if (w > 0) $content.first().css("width", "auto");
          let $toast = toast({
            class: "ew-toast bg-" + value,
            title: $heading[0] ? $heading.html() : ew.language.phrase(value),
            body: $alert.html(),
            autohide: value == "success" ? ew.autoHideSuccessMessage : false,
            // Autohide for success message
            delay: value == "success" ? ew.autoHideSuccessMessageDelay : 500
          });
          if (w > 0) $toast.css("max-width", w); // Override bootstrap .toast max-width

          return;
        }
      });
    }

    if ($__default['default'].isString(arg)) {
      return swal.fire({ ...ew.sweetAlertSettings,
        html: arg
      });
    }
  } // Random number

  function random() {
    return Math.floor(Math.random() * 100001) + 100000;
  } // File upload

  function upload(input) {
    var $input = $__default['default'](input);
    if ($input.data("blueimpFileupload")) return;
    var id = $input.attr("name"),
        nid = id.replace(/\$/g, "\\$"),
        tbl = $input.data("table"),
        multiple = $input.is("[multiple]"),
        $dropzone = $input.closest(".ew-file-drop-zone"),
        $p = $input.closest(fieldContainerSelector),
        readonly = $input.prop("disabled") || $input.closest("form").find("#confirm").val() == "confirm",
        $ft = $p.find("#ft_" + nid),
        $fn = $p.find("#fn_" + nid),
        $fa = $p.find("#fa_" + nid),
        $fs = $p.find("#fs_" + nid),
        $exts = $p.find("#fx_" + nid),
        $maxsize = $p.find("#fm_" + nid),
        $maxfilecount = $p.find("#fc_" + nid),
        $label = $p.find(".ew-file-label"),
        label = $label.html();

    var _done = function (e, data) {
      if (data.result.files[0].error) return;
      var name = data.result.files[0].name;
      var ar = multiple ? $fn.val() ? $fn.val().split(ew.MULTIPLE_UPLOAD_SEPARATOR) : [] : [];
      ar.push(name);
      $fn.val(ar.join(ew.MULTIPLE_UPLOAD_SEPARATOR));
      $fa.val("0");
      if (!multiple) // Remove other entries if not multiple upload
        $ft.find("tbody > tr:not(:last-child)").remove();
    };

    var _deleted = function (e, data) {
      var url = $__default['default'](e.originalEvent.target).data("url"),
          param = new URLSearchParams(url.split("?")[1]),
          fid = param.get("id"),
          name = param.get(fid);

      if (name) {
        var ar = $fn.val() ? $fn.val().split(ew.MULTIPLE_UPLOAD_SEPARATOR) : [];
        var index = ar.indexOf(name);
        if (index > -1) ar.splice(index, 1);
        $fn.val(ar.join(ew.MULTIPLE_UPLOAD_SEPARATOR));
        $fa.val("0");
      }
    };

    var _change = function (e, data) {
      var _data$files;

      $ft.toggleClass("ew-has-rows", ((_data$files = data.files) == null ? void 0 : _data$files.length) > 0);
      var ar = $fn.val() ? $fn.val().split(ew.MULTIPLE_UPLOAD_SEPARATOR) : [];

      for (var i = 0; i < data.files.length; i++) ar.push(data.files[i].name);

      var cnt = parseInt($maxfilecount.val(), 10);

      if ($__default['default'].isNumber(cnt) && cnt > 0 && ar.length > cnt) {
        _alert(ew.language.phrase("UploadErrMsgMaxNumberOfFiles"));

        return false;
      }

      var l = parseInt($fs.val(), 10);

      if ($__default['default'].isNumber(l) && l > 0 && ar.join(ew.MULTIPLE_UPLOAD_SEPARATOR).length > l) {
        _alert(ew.language.phrase("UploadErrMsgMaxFileLength"));

        return false;
      }
    };

    var _confirmDelete = function (e) {
      if (!multiple && $fn.val()) {
        if (!confirm(ew.language.phrase("UploadOverwrite"))) {
          e.preventDefault();
          e.stopPropagation();
        }
      }
    };

    var _changed = function (e, data) {
      var _data$files2, _data$result2, _data$result2$files;

      $ft.toggleClass("ew-has-rows", ((_data$files2 = data.files) == null ? void 0 : _data$files2.length) > 0 || ((_data$result2 = data.result) == null ? void 0 : (_data$result2$files = _data$result2.files) == null ? void 0 : _data$result2$files.length) > 0);
      var ar = $fn.val() ? $fn.val().split(ew.MULTIPLE_UPLOAD_SEPARATOR) : [];
      $label.html(ar.join(", ") || label);
    }; // var _clicked = function() {
    //     $input.closest("span.fileinput-button").tooltip("hide");
    // };
    // var _process = function(e, data) {
    //     $ft.toggleClass("ew-has-rows", data.files?.length > 0);
    // };

    var _downloadTemplate = $__default['default'].templates("#template-download"),
        _uploadTemplate = $__default['default'].templates("#template-upload");

    var _completed = function (e, data) {
      // After download template rendered
      var e = {
        target: data.context
      };
      initLightboxes(e);
      initPdfObjects(e);
      ew.updateDropdownPosition();
      data.context.find("img").on("load", ew.updateDropdownPosition);
    };

    var _added = function (e, data) {
      var _data$files3;

      // After upload template rendered
      $ft.toggleClass("ew-has-rows", ((_data$files3 = data.files) == null ? void 0 : _data$files3.length) > 0);
      data.context.find(".start").click(_confirmDelete);
    }; // Hide input button if readonly

    var form = getForm(input),
        $form = $__default['default'](form),
        readonly = $form.find("#confirm").val() == "confirm" || $input.attr("readonly");
    if (readonly) $input.prop("disabled", true); // $form.find("span.fileinput-button").hide();

    var cnt = parseInt($maxfilecount.val(), 10);
    var uploadUrl = getApiUrl(ew.API_JQUERY_UPLOAD_ACTION);
    var formData = {
      id: id,
      table: tbl,
      session: ew.SESSION_ID,
      replace: multiple ? "0" : "1",
      exts: $exts.val(),
      maxsize: $maxsize.val(),
      maxfilecount: $maxfilecount.val()
    };
    $input.fileupload({
      url: uploadUrl,
      type: "POST",
      multipart: true,
      autoUpload: true,
      // Comment out to disable auto upload
      loadImageFileTypes: /^image\/(gif|jpe?g|png)$/i,
      loadVideoFileTypes: /^video\/mp4$/i,
      loadAudioFileTypes: /^audio\/(mpeg|mp3)$/i,
      acceptFileTypes: $exts.val() ? new RegExp('\\.(' + $exts.val().replace(/,/g, '|') + ')$', 'i') : null,
      maxFileSize: parseInt($maxsize.val(), 10),
      maxNumberOfFiles: cnt > 1 ? cnt : null,
      filesContainer: $ft,
      formData: formData,
      uploadTemplateId: null,
      downloadTemplateId: null,
      uploadTemplate: _uploadTemplate.render.bind(_uploadTemplate),
      downloadTemplate: _downloadTemplate.render.bind(_downloadTemplate),
      previewMaxWidth: ew.UPLOAD_THUMBNAIL_WIDTH,
      previewMaxHeight: ew.UPLOAD_THUMBNAIL_HEIGHT,
      dropZone: $dropzone,
      messages: {
        acceptFileTypes: ew.language.phrase("UploadErrMsgAcceptFileTypes"),
        maxFileSize: ew.language.phrase("UploadErrMsgMaxFileSize"),
        maxNumberOfFiles: ew.language.phrase("UploadErrMsgMaxNumberOfFiles"),
        minFileSize: ew.language.phrase("UploadErrMsgMinFileSize")
      },
      readonly: readonly // Custom

    }).on("fileuploaddone", _done).on("fileuploaddestroy", _deleted).on("fileuploadchange", _change).on("fileuploadadded fileuploadfinished fileuploaddestroyed", _changed) //.on("fileuploadprocess", _process)
    .on('fileuploadadded', _added).on('fileuploadcompleted', _completed); // .click(_clicked);

    if ($fn.val()) {
      $__default['default'].ajax({
        url: uploadUrl,
        data: {
          id: id,
          table: tbl,
          session: ew.SESSION_ID
        },
        dataType: "json",
        context: this,
        success: function (result) {
          if (result != null && result[id]) {
            var done = $input.fileupload("option", "done");
            if (done) done.call(input, $__default['default'].Event(), {
              result: {
                files: result[id]
              }
            }); // Use "files"
          }

          if (readonly) // Hide delete button if readonly
            $ft.find("td.delete").hide();
        }
      });
    }
  }
  /**
   * Convert data to number
   *
   * @param {*} data - Data being converted
   * @returns {number}
   */

  function parseNumber(data) {
    return ew.parse(data, {
      locale: ew.getLocaleFromPlatform(ew.LANGUAGE_ID)
    });
  }
  /**
   * Get numbering syystem
   */

  function getNumberingSystem() {
    return new Intl.NumberFormat(ew.LANGUAGE_ID).resolvedOptions().numberingSystem;
  }
  let DateTime = luxon__default['default'].DateTime;
  /**
   * Format data by DateTime (see https://moment.github.io/luxon/docs/class/src/datetime.js~DateTime.html)
   *
   * @param {string|Number|Date} data - JS Date object
   * @param {string|Array} format - Date format (see https://moment.github.io/luxon/docs/manual/formatting.html#toformat)
   * @returns {string}
   */

  function formatDateTime(data, format) {
    let dt;
    if ($__default['default'].isString(data)) // SQL dates, times, and datetimes
      dt = DateTime.fromSQL(data);else if ($__default['default'].isNumber(data)) // Unix timestamps
      dt = DateTime.fromSeconds(data);else if (data instanceof Date) // JS Date Object
      dt = DateTime.fromJSDate(data);
    return dt.setLocale(ew.LANGUAGE_ID).toFormat(format);
  }
  /**
   * Parse data to DateTime (see https://moment.github.io/luxon/docs/class/src/datetime.js~DateTime.html)
   *
   * @param {string} data - Date/Time string supported by DateTime
   * @param {string|Array} format - Date format (see https://moment.github.io/luxon/docs/manual/formatting.html#toformat)
   * @returns {DateTime}
   */

  function parseDateTime(data, format) {
    return DateTime.fromFormat(data, format, {
      locale: ew.LANGUAGE_ID,
      numberingSystem: ew.getNumberingSystem()
    });
  } // Parse date/time (alias of parseDateTime)
  /**
   * Check if data can be parsed to DateTime (see https://moment.github.io/luxon/docs/class/src/datetime.js~DateTime.html)
   *
   * @param {string} data - Date string supported by DateTime
   * @param {string|Array} format - Date format (see https://moment.github.io/luxon/docs/manual/formatting.html#toformat)
   * @returns {boolean}
   */

  function checkDate(data, format) {
    if (!data || data.length == 0) return true;
    return parseDateTime(data, format).isValid;
  } // Check time (alias of checkDate)

  function checkTime(data, format) {
    if (!data || data.length == 0) return true;
    return parseDateTime(data, format).isValid;
  }
  /**
   * Format currency
   *
   * @param {number} value - Value
   * @param {string} format - Formatter pattern
   */

  function formatCurrency(value, format) {
    return ew.format(value, format || ew.CURRENCY_FORMAT, {
      locale: ew.getLocaleFromPlatform(ew.LANGUAGE_ID),
      currency: ew.CURRENCY_SYMBOL
    });
  }
  /**
   * Format number
   *
   * @param {number} value - Value
   * @param {string} format - Formatter pattern
   */

  function formatNumber(value, format) {
    return ew.format(value, format || ew.NUMBER_FORMAT, {
      locale: ew.getLocaleFromPlatform(ew.LANGUAGE_ID)
    });
  }
  /**
   * Format percent
   *
   * @param {number} value - Value
   * @param {string} format - Formatter pattern
   */

  function formatPercent(value, format) {
    return ew.format(value, format || ew.PERCENT_FORMAT, {
      locale: ew.getLocaleFromPlatform(ew.LANGUAGE_ID)
    });
  }
  /**
   * Init page
   *
   * @param {Event|undefined} e - Event
   */

  function initPage(e) {
    var _e$target10;

    var el = (_e$target10 = e == null ? void 0 : e.target) != null ? _e$target10 : document,
        $el = $__default['default'](el),
        $tables = $el.find("table.ew-table:not(.ew-export-table)");
    ew.initPanels(el); // Init grid panels

    ew.renderJsTemplates(e);
    lazyLoad(e);
    initForms(e);
    initTooltips(e);
    initPasswordOptions(e);
    initIcons(e);
    initLightboxes(e);
    initPdfObjects(e);
    $el.find("[data-widget='treeview']").each(function () {
      adminlte.Treeview._jQueryInterface.call($__default['default'](this), "init");
    });
    $tables.each(setupTable); // Init tables

    $el.find(".ew-table-header-caption[data-sort-url]").each(function () {
      // Table captions for sorting
      let $this = $__default['default'](this);
      $this.on("click", e => ew.sort(e, $this.data("sortUrl"), $this.data("sortType")));
    });
    $el.find(".ew-column-dropdown").each(function () {
      var _localStorage$getItem;

      let table = this.dataset.table;
      (_localStorage$getItem = localStorage.getItem(ew.PROJECT_NAME + "_" + table + "_invisible_fields")) == null ? void 0 : _localStorage$getItem.split(",").forEach(field => $__default['default']("#tbl_" + table + "list").find("th[data-name='" + field + "'],td[data-name='" + field + "']").toggleClass("d-none", true));
      $__default['default'](this).find(".ew-dropdown-checkbox").on("click", function (e) {
        let input = this.querySelector(".ew-dropdown-check-input[data-field]"),
            field = input == null ? void 0 : input.dataset.field;

        if (table && field) {
          input.classList.toggle("ew-checked");
          $__default['default']("#tbl_" + table + "list").find("th[data-name='" + field + "'],td[data-name='" + field + "']").toggleClass("d-none", !input.classList.contains("ew-checked"));
        }

        localStorage.setItem(ew.PROJECT_NAME + "_" + table + "_invisible_fields", Array.from(e.currentTarget.closest(".dropdown-menu").querySelectorAll(".ew-dropdown-check-input[data-field]:not(.ew-checked)"), el => el.dataset.field));
      });
    }).on("show.bs.dropdown", function (e) {
      let table = e.currentTarget.dataset.table,
          inputs = e.currentTarget.querySelectorAll(".ew-dropdown-check-input[data-field]");

      for (let input of inputs) {
        let field = input.dataset.field;
        input.classList.toggle("ew-checked", !!$__default['default']("#tbl_" + table + "list").find("th[data-name='" + field + "']:not(.d-none)")[0]);
      }
    });
    $el.find("input.ew-page-no").on("keydown", function (e) {
      if (e.key == "Enter") {
        currentUrl.searchParams.set(this.name, ew.parseNumber(this.value));
        window.location = sanitizeUrl(currentUrl.toString());
        return false;
      }
    });

    if (!ew.IS_SCREEN_SM_MIN) {
      $el.find("." + ew.RESPONSIVE_TABLE_CLASS + " [data-bs-toggle='dropdown']").parent().on("shown.bs.dropdown", function () {
        var $this = $__default['default'](this),
            $menu = $this.find(".dropdown-menu"),
            div = $this.closest("." + ew.RESPONSIVE_TABLE_CLASS)[0];

        if (div.scrollHeight - div.clientHeight) {
          var d = $menu.offset().top + $menu.outerHeight() - $__default['default'](div).offset().top - div.clientHeight;
          if (d > 0) $menu.css(ew.IS_RTL ? "right" : "left", "100%").css("top", parseFloat($menu.css("top")) - d);
        }
      });
    }

    initExportLinks(e);
    initMultiSelectCheckboxes(e); // Report

    var $rpt = $el.find(".ew-report");

    if ($rpt[0]) {
      $rpt.find(".card").on("collapsed.lte.widget", function () {
        // Fix min-height when .lte.widget is collapsed
        var $card = $__default['default'](this),
            $div = $card.closest("[class^='col-']"),
            mh = $div.css("min-height");
        if (mh) $div.data("min-height", mh);
        $div.css("min-height", 0);
      }).on("expanded.lte.widget", function () {
        // Fix min-height when .lte.widget is expanded
        var $card = $__default['default'](this),
            $div = $card.closest("[class^='col-']"),
            mh = $div.css("min-height");
        if (mh) $div.css("min-height", mh); // Restore min-height
      }); // Group expand/collapse button

      $rpt.find(".ew-group-toggle").on("click", function () {
        ew.toggleGroup(this);
      });
    } // Show message

    if (typeof ew.USE_JAVASCRIPT_MESSAGE != "undefined" && ew.USE_JAVASCRIPT_MESSAGE) showMessage(e);
  } // Redirect by HTTP GET or POST

  function redirect(url, f, method) {
    var _ew$vars;

    let urls = (_ew$vars = ew.vars) != null && _ew$vars.login ? Array.from(Object.entries(ew.vars.login)).filter(entry => entry[0].endsWith("Url")).map(entry => entry[1]) : [];

    if (urls.includes(url)) {
      // Known URLs
      window.location = url;
      return false;
    }

    let newUrl;

    if (url.startsWith("http")) {
      newUrl = new URL(url);
    } else if (url.startsWith("/")) {
      newUrl = new URL(url, location.protocol + "//" + location.host + (location.port ? ":" + location.port : ""));
    } else {
      _alert(ew.language.phrase("IncorrectUrl"));

      return false;
    }

    let params = newUrl.searchParams;
    params.set(ew.TOKEN_NAME_KEY, ew.TOKEN_NAME);
    params.set(ew.ANTIFORGERY_TOKEN_KEY, ew.ANTIFORGERY_TOKEN);

    if (sameText(method, "post")) {
      // POST
      let $form = f ? $__default['default'](f) : $__default['default']("<form></form>").appendTo("body");
      $form.attr({
        action: url.split("?")[0],
        method: "post"
      });
      params.forEach(function (value, key) {
        $__default['default']('<input type="hidden">').attr({
          name: key,
          value: ew.sanitize(value)
        }).appendTo($form);
      });
      $form.trigger("submit");
    } else {
      // GET
      window.location = sanitizeUrl(newUrl.toString());
    }

    return false;
  } // Show/Hide password

  function togglePassword(e) {
    var $btn = $__default['default'](e.currentTarget),
        $input = $btn.closest(".input-group").find("input"),
        $i = $btn.find("i");

    if ($input.attr("type") == "text") {
      $input.attr("type", "password");
      $i.toggleClass("fa-eye-slash fa-eye");
    } else if ($input.attr("type") == "password") {
      $input.attr("type", "text");
      $i.toggleClass("fa-eye-slash fa-eye");
    }
  } // Export with charts

  function exportWithCharts(url, exportId, f) {
    let exportUrl = new URL(window.location.href),
        ar = url.split("?"),
        method = f ? "post" : "get";
    exportId += "_" + Date.now();
    exportUrl.pathname = ar[0];
    exportUrl.search = ar[1];
    exportUrl.searchParams.set("exportid", exportId);

    let _export = function () {
      let params = exportUrl.searchParams,
          custom = params.get("custom") == "1";

      if (f && !custom) {
        // Not custom
        let data = $__default['default'](f).serialize(); // Add token

        $__default['default'].post(exportUrl, data, function (result) {
          showMessage(result);
        });
      } else {
        // Custom
        let exportType = params.get("export");

        if (custom && ["word", "excel", "pdf", "email"].includes(exportType)) {
          if (exportType == "email") {
            params.delete("export"); // Remove duplicate export=email (exists in form)

            exportUrl.search = params.toString() + "&" + $__default['default'](f).serialize();
          }

          $__default['default']("iframe.ew-export").remove();
          $__default['default']("<iframe></iframe>").addClass("ew-export d-none").attr("src", exportUrl.toString()).appendTo($body.css("cursor", "wait"));
          setTimeout(() => $body.css("cursor", "default"), 5000);
        } else if (exportType == "print") {
          redirect(exportUrl.toString(), f, method);
        } else {
          fileDownload(exportUrl.toString(), null);
        }
      }

      return false;
    };

    let keys = Object.keys(window.exportCharts);
    if (keys.length == 0) // No charts, just submit the form
      return _export(); // Export charts

    $body.css("cursor", "wait");
    let charts = [];

    for (const [id, chart] of Object.entries(window.exportCharts)) {
      let params = "exportfilename=" + exportId + "_" + id + ".png|exportformat=png|exportaction=download|exportparameters=undefined";
      if (chart != null && chart.toBase64Image) // Chart.js chart
        charts.push({
          chartEngine: "Chart.js",
          streamType: "base64",
          stream: chart.toBase64Image(),
          parameters: params
        });
    }

    $__default['default'].ajax({
      "url": getApiUrl(ew.API_EXPORT_CHART_ACTION),
      "data": {
        "charts": JSON.stringify(charts)
      },
      "cache": false,
      "type": "POST"
    }).done(result => {
      result = $__default['default'].isString(result) ? parseJson(result) : result;
      result.success ? _export() : _alert(result.error);
    }).fail((xhr, status, error) => _alert(error + ": " + xhr.responseText)) // Show detailed export error message
    .always(() => $body.css("cursor", "default"));
    return false;
  } // Layout

  var _fixLayoutHeightTimer; // Fix layout height

  function fixLayoutHeight() {
    if (_fixLayoutHeightTimer) _fixLayoutHeightTimer.cancel(); // Clear timer

    _fixLayoutHeightTimer = $__default['default'].later(50, null, function () {
      var layout = $body.data("lte.layout");
      if (layout) layout.fixLayoutHeight();
    });
  } // Add user event handlers

  function addEventHandlers(tblVar) {
    let fields = ew.events[tblVar];

    if (fields) {
      for (var [fldVar, events] of Object.entries(fields)) $__default['default']('[data-table=' + tblVar + '][data-field=' + fldVar + ']').on(events);
    }
  }

  var functions = {
    __proto__: null,
    currentUrl: currentUrl,
    forms: forms,
    AjaxLookup: AjaxLookup,
    AutoSuggest: AutoSuggest,
    Form: Form,
    SelectionListOption: SelectionListOption,
    Select2Utils: Utils,
    Select2Defaults: Defaults,
    fieldContainerSelector: fieldContainerSelector,
    createSelect: createSelect,
    createModalLookup: createModalLookup,
    createFilter: createFilter,
    initIcons: initIcons,
    initPasswordOptions: initPasswordOptions,
    getApiUrl: getApiUrl,
    sanitizeUrl: sanitizeUrl,
    setSessionTimer: setSessionTimer,
    initExportLinks: initExportLinks,
    initMultiSelectCheckboxes: initMultiSelectCheckboxes,
    fileDownload: fileDownload,
    lazyLoad: lazyLoad,
    updateDropdownPosition: updateDropdownPosition,
    initLightboxes: initLightboxes,
    initPdfObjects: initPdfObjects,
    initTooltips: initTooltips,
    parseJson: parseJson,
    searchOperatorChanged: searchOperatorChanged,
    initForms: initForms,
    isFunction: isFunction$2,
    alert: _alert,
    prompt: _prompt,
    toast: toast,
    showToast: showToast,
    getForm: getForm,
    hasFormData: hasFormData,
    setSearchType: setSearchType,
    updateOptions: updateOptions,
    getUserParams: getUserParams,
    applyTemplate: applyTemplate,
    toggleGroup: toggleGroup,
    convertToBool: convertToBool,
    valueChanged: valueChanged,
    setLanguage: setLanguage,
    submitAction: submitAction,
    'export': _export,
    removeSpaces: removeSpaces,
    isHiddenTextArea: isHiddenTextArea,
    isModalLookup: isModalLookup,
    isFilter: isFilter,
    isAutoSuggest: isAutoSuggest,
    isTextbox: isTextbox,
    clearError: clearError,
    onError: onError,
    setFocus: setFocus,
    setInvalid: setInvalid,
    setValid: setValid,
    hasValue: hasValue,
    isMaskedPassword: isMaskedPassword,
    sort: sort,
    filter: filter,
    confirmDelete: confirmDelete,
    keySelected: keySelected,
    selectAllKeys: selectAllKeys,
    selectAll: selectAll,
    updateSelected: updateSelected,
    clearSelected: clearSelected,
    clearDelete: clearDelete,
    clickDelete: clickDelete,
    selectKey: selectKey,
    setupTable: setupTable,
    setupGrid: setupGrid,
    addGridRow: addGridRow,
    deleteGridRow: deleteGridRow,
    htmlEncode: htmlEncode,
    getElements: getElements,
    getElement: getElement,
    getAncestorBy: getAncestorBy,
    isHidden: isHidden,
    sameText: sameText,
    sameString: sameString,
    getValue: getValue,
    getOptionValues: getOptionValues,
    getOptionTexts: getOptionTexts,
    clearOptions: clearOptions,
    getId: getId,
    valueSeparator: valueSeparator,
    displayValue: displayValue,
    optionHtml: optionHtml,
    optionsHtml: optionsHtml,
    newOption: newOption,
    selectOption: selectOption,
    fetch: _fetch,
    executeScript: executeScript,
    stripScript: stripScript,
    addScript: addScript,
    removeScript: removeScript,
    getContent: getContent,
    getOptions: getOptions,
    enable2FA: enable2FA,
    disable2FA: disable2FA,
    showBackupCodes: showBackupCodes,
    addOptionDialogShow: addOptionDialogShow,
    modalDialogHide: modalDialogHide,
    modalDialogShow: modalDialogShow,
    importDialogShow: importDialogShow,
    autoFill: autoFill,
    tooltip: tooltip,
    emailDialogShow: emailDialogShow,
    showDrillDown: showDrillDown,
    ajax: ajax,
    currentPage: currentPage,
    toggleSearchOperator: toggleSearchOperator,
    toggleLayout: toggleLayout,
    copyToClipboard: copyToClipboard,
    checkInteger: checkInteger,
    checkNumber: checkNumber,
    escapeRegExChars: escapeRegExChars,
    checkRange: checkRange,
    checkPhone: checkPhone,
    checkZip: checkZip,
    checkCreditCard: checkCreditCard,
    checkSsn: checkSsn,
    checkEmails: checkEmails,
    checkEmail: checkEmail,
    checkGuid: checkGuid,
    checkUrl: checkUrl,
    checkByRegEx: checkByRegEx,
    showMessage: showMessage,
    random: random,
    upload: upload,
    parseNumber: parseNumber,
    getNumberingSystem: getNumberingSystem,
    formatDateTime: formatDateTime,
    parseDateTime: parseDateTime,
    parseDate: parseDateTime,
    parseTime: parseDateTime,
    checkDate: checkDate,
    checkTime: checkTime,
    formatCurrency: formatCurrency,
    formatNumber: formatNumber,
    formatPercent: formatPercent,
    initPage: initPage,
    redirect: redirect,
    togglePassword: togglePassword,
    exportWithCharts: exportWithCharts,
    fixLayoutHeight: fixLayoutHeight,
    addEventHandlers: addEventHandlers
  };

  /**
   * Service worker
   */

  ew__default['default'].SERVICE_WORKER = "sw.js";
  /**
   * Show dialog for push notification
   *
   * @param {Object} args - Arguments
   * @param {string} args.hdr - Dialog header
   * @param {string} args.url - URL of web push API
   * @param {MouseEvent} args.evt - Mouse event
   * @returns false
   */

  async function pushNotificationDialogShow(args) {
    let $dlg = ew__default['default'].pushDialog || $__default['default']("#ew-push-notification-dialog").on("shown.bs.modal", e => setTimeout(() => {
      var _e$target$querySelect;

      return (_e$target$querySelect = e.target.querySelector(".modal-body .form-control")) == null ? void 0 : _e$target$querySelect.focus();
    }, 200)).on("click", ".modal-footer .btn-primary", function (e) {
      var _$$closest$find$data;

      e.preventDefault();
      if ((_$$closest$find$data = $__default['default'](this).closest(".modal").find(".modal-body form").data("form")) != null && _$$closest$find$data.submit()) $dlg.modal("hide");
    });

    if (!$dlg[0]) {
      console.log("DIV #ew-push-notificatoin-dialog not found");
      return false;
    }

    if (!args.url) {
      // No API URL
      console.log("Missing URL of Web Push API");
      return false;
    }

    let target = args.evt.currentTarget,
        // Button
    $form = $__default['default'](target.form),
        $f = $dlg.find(".modal-body form"),
        frm = $f.data("form");
    $f.data("all", false); // Reset

    if (!$form.find("input[name='key_m[]']:checked")[0]) {
      // No keys selected
      let result = await ew__default['default'].prompt(ew__default['default'].language.phrase("SendPushNotificationsToAll"), bool => bool); // Callback returns result as boolean

      $f.data("all", result);
      if (!result) // Cancelled
        return;
    }

    if (!frm) {
      frm = new ew__default['default'].Form($f.attr("id"));
      frm.addFields([["title", ew__default['default'].Validators.required(ew__default['default'].language.phrase("PushNotificationFormTitle"))], ["body", ew__default['default'].Validators.required(ew__default['default'].language.phrase("PushNotificationFormBody"))]]);

      frm.validate = function () {
        return this.validateFields();
      };

      frm.submit = function () {
        if (!this.validate()) return false;
        let data = [$f.serialize(), $f.data("all") ? "" : $form.find("input[name='key_m[]']:checked").serialize()].join("&");
        $__default['default'].post(args.url, data, result => {
          var _result$error;

          if (Array.isArray(result)) {
            let successes = result.reduce((acc, cur) => acc + (cur.success ? 1 : 0), 0),
                failures = result.length - successes;
            if (successes > 0 && failures == 0) ew__default['default'].alert(ew__default['default'].language.phrase("PushNotificationSuccess").replace("%s", successes), "success");else if (successes == 0 && failures > 0) ew__default['default'].alert(ew__default['default'].language.phrase("PushNotificationFailure").replace("%f", failures));else if (successes == 0 && failures == 0) ew__default['default'].alert(ew__default['default'].language.phrase("NoSubscriptions").replace("%f", failures), "primary");else ew__default['default'].alert(ew__default['default'].language.phrase("PushNotificationSent").replace("%s", successes).replace("%f", failures), "primary");
          } else if (result != null && (_result$error = result.error) != null && _result$error.description) {
            ew__default['default'].alert(result.error.description);
          }
        });
        return true;
      };

      $f.data("form", frm);
    }

    ew__default['default'].pushDialog = $dlg.modal("hide").find(".modal-title").html(args.hdr || target.dataset.caption).end().modal("show");
    return false;
  }
  /**
   * Check if push notification and service workers are supported by browser
   */

  function isPushNotificationSupported() {
    return "serviceWorker" in navigator && "PushManager" in window;
  }
  /**
   * Base 64 to Unit8Array
   */

  function urlBase64ToUint8Array(base64String) {
    const padding = "=".repeat((4 - base64String.length % 4) % 4),
          base64 = (base64String + padding).replace(/\-/g, "+").replace(/_/g, "/"),
          rawData = window.atob(base64),
          outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) outputArray[i] = rawData.charCodeAt(i);

    return outputArray;
  }
  /**
   * Send subscription to server
   */

  async function sendSubscriptionToServer(subscription, url) {
    const key = subscription.getKey("p256dh"),
          token = subscription.getKey("auth"),
          contentEncoding = (PushManager.supportedContentEncodings || ["aesgcm"])[0];
    let formData = new FormData();
    formData.set("endpoint", subscription.endpoint);
    formData.set("publicKey", key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null);
    formData.set("authToken", token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null);
    formData.set("contentEncoding", contentEncoding);
    let response = await ew__default['default'].fetch(url, {
      method: "POST",
      body: formData
    });
    return response.json();
  }
  /**
   * Create subscription and send to server
   * @returns Promise that resolves to a PushSubscription object
   */

  async function createSubscription() {
    var _result$error2;

    let url = ew__default['default'].getApiUrl([ew__default['default'].API_PUSH_NOTIFICATION_ACTION, ew__default['default'].API_PUSH_NOTIFICATION_SUBSCRIBE]),
        serviceWorkerReg = await navigator.serviceWorker.ready,
        subscription = await serviceWorkerReg.pushManager.subscribe({
      userVisibleOnly: true,
      applicationServerKey: urlBase64ToUint8Array(ew__default['default'].PUSH_SERVER_PUBLIC_KEY)
    }),
        result = await sendSubscriptionToServer(subscription, url);
    if (result != null && (_result$error2 = result.error) != null && _result$error2.description) ew__default['default'].alert(result.error.description);
    return result.success ? subscription : null;
  }
  /**
   * Get subscription
   */

  async function getSubscription() {
    let serviceWorkerReg = await navigator.serviceWorker.ready;
    return serviceWorkerReg.pushManager.getSubscription();
  }
  /**
   * Set subscription
   * @param {PushSubscription} subscription
   */

  function setSubscription(subscription) {
    let $btn = $__default['default']("#subscribe-notification").toggleClass("ew-enable-notification", !subscription).attr("data-bs-original-title", ew__default['default'].language.phrase(subscription ? "DisableNotifications" : "EnableNotifications")).removeClass("disabled");
    $btn.find("i").toggleClass("fa-bell", !subscription).toggleClass("fa-bell-slash", !!subscription);
    let inst = bootstrap.Tooltip.getInstance($btn[0]);
    if (inst != null && inst.tip) inst.setContent(inst.tip);
  }
  /**
   * Subscribe notifications
   *
   * @returns false
   */

  async function subscribeNotification() {
    if (Notification.permission !== "denied" && !ew__default['default'].IS_SYS_ADMIN) {
      // Support non system administrator
      let $body = $__default['default']("body").css("cursor", "wait");

      try {
        if (Notification.permission === "granted") {
          var _await$getSubscriptio, _document$getElementB;

          setSubscription((_await$getSubscriptio = await getSubscription()) != null ? _await$getSubscriptio : await createSubscription());
          if (!((_document$getElementB = document.getElementById("subscribe-notification")) != null && _document$getElementB.classList.contains("ew-enable-notification"))) ew__default['default'].showToast(ew__default['default'].language.phrase("NotificationsEnabled"), "success");
        } else if (Notification.permission === "default" && (await Notification.requestPermission()) == "granted") {
          var _document$getElementB2;

          setSubscription(await createSubscription());
          if (!((_document$getElementB2 = document.getElementById("subscribe-notification")) != null && _document$getElementB2.classList.contains("ew-enable-notification"))) ew__default['default'].showToast(ew__default['default'].language.phrase("NotificationsEnabled"), "success");
        }
      } catch (e) {
        ew__default['default'].alert(e);
      } finally {
        $body.css("cursor", "default");
      }
    }

    return false;
  }
  /**
   * Check subscription
   *
   * @returns true
   */

  async function checkSubscription() {
    $__default['default']("#subscribe-notification").tooltip();
    if (Notification.permission == "granted") setSubscription(await getSubscription());else setSubscription(null);
    return true;
  }
  /**
   * Unsubscribe notifications
   *
   * @returns false
   */

  async function unsubscribeNotification() {
    ew__default['default'].prompt({
      html: ew__default['default'].language.phrase("DisableNotificationsMsg")
    }, async res => {
      if (!res) return;
      let $body = $__default['default']("body").css("cursor", "wait");

      try {
        var _result$error3;

        let subscription = await getSubscription();
        await subscription.unsubscribe();
        let url = ew__default['default'].getApiUrl([ew__default['default'].API_PUSH_NOTIFICATION_ACTION, ew__default['default'].API_PUSH_NOTIFICATION_DELETE]),
            result = await sendSubscriptionToServer(subscription, url); // Delete subscription

        if (result != null && (_result$error3 = result.error) != null && _result$error3.description) {
          ew__default['default'].alert(result.error.description);
          return false;
        }

        if (result.success) {
          // No subscription or deleted successfully
          setSubscription(null);
          ew__default['default'].showToast(ew__default['default'].language.phrase("NotificationsDisabled"), "success");
        }
      } catch (e) {
        ew__default['default'].alert(e);
      } finally {
        $body.css("cursor", "default");
      }
    });
    return false;
  }
  /**
   * Init web push notifications
   */

  loadjs.ready("foot", () => {
    if (ew__default['default'].PUSH_SERVER_PUBLIC_KEY && isPushNotificationSupported()) {
      navigator.serviceWorker.register(ew__default['default'].PATH_BASE + ew__default['default'].SERVICE_WORKER, {
        scope: ew__default['default'].PATH_BASE
      }).then(() => {
        checkSubscription();
        $__default['default']("#subscribe-notification").on("click", function () {
          this.classList.contains("ew-enable-notification") ? subscribeNotification() : unsubscribeNotification();
        });
      }).catch(e => console.log(e));
    } else {
      $__default['default']("#subscribe-notification").addClass("d-none");
    }
  });

  var webpush = {
    __proto__: null,
    pushNotificationDialogShow: pushNotificationDialogShow,
    isPushNotificationSupported: isPushNotificationSupported,
    subscribeNotification: subscribeNotification,
    checkSubscription: checkSubscription,
    unsubscribeNotification: unsubscribeNotification
  };

  /**
   * Map styles
   */
  /**
   * Show map
   * @param {Object} data Data of map
   */

  function show(data) {
    if (data.inited) // Already initiated
      return true;
    let latlng = data.latlng,
        $div = $__default['default']("#" + data.id),
        useSingleMap = data.useSingleMap,
        showAllMarkers = data.showAllMarkers,
        useMarkerClusterer = data.useMarkerClusterer,
        ext = ew.maps[data.ext];

    if (useSingleMap) {
      // Use single map
      let id = data.id.replace(/^mp\d*_/, "mp_"); // Remove index from "m<n>_" prefix

      $div = $__default['default']("#" + id);

      if (!$div[0]) {
        $div = $__default['default']("<div></div>").attr("id", id).addClass("ew-single-map").height(data.singleMapHeight); // Create new $div for single map

        if (data.singleMapWidth) $div.width(data.singleMapWidth);
        $__default['default'](".ew-grid, .ew-multi-column-grid").first()[data.showMapOnTop ? "before" : "after"]($div); // Insert before/after table

        data.map = ext.createMap($div[0], data);
        $div.data("map", data.map);
        $div.data("ext", data.ext);
        $div.data("bounds", showAllMarkers ? ext.createBounds() : null);
        $div.data("markerClusterer", useMarkerClusterer ? ext.createMarkerClusterer(data) : null);
      }

      data = Object.assign(data, $div.data()); // Merge data
    } else {
      if (!latlng) {
        // Location not found
        $div.addClass("d-none").html(data.status);
        return true;
      }

      $div.next(".ew-map-value").addClass("d-none"); // Hide view value

      if (!data.map) data.map = ext.createMap($div[0], data);
    }

    data.marker = ext.createMarker(data); // Create marker

    data.inited = true; // Initiated

    $__default['default'](document).trigger("map", [data]);
    return true;
  }
  /**
   * All maps initiated
   */

  function done() {
    $__default['default'](".ew-single-map").each(function () {
      let data = $__default['default'](this).data();
      ew.maps[data.ext].fitBounds(data); // Fit bounds
    });
    $__default['default'](document).trigger("maps");
  }
  /**
   * Init maps
   * @param {string} [ext] - Map type, e.g. 'googlemaps', 'leaflet'
   * @returns
   */

  function init(ext) {
    let promises = $__default['default'](".ew-map").filter(function () {
      return !ext || $__default['default'](this).data("ext") == ext;
    }).map(function (i) {
      let data = $__default['default'](this).data();
      if (data.inited) // Already initiated
        return show(data);
      data.id = this.id; // Get ID

      data.address = (data.address || "").trim();

      if (data.address) {
        let geocodingDelay = data.geocodingDelay;
        return new Promise(resolve => {
          $__default['default'].later(i * geocodingDelay, null, () => {
            // Set a timer for better performance
            resolve(ew.maps[data.ext].geocode(data).then(latlng => {
              data.latlng = latlng;
            }).catch(status => {
              data.status = status;
            }).finally(() => show(data)));
          });
        });
      } else {
        let latitude = data.latitude,
            longitude = data.longitude;
        if (latitude && !isNaN(latitude) && longitude && !isNaN(longitude)) data.latlng = ew.maps[data.ext].createLatLng(latitude, longitude);
        return show(data);
      }
    }).get();
    return Promise.all(promises).then(done);
  }
  /**
   * Init
   */

  $__default['default'](function () {
    $__default['default']("#ew-modal-dialog").on("load.ew", init);
    $__default['default'](document).on("preview", init);
  });

  var maps = {
    __proto__: null,
    show: show,
    done: done,
    init: init
  };

  ew.IS_SCREEN_SM_MIN = window.matchMedia("(min-width: 768px)").matches; // Should matches $screen-sm-min

  ew.MOBILE_DETECT = new MobileDetect(window.navigator.userAgent);
  ew.IS_MOBILE = !!ew.MOBILE_DETECT.mobile(); // Charts

  window.exportCharts = {}; // Per window
  // Extend

  Object.assign(ew, {
    MultiPage,
    Form,
    Validators,
    maps
  }, functions, webpush);
  var $document = $__default['default'](document); // Init document

  loadjs.ready("load", function () {
    $__default['default'].views.settings.debugMode(ew.DEBUG);
    ew.setSessionTimer();
    ew.initPage();
    $__default['default']("#ew-modal-dialog").on("load.ew", ew.initPage);
    $__default['default']("#ew-add-opt-dialog").on("load.ew", ew.initPage);
    var hash = ew.currentUrl.searchParams.get("hash");
    if (hash) $__default['default']("html, body").animate({
      scrollTop: $__default['default']("#" + hash).offset().top
    }, 800);
    $document.trigger("load");
  }); // Default "addoption" event (fired before adding new option to selection list)

  $document.on("addoption", function (e, args) {
    var row = args.data; // New row to be validated

    var arp = args.parents; // Parent field values

    for (var i = 0, cnt = arp.length; i < cnt; i++) {
      // Iterate parent values
      var p = arp[i];
      if (!p.length) // Empty parent
        //continue; // Allow
        return args.valid = false; // Disallow

      var val = row["ff" + (i > 0 ? i + 1 : "")]; // Filter fields start from the 6th field

      if (!$__default['default'].isUndefined(val) && !p.includes(String(val))) // Filter field value not in parent field values
        return args.valid = false; // Returns false if invalid
    }
  }); // Click handler for buttons

  $document.on("click", "[data-ew-action]:not([data-ew-action=''])", function (e) {
    let data = Object.assign({}, $__default['default'](this).data()),
        action = data.ewAction;

    if (!action) {
      return true;
    } else if (action == "none") {
      return false;
    } else if (action == "redirect") {
      return ew.redirect(data.url);
    } else if (action == "reload") {
      location.reload();
      return false;
    } else if (action == "submit") {
      delete data.ewAction;
      return ew.submitAction(e, data);
    } else if (action == "modal") {
      delete data.ewAction;
      return ew.modalDialogShow({
        evt: e,
        ...data
      });
    } else if (action == "export") {
      return ew.export(e, data.url, data.export, data.custom, data.exportSelected);
    } else if (action == "layout") {
      return ew.toggleLayout(this);
    } else if (action == "language") {
      return ew.setLanguage(this);
    } else if (action == "filter") {
      return ew.filter(e);
    } else if (action == "email") {
      delete data.ewAction;
      return ew.emailDialogShow({
        evt: e,
        ...data
      });
    } else if (action == "set-action") {
      this.form.elements["action"].value = data.value;
    } else if (action == "drilldown") {
      return ew.showDrillDown(e, this, data.url, data.id, data.hdr);
    } else if (action == "export-charts") {
      return ew.exportWithCharts(data.url, data.exportid);
    } else if (action == "add-option") {
      delete data.ewAction;
      return ew.addOptionDialogShow({
        evt: e,
        ...data
      });
    } else if (action == "search-type") {
      return ew.setSearchType(this);
    } else if (action == "search-operator") {
      ew.toggleSearchOperator(e, data.target, data.value);
    } else if (action == "inline-delete") {
      return ew.confirmDelete(this);
    } else if (action == "add-grid-row") {
      return ew.addGridRow(this);
    } else if (action == "delete-grid-row") {
      return ew.deleteGridRow(this, this.dataset.rowindex);
    } else if (action == "select-all") {
      ew.selectAll(this);
    } else if (action == "select-key") {
      ew.selectKey(e);
    } else if (action == "select-all-keys") {
      ew.selectAllKeys(this);
    } else if (action == "import") {
      return ew.importDialogShow({
        evt: e,
        hdr: data.hdr
      });
    } else if (action == "password") {
      return ew.togglePassword(e);
    } else if (action == "push") {
      return ew.pushNotificationDialogShow({
        evt: e,
        url: data.apiUrl
      });
    } else if (action == "enable-2fa") {
      return ew.enable2FA();
    } else if (action == "disable-2fa") {
      return ew.disable2FA();
    } else if (action == "backup-codes") {
      return ew.showBackupCodes();
    } else if (action == "scroll-top") {
      $__default['default'](document).scrollTop($__default['default']('#top').offset().top);
      return false;
    }
  }); // Fix z-index of multiple modals

  $document.on("show.bs.modal", ".modal", function () {
    var zIndex = 1050 + $__default['default'](".modal:visible").length;
    $__default['default'](this).css("z-index", zIndex);
    setTimeout(function () {
      $__default['default'](".modal-backdrop").not(".modal-stack").css("z-index", zIndex - 1).addClass("modal-stack");
    }, 0);
  }); // Fix scrolling of multiple modals

  $document.on("hidden.bs.modal", ".modal", function () {
    $__default['default'](".modal:visible").length && $__default['default']("body").addClass("modal-open");
  });

  $__default['default'].extend({
    isBoolean: function (o) {
      return typeof o === 'boolean';
    },
    isNull: function (o) {
      return o === null;
    },
    isNumber: function (o) {
      return typeof o === 'number' && isFinite(o);
    },
    isObject: function (o) {
      return o && (typeof o === 'object' || this.isFunction(o)) || false;
    },
    isString: function (o) {
      return typeof o === 'string';
    },
    isUndefined: function (o) {
      return typeof o === 'undefined';
    },
    isValue: function (o) {
      return this.isObject(o) || this.isString(o) || this.isNumber(o) || this.isBoolean(o);
    },
    isDate: function (o) {
      return this.type(o) === 'date' && o.toString() !== 'Invalid Date' && !isNaN(o);
    },
    later: function (when, o, fn, data, periodic) {
      when = when || 0;
      o = o || {};
      var m = fn,
          d = data,
          f,
          r;
      if (this.isString(fn)) m = o[fn];
      if (!m) return;
      if (!this.isUndefined(data) && !this.isArray(d)) d = [data];

      f = function () {
        m.apply(o, d || []);
      };

      r = periodic ? setInterval(f, when) : setTimeout(f, when);
      return {
        interval: periodic,
        cancel: function () {
          if (this.interval) {
            clearInterval(r);
          } else {
            clearTimeout(r);
          }
        }
      };
    }
  });

  /**
   * jQuery.fields() plugin
   *
   * @param {string|undefined} fldvar - Field variable name or undefined
   *  If field variable name, returns jQuery object of the specified field element(s).
   *  If unspecified, returns object of jQuery objects of all fields.
   * @returns jQuery object
   */

  $__default['default'].fn.fields = function (fldvar) {
    // Note: fldvar has NO "x_" prefix
    var rec = {},
        id = this.attr("id"),
        obj = this[0],
        m = id.match(/^[xy](\d*)_/),
        f,
        tbl,
        infix;

    if (m) {
      // "this" is input element
      f = ew.getForm(obj); // form

      tbl = this.data("table"); // table var

      infix = m[1]; // row index
    } else if (obj != null && obj.htmlForm) {
      // "this" is form
      f = obj.$element; // form

      tbl = obj.id.replace(new RegExp("^f|" + obj.pageId + "$", "g"), ""); // table var

      infix = obj.htmlForm.dataset.rowindex; // row index
    }

    var selector = "[data-table" + (tbl ? "=" + tbl : "") + "][data-field" + (fldvar ? "=x_" + fldvar : "") + "]";
    if ($__default['default'].isValue(infix)) selector += "[name^=x" + infix + "_]";

    if (f && selector) {
      $__default['default'](f).find(selector).each(function () {
        var key = this.getAttribute("data-field").substr(2),
            name = this.getAttribute("name");
        key = /^y_/.test(name) ? "y_" + key : key; // Use "y_fldvar" as key for 2nd search input

        rec[key] = rec[key] ? rec[key].add(this) : $__default['default'](this); // Create jQuery object for each field
      });
    }

    return fldvar ? rec[fldvar] : rec;
  };

  $__default['default'].fn.extend({
    // Get jQuery object of the row (<div> or <tr>)
    row: function () {
      var _this$data;

      var $row = this.closest("#r_" + ((_this$data = this.data("field")) == null ? void 0 : _this$data.substr(2)));
      if (!$row[0]) $row = this.closest(".ew-table > tbody > tr"); // Grid page

      return $row;
    },
    // Show/Hide field
    visible: function (v) {
      var _this$data2;

      var $p = this.closest("#r_" + ((_this$data2 = this.data("field")) == null ? void 0 : _this$data2.substr(2))); // Find the row

      if (!$p[0]) $p = this.closest("[id^=el]"); // Find the span

      if (typeof v != "undefined") {
        $p.toggle(v);
        return this;
      } else {
        return $el.is(":visible");
      }
    },
    // Get/Set field "readonly" attribute
    // Note: This attribute is ignored if the value of the type attribute is hidden, range, color, checkbox, radio, file, or a button type
    readonly: function (v) {
      if (typeof v != "undefined") {
        this.prop("readOnly", v);
        return this;
      } else {
        return this.prop("readOnly");
      }
    },
    // Get/Set field "disabled" attribute
    // Note: A disabled control's value isn't submitted with the form
    disabled: function (v) {
      if (typeof v != "undefined") {
        this.prop("disabled", v);
        return this;
      } else {
        return this.prop("disabled");
      }
    },
    // Get/Set field value(s)
    // Note: Return array if select-multiple
    value: function (v) {
      var type = this.attr("type");

      if (typeof v != "undefined") {
        if (!Array.isArray(v)) v = [v];
        var type = this.attr("type");
        var el = type == "radio" || type == "checkbox" ? this.get() : this[0];

        if (ew.isHiddenTextArea(this)) {
          this.val(v).data("editor").save();
        } else {
          ew.selectOption(el, v);

          if (this.hasClass("select2-hidden-accessible")) {
            // Select2
            this.trigger("change");
          }
        }

        return this;
      } else {
        if (type == "checkbox") {
          var val = ew.getOptionValues(this.get());
          return this.length == 1 ? val.join() : val;
        } else if (type == "radio") {
          return ew.getOptionValues(this.get()).join();
        } else if (ew.isHiddenTextArea(this)) {
          this.data("editor").save();
          return this.val();
        } else {
          return this.val();
        }
      }
    },
    // Get field value as number
    toNumber: function () {
      return ew.parseNumber(this.value());
    },
    // Get field value as Luxon object
    toDate: function () {
      var _ew$vars$tables, _ew$vars$tables$table, _ew$vars$tables$table2, _ew$vars$tables$table3;

      let data = this.data(),
          table = data.table,
          field = data.field.replace(/^[xy]_/, ""),
          format = (_ew$vars$tables = ew.vars.tables) == null ? void 0 : (_ew$vars$tables$table = _ew$vars$tables[table]) == null ? void 0 : (_ew$vars$tables$table2 = _ew$vars$tables$table.fields) == null ? void 0 : (_ew$vars$tables$table3 = _ew$vars$tables$table2[field]) == null ? void 0 : _ew$vars$tables$table3.clientFormatPattern;
      return ew.parseDateTime(this.value(), format);
    },
    // Get field value as native Date object
    toJsDate: function () {
      return this.toDate().toDate();
    }
  });

  bootstrap.Dropdown.prototype._getMenuElement = function () {
    if (this._element.closest("[data-widget]")) $__default['default'](this._element).on("click.bs.dropdown", e => e.stopPropagation());

    if (!this._menu) {
      const parent = bootstrap.Dropdown.getParentFromElement(this._element);

      if (parent) {
        this._menu = parent.querySelector('.dropdown-menu'); // Move the menu to document body if menu inside responsive table

        if (this._menu.closest('.table-responsive')) {
          let container = this._menu.closest('.popover-body, .modal-body, body');

          container.appendChild(this._menu);
          let menu = this._menu;
          if (!this._element.id) this._element.id = "dropdownbtn" + ew.random();
          menu.setAttribute('aria-labelledby', this._element.id);

          function callback(mutationList) {
            mutationList.forEach(mutation => {
              switch (mutation.type) {
                case "attributes":
                  if (mutation.target.classList.contains('show')) {
                    menu.classList.add('d-block');
                  } else {
                    menu.classList.remove('d-block');
                  }

                  break;
              }
            });
          }

          let observer = new MutationObserver(callback);
          observer.observe(parent, {
            attributeFilter: ["class"],
            attributeOldValue: false,
            subtree: false
          });
        }
      }
    }

    return this._menu;
  };

  $__default['default'](window).off("load.lte.treeview"); // Treeview

  var Treeview = adminlte.Treeview;
  Treeview.prototype._toggle = Treeview.prototype.toggle;

  Treeview.prototype.toggle = function toggle(e) {
    let $currentTarget = $__default['default'](e.currentTarget),
        treeviewMenu = $currentTarget.next(),
        href = $currentTarget.attr("href"),
        isText = e.target.tagName == "P";
    if (!treeviewMenu.is(".nav-treeview") || isText && href && href != "#" && href != "javascript:void(0);") // Menu text with href
      return;

    this._toggle(e);

    e.stopImmediatePropagation();
  }; // Dropdown menu parent item with href // Override AdminLTE

  $__default['default']("ul.dropdown-menu [data-bs-toggle=dropdown]").on("click", function (e) {
    let href = $__default['default'](this).attr("href");
    if (href && href != "#" && e.target.tagName == "SPAN") window.location = href;
  });

  var isNil = (value) => {
      return value === null || value === undefined;
  };

  var isNil$1 = isNil;

  var isFunction = (value) => {
      return typeof value === 'function';
  };

  var isFunction$1 = isFunction;

  var isNaNNumber = (value) => {
      return typeof value === 'number' && isNaN(value);
  };

  var isNaNNumber$1 = isNaNNumber;

  var isFiniteNumber = (value) => {
      return typeof value == 'number' && isFinite(value);
  };

  var isFiniteNumber$1 = isFiniteNumber;

  /**
   * Optimized for performance
   */
  const multiplyByPowerOfTen = (number, powerOfTenExponent) => {
      if (!isFiniteNumber$1(number))
          return NaN;
      const numAsString = '' + number;
      const indexOfE = numAsString.indexOf('e');
      if (indexOfE === -1) {
          return +(numAsString + 'e' + powerOfTenExponent);
      }
      else {
          return +(numAsString.slice(0, indexOfE) + 'e' + (+numAsString.slice(indexOfE + 1) + powerOfTenExponent));
      }
  };

  var multiplyByPowerOfTen$1 = multiplyByPowerOfTen;

  /**
   * Only handles direct power of ten (only integer exponents)
   */
  const log10 = (numberThatIsPowerOfTen) => {
      return Math.round(Math.log(numberThatIsPowerOfTen) * Math.LOG10E);
  };

  var log10$1 = log10;

  const toObject = (arr, entriesResolver) => {
      const object = {};
      for (let i = 0; i < arr.length; ++i) {
          if (i in arr) {
              const [key, value] = entriesResolver(arr[i], i);
              object[key] = value;
          }
      }
      return object;
  };

  var toObject$1 = toObject;

  // <i> Extracted from https://stackoverflow.com/questions/3446170/escape-string-for-use-in-javascript-regex
  const escapeRegexString = (string) => {
      return string.replace(/[.*+?^${}()|[\]\\]/g, match => `\\${match}`);
  };

  var escapeRegexString$1 = escapeRegexString;

  /**
   * This function doesn't work with non-primitive arguments
   */
  const memoize = (fn) => {
      const cache = {};
      return function (...args) {
          const cacheKey = args.length > 1 ? args.join('-(:-:)-') : args[0];
          if (cacheKey in cache) {
              return cache[cacheKey];
          }
          const result = fn.apply(this, args);
          cache[cacheKey] = result;
          return result;
      };
  };

  var memoize$1 = memoize;

  const powerOf10LookupObject = (() => {
      const object = {};
      // 1 <= x <= Infinity (positive exponent)
      let additionalZeros = '';
      let currentValue;
      while (currentValue !== Infinity) {
          currentValue = +('1' + additionalZeros);
          object[currentValue] = true;
          additionalZeros += '0';
      }
      // 0 <= x < 1 (negative exponent)
      additionalZeros = '';
      currentValue = undefined;
      while (currentValue !== 0) {
          currentValue = +('0.' + additionalZeros + '1');
          object[currentValue] = true;
          additionalZeros += '0';
      }
      return object;
  })();
  const isPowerOfTen = (number) => {
      return !!powerOf10LookupObject[number];
  };

  var isPowerOfTen$1 = isPowerOfTen;

  const toBase = (value, valueUnit, unitScale) => {
      if (!isFiniteNumber$1(value) || valueUnit === unitScale.base)
          return value;
      if (!(valueUnit in unitScale.scale))
          return NaN;
      const toBaseMultiplier = unitScale.scale[valueUnit] || 1;
      return isPowerOfTen$1(toBaseMultiplier)
          ? multiplyByPowerOfTen$1(value, log10$1(toBaseMultiplier))
          : value * toBaseMultiplier;
  };
  const convertUnit = (value, originUnit, targetUnit, unitScale) => {
      if (!isFiniteNumber$1(value) || originUnit === targetUnit)
          return value;
      const valueAsBase = toBase(value, originUnit, unitScale);
      const resolvedScale = Object.assign(Object.assign({}, unitScale.scale), { [unitScale.base]: 1 });
      if (isNaN(valueAsBase) || !(originUnit in resolvedScale) || !(targetUnit in resolvedScale))
          return NaN;
      const conversionFactorFromBase = unitScale.scale[targetUnit] || 1;
      return isPowerOfTen$1(conversionFactorFromBase)
          ? multiplyByPowerOfTen$1(valueAsBase, -log10$1(conversionFactorFromBase))
          : valueAsBase / conversionFactorFromBase;
  };
  /**
   * Looks through every possibility for the 'best' available unit.
   * i.e. Where the value has the fewest numbers before the decimal point,
   * but is still higher than 1.
   */
  const toBest = (value, originUnit, unitScale, options) => {
      const resolvedOptions = Object.assign({ exclude: [], cutOffNumber: 1 }, options);
      let best = null;
      const scale = unitScale.scale;
      Object.keys(scale).sort((a, b) => scale[a] - scale[b]).forEach((scaleUnit) => {
          const isIncluded = resolvedOptions.exclude.indexOf(scaleUnit) === -1;
          if (!isIncluded)
              return;
          const result = convertUnit(value, originUnit, scaleUnit, unitScale);
          const absoluteResult = Math.abs(result);
          if (!best || (absoluteResult >= resolvedOptions.cutOffNumber && absoluteResult < Math.abs(best[0]))) {
              best = [result, scaleUnit];
          }
      });
      return best || [value, originUnit];
  };
  const unitScale = (unitScaleDefinition) => {
      return {
          toBase: (value, unit) => {
              return toBase(value, unit, unitScaleDefinition);
          },
          convert: (value, originUnit, targetUnit) => {
              return convertUnit(value, originUnit, targetUnit, unitScaleDefinition);
          },
          toBest: (value, originUnit, options) => {
              return toBest(value, originUnit, unitScaleDefinition, options);
          },
          scaleDefinition: unitScaleDefinition,
      };
  };

  /**
   * Short version of mozilla polyfill:
   * <i> See https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/repeat
   */
  const stringRepeat = (str, count) => {
      // return (str.repeat && str.repeat(count)) || new Array(count + 1).join(str);
      if (count < 1)
          return '';
      let result = '';
      let pattern = str;
      while (count > 1) {
          if (count & 1)
              result += pattern;
          count >>>= 1, pattern += pattern;
      }
      return result + pattern;
  };

  var stringRepeat$1 = stringRepeat;

  const baseCreateUnitScaleFromLocaleAbbreviations = (str) => {
      if (!str) {
          return unitScale({ base: '', scale: {} });
      }
      const scale = str.split('|');
      const scaleDefinition = { ['']: 1 };
      scale.forEach((scaleItem, scaleItemIndex) => {
          if (!scaleItem)
              return;
          scaleDefinition[scaleItem] = +(1 + stringRepeat$1('0', scaleItemIndex));
      });
      return unitScale({ base: '', scale: scaleDefinition });
  };
  const createUnitScaleFromLocaleAbbreviations = memoize$1(baseCreateUnitScaleFromLocaleAbbreviations);

  var createUnitScaleFromLocaleAbbreviations$1 = createUnitScaleFromLocaleAbbreviations;

  const replaceNumeralSystemWithLatinNumbers = (numericStringWithExtraInfo, numeralSystemMap) => {
      if (!numeralSystemMap || numeralSystemMap.length !== 10)
          return numericStringWithExtraInfo;
      const numericStringLength = numericStringWithExtraInfo.length;
      const numeralSystemToLatinSystemMap = toObject$1(numeralSystemMap, (digit, digitIndex) => [digit.replace(/\u200e/g, ''), '' + digitIndex]);
      let output = '';
      for (let numericStringIndex = 0; numericStringIndex < numericStringLength; numericStringIndex++) {
          const char = numericStringWithExtraInfo[numericStringIndex];
          output += numeralSystemToLatinSystemMap[char] || char;
      }
      return output;
  };
  const getScalingFactorFromAbbreviations = (stringOriginal, options) => {
      var _a;
      const scale = createUnitScaleFromLocaleAbbreviations$1((_a = options.locale) === null || _a === void 0 ? void 0 : _a.abbreviations);
      const abbreviationsSortedByLengthDesc = Object.keys(scale.scaleDefinition.scale).sort((a, b) => b.length - a.length);
      let abbreviationScalingFactor = 1;
      for (const abbreviation of abbreviationsSortedByLengthDesc) {
          const scapedAbbreviationForRegex = escapeRegexString$1(abbreviation);
          const regexp = new RegExp('[^a-zA-Z]'
              + `(${scapedAbbreviationForRegex})|(${scapedAbbreviationForRegex.replace(/\u200e/g, '')})`
              + '(?:\\)(?:\\))?)?$');
          if (stringOriginal.match(regexp)) {
              abbreviationScalingFactor = scale.toBase(abbreviationScalingFactor, abbreviation);
              break;
          }
      }
      return abbreviationScalingFactor;
  };
  // unformats numbers separators, decimals places, signs, abbreviations
  const formattedStringToNumber = (inputString, options) => {
      var _a;
      const locale = options.locale;
      const stringOriginal = inputString;
      let value;
      // Replace special digits with latin digits
      const stringWithLatinDigits = replaceNumeralSystemWithLatinNumbers(inputString, (_a = options.locale) === null || _a === void 0 ? void 0 : _a.numeralSystem);
      if (options.zeroFormat && stringWithLatinDigits === options.zeroFormat) {
          value = 0;
      }
      else if (options.nullFormat && stringWithLatinDigits === options.nullFormat || !stringWithLatinDigits.replace(/[^0-9]+/g, '').length) {
          value = null;
      }
      else {
          // Replaces the locale decimal delimiter with a dot (.)
          const decimalDelimiterFromLocale = locale.delimiters.decimal;
          const stringWithDotDecimalDelimiter = decimalDelimiterFromLocale === '.'
              ? stringWithLatinDigits
              : stringWithLatinDigits.replace(/\./g, '').replace(decimalDelimiterFromLocale, '.');
          // Determines the scaling factor from the abbreviations (if has abbreviations)
          const abbreviationScalingFactor = getScalingFactorFromAbbreviations(stringOriginal, options);
          // Check for negative number
          const negativeFactor = (stringWithDotDecimalDelimiter.split('-').length
              + Math.min(stringWithDotDecimalDelimiter.split('(').length - 1, stringWithDotDecimalDelimiter.split(')').length - 1)) % 2 ? 1 : -1;
          // Remove non numbers
          const numberAsString = stringWithDotDecimalDelimiter.replace(/[^0-9.]+/g, '');
          value = negativeFactor * multiplyByPowerOfTen$1(+numberAsString, log10$1(abbreviationScalingFactor));
      }
      return value;
  };

  var formattedStringToNumber$1 = formattedStringToNumber;

  const locale = {
      code: 'en',
      delimiters: {
          thousands: ',',
          decimal: '.',
      },
      abbreviations: '|||K|||M|||B|||T',
      ordinal: number => {
          const b = number % 10;
          return (Math.floor(number % 100 / 10) === 1)
              ? 'th'
              : b === 1
                  ? 'st'
                  : b === 2
                      ? 'nd'
                      : b === 3
                          ? 'rd'
                          : 'th';
      },
  };

  var locale$1 = locale;

  function merge(...args) {
      const newObject = {};
      const argsLength = args.length;
      for (let i = 0; i < argsLength; i++) {
          for (const key in args[i])
              newObject[key] = args[i][key];
      }
      return newObject;
  }

  var isObject = (value) => {
      return typeof value === 'object' && value !== null;
  };

  var isObject$1 = isObject;

  var isString = (value) => {
      return typeof value === 'string';
  };

  var isString$1 = isString;

  const truncateNumber = (value) => {
      return value < 0 ? Math.ceil(value) : Math.floor(value);
  };

  var truncateNumber$1 = truncateNumber;

  const getPatternParts = (patternMask) => {
      let isInEscapedPart = false;
      let currentEscapedWord = '';
      const parts = [];
      for (let i = 0; i < patternMask.length; i++) {
          const char = patternMask.charAt(i);
          if (char === "'" && !isInEscapedPart) {
              isInEscapedPart = true;
              currentEscapedWord = '';
          }
          else if (char === "'" && isInEscapedPart && patternMask.charAt(i - 1) !== "\\") {
              isInEscapedPart = false;
              parts.push({ escaped: true, value: currentEscapedWord });
          }
          else if (isInEscapedPart) {
              currentEscapedWord += char;
          }
          else {
              if (parts.length && !parts[parts.length - 1].escaped) {
                  parts[parts.length - 1].value += char;
              }
              else {
                  parts.push({ escaped: false, value: char });
              }
          }
      }
      return parts;
  };
  /**
   * Checks only the pattern parts that are not escaped
   */
  const patternIncludes = (patternMask, search) => {
      return patternRemoveEscapedText(patternMask).indexOf(search) !== -1;
  };
  /**
   * Replaces only the pattern parts that are not escaped
   */
  const patternReplace = (patternMask, searchValue, replaceValue) => {
      return getPatternParts(patternMask)
          .map(e => e.escaped ? `'${e.value}'` : e.value.replace(searchValue, _ => replaceValue))
          .join('');
  };
  const patternRemoveEscapedText = (patternMask) => {
      return getPatternParts(patternMask)
          .filter(e => !e.escaped)
          .map(e => e.value)
          .join('');
  };
  const patternStripAndNormalizeEscapedText = (patternMask) => {
      return getPatternParts(patternMask)
          .map(e => e.escaped ? e.value.replace(/\\'/g, "'") : e.value)
          .join('');
  };

  const stringIncludes = (str, search) => {
      return str.indexOf(search) !== -1;
  };

  var stringIncludes$1 = stringIncludes;

  /**
   * What does it look for in the pattern?
   *     '(' | '+' | '-'
   * What does it remove from the pattern?
   *     '(' | ')' | '+' | '-'
   * What options does it provide?
   *     - negativeParentheses (if negative value should be wrapped between parentheses)
   *     - forceSign (is positive values should have a + sign)
   * How will it transform the output?
   *     - Parentheses:
   *         '-23.58' & '(0.00)'  =>  '(23.58)'
   *         '-23.58' & '( 0.00 )'  =>  '( 23.58 )'
   *         '-23.58' & '(  0.00 ) '  =>  ' (  23.58 )'
   *     - Sign:
   *         '12.34' & '+0.0'  =>  '+12.34'
   *         '-12.34' & '+0.0'  =>  '-12.34'
   *
   * <i> If '+' is somewhere in the pattern, it will set the '+' sign for positive numbers
   *     and same for negative numbers.
   * <i> If '-' is somewhere in the pattern, it will place the negative sign in the defined position.
   *     But it won't still set the sign for positive numbers.
   * <i> Checks if we should use parentheses for negative number or if we should prefix with a sign.
   *     If both are present we default to parentheses.
   */
  const signRule = (pattern) => {
      const patternWithoutEscapedText = patternRemoveEscapedText(pattern);
      const negativeParentheses = stringIncludes$1(patternWithoutEscapedText, '(') && stringIncludes$1(patternWithoutEscapedText, ')');
      const forceSign = !negativeParentheses && stringIncludes$1(patternWithoutEscapedText, '+');
      let outputPatternMask = pattern;
      outputPatternMask = patternReplace(outputPatternMask, '(', `'ɵnps'`);
      outputPatternMask = patternReplace(outputPatternMask, ')', `'ɵnpe'`);
      outputPatternMask = patternReplace(outputPatternMask, /(-|\+)/, `'ɵs'`);
      return [outputPatternMask, { negativeParentheses, forceSign }];
  };

  var signRule$1 = signRule;

  /**
   * Checks if abbreviation is wanted
   * <i> Applied only when 'a' is present.
   * <i> If 'a' is followed by 'k' | 'm' | 'b' | 't', then, it will force the abbreviation to be the specified
   *     unit. (e.g. (123456.78, '0,0.00am')  =>  '0.12M')
   */
  const abbreviationRule = (patternMask) => {
      let compactUnit = null; // force abbreviation
      let compact = false;
      // If it includes 'a' means it should be abbreviated (only if at least includes 'a')
      if (patternIncludes(patternMask, 'a')) {
          compact = true;
          const patternWithoutEscapedText = patternRemoveEscapedText(patternMask);
          const abbreviationRegExpResult = patternWithoutEscapedText.match(/a(k|m|b|t)?/);
          compactUnit = !!abbreviationRegExpResult ? abbreviationRegExpResult[1] : null;
      }
      let outputPatternMask = patternMask;
      outputPatternMask = patternReplace(outputPatternMask, /a(k|m|b|t)?/, `'ɵa'`);
      return [outputPatternMask, { compact, compactUnit, compactAuto: compact && !compactUnit }];
  };

  var abbreviationRule$1 = abbreviationRule;

  /**
   * Faster version of String.prototype.split that only handles splitting in two parts
   */
  const splitStringInTwoParts = (str, separator) => {
      if (!str)
          return ['', ''];
      const indexOfSearchChar = str.indexOf(separator);
      if (indexOfSearchChar === -1) {
          return [str, ''];
      }
      else {
          return [str.slice(0, indexOfSearchChar), str.slice(indexOfSearchChar + 1)];
      }
  };

  var splitStringInTwoParts$1 = splitStringInTwoParts;

  const countChars = (string, char) => {
      return !string ? 0 : string.split('').filter(stringChar => stringChar === char).length;
  };
  /**
   * Fraction digits (decimals) count rule (minimum and maximum fraction digits)
   * <i> Optional fraction digits would go always after the forced ones
   */
  const decimalPlacesRule = (patternMask) => {
      const patternWithoutEscapedText = patternRemoveEscapedText(patternMask);
      const patternPrecisionPart = splitStringInTwoParts$1(patternWithoutEscapedText, '.')[1];
      let minimumFractionDigits = 0;
      let maximumFractionDigits = 0;
      if (!!patternPrecisionPart) {
          const trimmedPatternPrecisionPart = patternPrecisionPart.trim();
          if (stringIncludes$1(trimmedPatternPrecisionPart, '[')) {
              // If it contains optional fraction digits
              const patternPrecisionPartWithoutClosingBracket = trimmedPatternPrecisionPart.replace(']', '');
              // Isolates forced (left) vs optional (right) decimals
              const precisionSplitted = splitStringInTwoParts$1(patternPrecisionPartWithoutClosingBracket, '[');
              minimumFractionDigits = countChars(precisionSplitted[0], '0');
              maximumFractionDigits = minimumFractionDigits + countChars(precisionSplitted[1], '0');
          }
          else if (stringIncludes$1(trimmedPatternPrecisionPart, '#')) {
              // If it contains optional fraction digits marked with '#'
              minimumFractionDigits = countChars(trimmedPatternPrecisionPart.split('#')[0], '0');
              maximumFractionDigits = trimmedPatternPrecisionPart.length;
          }
          else if (stringIncludes$1(trimmedPatternPrecisionPart, 'X')) {
              // If it contains no-maximum fraction digits marked with 'X'
              minimumFractionDigits = countChars(trimmedPatternPrecisionPart.split('X')[0], '0');
              maximumFractionDigits = 500;
          }
          else {
              const fractionDigits = countChars(trimmedPatternPrecisionPart.split(' ')[0], '0');
              minimumFractionDigits = fractionDigits;
              maximumFractionDigits = fractionDigits;
          }
      }
      return { minimumFractionDigits, maximumFractionDigits };
  };

  var decimalPlacesRule$1 = decimalPlacesRule;

  /**
   * Check for optional decimals.
   *
   * <i> 'optionalDecimals' This would mean that:
   *     - In case the number (value) HAS decimals (e.g. 55.34), then it would display the fixed amount of defined
   *       decimals (e.g. '0[.]000' => 3 fixed decimals), but, if the number is an straight integer, then it won't
   *       display any decimals.
   * <i> It could also accept optional decimals afterwards. So for the case '0[.]00##':
   *     - If it is an integer, displays only an integer:  23 => '23'
   *     - If it has 1 decimal, displays 2 decimals:       23.4 => '23.40'
   *     - If it has 3 decimals, displays 3 decimals:      23.456 => '23.456'
   */
  const optionalDecimalPlacesRule = (patternMask) => {
      let optionalFractionDigits = false;
      let outputPatternMask = patternMask;
      if (patternIncludes(patternMask, '[.]')) {
          optionalFractionDigits = true;
          outputPatternMask = patternReplace(outputPatternMask, '[.]', '.');
      }
      return [outputPatternMask, { optionalFractionDigits }];
  };

  var optionalDecimalPlacesRule$1 = optionalDecimalPlacesRule;

  /**
   * <i> The regExp tests for:
   *     - 0.00##X
   *     - 0,0.00##X
   *     - #.00##X (without leading zeros)
   *     - #,#.00##X (without leading zeros)
   */
  const numberPositionRule = (patternMask) => {
      const numberPartRegExp = /((((0|#)+,)?(0|#)+(\.([0#X]|\[0+\])+)?){1})/;
      return patternReplace(patternMask, numberPartRegExp, `'ɵn'`);
  };
  /**
   * Minimum leading integer digits rule
   * This will define the minimum amount of digits on the integer part (left-most grouped zeroes).
   *     - (12.34, '0000.0') =>  '0012.3'
   *     - (12.34, '0000,0.0')  =>  '0,012.3'
   *     - (0.34, '#.0') => '.3'
   *     - (1.34, '#.0') => '1.3'
   *
   * <i> It always pick the left-most amount of zeros, so:
   *     - If pattern has NO thousands separator ('000.0'), then the amount at the left of the DOT is used.
   *     - If pattern HAS thousands separator ('00,0.0'), then the amount at the left of the COMMA is used.
   * <i> This will remove the integer zero for numbers between 1 and -1 (e.g. 0.23 or -0.5)
   *     - If pattern integer part is option (0.24, '#.00') => '.24'
   */
  const minimumIntegerDigitsRule = (patternMask) => {
      const patternMaskWithoutEscapedText = patternRemoveEscapedText(patternMask);
      const patternMaskIntegerPart = patternMaskWithoutEscapedText.split('.')[0].split(',')[0];
      // If it has '#' in the integer part, sets the minimumIntegerDigits to 0
      if (/#/g.test(patternMaskIntegerPart)) {
          return 0;
      }
      return (patternMaskIntegerPart.match(/0/g) || []).length;
  };
  // If sign is not included, put sign at the left of the number
  const addSignPositionIfItDoesNotExists = (patternMask) => {
      if (stringIncludes$1(patternMask, `'ɵs'`) || stringIncludes$1(patternMask, `'ɵnps'`))
          return patternMask;
      return patternMask.replace(`'ɵn'`, _ => `'ɵs''ɵn'`);
  };
  const baseParsePattern = (inputPattern) => {
      const resolvedInputPattern = isString$1(inputPattern) && inputPattern || '0,0.##########';
      const [patternMaskAfterSignRule, signRules] = signRule$1(resolvedInputPattern);
      const [patternMaskAfterAbbreviationRule, abbreviationRules] = abbreviationRule$1(patternMaskAfterSignRule);
      const [patternMaskAfterOptionalDecimalPlacesRule, optionalDecimalPlacesRules] = optionalDecimalPlacesRule$1(patternMaskAfterAbbreviationRule);
      const outputPatternMask = patternMaskAfterOptionalDecimalPlacesRule;
      const outputPatternMaskWithoutEscapedText = patternRemoveEscapedText(outputPatternMask);
      const decimalPlacesRules = decimalPlacesRule$1(outputPatternMask);
      const minimumIntegerDigits = minimumIntegerDigitsRule(outputPatternMask);
      const grouping = outputPatternMaskWithoutEscapedText.indexOf(',') > -1;
      const patternMaskAfterHandlingNumberPosition = numberPositionRule(outputPatternMask);
      const patternMaskWithEnsuredSignPosition = addSignPositionIfItDoesNotExists(patternMaskAfterHandlingNumberPosition);
      const patternMask = patternMaskWithEnsuredSignPosition;
      return Object.assign(Object.assign(Object.assign(Object.assign(Object.assign({}, signRules), abbreviationRules), optionalDecimalPlacesRules), decimalPlacesRules), { grouping,
          minimumIntegerDigits,
          patternMask });
  };
  const parsePattern = memoize$1(baseParsePattern);

  var parsePattern$1 = parsePattern;

  /**
   * <i> Checks if value is negative, and removes the sign in case it exists
   * Expects: a value as string, with or without the minus sign, AND NOTHING ELSE.
   * Returns: same as the input but without the minus sign in case it had.
   */
  const removeSignIfExists = (valueAsString) => {
      return valueAsString[0] === '-' ? valueAsString.slice(1) : valueAsString;
  };

  var removeSignIfExists$1 = removeSignIfExists;

  /**
   * This process only is applied for automatic abbreviation ('a'), and only in the rounding
   * bubbling cases where the scale has to be recomputed.
   * E.g.
   *     formatNumber(999960, 0.0a') // Would return '1000.0k' instead of '1.0m' without this rescaling-fix
   *
   * It only applies rescaling if the absolute value of 'the already scaled and rounded value' (1.87, 'k') is greater or
   * equal to 1000, and the abbreviation is not greater or equal to trillion.
   *
   * <i> After initial scaling, value shouldn't be greater than 1000, unless it is a trillion.
   * <i> The resulting decimal part, will be always 0, as this will be executed only on the corner cases,
   *     that results from rounding bubbling. This is why decimal part is ignored.
   */
  const rescaleRoundedValue = (value, currentAbbreviationScale, patternRules, options) => {
      const { compact, compactAuto } = patternRules;
      const { abbreviations } = options.locale;
      if (!compact || !compactAuto) {
          return [value, currentAbbreviationScale];
      }
      const scale = createUnitScaleFromLocaleAbbreviations$1(abbreviations);
      const [newScaledValue, newScaledValueUnit] = scale.toBest(value, currentAbbreviationScale || '');
      return [newScaledValue, newScaledValueUnit];
  };

  var rescaleRoundedValue$1 = rescaleRoundedValue;

  /**
   * If abbreviation is forced, looks for the closest (in terms of power of ten) abbreviation in the current locale
   *     k === 10 ** 3
   *     m === 10 ** 6
   *     b === 10 ** 9
   *     t === 10 ** 12
   */
  const resolveForcedAbbreviationUnit = (forcedAbbreviationUnit, abbreviationsFromLocale, value) => {
      // Record<AbbreviationSymbol, PowerOfTenExponent>
      const forcedScaleMap = { k: 3, m: 6, b: 9, t: 12 };
      const targetPowerOfTenExponent = forcedScaleMap[forcedAbbreviationUnit];
      const scaleDefinitionFromLocale = (abbreviationsFromLocale === null || abbreviationsFromLocale === void 0 ? void 0 : abbreviationsFromLocale.split('|')) || [];
      let closestPowerOfTenWithAvailableAbbreviation = null;
      for (let distanceFromTarget = 0; distanceFromTarget < scaleDefinitionFromLocale.length; distanceFromTarget++) {
          if (!scaleDefinitionFromLocale[targetPowerOfTenExponent - distanceFromTarget])
              continue;
          closestPowerOfTenWithAvailableAbbreviation = targetPowerOfTenExponent - distanceFromTarget;
          break;
      }
      if (closestPowerOfTenWithAvailableAbbreviation === null) {
          return [value, null];
      }
      return [
          multiplyByPowerOfTen$1(value, -closestPowerOfTenWithAvailableAbbreviation),
          scaleDefinitionFromLocale[closestPowerOfTenWithAvailableAbbreviation],
      ];
  };
  const scaleValueWithAbbreviation = (value, patternRules, options) => {
      const { compact, compactUnit } = patternRules;
      const { abbreviations } = options.locale;
      if (!compact)
          return [value, null];
      if (!!compactUnit) {
          return resolveForcedAbbreviationUnit(compactUnit, abbreviations, value);
      }
      /**
       * If abbreviation is automatic, resolves the abbreviation to the best (where the value has
       * the fewest numbers before the decimal point, but is still higher than 1).
       */
      const scale = createUnitScaleFromLocaleAbbreviations$1(abbreviations);
      const [scaledValue, localizedUnit] = scale.toBest(value, '');
      return [scaledValue, localizedUnit || null];
  };

  var scaleValueWithAbbreviation$1 = scaleValueWithAbbreviation;

  const roundNumber = (number, precision, roundingFunction) => {
      const resolvedPrecision = precision || 0;
      const resolvedRoundingFunction = roundingFunction || Math.round;
      const scaledValueForRounding = multiplyByPowerOfTen$1(number, resolvedPrecision);
      const roundedScaledValue = resolvedRoundingFunction(scaledValueForRounding);
      const roundedValue = multiplyByPowerOfTen$1(roundedScaledValue, -resolvedPrecision);
      return roundedValue;
  };

  var roundNumber$1 = roundNumber;

  /**
   * The result from toFixed can contain an exponent for big numbers (e.g. 1.12345671234567e+50).
   * <!> Only handles positive exponents.
   */
  const formatPositiveExponentResult = (valueAsString) => {
      const [significand, exponent] = splitStringInTwoParts$1(valueAsString, 'e');
      const exponentAsNumber = +exponent;
      if (exponentAsNumber < 0)
          return valueAsString;
      const [integerPartOfSignificand, fractionalPartOfSignificand] = splitStringInTwoParts$1(significand, '.');
      const numberOfZerosToAdd = exponentAsNumber - fractionalPartOfSignificand.length;
      return `${integerPartOfSignificand}${fractionalPartOfSignificand}${stringRepeat$1('0', numberOfZerosToAdd)}`;
  };
  /**
   * The result from toFixed can contain an exponent for small numbers (e.g. 1.123e-87).
   * <i> Only handles negative exponents
   */
  const formatNegativeExponentResult = (value, exponentAsNumber, significandAsString) => {
      const negativeExponentAbsoluteValue = Math.abs(exponentAsNumber);
      const [integerPartOfSignificand, fractionalPartOfSignificand] = splitStringInTwoParts$1(significandAsString, '.');
      const absoluteIntegerPartOfSignificand = integerPartOfSignificand[0] === '-' ? integerPartOfSignificand.slice(1) : integerPartOfSignificand;
      let outputIntegerPartOfSignificand = absoluteIntegerPartOfSignificand;
      let outputFractionalPartOfSignificand = fractionalPartOfSignificand;
      for (let i = 0; i < negativeExponentAbsoluteValue; i += 1) {
          // Consider using array.shift
          const firstCharInIntegerPart = outputIntegerPartOfSignificand[0] || '';
          outputIntegerPartOfSignificand = outputIntegerPartOfSignificand.slice(0, outputIntegerPartOfSignificand.length - 1);
          outputFractionalPartOfSignificand = (firstCharInIntegerPart || '0') + outputFractionalPartOfSignificand;
      }
      return `${value < 0 ? '-' : ''}${outputIntegerPartOfSignificand || 0}.${outputFractionalPartOfSignificand}`;
  };
  /**
   * Like Number.prototype.toString() but excluding the exponential info for small and big numbers.
   * e.g.
   *     Small numbers:
   *         value: 0.0000000000001234 (1.234e-13)
   *         toString() => "1.234e-13"
   *         numberToStringWithoutExponent() => "0.0000000000001234"
   *     Big numbers:
   *         value: 1234123412341230000000 (1.234123412341234e+21)
   *         toString() => "1.234123412341234e+21"
   *         numberToStringWithoutExponent() => "1234123412341230000000"
   */
  const numberToNonExponentialString = (value) => {
      const valueAsString = (value || 0).toString();
      const valueAsStringHasExponentialInfo = valueAsString.indexOf('e') >= 0;
      if (!valueAsStringHasExponentialInfo)
          return valueAsString;
      // If the toString returns an exponential number (e.g. 1.23e+28)
      const [significand, exponent] = splitStringInTwoParts$1(valueAsString, 'e');
      const exponentAsNumber = +exponent;
      return exponentAsNumber >= 0
          ? formatPositiveExponentResult(valueAsString)
          : formatNegativeExponentResult(value, exponentAsNumber, significand);
  };

  var numberToNonExponentialString$1 = numberToNonExponentialString;

  const addTrailingZerosInFractionalPart = (valueAsString, minimumFractionDigits) => {
      const [integerPart, fractionalPart] = splitStringInTwoParts$1(valueAsString, '.');
      return `${integerPart}.${fractionalPart + stringRepeat$1('0', minimumFractionDigits - fractionalPart.length)}`;
  };
  /**
   * Implementation of Number.prototype.toFixed() that treats floats more like decimals
   *
   * Fixes binary rounding issues (eg. (0.615).toFixed(2) === '0.61') that present
   * problems for accounting- and finance-related software.
   *
   * <!> This function should only receive a finite number, never NaN, Infinity or -Infinity
   * <i> This function should return always a JS string representation of a number, but without exponent.
   * <i> optionalFractionDigits means: from the fractionDigits amount, the ones that are optional.
   */
  const numberToFixed = (finiteNumber, fractionDigits, roundingFunction, optionalFractionDigits) => {
      const valueAsString = numberToNonExponentialString$1(finiteNumber);
      const minimumFractionDigits = fractionDigits - (optionalFractionDigits || 0);
      const fractionalPartOfValueAsString = splitStringInTwoParts$1(valueAsString, '.')[1];
      const targetFractionDigitsAmount = !!fractionalPartOfValueAsString
          ? Math.min(Math.max(fractionalPartOfValueAsString.length, minimumFractionDigits), fractionDigits)
          : minimumFractionDigits;
      const roundedValue = roundNumber$1(finiteNumber, targetFractionDigitsAmount, roundingFunction);
      let output = numberToNonExponentialString$1(roundedValue);
      // Add trailing zeros if needed
      if (!!minimumFractionDigits) {
          output = addTrailingZerosInFractionalPart(output, minimumFractionDigits);
      }
      return output;
  };

  var numberToFixed$1 = numberToFixed;

  const roundValueAndAddTrailingZeros = (value, patternRules, options) => {
      const { rounding } = options;
      const { minimumFractionDigits, maximumFractionDigits } = patternRules;
      const resolvedRoundingFunction = rounding || Math.round;
      const shouldIncludeDecimalPlaces = minimumFractionDigits > 0 || maximumFractionDigits > 0;
      if (shouldIncludeDecimalPlaces) {
          const optionalDecimalDigitsCount = maximumFractionDigits - minimumFractionDigits;
          return numberToFixed$1(value, maximumFractionDigits, resolvedRoundingFunction, optionalDecimalDigitsCount);
      }
      else {
          return numberToFixed$1(value, 0, resolvedRoundingFunction);
      }
  };

  var roundValueAndAddTrailingZeros$1 = roundValueAndAddTrailingZeros;

  const replaceDigitsWithNumeralSystem = (numericString, numeralSystemMap) => {
      if (!numeralSystemMap || numeralSystemMap.length !== 10)
          return numericString;
      const numericStringLength = numericString.length;
      let output = '';
      for (let numericStringIndex = 0; numericStringIndex < numericStringLength; numericStringIndex++) {
          const char = numericString[numericStringIndex];
          output += numeralSystemMap[char] || char;
      }
      return output;
  };

  var replaceDigitsWithNumeralSystem$1 = replaceDigitsWithNumeralSystem;

  /**
   * <i> Add or remove leading zeros
   * Expects: a value integer part as string, without the minus sign. And nothing else but a number at the start.
   * Returns:
   *     - The value with the added or removed leading zeros
   */
  const addOrRemoveLeadingZerosToValue = (valueIntegerPartWithoutSign, patternRules) => {
      const { minimumIntegerDigits } = patternRules;
      if (minimumIntegerDigits === 0 && +valueIntegerPartWithoutSign < 1 && +valueIntegerPartWithoutSign > -1) {
          return '';
      }
      return valueIntegerPartWithoutSign.length >= minimumIntegerDigits
          ? valueIntegerPartWithoutSign
          : `${stringRepeat$1('0', minimumIntegerDigits - valueIntegerPartWithoutSign.length)}${valueIntegerPartWithoutSign}`;
  };

  var addOrRemoveLeadingZerosToValue$1 = addOrRemoveLeadingZerosToValue;

  const addSignInfoToFullFormattedNumber = (fullFormattedValueWithoutSign, isValueNegative, isValueZero, patternRules) => {
      const { negativeParentheses, forceSign } = patternRules;
      let output = fullFormattedValueWithoutSign;
      if (negativeParentheses && isValueNegative) {
          output = output.replace(/'ɵ(nps|npe)'/g, match => match === `'ɵnps'` ? '(' : ')');
      }
      else if (forceSign) {
          output = output.replace(`'ɵs'`, isValueNegative ? '-' : isValueZero ? '' : '+');
      }
      else if (isValueNegative) {
          output = output.replace(`'ɵs'`, '-');
      }
      return output;
  };

  var addSignInfoToFullFormattedNumber$1 = addSignInfoToFullFormattedNumber;

  /**
   * Splits the given number (as string) in the integer and decimal parts.
   * Returns:
   *     [integerPart: string, decimalPart: string]
   * <i> The integer part can potentially contain the number sign (-) if it wasn't removed previously.
   * <i> It should always return [string, string]
   */
  const splitNumberIntegerAndDecimalParts = (valueAsString, patternRules) => {
      const { optionalFractionDigits } = patternRules;
      const [integerPart, decimalPart] = splitStringInTwoParts$1(valueAsString, '.');
      // Checks whether optionalDecimalPlaces [.] is enabled and the value is an integer (no decimals)
      if (optionalFractionDigits && Number(decimalPart) === 0) {
          return [integerPart, ''];
      }
      return [integerPart, decimalPart];
  };

  var splitNumberIntegerAndDecimalParts$1 = splitNumberIntegerAndDecimalParts;

  const addThousandsSeparatorToValueIntegerPart = (valueIntegerPartWithLeadingZerosAndWithoutSign, patternRules, options) => {
      const { delimiters, digitGroupingStyle } = options.locale;
      const { grouping } = patternRules;
      if (!grouping || !delimiters.thousands) {
          return valueIntegerPartWithLeadingZerosAndWithoutSign;
      }
      const valueAsString = valueIntegerPartWithLeadingZerosAndWithoutSign;
      const thousandsSeparator = delimiters.thousands;
      const digitGrouping = !!(digitGroupingStyle === null || digitGroupingStyle === void 0 ? void 0 : digitGroupingStyle.length) ? digitGroupingStyle : [3];
      const restDigitGrouping = [...digitGrouping];
      let output = '';
      let groupingSubIteration = 1;
      for (let i = valueAsString.length - 1; i >= 0; i--) {
          if (groupingSubIteration === restDigitGrouping[0] && i !== 0) {
              output = thousandsSeparator + valueAsString[i] + output;
              if (restDigitGrouping.length > 1)
                  restDigitGrouping.shift();
              groupingSubIteration = 1;
          }
          else {
              output = valueAsString[i] + output;
              groupingSubIteration += 1;
          }
      }
      return output;
  };

  var addThousandsSeparatorToValueIntegerPart$1 = addThousandsSeparatorToValueIntegerPart;

  /**
   * Applies the localized abbreviation unit to the pattern mask
   * <i> If the localized unit is empty (''), it will remove the space between the number and the abbreviation.
   * <i> Replaces the single quotes from the abbreviation, to prevent collision with patternMask escaped text.
   */
  const applyAbbreviationLocalizedUnitToPatternMask = (patternMask, abbreviationLocalizedUnit, hasAbbreviationInPatternMask) => {
      if (!hasAbbreviationInPatternMask)
          return patternMask;
      if (abbreviationLocalizedUnit) {
          /**
           * If it has abbreviation in the rules, and has a valid unit (e.g. K | M | B | T, or
           * other localized one), escapes the single quotes in the localized abbreviation unit and appends to the mask.
           */
          return patternMask.replace(`'ɵa'`, _ => `'${abbreviationLocalizedUnit.replace(/'/g, _ => "\\'")}'`);
      }
      else {
          // If it has abbreviation in the rules, but it has no unit, removes the space between abbreviation and number
          return patternMask.match(/'ɵn'\s*'ɵa'/)
              // If abbreviation is before
              ? patternMask.replace(/\s*'ɵa'/, '')
              // If abbreviation is after
              : patternMask.replace(/'ɵa'\s*/, '');
      }
  };

  var applyAbbreviationLocalizedUnitToPatternMask$1 = applyAbbreviationLocalizedUnitToPatternMask;

  const scaleAndRoundValue = (number, patternRules, options) => {
      // If it doesn't have abbreviation, just round the value and add trailing zeros
      if (!patternRules.compact) {
          const roundedValueAsString = roundValueAndAddTrailingZeros$1(number, patternRules, options);
          return [roundedValueAsString, null];
      }
      // If it has abbreviation, scales the value
      const [scaledValue, scaledValueLocalizedUnit] = scaleValueWithAbbreviation$1(number, patternRules, options);
      const roundedScaledValue = +roundValueAndAddTrailingZeros$1(scaledValue, patternRules, options);
      const [rescaledValue, rescaledValueLocalizedUnit] = rescaleRoundedValue$1(+roundedScaledValue, scaledValueLocalizedUnit, patternRules, options);
      const roundedRescaledValueAsStringWithTrailingZeros = roundValueAndAddTrailingZeros$1(rescaledValue, patternRules, options);
      return [roundedRescaledValueAsStringWithTrailingZeros, rescaledValueLocalizedUnit];
  };
  const numberToFormattedNumber = (number, pattern, options) => {
      var _a;
      const patternRules = parsePattern$1(pattern);
      // Ensure always uses a number or default number
      const resolvedValue = isFiniteNumber$1(number) ? number : 0;
      const [valueAsString, localizedAbbreviationUnit] = scaleAndRoundValue(resolvedValue, patternRules, options);
      // Prevents potentially wrong formatting coming from this function
      if (valueAsString === 'NaN')
          return '';
      const isValueNegative = options.signedZero ? number < 0 : +valueAsString < 0;
      const isValueZero = options.signedZero ? number === 0 : +valueAsString === 0;
      const valueAsStringWithoutSign = removeSignIfExists$1(valueAsString);
      const [integerPart, decimalPart] = splitNumberIntegerAndDecimalParts$1(valueAsStringWithoutSign, patternRules);
      const valueIntegerPartWithLeadingZeros = addOrRemoveLeadingZerosToValue$1(integerPart, patternRules);
      const valueIntegerPartWithThousandsSeparator = addThousandsSeparatorToValueIntegerPart$1(valueIntegerPartWithLeadingZeros, patternRules, options);
      const numeralSystemFromLocale = options.locale.numeralSystem;
      const integerPartWithNumeralSystem = replaceDigitsWithNumeralSystem$1(valueIntegerPartWithThousandsSeparator, numeralSystemFromLocale);
      const decimalPartWithNumeralSystem = replaceDigitsWithNumeralSystem$1(decimalPart, numeralSystemFromLocale);
      const fullNumberWithNumeralSystem = (integerPartWithNumeralSystem
          + (!!decimalPartWithNumeralSystem ? (((_a = options.locale.delimiters) === null || _a === void 0 ? void 0 : _a.decimal) || '.') + decimalPartWithNumeralSystem : ''));
      // Assembling
      const patternMaskWithAbbreviation = applyAbbreviationLocalizedUnitToPatternMask$1(patternRules.patternMask, localizedAbbreviationUnit, patternRules.compact);
      const patternMaskWithNumber = patternMaskWithAbbreviation.replace(`'ɵn'`, _ => `'${fullNumberWithNumeralSystem.replace(/'/g, "\\'")}'`);
      const patternMaskWithSignInfo = addSignInfoToFullFormattedNumber$1(patternMaskWithNumber, isValueNegative, isValueZero, patternRules);
      const cleanPatternMask = patternMaskWithSignInfo.replace(/'ɵ(nps|npe|s|a|n)'/g, '');
      const fullFormattedValueWithNormalizedText = patternStripAndNormalizeEscapedText(cleanPatternMask);
      return fullFormattedValueWithNormalizedText;
  };

  var numberToFormattedNumber$1 = numberToFormattedNumber;

  /**
   * Basis point format (BPS)
   * <i> See https://en.wikipedia.org/wiki/Basis_point
   */
  const bpsFormatter = {
      name: 'bps',
      regexps: {
          format: /BPS/,
          unformat: /BPS/,
      },
      format: (number, pattern, options) => {
          const scaledValue = multiplyByPowerOfTen$1(number, 4);
          const patternWithEscapedBPS = patternReplace(pattern, /BPS/, `'ɵBPSɵ'`);
          const formatResult = numberToFormattedNumber$1(scaledValue, patternWithEscapedBPS, options);
          return formatResult.replace('ɵBPSɵ', 'BPS');
      },
      unformat: (string, options) => {
          const number = formattedStringToNumber$1(string.replace(/\s?BPS/, ''), options);
          return isFiniteNumber$1(number) ? multiplyByPowerOfTen$1(number, -4) : number;
      },
  };

  var bpsFormatter$1 = bpsFormatter;

  const timeFormatter = {
      name: 'time',
      regexps: {
          format: /([0-9]{1,2}:[0-9]{2}) *$/,
          unformat: /([0-9]{1,2}:[0-9]{2}) *$/,
      },
      format: (number) => {
          const absoluteValue = Math.abs(number);
          const sign = number < 0 ? '-' : '';
          const hours = truncateNumber$1(absoluteValue / 3600);
          const minutes = truncateNumber$1((absoluteValue - (hours * 3600)) / 60);
          const seconds = truncateNumber$1(absoluteValue - (hours * 3600) - (minutes * 60));
          return `${sign}${hours}:${(minutes < 10 ? '0' : '') + minutes}:${(seconds < 10 ? '0' : '') + seconds}`;
      },
      unformat: (string) => {
          const isNegative = /^ *-/.test(string);
          const stringWithoutSign = string.replace(/^ *-/, '');
          const timeArray = stringWithoutSign.split(':').reverse();
          let seconds = 0;
          seconds += +timeArray[0];
          seconds += +timeArray[1] * 60;
          seconds += (+timeArray[2] || 0) * 3600;
          return isNegative && seconds !== 0 ? -seconds : seconds;
      },
  };

  var timeFormatter$1 = timeFormatter;

  const decimalSuffixes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
  const binarySuffixes = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
  const allSuffixes = decimalSuffixes.concat(binarySuffixes.slice(1));
  /** Avoid collision with BPS format @see formats|bps.ts */
  const unformatRegex = `(${allSuffixes.join('|').replace(/B/g, 'B(?!PS)')})`;
  const bytesDecimalScale = unitScale({ base: 'B', scale: toObject$1(decimalSuffixes, (unit, unitIndex) => [unit, Math.pow(1000, unitIndex)]) });
  const bytesBinaryScale = unitScale({ base: 'B', scale: toObject$1(binarySuffixes, (unit, unitIndex) => [unit, Math.pow(1024, unitIndex)]) });
  const bytesFormatter = {
      name: 'bytes',
      regexps: {
          format: /([0\s]b[bd])|(b[bd][0\s])/,
          unformat: (string, options) => options.type === 'bytes' ? new RegExp(unformatRegex).test(string) : false,
      },
      format: (number, pattern, options) => {
          const scale = patternIncludes(pattern, 'bb') ? bytesBinaryScale : bytesDecimalScale;
          const [scaledValue, scaledValueUnit] = scale.toBest(number, 'B');
          const patternWithEscapedBytes = patternReplace(pattern, /b[bd]/, `'ɵbytesɵ'`);
          const formatResult = numberToFormattedNumber$1(scaledValue, patternWithEscapedBytes, options);
          return formatResult.replace('ɵbytesɵ', scaledValueUnit || '');
      },
      unformat: (string, options) => {
          var _a;
          const number = formattedStringToNumber$1(string.replace(new RegExp(unformatRegex), ''), options);
          const suffix = ((_a = string.match(unformatRegex)) === null || _a === void 0 ? void 0 : _a[0]) || '';
          const scale = !!bytesBinaryScale.scaleDefinition.scale[suffix] ? bytesBinaryScale : bytesDecimalScale;
          return number ? scale.toBase(number, suffix) : number;
      }
  };

  var bytesFormatter$1 = bytesFormatter;

  const ordinalFormatter = {
      name: 'ordinal',
      regexps: {
          format: /o/,
      },
      format: (number, pattern, options) => {
          var _a, _b;
          const localizedOrdinal = ((_b = (_a = options.locale).ordinal) === null || _b === void 0 ? void 0 : _b.call(_a, number)) || '';
          const patternWithEscapedOrdinal = patternReplace(pattern, /o/, `'ɵordɵ'`);
          const formatResult = numberToFormattedNumber$1(number, patternWithEscapedOrdinal, options);
          return formatResult.replace('ɵordɵ', _ => localizedOrdinal);
      }
  };

  var ordinalFormatter$1 = ordinalFormatter;

  const currencySymbolsMap = {
      EUR: '€',
      USD: '$',
      XCD: 'EC$',
      AUD: 'A$',
      INR: '₹',
      BRL: 'R$',
      CAD: 'CA$',
      XAF: 'FCFA',
      CNY: 'CN¥',
      NZD: 'NZ$',
      XPF: 'CFPF',
      GBP: '£',
      HKD: 'HK$',
      ILS: '₪',
      JPY: '¥',
      KRW: '₩',
      XOF: 'CFA',
      MXN: 'MX$',
      TWD: 'NT$',
      VND: '₫',
  };
  const currencyFormatter = {
      name: 'currency',
      regexps: {
          format: /(\$)/,
      },
      format: (number, pattern, options) => {
          var _a;
          const currencyFromOptions = (_a = options.currency) === null || _a === void 0 ? void 0 : _a.toUpperCase();
          const localizedCurrencySymbol = currencySymbolsMap[currencyFromOptions] || currencyFromOptions || '';
          const patternWithEscapedCurrencySymbol = patternReplace(pattern, /\$/, `'ɵcurrencyɵ'`);
          const formatResult = numberToFormattedNumber$1(number, patternWithEscapedCurrencySymbol, options);
          return formatResult.replace('ɵcurrencyɵ', _ => localizedCurrencySymbol);
      },
  };

  var currencyFormatter$1 = currencyFormatter;

  const percentageFormatter = {
      name: 'percentage',
      regexps: {
          format: /%!?/,
          unformat: /%/,
      },
      format: (number, pattern, options) => {
          const hasNotScalePercentageSymbolInPattern = patternIncludes(pattern, '%!');
          const scaledValue = options.scalePercentage && !hasNotScalePercentageSymbolInPattern ? multiplyByPowerOfTen$1(number, 2) : number;
          const patternWithEscapedPercentage = patternReplace(pattern, /%!?/, `'ɵ%ɵ'`);
          const formatResult = numberToFormattedNumber$1(scaledValue, patternWithEscapedPercentage, options);
          return formatResult.replace('ɵ%ɵ', '%');
      },
      unformat: (string, options) => {
          const number = formattedStringToNumber$1(string.replace(/\s?%/, ''), options);
          return number && options.scalePercentage ? multiplyByPowerOfTen$1(number, -2) : number;
      },
  };

  var percentageFormatter$1 = percentageFormatter;

  const exponentialFormatter = {
      name: 'exponential',
      regexps: {
          format: /[eE][+-][0-9]+/,
          unformat: /[eE][+-][0-9]+/,
      },
      format: (number, pattern, options) => {
          const exponential = typeof number === 'number' && !isNaNNumber$1(number) ? number.toExponential() : '0e+0';
          const parts = splitStringInTwoParts$1(exponential, 'e');
          const patternWithoutExponential = patternReplace(pattern, /e[+|-]{1}0/i, '');
          const formatResult = numberToFormattedNumber$1(+parts[0], patternWithoutExponential, options);
          return formatResult + 'e' + parts[1];
      },
      unformat: (string, options) => {
          var _a;
          const value = formattedStringToNumber$1(string.replace(/e[+-]{1}[0-9]{1,3}/i, ''), options);
          const powerOfTenExponent = +(((_a = string.match(/e([+-]{1}[0-9]{1,3})/i)) === null || _a === void 0 ? void 0 : _a[1]) || '0');
          return isFiniteNumber$1(value) ? multiplyByPowerOfTen$1(value, powerOfTenExponent) : value;
      },
  };

  var exponentialFormatter$1 = exponentialFormatter;

  const BUILT_IN_FORMATTERS = [
      percentageFormatter$1,
      currencyFormatter$1,
      ordinalFormatter$1,
      timeFormatter$1,
      bytesFormatter$1,
      exponentialFormatter$1,
      bpsFormatter$1,
  ];

  var BUILT_IN_FORMATTERS$1 = BUILT_IN_FORMATTERS;

  const roundHalfAwayFromZero = (value) => {
      return value >= 0
          ? Math.round(value)
          : (value % 0.5 === 0) ? Math.floor(value) : Math.round(value);
  };

  var roundHalfAwayFromZero$1 = roundHalfAwayFromZero;

  const areDelimitersValid = (delimiters) => {
      return !!(delimiters === null || delimiters === void 0 ? void 0 : delimiters.decimal)
          && isString$1(delimiters === null || delimiters === void 0 ? void 0 : delimiters.thousands)
          && delimiters.decimal !== delimiters.thousands;
  };
  const resolveOptionsLocale = (optionsLocale) => {
      const defaultLocale = locale$1;
      if (!isObject$1(optionsLocale))
          return defaultLocale;
      return merge(optionsLocale, {
          delimiters: areDelimitersValid(optionsLocale.delimiters) ? optionsLocale.delimiters : defaultLocale.delimiters,
          abbreviations: optionsLocale.abbreviations || defaultLocale.abbreviations,
          ordinal: optionsLocale.ordinal || defaultLocale.ordinal,
      });
  };
  const resolveRoundingOption = (roundingOption) => {
      switch (roundingOption) {
          case 'ceil': return Math.ceil;
          case 'floor': return Math.floor;
          case 'truncate': return truncateNumber$1;
          case 'half-up': return Math.round;
          case 'half-away-from-zero': return roundHalfAwayFromZero$1;
          default: return isFunction$1(roundingOption) ? roundingOption : roundHalfAwayFromZero$1;
      }
  };
  const resolveOptionsFormatters = (optionsFormatters) => {
      if (!optionsFormatters)
          return BUILT_IN_FORMATTERS$1;
      return isFunction$1(optionsFormatters)
          ? optionsFormatters(BUILT_IN_FORMATTERS$1)
          : [...optionsFormatters, ...BUILT_IN_FORMATTERS$1];
  };
  const resolveFormatOptions = (formatOptions) => {
      var _a, _b, _c;
      const options = formatOptions || {};
      const resolvedRoundingFunction = resolveRoundingOption(options.rounding);
      const resolvedLocale = resolveOptionsLocale(options.locale);
      const resolvedFormatters = resolveOptionsFormatters(options.formatters);
      return {
          defaultPattern: options.defaultPattern || '0,0.##########',
          nullFormat: options.nullFormat || '',
          nanFormat: options.nanFormat,
          zeroFormat: options.zeroFormat,
          locale: resolvedLocale,
          rounding: resolvedRoundingFunction,
          type: options.type,
          scalePercentage: (_a = options.scalePercentage) !== null && _a !== void 0 ? _a : true,
          trim: (_b = options.trim) !== null && _b !== void 0 ? _b : true,
          formatters: resolvedFormatters,
          currency: options.currency,
          signedZero: !!options.signedZero,
          nonBreakingSpace: (_c = options.nonBreakingSpace) !== null && _c !== void 0 ? _c : false,
      };
  };

  var resolveFormatOptions$1 = resolveFormatOptions;

  const getUnformatFunctionIfMatch = (input, resolvedOptions) => {
      for (const formatter of resolvedOptions.formatters) {
          const matcher = formatter.regexps.unformat;
          if (!matcher)
              continue;
          const matcherResult = isFunction$1(matcher) ? matcher(input, resolvedOptions) : !!input.match(matcher);
          if (matcherResult)
              return formatter.unformat;
      }
  };
  const parse$2 = (input, options) => {
      const resolvedOptions = resolveFormatOptions$1(options);
      let value;
      if (isNil$1(input) || isNaNNumber$1(input)) {
          value = null;
      }
      else if (typeof input === 'number') {
          // Handles negative zero
          value = input === 0 ? 0 : input;
      }
      else if (typeof input === 'string') {
          if (resolvedOptions.zeroFormat && input === resolvedOptions.zeroFormat) {
              value = 0;
          }
          else if (resolvedOptions.nullFormat && input === resolvedOptions.nullFormat) {
              value = null;
          }
          else {
              // Removes non-breaking spaces if they exists
              const inputStringWithNormalSpaces = input.replace(/\u00A0/, ' ');
              const unformatFunctionFromFormatters = getUnformatFunctionIfMatch(inputStringWithNormalSpaces, resolvedOptions);
              const unformatFunction = unformatFunctionFromFormatters || formattedStringToNumber$1;
              value = unformatFunction(inputStringWithNormalSpaces, resolvedOptions);
          }
      }
      else {
          const result = +input;
          value = result === 0 ? result : (result || null);
      }
      return value;
  };

  var parse$1$1 = parse$2;

  /**
   * @example
   * ```javascript
   * parse('1,250.48')
   * //=> 1250.48
   * parse('10 %')
   * //=> 0.1
   * parse('1 000,582', { locale: fr })
   * //=> 1000.582
   * ```
   * Parse the given numeric-string applying the provided options.
   *
   * options:
   * ```typescript
   * {
   * nullFormat?: string;
   * nanFormat?: string;
   * zeroFormat?: string;
   * defaultPattern?: string;
   * rounding?: 'truncate' | 'ceil' | 'floor' | 'round' | ((scaledValueForRounding: number) => number);
   * locale?: NumerableLocale;
   * type?: string;
   * scalePercentage?: boolean;
   * formatters?: NumerableFormatter[] | ((builtInFormatters: NumerableFormatter[]) => NumerableFormatter[]);
   * }
   * ```
   *
   * @param string string: The numeric-string to parse (e.g. **'10 %'**)
   * @param options options: The options used to parse the numeric-string
   * ```typescript
   * {
   * nullFormat?: string;
   * nanFormat?: string;
   * zeroFormat?: string;
   * defaultPattern?: string;
   * rounding?: 'truncate' | 'ceil' | 'floor' | 'round' | ((scaledValueForRounding: number) => number);
   * locale?: NumerableLocale;
   * type?: string;
   * scalePercentage?: boolean;
   * formatters?: NumerableFormatter[] | ((builtInFormatters: NumerableFormatter[]) => NumerableFormatter[]);
   * }
   * ```
   */
  const parse = (string, options) => {
      return parse$1$1(string, options);
  };

  var parse$1 = parse;

  /**
   * @example
   * ```javascript
   * round(12.687, 2)
   * //=> 12.69
   * round(12.687)
   * //=> 13
   * round(12.687, 2, Math.floor)
   * //=> 12.68
   * ```
   * Rounds the given number to the specified amount of decimal places.
   *
   * - The **default precision** is 0.
   * - The **default roundingFunction** is Math.round.
   *
   * @param number number: The number to round (e.g. **10.23**)
   * @param precision precision: The desired amount of decimal places (e.g. **2**)
   * @param roundingFunction roundingFunction: The function applied for rounding (e.g. **Math.floor**)
   * */
  const round = (number, precision, roundingFunction) => {
      return roundNumber$1(number, precision, roundingFunction);
  };

  var round$1 = round;

  const getFormatFunctionIfMatch = (pattern, resolvedOptions) => {
      const patternWithoutEscapedText = patternRemoveEscapedText(pattern);
      for (const formatter of resolvedOptions.formatters) {
          const matcher = formatter.regexps.format;
          if (!matcher)
              continue;
          const matcherResult = isFunction$1(matcher) ? matcher(pattern, resolvedOptions) : !!patternWithoutEscapedText.match(matcher);
          if (matcherResult)
              return formatter.format;
      }
  };
  const format$1 = (value, pattern, options) => {
      var _a;
      try {
          const resolvedValue = isString$1(value) ? parseFloat(value) : value;
          const resolvedOptions = resolveFormatOptions$1(options);
          const resolvedPattern = pattern || resolvedOptions.defaultPattern;
          let output;
          if (resolvedValue === Infinity || resolvedValue === -Infinity) {
              output = resolvedValue > 0 ? '∞' : '-∞';
          }
          else if (isNaNNumber$1(resolvedValue)) {
              return isString$1(resolvedOptions.nanFormat)
                  ? resolvedOptions.nanFormat
                  : (isString$1(resolvedOptions.nullFormat) ? resolvedOptions.nullFormat : '');
          }
          else if (isNil$1(resolvedValue)) {
              output = isString$1(resolvedOptions.nullFormat) ? resolvedOptions.nullFormat : '';
          }
          else if (resolvedValue === 0 && isString$1(resolvedOptions.zeroFormat)) {
              output = resolvedOptions.zeroFormat;
          }
          else {
              // <!> Here value should always be a number
              const resolvedValueAsNumber = resolvedValue || 0;
              const formatFunctionFromFormatters = getFormatFunctionIfMatch(resolvedPattern, resolvedOptions);
              const resolvedFormatFunction = formatFunctionFromFormatters || numberToFormattedNumber$1;
              output = resolvedFormatFunction(resolvedValueAsNumber, resolvedPattern, resolvedOptions);
          }
          // Ensures that it always returns an string
          output = isString$1(output) ? output : '';
          // Replaces spaces with non-breaking spaces if needed
          output = resolvedOptions.nonBreakingSpace
              ? output.replace(/ /g, _ => '\u00A0')
              : output;
          // Trims the output if needed
          output = resolvedOptions.trim ? output.trim() : output;
          return output;
      }
      catch (_error) {
          return ((_a = options) === null || _a === void 0 ? void 0 : _a._errorFormat) || '';
      }
  };

  var format$1$1 = format$1;

  function format(number, arg2, arg3) {
      const pattern = isString$1(arg2) ? arg2 : null;
      const options = isObject$1(arg2) ? arg2 : (isObject$1(arg3) ? arg3 : {});
      return format$1$1(number, pattern, options);
  }
  const createFormatFunction = (options) => {
      const baseOptions = merge(options, {
          locale: isFunction$1(options.locale) ? options.locale() : options.locale,
      });
      return ((value, arg2, arg3) => {
          const pattern = isString$1(arg2) ? arg2 : null;
          const optionsFromArguments = isObject$1(arg2) ? arg2 : (isObject$1(arg3) ? arg3 : {});
          return format$1$1(value, pattern, merge(baseOptions, optionsFromArguments));
      });
  };
  format.withOptions = createFormatFunction;

  const unique = (arr) => {
      if (!arr)
          return [];
      return arr.filter((value, index, self) => self.indexOf(value) === index);
  };

  var unique$1 = unique;

  // <i> Extracted from https://stackoverflow.com/questions/12006095/javascript-how-to-check-if-character-is-rtl
  const leftToRightMark = '\u200e';
  const rtlCharsRanges = '\u0591-\u07FF\u200F\u202B\u202E\uFB1D-\uFDFD\uFE70-\uFEFC';
  const rtlDirCheck = new RegExp('^[^' + rtlCharsRanges + ']*?[' + rtlCharsRanges + ']');
  const isRTL = (string) => rtlDirCheck.test(string);
  const appendLeftToRightMarkIfIsRTL = (string) => isRTL(string) ? string + leftToRightMark : string;
  const languagesWith4DigitsGroupingStyle = ['zh', 'yue', 'ko', 'ja'];
  const toLocaleStringSupportsOptions = () => {
      return typeof Intl === 'object' && !!Intl && typeof Intl.NumberFormat === 'function';
  };
  const getNumeralSystemDigits = (languageTag) => {
      try {
          const localizedNumber = (1234567890).toLocaleString(languageTag, { useGrouping: false });
          const lookupObject = {};
          const repeatedChar = localizedNumber.split('').find((char) => {
              if (lookupObject[char])
                  return true;
              lookupObject[char] = true;
          });
          const digitsWithoutGroupingDelimiters = repeatedChar
              ? localizedNumber.replace(new RegExp(escapeRegexString$1(repeatedChar || ''), 'g'), '')
              : localizedNumber;
          const digitsAsArray = digitsWithoutGroupingDelimiters.split('');
          const sortedDigits = [digitsAsArray[digitsAsArray.length - 1], ...digitsAsArray.slice(0, -1)];
          return sortedDigits.join('');
      }
      catch (_err) {
          return null;
      }
  };
  const getGroupingAndFractionDelimiters = (languageTag, digits) => {
      try {
          const localizedNumber = (12345678.123).toLocaleString(languageTag);
          const localizedNumberWithoutDigits = localizedNumber.replace(new RegExp(`[${escapeRegexString$1(digits)}]`, 'g'), '');
          const [groupingDelimiter = ',', fractionDelimiter = '.'] = unique$1(localizedNumberWithoutDigits.split(''));
          return [groupingDelimiter, fractionDelimiter];
      }
      catch (_err) {
          return null;
      }
  };
  const getGroupingStyle = (languageTag, groupingDelimiter) => {
      // <i> Handle '4 digits' grouping style for some asian countries (not CLDR)
      if (languagesWith4DigitsGroupingStyle.some(language => languageTag.indexOf(language) === 0))
          return [4];
      try {
          const result = [];
          let subIterationIndex = 0;
          (100000000000).toLocaleString(languageTag).split('').reverse().forEach((digitOrGroupingDelimiter) => {
              if (digitOrGroupingDelimiter === groupingDelimiter) {
                  result.push(subIterationIndex);
                  subIterationIndex = 0;
              }
              else {
                  subIterationIndex += 1;
              }
          });
          let resultIndex = result.length;
          while (resultIndex--) {
              if (result[resultIndex] === result[resultIndex - 1])
                  result.pop();
              else
                  break;
          }
          return result;
      }
      catch (_err) {
          return null;
      }
  };
  const getAbbreviations = (languageTag, digits, type) => {
      try {
          if (!toLocaleStringSupportsOptions())
              return null;
          const intlFormatOptions = { notation: 'compact', useGrouping: false, compactDisplay: type };
          const [digitOfZero, digitOfOne, digitOfTwo] = digits.split('');
          let abbreviations = '';
          for (let i = 1; i < 50; i++) {
              const abbreviationResultForOne = (+(1 + stringRepeat$1('0', i))).toLocaleString(languageTag, intlFormatOptions);
              if (new RegExp(`^${digitOfOne}[^${digitOfZero}]+$`).test(abbreviationResultForOne)) {
                  if (type === 'long') {
                      const abbreviationResultForTwo = (+(2 + stringRepeat$1('0', i))).toLocaleString(languageTag, intlFormatOptions);
                      const abbreviationOne = abbreviationResultForOne.replace(new RegExp(`${digitOfOne}`, 'g'), '').trim();
                      const abbreviationTwo = abbreviationResultForTwo.replace(new RegExp(`${digitOfTwo}`, 'g'), '').trim();
                      abbreviations += '|' + appendLeftToRightMarkIfIsRTL(abbreviationOne) + ':::' + appendLeftToRightMarkIfIsRTL(abbreviationTwo);
                  }
                  else {
                      const abbreviation = abbreviationResultForOne.replace(new RegExp(`${digitOfOne}`, 'g'), '').trim();
                      abbreviations += '|' + appendLeftToRightMarkIfIsRTL(abbreviation);
                  }
              }
              else {
                  abbreviations += '|';
              }
          }
          // Remove trailing pipes '|'
          let result = abbreviations;
          let resultIndex = result.length;
          while (resultIndex--) {
              if (result[resultIndex] === '|')
                  result = result.slice(0, -1);
              else
                  break;
          }
          return result;
      }
      catch (_err) {
          return null;
      }
  };
  const baseGetLocaleFromPlatform = (languageTag) => {
      const resolvedLanguageTag = languageTag || 'en';
      const digits = getNumeralSystemDigits(resolvedLanguageTag);
      const resolvedDigits = digits || '0123456789';
      const delimiters = getGroupingAndFractionDelimiters(resolvedLanguageTag, resolvedDigits);
      const [groupingDelimiter, fractionDelimiter] = !!delimiters && delimiters.length >= 2 ? delimiters : [',', '.'];
      const groupingStyle = getGroupingStyle(resolvedLanguageTag, groupingDelimiter);
      const shortAbbreviations = getAbbreviations(resolvedLanguageTag, resolvedDigits, 'short');
      const longAbbreviations = getAbbreviations(resolvedLanguageTag, resolvedDigits, 'long');
      return {
          _abbreviationsLong: longAbbreviations || locale$1.abbreviations,
          code: resolvedLanguageTag,
          delimiters: { thousands: groupingDelimiter, decimal: fractionDelimiter },
          abbreviations: shortAbbreviations || locale$1.abbreviations,
          digitGroupingStyle: !!(groupingStyle === null || groupingStyle === void 0 ? void 0 : groupingStyle.length) ? groupingStyle : undefined,
          numeralSystem: digits !== '0123456789' ? digits === null || digits === void 0 ? void 0 : digits.split('').map(appendLeftToRightMarkIfIsRTL) : undefined,
          ordinal: locale$1.ordinal,
      };
  };
  const getLocaleFromPlatform$2 = memoize$1(baseGetLocaleFromPlatform);

  var getLocaleFromPlatform$1$1 = getLocaleFromPlatform$2;

  /**
   * Given a language tag (e.g. '**zh**' | '**es**' | '**fr**' | '**en-IN**' | '**zh-Hans**'), returns a NumerableLocale
   * object extracted from the platform Intl.NumberFormat behavior.
   *
   * This locale object can be used in the numerable functions that support i18n (*format* and *parse*).
   * Example:
   * ```javascript
   * format(12345, '0,0.00', { locale: getLocaleFromPlatform('fr') })
   * ```
   *
   * <i> Take into account that the returned locale is not complete, and some features like
   *     'ordinal formatting' won't work. Use this feature only for simple applications that don't require
   *     full support from numeral, and don't target legacy browsers.
   */
  const getLocaleFromPlatform = (languageTag) => {
      return getLocaleFromPlatform$1$1(languageTag);
  };

  var getLocaleFromPlatform$1 = getLocaleFromPlatform;

  var numerable = {
    __proto__: null,
    parse: parse$1,
    round: round$1,
    format: format,
    getLocaleFromPlatform: getLocaleFromPlatform$1
  };

  Object.assign(ew__default['default'], numerable);

}(ew, jQuery, luxon));
