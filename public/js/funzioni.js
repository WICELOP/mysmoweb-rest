/*file js per il posizionamento delle funzioni globali*/

$(document).ready(
  function logOut() {
    $("#bt2").click(function () {
      alert("Ti sei disconnesso!");

      document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
      var url = $("#url").val();
      window.open( url, "_self");
    });
  }
);
