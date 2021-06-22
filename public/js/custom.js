const showToast = function(message, success) {
  myToast = $.toast({
    text: message,
    position: 'bottom-right',
    icon: success,
    allowToastClose: true,
    stack: false,
    hideAfter: success == 'error' ? false : 3000
  })
};
