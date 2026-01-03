// Helper function to make AJAX calls and return the response
function fetchNotificationData(url) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: url,
      method: "POST",
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        resolve(respuesta); // Resolve with the raw response string
      },
      error: function (jqXHR, textStatus, errorThrown) {
        reject({ jqXHR, textStatus, errorThrown });
      },
    });
  });
}
