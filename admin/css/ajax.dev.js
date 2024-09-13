"use strict";

$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "ajax/generos.php",
    success: function success(respue) {
      var resss = JSON.parse(respue);
      var temm = '';
      var i = 0;
      var clas = 'dento_boton';
      resss.forEach(function (gen) {
        temm = "<div class='boton' id='" + gen.genero_id + "' style='width:163px;' onclick='cazargenero(" + gen.genero_id + ", \"genero\" ,1);' >\n                <input type='button' id='geo" + gen.genero_id + "' class='dento_boton'  value='" + gen.genero + "'>\n                </div>";
        $('#filtro').append(temm);
        i++;
      });
    }
  });
  $.ajax({
    type: "POST",
    url: "ajax/noticias.php",
    success: function success(respons) {
      $('#noticias').html(respons);
    }
  });
  $.ajax({
    type: "POST",
    url: "ajax/nuevos_volumenes.php",
    success: function success(response) {
      var res = JSON.parse(response);
      var templa = '';
      var i = 0;
      res.forEach(function (volu) {
        templa = "<form method='get' action='novela.php' id='ese".concat(i, "'>\n                            <input type='hidden' name='novela_id' id='novela_id").concat(i, "' value='").concat(volu.novela_id, "'>\n                            <input type='hidden' name='novela_nombre' id='novela_nombre").concat(i, "' value='").concat(volu.novela_nombre, "'>\n                            <div class='cont' onClick='$(\"#ese").concat(i, "\").submit()'>\n                                <div class='ima'>\n                                    <img id='img' src='../").concat(volu.volumen_miniatura, "' alt='").concat(volu.alt, "'>\n                                </div>\n                                <div class='fec' id='fec").concat(i, "'>\n                                    ").concat(volu.volumen, "<br>").concat(volu.fecha, "\n                                </div>\n                                <div class='gen' id='gen").concat(i, "'>\n                                    ").concat(volu.generos, "\n                                </div>\n                                <div class='nom' id='nom").concat(i, "'>\n                                    ").concat(volu.novela_nombre, "\n                                </div>\n                            </div>\n                        </form>");
        $('#nue_vol').append(templa);
        i++;
      });
    }
  });
  $.ajax({
    type: "POST",
    url: "ajax/nuevas_novelas.php",
    success: function success(resp) {
      var ress = JSON.parse(resp);
      var templat = '';
      var i = 0;
      ress.forEach(function (nov) {
        templat = "<form method='get' action='novela.php' id='este".concat(i, "'>\n                            <input type='hidden' name='novela_id' id='novela_id").concat(i, "' value='").concat(nov.novela_id, "'>\n                            <input type='hidden' name='novela_nombre' id='novela_nombre").concat(i, "' value='").concat(nov.novela_nombre, "'>\n                            <div class='cont' onClick='$(\"#este").concat(i, "\").submit()'>\n                                <div class='ima'>\n                                    <img id='img' src='../").concat(nov.novela_miniatura, "' alt='").concat(nov.alt, "'>\n                                </div>\n                                <div class='fec' id='fec").concat(i, "'>\n                                    ").concat(nov.fecha, "\n                                </div>\n                                <div class='gen' id='gen").concat(i, "'>\n                                    ").concat(nov.generos, "\n                                </div>\n                                <div class='nom' id='nom").concat(i, "'>\n                                    ").concat(nov.novela_nombre, "\n                                </div>\n                            </div>\n                        </form>");
        $('#nue_nov').append(templat);
        i++;
      });
    }
  });
  $.ajax({
    type: "POST",
    url: "ajax/top_descargas.php",
    success: function success(respu) {
      var ress = JSON.parse(respu);
      var tem = '';
      var i = 0;
      ress.forEach(function (top) {
        tem = "<form method='get' action='novela.php' id='oter".concat(i, "'>\n                            <input type='hidden' name='novela_id' id='novela_id").concat(i, "' value='").concat(top.novela_id, "'>\n                            <input type='hidden' name='novela_nombre' id='novela_nombre").concat(i, "' value='").concat(top.novela_nombre, "'>\n                            <div class='cont' onClick='$(\"#oter").concat(i, "\").submit()'>\n                                <div class='ima'>\n                                    <img id='img' src='../").concat(top.novela_miniatura, "' alt='").concat(top.alt, "'>\n                                </div>\n                                <div class='fec' id='fec").concat(i, "'>\n                                    ").concat(top.descargas, "\n                                </div>\n                                <div class='gen' id='gen").concat(i, "'>\n                                    ").concat(top.generos, "\n                                </div>\n                                <div class='nom' id='nom").concat(i, "'>\n                                    ").concat(top.novela_nombre, "\n                                </div>\n                            </div>\n                        </form>");
        $('#top_des').append(tem);
        i++;
      });
    }
  });
});