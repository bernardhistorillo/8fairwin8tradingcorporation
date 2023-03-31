/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
var appUrl;
var currentRouteName;
var winnersGemValue;
var mapIsInitialized = false;
var allOnload = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          appUrl = $("input[name='app_url']").val();
          currentRouteName = $("input[name='route_name']").val();
          winnersGemValue = parseFloat($("input[name='winners_gem_value']").val());
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          setInterval(function () {
            $(".gem-change-color").addClass("text-color-2");
            $(".gem-change-color").removeClass("text-color-1");
            $(".gem-change-color").css("transform", "rotate(0deg)");
            setTimeout(function () {
              $(".gem-change-color").css("transform", "rotate(-15deg)");
              $(".gem-change-color").removeClass("text-color-2");
              $(".gem-change-color").addClass("text-color-1");
            }, 1000);
            setTimeout(function () {
              $(".gem-change-color").css("transform", "rotate(15deg)");
            }, 1500);
          }, 2000);
        case 5:
        case "end":
          return _context.stop();
      }
    }, _callee);
  }));
  return function allOnload() {
    return _ref.apply(this, arguments);
  };
}();
var pageOnload = /*#__PURE__*/function () {
  var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
    return _regeneratorRuntime().wrap(function _callee2$(_context2) {
      while (1) switch (_context2.prev = _context2.next) {
        case 0:
          _context2.next = 2;
          return allOnload();
        case 2:
          if (currentRouteName === "home.index") {
            homeOnload();
          } else if (currentRouteName === "income.index") {
            incomeOnload();
          } else if (currentRouteName === "orders.index") {
            ordersOnload();
          } else if (currentRouteName === "network.index") {
            networkOnload();
          } else if (currentRouteName === "transfers.index") {
            transfersOnload();
          } else if (currentRouteName === "conversions.index") {
            conversionsOnload();
          } else if (currentRouteName === "withdrawals.index") {
            withdrawalsOnload();
          }
        case 3:
        case "end":
          return _context2.stop();
      }
    }, _callee2);
  }));
  return function pageOnload() {
    return _ref2.apply(this, arguments);
  };
}();
var homeOnload = function homeOnload() {
  var textWrapper1 = document.querySelector('#text-1');
  textWrapper1.innerHTML = textWrapper1.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc'>$&</span>");
  var textWrapper2 = document.querySelector('#text-2');
  textWrapper2.innerHTML = textWrapper2.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc text-color-1'>$&</span>");
  var textWrapper3 = document.querySelector('#text-3');
  textWrapper3.innerHTML = textWrapper3.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc'>$&</span>");
  var textWrapper4 = document.querySelector('#text-4');
  textWrapper4.innerHTML = textWrapper4.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc text-color-1'>$&</span>");
  var textWrapper5 = document.querySelector('#text-5');
  textWrapper5.innerHTML = textWrapper5.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc'>$&</span>");
  var textWrapper6 = document.querySelector('#text-6');
  textWrapper6.innerHTML = textWrapper6.textContent.replace(/\S/g, "<span class='letter aileron-regular'>$&</span>");
  anime.timeline({
    loop: false
  }).add({
    targets: '#text-1 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 150,
    delay: function delay(el, i) {
      return 80 * (i + 1);
    }
  }).add({
    targets: '#text-2 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 150,
    delay: function delay(el, i) {
      return 80 * (i + 1);
    }
  }).add({
    targets: '#text-3 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 150,
    delay: function delay(el, i) {
      return 80 * (i + 1);
    }
  }).add({
    targets: '#text-4 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 150,
    delay: function delay(el, i) {
      return 80 * (i + 1);
    }
  }).add({
    targets: '#text-5 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 150,
    delay: function delay(el, i) {
      return 80 * (i + 1);
    }
  }).add({
    targets: '#text-6 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 40,
    delay: function delay(el, i) {
      return 10 * (i + 1);
    }
  }).add({
    targets: '#text-6 .letter',
    opacity: [1, 1],
    easing: "easeInOutQuad",
    duration: 50,
    delay: function delay(el, i) {
      return 30 * (i + 1);
    }
  });
  $(".products-carousel").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    centerMode: true,
    centerPadding: '150px',
    responsive: [{
      breakpoint: 1400,
      settings: {
        slidesToShow: 3,
        centerPadding: '150px'
      }
    }, {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        centerPadding: '0'
      }
    }]
  });
  AOS.init();
};
var incomeOnload = function incomeOnload() {
  initializeDataTables();
};
var ordersOnload = function ordersOnload() {
  initializeDataTables();
};
var networkOnload = function networkOnload() {
  getGenealogy();
  initializeDataTables();
};
var transfersOnload = function transfersOnload() {
  initializeDataTables();
};
var conversionsOnload = function conversionsOnload() {
  initializeDataTables();
};
var withdrawalsOnload = function withdrawalsOnload() {
  initializeDataTables();
};
var initMap = function initMap() {
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 5.8,
    disableDefaultUI: true,
    center: {
      lat: 14.09782,
      lng: 121.33163
    },
    styles: [{
      "featureType": "landscape",
      "elementType": "geometry",
      "stylers": [{
        "color": "#e3b504"
      }]
    }, {
      "featureType": "landscape.natural.terrain",
      "elementType": "geometry",
      "stylers": [{
        "saturation": -100
      }]
    }, {
      "featureType": "poi",
      "elementType": "geometry",
      "stylers": [{
        "color": "#e3b504"
      }]
    }, {
      "featureType": "road",
      "elementType": "geometry",
      "stylers": [{
        "color": "#ffffff"
      }]
    }, {
      "featureType": "water",
      "elementType": "geometry",
      "stylers": [{
        "color": "#104d22"
      }]
    }, {
      "featureType": "water",
      "elementType": "labels",
      "stylers": [{
        "color": "#ffffff"
      }]
    }]
  });
  var marker = new google.maps.Marker({
    position: {
      lat: 14.09782,
      lng: 121.33163
    },
    map: map,
    icon: {
      url: appUrl + "/img/contact/map-marker.png",
      scaledSize: new google.maps.Size(80, 80)
    }
  });
  if (map) {
    mapIsInitialized = true;
  }
};
var initializeDataTables = function initializeDataTables() {
  $(".data-table").DataTable({
    "aaSorting": []
  });
  $(".loading-text").css("display", "none");
  $(".data-table").css("display", "table");
};
var showErrorFromAjax = function showErrorFromAjax(error) {
  var content = "Something went wrong.";
  if (error.responseJSON) {
    content = error.responseJSON.message;
    for (var prop in error.responseJSON.errors) {
      if (Object.prototype.hasOwnProperty.call(error.responseJSON.errors, prop)) {
        content += ' ' + error.responseJSON.errors[prop];
      }
    }
  }
  $("#modal-error .message").html(content);
  $("#modal-error").modal("show");
};
function getOffset(el) {
  var rect = el.getBoundingClientRect();
  return {
    left: rect.left + window.scrollX,
    top: rect.top + window.scrollY
  };
}
$(document).ready(function () {
  pageOnload();
});
$(window).on('scroll', function () {
  var navbar = $(".navbar");
  if ($(this).scrollTop() > 0) {
    navbar.addClass("scrolled");
    navbar.removeClass("navbar-dark");
  } else {
    navbar.removeClass("scrolled");
    navbar.addClass("navbar-dark");
  }
  if ($("#map").length) {
    if ($(this).scrollTop() + $(this).height() >= getOffset($("#footer")[0]).top && !mapIsInitialized) {
      initMap();
    }
  }
});
$(document).on("click", ".navbar-toggler", function () {
  var navbar = $(".navbar");
  if ($(this).hasClass("collapsed") && $(window).scrollTop() === 0) {
    navbar.removeClass("scrolled");
    navbar.addClass("navbar-dark");
  } else {
    navbar.addClass("scrolled");
    navbar.removeClass("navbar-dark");
  }
});

// Start: Registration
var referralCodeOnChange = function referralCodeOnChange() {
  $("#register-sponsor-blank").css("display", "none");
  $("#register-sponsor-no-match").css("display", "none");
  $("#register-sponsor-has-match").css("display", "none");
  $("#register-sponsor-loading").css("display", "inline-block");
  var referral_code = $("#register-sponsors-code").val();
  var checkSponsor = function checkSponsor() {
    $.ajax({
      method: "POST",
      url: $("#register-sponsors-code").attr("data-action"),
      timeout: 30000,
      data: {
        referral_code: referral_code
      }
    }).done(function (response) {
      if (!response.sponsor) {
        $("#register-sponsor-blank").css("display", "none");
        $("#register-sponsor-no-match").css("display", "inline-block");
        $("#register-sponsor-has-match").css("display", "none");
        $("#register-sponsor-loading").css("display", "none");
      } else {
        $("#register-sponsor-has-match").html(response.sponsor);
        $("#register-sponsor-blank").css("display", "none");
        $("#register-sponsor-no-match").css("display", "none");
        $("#register-sponsor-has-match").css("display", "inline-block");
        $("#register-sponsor-loading").css("display", "none");
      }
    }).fail(function (error) {
      showErrorFromAjax(error);
    });
  };
  if (referral_code === "") {
    $("#register-sponsor-blank").css("display", "inline-block");
    $("#register-sponsor-no-match").css("display", "none");
    $("#register-sponsor-has-match").css("display", "none");
    $("#register-sponsor-loading").css("display", "none");
  } else {
    checkSponsor();
  }
};
$(document).on("change", "#register-sponsors-code", function () {
  referralCodeOnChange();
});
$(document).on("click", "#register-show-confirmation", function () {
  $("#modal-warning .message").html("Your registration information will now be submitted.");
  $("#modal-warning .proceed").html("Confirm");
  $("#modal-warning .proceed").attr("id", "register");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#register", function () {
  $("#modal-warning .cancel").css("display", "none");
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  var firstname = $("#register-firstname").val();
  var lastname = $("#register-lastname").val();
  var contact_number = $("#register-contact-number").val();
  var email_address = $("#register-email-address").val();
  var username = $("#register-username").val();
  var password = $("#register-password").val();
  var confirm_password = $("#register-confirm-password").val();
  var pin_code = $("#register-pin-code").val();
  var confirm_pin_code = $("#register-confirm-pin-code").val();
  var sponsors_code = $("#register-sponsors-code").val();
  $.ajax({
    method: "POST",
    url: $("#register-show-confirmation").attr("data-action"),
    timeout: 30000,
    data: {
      firstname: firstname,
      lastname: lastname,
      contact_number: contact_number,
      email_address: email_address,
      username: username,
      password: password,
      confirm_password: confirm_password,
      pin_code: pin_code,
      confirm_pin_code: confirm_pin_code,
      sponsors_code: sponsors_code
    }
  }).done(function (response) {
    $("#modal-success button[data-bs-dismiss='modal']").removeAttr("data-bs-dismiss");
    $('#modal-success .proceed').attr("onclick", "window.location = '/dashboard'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
    $("#modal-success .message").html("Congratulations! You have successfully created your account.");
    $("#modal-success").modal("show");
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal("hide");
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning .cancel").css("display", "block");
  });
});
// End: Registration

// Start: Log In
$(document).on("submit", "#login-form", function (e) {
  e.preventDefault();
  $("#login").prop("disabled", true);
  $("#login").html("Logging In...");
  var username = $("#login-username").val();
  var password = $("#login-password").val();
  $.ajax({
    method: "POST",
    url: $("#login-form").attr("action"),
    timeout: 30000,
    data: {
      username: username,
      password: password
    }
  }).done(function (response) {
    $("#login").html("Redirecting...");
    window.location = "/dashboard";
  }).fail(function (error) {
    showErrorFromAjax(error);
  });
});
// End: Log In

var genealogy;
var root;
var selected_node;
var generate_referral_table_once = 0;
var proof_of_payment_uploader = $('<input type="file" accept="image/*" />');
var profile_picture_uploader = $('<input type="file" accept="image/*" />');
var account_package = ["", "DBP - ", "DSP - ", "FDP - ", "DMP - "];
var ranks = ["Free Account", "Dealer", "Explorer", "Pathfinder", "Navigator", "Master Guide", "Fair Winner", "Grand Fair Winner", "Royal Fair Winner", "Crown Fair Winner"];
var getGenealogy = function getGenealogy() {
  $.ajax({
    method: "POST",
    url: $("input[name='get-genealogy-route']").val(),
    timeout: 30000,
    data: {
      type: 2
    }
  }).done(function (response) {
    genealogy = response.genealogy;
    root = response.root;
    selected_node = response.root;
    generateGenealogy();
  }).fail(function () {
    setTimeout(function () {
      getGenealogy();
    }, 1000);
  });
};
var generateGenealogy = function generateGenealogy() {
  var uplines = [];
  uplines.push(selected_node);
  var parsed_upline = selected_node;
  while (parsed_upline > 1 && parsed_upline != root) {
    for (var i = 0; i < genealogy.length; i++) {
      if (genealogy[i].downline == parsed_upline) {
        uplines.push(genealogy[i].upline);
        parsed_upline = genealogy[i].upline;
        break;
      }
    }
  }
  var uplines_breadcrumb = '';
  for (var j = uplines.length - 1; j >= 0; j--) {
    for (var i = 0; i < genealogy.length; i++) {
      if (uplines[j] == genealogy[i].downline) {
        if (j == 0) {
          uplines_breadcrumb += '<li class="breadcrumb-item active">' + genealogy[i].firstname + " " + genealogy[i].lastname + '</li>';
        } else {
          uplines_breadcrumb += '<li class="breadcrumb-item">';
          uplines_breadcrumb += '		<a href="javascript:void(0)" class="uplines" node-id="' + genealogy[i].downline + '">' + genealogy[i].firstname + " " + genealogy[i].lastname + '</a>';
          uplines_breadcrumb += '</li>';
        }
      }
    }
  }
  $(".uplines-container").html(uplines_breadcrumb);
  $("#chart").css("height", $(window).height() - 100 + "px");
  var chart_config = [];
  var nodes = [];
  var nodes_to_be_parsed = [selected_node];
  chart_config.push({
    container: "#chart",
    nodeAlign: "BOTTOM",
    connectors: {
      type: 'step'
    }
  });
  for (var i = 0; i < genealogy.length; i++) {
    if (genealogy[i].downline == selected_node) {
      nodes[genealogy[i].downline] = {
        HTMLclass: "root",
        text: {
          name: genealogy[i].firstname + " " + genealogy[i].lastname,
          id: genealogy[i].downline,
          rank: account_package[genealogy[i].package_id] + ranks[genealogy[i].rank],
          username: "Username: " + genealogy[i].username,
          referral_code: "Referral Code: " + genealogy[i].referral_code
        }
      };
      chart_config.push(nodes[genealogy[i].downline]);
      break;
    }
  }
  var number_of_levels_to_be_shown = $("#number-of-levels-to-be-shown").val();
  for (var j = 0; j < number_of_levels_to_be_shown; j++) {
    var nodes_to_be_parsed_temp = [];
    for (var k = 0; k < nodes_to_be_parsed.length; k++) {
      for (var i = 0; i < genealogy.length; i++) {
        if (genealogy[i].upline == nodes_to_be_parsed[k]) {
          var content = ' <p class="node-name">' + genealogy[i].firstname + ' ' + genealogy[i].lastname + '</p>';
          content += '    <p class="node-id">' + genealogy[i].downline + '</p>';
          content += '    <p class="node-rank">' + account_package[genealogy[i].package_id] + ranks[genealogy[i].rank] + '</p>';
          content += '    <p class="node-username">Username: ' + genealogy[i].username + '</p>';
          content += '    <p class="node-referral_code">Referral Code: ' + genealogy[i].referral_code + ' </p>';
          content += '    <p class="node-button"><button class="btn btn-custom-2 font-size-90 btn-sm node-expand" value="' + genealogy[i].downline + '">Expand</button></p>';
          nodes[genealogy[i].downline] = {
            parent: nodes[genealogy[i].upline],
            innerHTML: content
          };
          chart_config.push(nodes[genealogy[i].downline]);
          nodes_to_be_parsed_temp.push(genealogy[i].downline);
        }
      }
    }
    nodes_to_be_parsed = nodes_to_be_parsed_temp;
  }
  if (generate_referral_table_once == 0) {
    nodes_to_be_parsed = [selected_node];
    var table_content = '<table class="table table-bordered data-table" style="display:none">';
    table_content += '		<thead>';
    table_content += '			<tr>';
    table_content += '				<th>Name</th>';
    table_content += '				<th>Username</th>';
    table_content += '				<th>Referral Code</th>';
    table_content += '				<th>Sponsor Name</th>';
    table_content += '			</tr>';
    table_content += '		</thead>';
    table_content += '		<tbody>';
    console.log(genealogy);
    while (nodes_to_be_parsed.length > 0) {
      var nodes_to_be_parsed_temp = [];
      for (var k = 0; k < nodes_to_be_parsed.length; k++) {
        for (var i = 0; i < genealogy.length; i++) {
          if (genealogy[i].upline == nodes_to_be_parsed[k]) {
            table_content += '	<tr>';
            table_content += '		<td>' + genealogy[i].firstname + ' ' + genealogy[i].lastname + '</td>';
            table_content += '		<td>' + genealogy[i].username + '</td>';
            table_content += '		<td>' + genealogy[i].referral_code + '</td>';
            table_content += '		<td>' + genealogy[i].upline_firstname + ' ' + genealogy[i].upline_lastname + '</td>';
            table_content += '	</tr>';
            nodes_to_be_parsed_temp.push(genealogy[i].downline);
          }
        }
      }
      nodes_to_be_parsed = nodes_to_be_parsed_temp;
    }
    table_content += '		</tbody>';
    table_content += '	</table>';
    $(".genealogy-table-container").html(table_content);
    $(".data-table").DataTable();
    $(".data-table").css("display", "table");
    generate_referral_table_once = 1;
  }
  $("#chart").html('<h5 class="text-center my-5 py-5">Loading...</h5>');
  if ($("#has-network").attr("data-value") == 1) {
    setTimeout(function () {
      new Treant(chart_config);
      $('#chart').animate({
        scrollLeft: parseFloat($('.root').css("left")) - $('#chart').width() / 2 + $('.node').width() / 2
      }, 500);
    }, 500);
  } else {
    $("#chart").html('<h5 class="text-center my-5 py-5">No Network</h5>');
  }
};
var load_cart = function load_cart(empty_cart) {
  if (empty_cart) {
    remove_from_cart(0);
  }
  var total_quantity = 0;
  var total_price = 0;
  var total_points = 0;
  var content = '	<table class="table table-bordered">';
  $(".cart").each(function () {
    if ($(this).attr("data-added-to-cart") == 1) {
      total_quantity += parseInt($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"));
      total_price += $(".product-container[data-id='" + $(this).val() + "']").attr("data-price") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity");
      total_points += $(".product-container[data-id='" + $(this).val() + "']").attr("data-points") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity");
      content += '<tr>';
      content += '	<td style="width:50px">' + $(".product-container[data-id='" + $(this).val() + "']").find(".image-container").html() + '</td>';
      content += '	<td style="text-align:left; position:relative">';
      content += '		<h6 style="font-size:0.9em">' + $(".product-container[data-id='" + $(this).val() + "']").attr("data-name") + '</h6>';
      if ($(this).attr("data-type") == 2 || $("input[name='stockist-purchase']:checked").val() > 0) {
        content += '	<p class="mb-0" style="font-size:0.9em">' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-price"), true) + ' Gems &times; ' + $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity") + ' = ' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-price") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"), true) + ' Gems</p>';
        content += '	<p class="mb-0" style="font-size:0.9em">' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-points"), true) + ' PV &times; ' + $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity") + ' = ' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-points") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"), true) + ' PV</p>';
        content += '	<div class="btn-group mt-1" role="group">';
        content += '		<button class="btn btn-sm change-quantity" value="' + $(this).val() + '" data-change="-1" style="background-color:#0e4d22; color:#ffffff; width:50px; border-right:1px solid #ffffff"><i class="fas fa-minus"></i></button>';
        content += '		<button class="btn btn-sm change-quantity" value="' + $(this).val() + '" data-change="1" style="background-color:#0e4d22; color:#ffffff; width:50px; border-left:1px solid #ffffff""><i class="fas fa-plus"></i></button>';
        content += '	</div>';
        content += '	<br>';
      }
      content += '		<button class="btn btn-custom-4 btn-sm mt-1 font-size-80 remove-from-cart px-3" value="' + $(this).val() + '">REMOVE FROM CART</button>';
      content += '	</td>';
      content += '</tr>';
    }
  });
  content += '	</table>';
  if (total_quantity == 0) {
    content += '	<tr>';
    content += '		<td>No Items Added Yet</td>';
    content += '	</tr>';
  }
  $("#cart-container").html(content);
  $("#total-quantity").html(numberFormat(total_quantity, false));
  $("#total-price").html(numberFormat(total_price, true));
  $("#total-points").html(numberFormat(total_points, true));
};
var remove_from_cart = function remove_from_cart(id) {
  id = parseInt(id);
  if (id === 0) {
    $(".cart").attr("data-added-to-cart", -1);
    $(".cart").removeClass("btn-custom-4");
    $(".cart").addClass("btn-custom-2");
    $(".cart").html('<div class="py-1">ADD TO CART</div>');
    $(".product-container").attr("data-quantity", 1);
  } else {
    $(".cart[value='" + id + "']").attr("data-added-to-cart", -1);
    $(".cart[value='" + id + "']").removeClass("btn-custom-4");
    $(".cart[value='" + id + "']").addClass("btn-custom-2");
    $(".cart[value='" + id + "']").html('<div class="py-1">ADD TO CART</div>');
    $(".product-container[data-id='" + id + "']").attr("data-quantity", 1);
  }
};
var numberFormat = function numberFormat(x, decimal) {
  x = parseFloat(x);
  var parts = x.toFixed(2).toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  if (decimal) {
    return parts.join(".");
  } else {
    return parts[0];
  }
};
proof_of_payment_uploader.on("change", function () {
  var reader = new FileReader();
  reader.onload = function (event) {
    var img = new Image();
    img.onload = function () {
      var height = img.height;
      var width = img.width;
      $("#proof-of-payment-container .proof-of-payment:last").attr("data-image", img.src);
      $("#proof-of-payment-container .proof-of-payment:last").attr("data-has-image", 1);
      $("#proof-of-payment-container .proof-of-payment:last").attr("data-extension", proof_of_payment_uploader[0].files[0].name.split('.').pop().toLowerCase());
      var content = ' <div style="position:relative; width:100%; height:100%; padding-top:150px; overflow:hidden">';
      content += '         <img src="' + img.src + '" style="' + (width >= height ? 'height:auto; width:100%;' : 'height:100%; width:auto;') + ' margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" />';
      content += '    </div>';
      $("#proof-of-payment-container .proof-of-payment:last").html(content);
      $("#proof-of-payment-container").append($("#proof-of-payment-content").html());
    };
    img.src = event.target.result;
  };
  reader.readAsDataURL(proof_of_payment_uploader[0].files[0]);
});
profile_picture_uploader.on("change", function () {
  $(".profile-picture-loading").removeClass("d-none");
  var previous_photo = $(".change-profile-picture-container").css("background-image");
  $(".change-profile-picture-container").css("background-image", "none");
  var reader = new FileReader();
  reader.onload = function (event) {
    var img = new Image();
    img.onload = function () {
      var photo = {
        image: img.src,
        extension: profile_picture_uploader[0].files[0].name.split('.').pop().toLowerCase()
      };
      $.ajax({
        method: "POST",
        url: "api/change-profile-picture.php",
        data: {
          photo: JSON.stringify(photo)
        },
        timeout: 30000
      }).done(function (response) {
        $(".change-profile-picture-container").css("background-image", "url('" + img.src + "')");
      }).fail(function (error) {
        $(".change-profile-picture-container").css("background", previous_photo);
        showErrorFromAjax(error);
      }).always(function () {
        $(".profile-picture-loading").addClass("d-none");
      });
    };
    img.src = event.target.result;
  };
  reader.readAsDataURL(profile_picture_uploader[0].files[0]);
});
$(document).ready(function () {
  var page_name = location.href.split("/").slice(-1);
  page_name = page_name[0].split(".");
  if (page_name[0] == "terminal") {
    $(".data-table").DataTable({
      "aaSorting": [],
      "pageLength": 5
    });
    $("#items-table").DataTable({
      "aaSorting": [],
      "pageLength": 5,
      "order": [[2, "desc"]]
    });
    $(".loading-text").css("display", "none");
    $(".data-table, #items-table").css("display", "table");
  }
});
$(document).on("click", ".products-tab", function () {
  load_cart(true);
  $(".products-tab").removeClass("active");
  $(this).addClass("active");
  $(".products-section").addClass("d-none");
  if ($(this).data("type") == 1) {
    if ($(this).data("package-id") == 0) {
      $(".products-section[data-type='1']").removeClass("d-none");
    } else if ($(this).data("package-id") == 4) {
      $(".products-section[data-type='1'][data-package-id='1']").removeClass("d-none");
      $(".products-section[data-type='1'][data-package-id='2']").removeClass("d-none");
      $(".products-section[data-type='1'][data-package-id='3']").removeClass("d-none");
    } else if ($(this).data("package-id") == 2) {
      $(".products-section[data-type='1'][data-package-id='1']").removeClass("d-none");
      $(".products-section[data-type='1'][data-package-id='3']").removeClass("d-none");
    } else if ($(this).data("package-id") == 1) {
      $(".products-section[data-type='1'][data-package-id='3']").removeClass("d-none");
    }
  } else {
    $(".products-section[data-type='" + $(this).data("type") + "']").removeClass("d-none");
  }
});
$(document).on("change", "input[name='stockist-purchase']", function () {
  var stockist = $("input[name='stockist-purchase']:checked").val();
  var price;
  if (stockist == 0) {
    price = "distributors-price";
    $(".crossed-price").removeClass("d-none");
  } else if (stockist == 1) {
    price = "mobile-price";
    $(".crossed-price").addClass("d-none");
  } else if (stockist == 2) {
    price = "center-price";
    $(".crossed-price").addClass("d-none");
  }
  $("#place-order-confirm").attr("data-stockist", stockist);
  $(".product-container").each(function () {
    $(this).attr("data-price", $(this).data(price));
    $(this).find(".price").html(numberFormat($(this).attr("data-price"), true));
  });
  if (stockist != 0) {
    $(".products-section").removeClass("d-none");
    $("#products-tab-container").addClass("d-none");
    $(".products-tab").removeClass("active");
    $(".products-tab[data-type='2']").addClass("active");
  } else {
    if ($("#products-tab-container").data("hidden") == 1) {
      $("#products-tab-container").addClass("d-none");
    } else {
      $("#products-tab-container").removeClass("d-none");
    }
    $(".products-tab[data-type='2']").trigger("click");
  }
  load_cart(true);
});
$(document).on("click", ".cart", function () {
  $(".cart").prop("disabled", true);
  $(".change-quantity").prop("disabled", true);
  $(".remove-from-cart").prop("disabled", true);
  if ($(this).attr("data-type") == 1 && $(".products-tab[data-type='1']").hasClass("active") && parseInt($(this).attr("data-added-to-cart")) === -1) {
    remove_from_cart(0);
  }
  if (parseInt($(this).attr("data-added-to-cart")) === -1) {
    $(this).attr("data-added-to-cart", 1);
    $(this).removeClass("btn-custom-2");
    $(this).addClass("btn-custom-4");
    $(this).html('<div class="py-1">REMOVE FROM CART</div>');
  } else {
    $(this).attr("data-added-to-cart", -1);
    $(this).removeClass("btn-custom-4");
    $(this).addClass("btn-custom-2");
    $(this).html('<div class="py-1">ADD TO CART</div>');
  }
  load_cart(false);
  $(".cart").prop("disabled", false);
  $(".change-quantity").prop("disabled", false);
  $(".remove-from-cart").prop("disabled", false);
});
$(document).on("click", ".change-quantity", function () {
  $(".cart").prop("disabled", true);
  $(".change-quantity").prop("disabled", true);
  $(".remove-from-cart").prop("disabled", true);
  var quantity = parseFloat($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"));
  if ($(this).attr("data-change") == 1) {
    quantity++;
  } else {
    quantity--;
    quantity = quantity == 0 ? 1 : quantity;
  }
  $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity", quantity);
  load_cart(false);
  $(".cart").prop("disabled", false);
  $(".change-quantity").prop("disabled", false);
  $(".remove-from-cart").prop("disabled", false);
});
$(document).on("click", ".remove-from-cart", function () {
  $(".cart").prop("disabled", true);
  $(".change-quantity").prop("disabled", true);
  $(".remove-from-cart").prop("disabled", true);
  remove_from_cart($(this).val());
  load_cart(false);
  $(".cart").prop("disabled", false);
  $(".change-quantity").prop("disabled", false);
  $(".remove-from-cart").prop("disabled", false);
});
$(document).on("click", "#place-order-confirm", function () {
  if ($("#place-order-confirm").data("terminal-account") == 0) {
    $("#modal-warning .message").html("Your order will now be placed.");
  } else {
    var less_in_stock = 0;
    var content = '	<div class="table-responsive">';
    content += '		<table class="table table-bordered">';
    content += '			<tr style="background-color:#f0f3f5">';
    content += '				<th>Item</th>';
    content += '				<th>In Stock</th>';
    content += '				<th>To Be Ordered</th>';
    content += '			</tr>';
    $(".cart").each(function () {
      if ($(this).attr("data-added-to-cart") == 1) {
        if (parseInt($(".product-container[data-id='" + $(this).val() + "'] .stock").html()) < parseInt($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"))) {
          less_in_stock++;
        }
        content += '	<tr>';
        content += '		<td>' + $(".product-container[data-id='" + $(this).val() + "'] .name").html() + '</td>';
        content += '		<td>' + numberFormat($(".product-container[data-id='" + $(this).val() + "'] .stock").html(), false) + '</td>';
        content += '		<td>' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"), false) + '</td>';
        content += '	</tr>';
      }
    });
    content += '		</table>';
    content += '	</div>';
    if (less_in_stock > 0) {
      content += '<div class="alert alert-danger text-center mb-1">';
      content += less_in_stock + ' of the items to be ordered ' + (less_in_stock > 1 ? 'are' : 'is') + ' less in stock.';
      content += '</div>';
    } else {
      content += '<div class="alert alert-success text-center mb-1">';
      content += '	This order will now be placed.';
      content += '</div>';
    }
    $("#modal-warning .message").html(content);
  }
  $("#modal-warning .proceed").attr("id", "place-order");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#place-order", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var ordered_items = [];
  $(".cart").each(function () {
    if ($(this).attr("data-added-to-cart") == 1) {
      ordered_items.push({
        id: $(this).val(),
        quantity: $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity")
      });
    }
  });
  $.ajax({
    method: "POST",
    url: $("input[name='place-order-route']").val(),
    data: {
      terminal_account: $("#place-order-confirm").data("terminal-account"),
      items: JSON.stringify(ordered_items),
      full_name: $("#full-name").val(),
      contact_number: $("#contact-number").val(),
      barangay: $("#barangay").val(),
      city: $("#city").val(),
      province: $("#province").val(),
      zip_code: $("#zip-code").val(),
      stockist: $("#place-order-confirm").attr("data-stockist")
    },
    timeout: 30000
  }).done(function (response) {
    var redirect = parseInt($("#place-order-confirm").data("terminal-account")) === 0 ? "orders" : "terminal?view=orders";
    $('#modal-success').attr("data-bs-backdrop", "static");
    $('#modal-success').attr("data-bs-keyboard", "false");
    $('#modal-success .proceed').removeAttr("data-bs-dismiss");
    $('#modal-success .proceed').attr("onclick", "window.location = '" + redirect + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
    $('#modal-success .message').html("You have successfully submitted your order request.");
    $('#modal-success').modal('show');
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("input", "#purchase-winners-gem-amount", function () {
  $("#purchase-winners-gem-price").val(parseFloat($(this).val() * winnersGemValue).toFixed(2));
});
$(document).on("input", "#purchase-winners-gem-price", function () {
  $("#purchase-winners-gem-amount").val(parseFloat($(this).val() / winnersGemValue).toFixed(2));
});
$(document).on("click", "#purchase-winners-gem-show-modal", function () {
  $("#modal-warning .message").html("Your Winners Gem purchase request will now be submitted");
  $("#modal-warning .proceed").attr("id", "purchase-winners-gem");
  $("#modal-gem-purchase").modal("hide");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#proof-of-payment-container .proof-of-payment[data-has-image='0']", function (e) {
  e.preventDefault();
  proof_of_payment_uploader.click();
});
$(document).on("click", "#purchase-winners-gem", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var price = $("#purchase-winners-gem-price").val();
  var proof_of_payments = [];
  $("#proof-of-payment-container .proof-of-payment[data-has-image='1']").each(function () {
    proof_of_payments.push({
      image: $(this).attr("data-image"),
      extension: $(this).attr("data-extension")
    });
  });
  $.ajax({
    method: "POST",
    url: $("input[name='purchase-winners-gem-route']").val(),
    data: {
      price: price,
      winners_gem_value: winnersGemValue,
      proof_of_payments: JSON.stringify(proof_of_payments)
    },
    timeout: 30000
  }).done(function (response) {
    if (response.type && response.type == "winners-gem-update") {
      winnersGemValue = parseFloat(response.winners_gem_value);
      $("#purchase-winners-gem-amount").val(parseFloat($(this).val() / winnersGemValue).toFixed(2));
      $("#modal-error .message").html("Winners Gem value has just changed. Winners Gem to be purchased was updated.");
      $("#modal-error").modal('show');
    } else {
      $("#purchase-winners-gem-amount").val(0);
      $('#modal-success').attr("data-bs-backdrop", "static");
      $('#modal-success').attr("data-bs-keyboard", "false");
      $('#modal-success .proceed').removeAttr("data-bs-dismiss");
      $('#modal-success .proceed').attr("onclick", "window.location = 'orders/winnersgem'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
      $('#modal-success .message').html("You have successfully submitted your Winners Gem purchase request.");
      $('#modal-success').modal('show');
    }
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("click", ".view-items", function () {
  $("#order-reference").html($(this).attr("data-reference"));
  $("#ordered-items-container").html('<h6 class="text-center">Loading...</h6>');
  $("#modal-view-order-items").modal('show');
  var order_id = $(this).val();
  $.ajax({
    method: "POST",
    url: $("#view-items-route").val(),
    data: {
      order_id: order_id
    },
    timeout: 30000
  }).done(function (response) {
    var content = '	<table class="table table-bordered mb-0">';
    content += '		<thead>';
    content += '			<tr>';
    content += '				<th></th>';
    content += '				<th>Item</th>';
    content += '				<th>Quantity</th>';
    content += '				<th>Amount</th>';
    content += '			</tr>';
    content += '		</thead>';
    content += '		<tbody>';
    for (var i = 0; i < response.items.length; i++) {
      content += '		<tr>';
      content += '			<td style="width:80px">';
      content += '				<div style="position:relative; width:100%; padding-top:100%; overflow:hidden; border:1px solid #eeeeee">';
      content += '					<img src="' + response.items[i].photo + '?v=' + response.items[i].version + '" style="' + (response.items[i].longestDimension == "width" ? 'width:100%; height:auto;' : 'width:auto; height:100%;') + 'max-height:100%; max-width:100%; margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" alt="' + response.items[i].name + '">';
      content += '				</div>';
      content += '			</td>';
      content += '			<td>' + response.items[i].name + '</td>';
      content += '			<td>' + response.items[i].quantity + '</td>';
      content += '			<td>' + numberFormat(response.items[i].quantity * response.items[i].price, true) + ' <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i></td>';
      content += '		</tr>';
    }
    content += '		</tbody>';
    content += '	</table>';
    $("#ordered-items-container").html(content);
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("change", "#transfer-receiver-username", function () {
  $("#transfer-receiver-blank").css("display", "none");
  $("#transfer-receiver-no-match").css("display", "none");
  $("#transfer-receiver-has-match").css("display", "none");
  $("#transfer-receiver-has-match").html("");
  $("#transfer-receiver-loading").css("display", "inline-block");
  var username = $("#transfer-receiver-username").val();
  var check_receiver = function check_receiver() {
    $.ajax({
      method: "POST",
      url: $("#check-receiver-route").val(),
      timeout: 30000,
      data: {
        username: username
      }
    }).done(function (response) {
      if (response.receiver == "") {
        $("#transfer-receiver-blank").css("display", "none");
        $("#transfer-receiver-no-match").css("display", "inline-block");
        $("#transfer-receiver-has-match").css("display", "none");
        $("#transfer-receiver-has-match").html("");
        $("#transfer-receiver-loading").css("display", "none");
      } else {
        $("#transfer-receiver-has-match").html(response.receiver);
        $("#transfer-receiver-blank").css("display", "none");
        $("#transfer-receiver-no-match").css("display", "none");
        $("#transfer-receiver-has-match").css("display", "inline-block");
        $("#transfer-receiver-loading").css("display", "none");
      }
    }).fail(function () {
      setTimeout(function () {
        check_receiver();
      }, 1000);
    });
  };
  if (username == "") {
    $("#register-sponsor-blank").css("display", "inline-block");
    $("#register-sponsor-no-match").css("display", "none");
    $("#register-sponsor-has-match").css("display", "none");
    $("#transfer-receiver-has-match").html("");
    $("#register-sponsor-loading").css("display", "none");
  } else {
    check_receiver();
  }
});
$(document).on("click", "#transfer-winners-gem-confirm", function () {
  var receiver = $("#transfer-receiver-has-match").html();
  var amount = numberFormat($("#transfer-winners-gem-amount").val(), true);
  if (receiver != "") {
    $("#modal-warning .message").html("Are you sure you want to transfer " + amount + " <i class='fas fa-gem' style='font-size:0.8em'></i> to " + receiver + "?");
    $("#modal-warning .proceed").attr("id", "transfer-winners-gem");
    $("#modal-transfer").modal("hide");
    $("#modal-warning").modal("show");
  }
});
$(document).on("click", "#transfer-winners-gem", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var username = $("#transfer-receiver-username").val();
  var amount = parseFloat($("#transfer-winners-gem-amount").val());
  var pin_code = $("#transfer-pin-code").val();
  $.ajax({
    method: "POST",
    url: $("#submit-transfer-route").val(),
    data: {
      username: username,
      amount: amount,
      pin_code: pin_code
    },
    timeout: 30000
  }).done(function (response) {
    var receiver = $("#transfer-receiver-has-match").html();
    $("#winners-gem-balance").html(numberFormat(response.gem_balance, true));
    $("#winners-gem-balance-in-pesos").html(numberFormat(response.gem_balance * winnersGemValue, true));
    $("#winners-gem-sent").html(numberFormat(response.gems_sent, true));
    $('#modal-success').attr("data-bs-backdrop", "static");
    $('#modal-success').attr("data-bs-keyboard", "false");
    $('#modal-success .proceed').removeAttr("data-bs-dismiss");
    $('#modal-success .proceed').attr("onclick", "window.location = '/transfers/sent'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
    $('#modal-success .message').html("You have successfully sent " + numberFormat(amount, true) + " <i class='fas fa-gem' style='font-size:0.8em'></i> to " + receiver + ".");
    $('#modal-success').modal('show');
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("change", "#convert-peso-to-gem-amount", function () {
  $("#convert-total-winners-gem").html(numberFormat($(this).val() / winnersGemValue, true));
});
$(document).on("change", "#convert-gem-to-peso-amount", function () {
  var amount = parseFloat($("#convert-gem-to-peso-amount").val());
  $("#convert-total-peso").html(numberFormat(amount * winnersGemValue, true));
  $("#convert-gem-to-peso-fee-peso").html(numberFormat(amount * winnersGemValue * 0.02, true));
  $("#convert-gem-to-peso-fee-gem").html(numberFormat(amount * 0.02, true));
  $("#convert-gem-to-peso-total-gems").html(numberFormat(amount * 1.02, true));
});
$(document).on("click", "#convert-confirm", function () {
  var type = $(".convert-tab.active").data("type");
  var amount = parseFloat($("#convert-" + type + "-amount").val());
  if (type == "peso-to-gem") {
    $("#modal-warning .message").html("Are you sure you want to convert <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount, true) + " to Winners Gem?");
  } else {
    $("#modal-warning .message").html("Are you sure you want to convert " + numberFormat(amount, true) + " Winners Gem to Peso?<br>This will cost a total of " + numberFormat(amount * 1.02, true) + " Winners Gem.");
  }
  $("#modal-warning .proceed").attr("id", "convert");
  $("#modal-convert").modal("hide");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#convert", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var type = $(".convert-tab.active").data("type");
  var amount = parseFloat($("#convert-" + type + "-amount").val());
  $.ajax({
    method: "POST",
    url: $("#submit-conversion-route").val(),
    data: {
      type: type,
      amount: amount,
      winners_gem_value: winnersGemValue
    },
    timeout: 30000
  }).done(function (response) {
    if (response.type && response.type === "winners-gem-update") {
      winnersGemValue = parseFloat(response.winners_gem_value);
      $("#purchase-winners-gem-amount").val(parseFloat($(this).val() / winnersGemValue).toFixed(2));
      $("#modal-error .message").html("Winners Gem value has just changed. Winners Gem to be purchased was updated.");
      $("#modal-error").modal('show');
    } else {
      $("#winners-gem-balance").html(numberFormat(response.gemBalance, true));
      $("#winners-gem-balance-in-pesos").html(numberFormat(response.gemBalance * winnersGemValue, true));
      $("#peso-balance").html(numberFormat(response.pesoBalance, true));
      $('#modal-success').attr("data-bs-backdrop", "static");
      $('#modal-success').attr("data-bs-keyboard", "false");
      $('#modal-success .proceed').removeAttr("data-bs-dismiss");
      $('#modal-success .proceed').attr("onclick", "window.location = '" + (type === "gem-to-peso" ? "/conversions" : "/conversions/peso-to-gem") + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
      $('#modal-success .message').html("You have successfully converted <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount, true) + " to Winners Gem.");
      $('#modal-success').modal('show');
    }
  }).fail(function () {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("change", "#withdraw-amount", function () {
  var amount = parseFloat($("#withdraw-amount").val());
  $("#withdraw-transaction-fee").html("<i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount * 0.01, true));
  $("#withdraw-total").html("<i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount * 1.01, true));
});
$(document).on("click", "#withdraw-confirm", function () {
  var amount = parseFloat($("#withdraw-amount").val());
  $("#modal-warning .message").html("Are you sure you want to withdraw <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount, true) + "?<br>Transaction fee costs <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount * 0.01, true) + ".");
  $("#modal-warning .proceed").attr("id", "withdraw");
  $("#modal-withdraw").modal("hide");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#withdraw", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  $.ajax({
    method: "POST",
    url: "api/withdraw.php",
    data: {
      amount: parseFloat($("#withdraw-amount").val())
    },
    timeout: 30000
  }).done(function (response) {
    $('#modal-success').attr("data-bs-backdrop", "static");
    $('#modal-success').attr("data-bs-keyboard", "false");
    $('#modal-success .proceed').removeAttr("data-bs-dismiss");
    $('#modal-success .proceed').attr("onclick", "window.location = 'withdrawals'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
    $('#modal-success .message').html("Withdrawal request has been successfully submitted");
    $('#modal-success').modal('show');
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("click", "#contribute-to-pool-share-confirm", function () {
  var amount = parseFloat($("#pool-share-contribution-amount").val());
  $("#modal-warning .message").html("Are you sure you want to contribute <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount, true) + " to Pool Share?");
  $("#modal-warning .proceed").attr("id", "contribute-to-pool-share");
  $("#modal-pool-share-contribute").modal("hide");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#contribute-to-pool-share", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var amount = parseFloat($("#pool-share-contribution-amount").val());
  $.ajax({
    method: "POST",
    url: "api/contribute-to-pool-share.php",
    data: {
      amount: amount
    },
    timeout: 30000
  }).done(function (response) {
    $("#peso-balance").html(numberFormat(response.peso_balance, true));
    $("#pool-share-amount").html(numberFormat(response.pool_share, true));
    $('#modal-success .message').html("You have successfully contributed to pool share. Thank you!");
    $('#modal-success').modal('show');
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("click", ".node-expand", function () {
  selected_node = $(this).val();
  generateGenealogy();
});
$(document).on("click", ".uplines", function () {
  selected_node = $(this).attr("node-id");
  generateGenealogy();
});
$(document).on("change", "#number-of-levels-to-be-shown", function () {
  if ($("#number-of-levels-to-be-shown").val() >= 1) {
    generateGenealogy();
  } else {
    $("#modal-error .message").html("Invalid Input");
    $("#modal-error").modal("show");
  }
});
$(document).on("click", "#change-profile-picture", function (e) {
  e.preventDefault();
  profile_picture_uploader.click();
});
$(document).on("click", "#edit-personal-info-show-fields", function () {
  $("#edit-firstname").prop("disabled", false);
  $("#edit-lastname").prop("disabled", false);
  $("#edit-username").prop("disabled", false);
  $("#edit-email-address").prop("disabled", false);
  $("#edit-contact-number").prop("disabled", false);
  $("#edit-address").prop("disabled", false);
  $("input[name='payout-method']").prop("disabled", false);
  $(".payout-field input").prop("disabled", false);
  $("#edit-personal-info-show-fields").css("display", "none");
  $("#change-password-show-fields").css("display", "none");
  $("#change-pin-code-show-fields").css("display", "none");
  $("#cancel").css("display", "inline-block");
  $("#edit-personal-info").css("display", "inline-block");
});
$(document).on("change", "input[name='payout-method']", function () {
  var method = $("input[name='payout-method']:checked").val();
  $(".payout-field").css("display", "none");
  if (method == "BDO") {
    $(".payout-method-bdo").css("display", "block");
  } else if (method == "Palawan Express") {
    $(".payout-method-palawan-express").css("display", "block");
  } else if (method == "GCash") {
    $(".payout-method-gcash").css("display", "block");
  } else if (method == "Coins.ph") {
    $(".payout-method-coinsph").css("display", "block");
  }
});
$(document).on("click", "#change-password-show-fields", function () {
  $("#password-fields").css("display", "flex");
  $("#password-fields input").val("");
  $("#edit-personal-info-show-fields").css("display", "none");
  $("#change-password-show-fields").css("display", "none");
  $("#change-pin-code-show-fields").css("display", "none");
  $("#cancel").css("display", "inline-block");
  $("#change-password").css("display", "inline-block");
});
$(document).on("click", "#change-pin-code-show-fields", function () {
  $("#pin-code-fields").css("display", "flex");
  $("#pin-code-fields input").val("");
  $("#edit-personal-info-show-fields").css("display", "none");
  $("#change-password-show-fields").css("display", "none");
  $("#change-pin-code-show-fields").css("display", "none");
  $("#cancel").css("display", "inline-block");
  $("#change-pin-code").css("display", "inline-block");
});
$(document).on("click", "#cancel", function () {
  $("#edit-firstname").prop("disabled", true);
  $("#edit-lastname").prop("disabled", true);
  $("#edit-username").prop("disabled", true);
  $("#edit-email-address").prop("disabled", true);
  $("#edit-contact-number").prop("disabled", true);
  $("#edit-address").prop("disabled", true);
  $("#edit-firstname").val($("#edit-firstname").attr("prev-value"));
  $("#edit-lastname").val($("#edit-lastname").attr("prev-value"));
  $("#edit-username").val($("#edit-username").attr("prev-value"));
  $("#edit-email-address").val($("#edit-email-address").attr("prev-value"));
  $("#edit-contact-number").val($("#edit-contact-number").attr("prev-value"));
  $("#edit-address").val($("#edit-address").attr("prev-value"));
  $("input[name='payout-method']").prop("disabled", false);
  $(".payout-field input").prop("disabled", true);
  $("#edit-payout-account-number").val($("#edit-payout-account-number").attr("prev-value"));
  $("#edit-payout-account-name").val($("#edit-payout-account-name").attr("prev-value"));
  $("#edit-payout-name").val($("#edit-payout-name").attr("prev-value"));
  $("#edit-payout-mobile-number").val($("#edit-payout-mobile-number").attr("prev-value"));
  $("#edit-payout-wallet-address").val($("#edit-payout-wallet-address").attr("prev-value"));
  $("#password-fields").css("display", "none");
  $("#pin-code-fields").css("display", "none");
  $("#edit-personal-info-show-fields").css("display", "inline-block");
  $("#change-password-show-fields").css("display", "inline-block");
  $("#change-pin-code-show-fields").css("display", "inline-block");
  $("#cancel").css("display", "none");
  $("#edit-personal-info").css("display", "none");
  $("#change-password").css("display", "none");
});
$(document).on("click", "#edit-personal-info", function () {
  $("#edit-personal-info").prop("disabled", true);
  $("#edit-personal-info").html("Saving Changes...");
  $("#cancel").css("display", "none");
  var firstname = $("#edit-firstname").val();
  var lastname = $("#edit-lastname").val();
  var username = $("#edit-username").val();
  var email_address = $("#edit-email-address").val();
  var contact_number = $("#edit-contact-number").val();
  var address = $("#edit-address").val();
  var payout_method = $("input[name='payout-method']:checked").val();
  var payout_account_number = $("#edit-payout-account-number").val();
  var payout_account_name = $("#edit-payout-account-name").val();
  var payout_name = $("#edit-payout-name").val();
  var payout_mobile_number = $("#edit-payout-mobile-number").val();
  var payout_wallet_address = $("#edit-payout-wallet-address").val();
  $.ajax({
    method: "POST",
    url: "api/edit-personal-info.php",
    data: {
      firstname: firstname,
      lastname: lastname,
      username: username,
      email_address: email_address,
      contact_number: contact_number,
      address: address,
      payout_method: payout_method,
      payout_account_number: payout_account_number,
      payout_account_name: payout_account_name,
      payout_name: payout_name,
      payout_mobile_number: payout_mobile_number,
      payout_wallet_address: payout_wallet_address
    }
  }).done(function (response) {
    $("#edit-firstname").prop("disabled", true);
    $("#edit-lastname").prop("disabled", true);
    $("#edit-username").prop("disabled", true);
    $("#edit-email-address").prop("disabled", true);
    $("#edit-contact-number").prop("disabled", true);
    $("#edit-address").prop("disabled", true);
    $("#edit-firstname").prop("disabled", true);
    $("#edit-lastname").prop("disabled", true);
    $("#edit-username").prop("disabled", true);
    $("#edit-email-address").attr("prev-value", email_address);
    $("#edit-contact-number").attr("prev-value", contact_number);
    $("#edit-address").attr("prev-value", address);
    $("input[name='payout-method']").prop("disabled", false);
    $(".payout-field input").prop("disabled", true);
    $("#edit-payout-account-number").attr("prev-value", payout_account_number);
    $("#edit-payout-account-name").attr("prev-value", payout_account_name);
    $("#edit-payout-name").attr("prev-value", payout_name);
    $("#edit-payout-mobile-number").attr("prev-value", payout_mobile_number);
    $("#edit-payout-wallet-address").attr("prev-value", payout_wallet_address);
    $("#cancel").css("display", "none");
    $("#edit-personal-info").css("display", "none");
    $("#edit-personal-info-show-fields").css("display", "inline-block");
    $("#change-password-show-fields").css("display", "inline-block");
    $("#change-pin-code-show-fields").css("display", "inline-block");
    $('#modal-success .message').html("Saving Changes Successful");
    $("#modal-success").modal("show");
  }).fail(function (error) {
    $("#cancel").css("display", "inline-block");
    showErrorFromAjax(error);
  }).always(function () {
    $("#edit-personal-info").html("Save Changes");
    $("#edit-personal-info").prop("disabled", false);
  });
});
$(document).on("click", "#change-password", function () {
  $("#change-password").prop("disabled", true);
  $("#change-password").html("Saving Changes...");
  $("#cancel").css("display", "none");
  var current_password = $("#edit-current-password").val();
  var new_password = $("#edit-new-password").val();
  var confirm_password = $("#edit-confirm-password").val();
  $.ajax({
    method: "POST",
    url: "api/change-password.php",
    data: {
      current_password: current_password,
      new_password: new_password,
      confirm_password: confirm_password
    }
  }).done(function (response) {
    $("#password-fields").css("display", "none");
    $("#edit-current-password").val("");
    $("#edit-new-password").val("");
    $("#edit-confirm-password").val("");
    $("#cancel").css("display", "none");
    $("#change-password").css("display", "none");
    $("#edit-personal-info-show-fields").css("display", "inline-block");
    $("#change-password-show-fields").css("display", "inline-block");
    $("#change-pin-code-show-fields").css("display", "inline-block");
    $('#modal-success .message').html("Saving Changes Successful");
    $("#modal-success").modal("show");
  }).fail(function (error) {
    $("#cancel").css("display", "inline-block");
    showErrorFromAjax(error);
  }).always(function () {
    $("#change-password").html("Save Changes");
    $("#change-password").prop("disabled", false);
  });
});
$(document).on("click", "#change-pin-code", function () {
  $("#change-pin-code").prop("disabled", true);
  $("#change-pin-code").html("Saving Changes...");
  $("#cancel").css("display", "none");
  var current_pin_code = $("#edit-current-pin-code").val();
  var new_pin_code = $("#edit-new-pin-code").val();
  var confirm_pin_code = $("#edit-confirm-pin-code").val();
  $.ajax({
    method: "POST",
    url: "api/change-pin-code.php",
    data: {
      current_pin_code: current_pin_code,
      new_pin_code: new_pin_code,
      confirm_pin_code: confirm_pin_code
    }
  }).done(function (response) {
    $("#pin-code-fields").css("display", "none");
    $("#edit-current-pin-code-fields").val("");
    $("#edit-new-pin-code-fields").val("");
    $("#edit-confirm-pin-code-fields").val("");
    $("#cancel").css("display", "none");
    $("#change-pin-code").css("display", "none");
    $("#edit-personal-info-show-fields").css("display", "inline-block");
    $("#change-password-show-fields").css("display", "inline-block");
    $("#change-pin-code-show-fields").css("display", "inline-block");
    $('#modal-success .message').html("Saving Changes Successful");
    $("#modal-success").modal("show");
  }).fail(function (error) {
    $("#cancel").css("display", "inline-block");
    showErrorFromAjax(error);
  }).always(function () {
    $("#change-pin-code").html("Save Changes");
    $("#change-pin-code").prop("disabled", false);
  });
});
$(document).on("click", ".view-payout-information", function () {
  var payout_information = JSON.parse($(this).find("span").html());
  var content = '	<table class="table table-bordered mb-0">';
  content += '		<tbody>';
  content += '			<tr>';
  content += '				<th style="background-color:#fafafa; text-align:right">Method</th>';
  content += '				<td style="text-align:left">' + payout_information.method + '</td>';
  content += '			</tr>';
  if (payout_information.method == "BDO") {
    content += '		<tr>';
    content += '			<th style="background-color:#fafafa; text-align:right">Account Number</th>';
    content += '			<td style="text-align:left">' + payout_information.account_number + '</td>';
    content += '		</tr>';
    content += '		<tr>';
    content += '			<th style="background-color:#fafafa; text-align:right">Account Name</th>';
    content += '			<td style="text-align:left">' + payout_information.account_name + '</td>';
    content += '		</tr>';
  } else if (payout_information.method == "Palawan Express") {
    content += '		<tr>';
    content += '			<th style="background-color:#fafafa; text-align:right">Name</th>';
    content += '			<td style="text-align:left">' + payout_information.name + '</td>';
    content += '		</tr>';
    content += '		<tr>';
    content += '			<th style="background-color:#fafafa; text-align:right">Mobile Number</th>';
    content += '			<td style="text-align:left">' + payout_information.mobile_number + '</td>';
    content += '		</tr>';
  } else if (payout_information.method == "GCash") {
    content += '			<tr>';
    content += '				<th style="background-color:#fafafa; text-align:right">Mobile Number</th>';
    content += '				<td style="text-align:left">' + payout_information.mobile_number + '</td>';
    content += '			</tr>';
  } else if (payout_information.method == "Coins.ph") {
    content += '		<tr>';
    content += '			<th style="background-color:#fafafa; text-align:right">Wallet Address</th>';
    content += '			<td style="text-align:left">' + payout_information.wallet_address + '</td>';
    content += '		</tr>';
  }
  content += '		</tbody>';
  content += '	</table>';
  $("#payout-information-container").html(content);
  $("#modal-payout-information").modal("show");
});
$(document).on("click", ".update-proof-of-payment", function () {
  $("#modal-proof-of-payment-update").modal("show");
  $("#proof-of-payment-container").html('<h6 class="text-center">Loading...</h6>');
  $("#update-proof-of-payment-confirm").val($(this).val());
  var proof_of_payments = JSON.parse($(this).find("span").html());
  var content = '';
  var i = 0;
  var load_image = function load_image() {
    var img = new Image();
    img.onload = function () {
      var height = img.height;
      var width = img.width;
      content += '	<div class="col-6 px-1" style="margin-bottom:10px">';
      content += '		<a href="' + img.src + '" data-fancybox="images" data-caption="Proof of Payment">';
      content += '			<div class="proof-of-payment" data-image="' + img.src + '" data-has-image="1" data-extension="' + img.src.split('.').pop().toLowerCase() + '" style="width:100%; height:154px; background-color:#eeeeee; border:2px solid #0e4d22; position:relative; cursor:pointer">';
      content += '				<div class="background-image-contain" style="position:relative; width:100%; height:100%; padding-top:150px; overflow:hidden; background-image:url(\'' + img.src + '\')"></div>';
      content += '			</div>';
      content += '		</a>';
      content += '	</div>';
      if (i == proof_of_payments.length - 1) {
        content += $("#proof-of-payment-content").html();
        $("#proof-of-payment-container").html(content);
      } else {
        load_image(proof_of_payments[++i]);
      }
    };
    img.src = proof_of_payments[i];
  };
  if (proof_of_payments.length > 0) {
    load_image(proof_of_payments[i]);
  } else {
    $("#proof-of-payment-container").html($("#proof-of-payment-content").html());
  }
});
$(document).on("click", "#update-proof-of-payment-confirm", function () {
  $("#modal-warning .message").html("Are you sure you want to save changes?");
  $("#modal-warning .proceed").attr("id", "update-proof-of-payment");
  $("#modal-warning .proceed").val($(this).val());
  $("#modal-proof-of-payment-update").modal("hide");
  $("#modal-warning").modal("show");
});
$(document).on("click", "#update-proof-of-payment", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var id = $(this).val();
  var proof_of_payments = [];
  $("#proof-of-payment-container .proof-of-payment[data-has-image='1']").each(function () {
    proof_of_payments.push({
      image: $(this).attr("data-image"),
      extension: $(this).attr("data-extension")
    });
  });
  $.ajax({
    method: "POST",
    url: $("#update-proof-of-payment").val(),
    data: {
      id: id,
      proof_of_payments: JSON.stringify(proof_of_payments)
    },
    timeout: 30000
  }).done(function (response) {
    $(".update-proof-of-payment[value='" + id + "'] span").html(response.proof_of_payment);
    $('#modal-success .message').html("Saving changes successful.");
    $('#modal-success').modal('show');
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("click", ".terminal-view-items", function () {
  $(".order-reference").html($(this).attr("data-reference"));
  $("#ordered-items-container").html('<h6 class="text-center">Loading...</h6>');
  $("#modal-view-order-items").modal('show');
  var order_id = $(this).val();
  $.ajax({
    method: "POST",
    url: "admin/api/view-items.php",
    data: {
      order_id: order_id
    },
    timeout: 30000
  }).done(function (response) {
    var content = '	<table class="table table-bordered mb-0">';
    content += '		<thead>';
    content += '			<tr>';
    content += '				<th></th>';
    content += '				<th>Item</th>';
    content += '				<th>Quantity</th>';
    content += '				<th>Amount</th>';
    content += '			</tr>';
    content += '		</thead>';
    content += '		<tbody>';
    for (var i = 0; i < response.items.length; i++) {
      content += '		<tr>';
      content += '			<td style="width:80px">';
      content += '				<div style="position:relative; width:100%; padding-top:100%; overflow:hidden; border:1px solid #eeeeee">';
      content += '					<img src="' + response.items[i].photo + '?v=' + response.items[i].version + '" style="' + (response.items[i].longestDimension == "width" ? 'width:100%; height:auto;' : 'width:auto; height:100%;') + 'max-height:100%; max-width:100%; margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" alt="' + response.items[i].name + '">';
      content += '				</div>';
      content += '			</td>';
      content += '			<td>' + response.items[i].name + '</td>';
      content += '			<td>' + response.items[i].quantity + '</td>';
      content += '			<td>' + numberFormat(response.items[i].quantity * response.items[i].price, true) + ' <span style="font-size:0.8em">Gems</span></td>';
      content += '		</tr>';
    }
    content += '		</tbody>';
    content += '	</table>';
    $("#ordered-items-container").html(content);
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $("#modal-warning").modal('hide');
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
  });
});
$(document).on("click", ".terminal-view-shipment", function () {
  $(".order-reference").html($(this).data("reference"));
  $("#shipment-full-name").html($(this).data("full-name") != "" ? $(this).data("full-name") : '<span style="font-style:italic">Empty</span>');
  $("#shipment-contact-number").html($(this).data("contact-number") != "" ? $(this).data("contact-number") : '<span style="font-style:italic">Empty</span>');
  $("#shipment-barangay").html($(this).data("barangay") != "" ? $(this).data("barangay") : '<span style="font-style:italic">Empty</span>');
  $("#shipment-city").html($(this).data("city") != "" ? $(this).data("city") : '<span style="font-style:italic">Empty</span>');
  $("#shipment-province").html($(this).data("province") != "" ? $(this).data("province") : '<span style="font-style:italic">Empty</span>');
  $("#shipment-zip-code").html($(this).data("zip-code") != "" ? $(this).data("zip-code") : '<span style="font-style:italic">Empty</span>');
  $("#modal-view-shipment").modal('show');
});
$(document).on("click", ".mark-order-as-complete-confirm", function () {
  $("#modal-warning .message").html("Are you sure you want to mark Order " + $(this).data("reference") + " as complete?");
  $("#modal-warning .proceed").val($(this).val());
  $("#modal-warning .proceed").attr("id", "mark-order-as-complete");
  $('#modal-warning').modal('show');
});
$(document).on("click", "#mark-order-as-complete", function () {
  $("#modal-warning .proceed").prop("disabled", true);
  $("#modal-warning .proceed").html("Processing...");
  $("#modal-warning button[data-bs-dismiss='modal']").css("display", "none");
  var id = $(this).val();
  $.ajax({
    method: "POST",
    url: "admin/api/mark-order-as-complete.php",
    timeout: 30000,
    data: {
      id: id,
      user: 2
    }
  }).done(function (response) {
    $("#terminal-winners-gem").html(numberFormat(response.terminal_winners_gem.balance, true));
    var content = '	<table class="table table-bordered data-table" style="display:none">';
    content += '		<thead>';
    content += '			<tr style="background-color:#f9f9f9">';
    content += '				<th></th>';
    content += '				<th>Date&nbsp;&amp; Time Placed</th>';
    content += '				<th>Type</th>';
    content += '				<th>Reference</th>';
    content += '				<th>Account</th>';
    content += '				<th>Price</th>';
    content += '				<th>Points</th>';
    content += '			</tr>';
    content += '		</thead>';
    content += '		<tbody>';
    response.orders.forEach(function (order) {
      if (!order.date_time_completed) {
        content += '	<tr>';
        content += '		<td>';
        content += '			<button class="btn btn-success btn-sm mt-1 terminal-view-items" value="' + order.id + '" data-reference="' + order.reference + '" style="background-color:#0e4d22; color:#ffffff">Items</button>';
        content += '			<button class="btn btn-success btn-sm mt-1 terminal-view-shipment" data-reference="' + order.reference + '" data-full-name="' + order.full_name + '" data-contact-number="' + order.contact_number + '" data-barangay="' + order.barangay + '" data-city="' + order.city + '" data-province="' + order.province + '" data-zip-code="' + order.zip_code + '" style="background-color:#0e4d22; color:#ffffff">Shipment</button>';
        content += '			<button class="btn btn-success btn-sm mt-1 mark-order-as-complete-confirm" value="' + order.id + '" data-reference="' + order.reference + '" style="background-color:#0e4d22; color:#ffffff">Mark as Complete</button>';
        content += '		</td>';
        content += '		<td>' + order.date_time_placed + '</td>';
        content += '		<td>' + (order.type == 1 ? "Package" : "Product") + '</td>';
        content += '		<td>' + order.reference + '</td>';
        content += '		<td>' + order.name + '</td>';
        content += '		<td>' + numberFormat(order.price, true) + ' <i class="fas fa-gem" style="font-size:0.8em"></i></td>';
        content += '		<td>' + numberFormat(order.points_value, true) + ' PV</td>';
        content += '	</tr>';
      }
    });
    content += '		</tbody>';
    content += '	</table>';
    $("#pending .table-responsive").html(content);
    content = '		<table class="table table-bordered data-table" style="display:none">';
    content += '		<thead>';
    content += '			<tr style="background-color:#f9f9f9">';
    content += '				<th></th>';
    content += '				<th>Date&nbsp;&amp; Time Placed</th>';
    content += '				<th>Date&nbsp;&amp; Time Completed</th>';
    content += '				<th>Type</th>';
    content += '				<th>Reference</th>';
    content += '				<th>Account</th>';
    content += '				<th>Price</th>';
    content += '				<th>Points</th>';
    content += '			</tr>';
    content += '		</thead>';
    content += '		<tbody>';
    response.orders.forEach(function (order) {
      if (order.date_time_completed) {
        content += '	<tr>';
        content += '		<td>';
        content += '			<button class="btn btn-success btn-sm mt-1 terminal-view-items" value="' + order.id + '" data-reference="' + order.reference + '" style="background-color:#0e4d22; color:#ffffff">Items</button>';
        content += '			<button class="btn btn-success btn-sm mt-1 terminal-view-shipment" data-reference="' + order.reference + '" data-full-name="' + order.full_name + '" data-contact-number="' + order.contact_number + '" data-barangay="' + order.barangay + '" data-city="' + order.city + '" data-province="' + order.province + '" data-zip-code="' + order.zip_code + '" style="background-color:#0e4d22; color:#ffffff">Shipment</button>';
        content += '		</td>';
        content += '		<td>' + order.date_time_placed + '</td>';
        content += '		<td>' + order.date_time_completed + '</td>';
        content += '		<td>' + (order.type == 1 ? "Package" : "Product") + '</td>';
        content += '		<td>' + order.reference + '</td>';
        content += '		<td>' + order.name + '</td>';
        content += '		<td>' + numberFormat(order.price, true) + ' <i class="fas fa-gem" style="font-size:0.8em"></i></td>';
        content += '		<td>' + numberFormat(order.points_value, true) + ' PV</td>';
        content += '	</tr>';
      }
    });
    content += '		</tbody>';
    content += '	</table>';
    $("#completed .table-responsive").html(content);
    $(".data-table").DataTable({
      "aaSorting": []
    });
    $(".data-table").css("display", "table");
    $('#modal-success .message').html("Order has been successfully completed.");
    $('#modal-success').modal('show');
  }).fail(function (error) {
    showErrorFromAjax(error);
  }).always(function () {
    $('#modal-warning').modal('hide');
    $("#modal-warning button[data-bs-dismiss='modal']").css("display", "block");
    $("#modal-warning .proceed").html("Confirm");
    $("#modal-warning .proceed").prop("disabled", false);
  });
});
$(document).on("click", "#minimize-side-nav", function () {
  if ($(".profile-pic-lg").hasClass("d-none")) {
    $(".profile-pic-lg").removeClass("d-none");
    $(".profile-pic-sm").addClass("d-none");
  } else {
    $(".profile-pic-sm").removeClass("d-none");
    $(".profile-pic-lg").addClass("d-none");
  }
});
/******/ })()
;