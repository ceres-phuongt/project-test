/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./packages/frontends/theme/resources/assets/js/cart.js ***!
  \**************************************************************/
(function ($) {
  "use strict";

  $(document).ready(function () {
    loadAjaxCart();
    $('.add-to-cart').click(function (e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var carId = $(this).closest('.product-detail').find('.car-id').val();
      var quantity = $(this).closest('.product-detail').find('.quantity-input').val();
      $.ajax({
        url: '/addToCart',
        method: 'POST',
        data: {
          'quantity': quantity,
          'carId': carId
        },
        success: function success(response) {
          toastr.success(response['status'], 'Message', {
            timeOut: 3000,
            progressBar: true,
            positionClass: "toast-bottom-right"
          });
          loadAjaxCart();
        }
      });
    });
    $('#cart-content .cart-item .btn-plus').on('click', function (e) {
      e.preventDefault();
      var incrementValue = $(this).parents('.cart-item').find('.quantity-input').val();
      var value = parseInt(incrementValue, 10);
      value = isNaN(value) ? 0 : value;
      value++;
      $(this).parents('.cart-item').find('.quantity-input').val(value);
    });
    $('#cart-content .cart-item .btn-minus').on('click', function (e) {
      e.preventDefault();
      var decrementValue = $(this).parents('.cart-item').find('.quantity-input').val();
      var value = parseInt(decrementValue, 10);
      value = isNaN(value) ? 0 : value;

      if (value > 1) {
        value--;
        $(this).parents('.cart-item').find('.quantity-input').val(value);
      }
    });
    $('#cart-content .cart-item .quantity-input').on('change', function (e) {
      e.preventDefault();
      updateCart();
    });
  });

  function loadAjaxCart() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/loadAjaxCart',
      method: 'GET',
      success: function success(response) {
        var value = jQuery.parseJSON(response);
        var total = value['totalCart'];
        $('.cart-icon .count').text(total);
      }
    });
  }

  function updateCart() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var quantity = $(this).closest(".cart-item").find('.quantity').val();
    var carId = $(this).closest(".cart-item").find('.car-id').val();
    var data = {
      'quantity': quantity,
      'carId': carId
    };
    $.ajax({
      url: '/updateCart',
      type: 'POST',
      data: data,
      success: function success(response) {
        var value = jQuery.parseJSON(response);
        var html = value['html'];
        $('#cart-content').html(html);
      }
    });
  }
})(jQuery);
/******/ })()
;