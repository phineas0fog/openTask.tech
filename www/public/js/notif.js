window.addEventListener('load', function () {
  Notification.requestPermission(function (status) {
    if (Notification.permission !== status) {
      Notification.permission = status;
    }
  });
});

function notify(text){
    var n = new Notification(text);
    n.onshow = function () {
      setTimeout(n.close.bind(n), 5000);
  };
}
