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
    $('#cart-content .cart-item .quantity-input').on('change', function (e) {
      e.preventDefault();
      var quantity = $(this).closest(".cart-item").find('.quantity-input').val();
      var carId = $(this).closest(".cart-item").find('.car-id').val();
      var data = {
        'quantity': quantity,
        'carId': carId
      };
      updateCart(data);
    });
    $('#cart-content .cart-item .btn-remove').on('click', function (e) {
      e.preventDefault();
      var carId = $(this).closest(".cart-item").find('.car-id').val();
      var data = {
        'carId': carId
      };
      removeFromCart(data);
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

  function updateCart(data) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/updateCart',
      type: 'POST',
      data: data,
      success: function success(response) {
        // let html = response.html;
        // $('#cart-content').html(html);
        // toastr.success('Update cart success', 'Message', { timeOut: 3000, progressBar: true, positionClass: "toast-bottom-right" });
        window.location.reload();
      }
    });
  }

  function removeFromCart(data) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/removeFromCart',
      type: 'POST',
      data: data,
      success: function success(response) {
        var html = response.html;
        $('#cart-content').html(html);
        toastr.success('Remove item from cart success', 'Message', {
          timeOut: 3000,
          progressBar: true,
          positionClass: "toast-bottom-right"
        }); // window.location.reload();
      }
    });
  }
})(jQuery);
/******/ })()
;