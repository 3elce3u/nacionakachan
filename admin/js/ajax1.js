$(document).ready(function(){
    
    $.ajax({
        type: "POST",
        url: "ajax/generos.php",
        success: function (respue) {
            var resss=JSON.parse(respue);
            let temm='';
            var i=0;
            var clas='dento_boton';
            resss.forEach(gen => {
                
                temm=`<div class='boton' id='`+gen.genero_id+`' style='width:163px;' onclick='cazargenero(`+gen.genero_id+`, "genero" ,1);' >
                <input type='button' id='geo`+gen.genero_id+`' class='dento_boton'  value='`+gen.genero+`'>
                </div>`;
                    $('#filtro').append(temm);
                i++
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/noticias.php",
        success: function (respons) {
            $('#noticias').html(respons);
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/nuevos_volumenes.php",
        success: function (response) {
            var res=JSON.parse(response);
            let templa='';
            var i=0;
            res.forEach(volu => {
                templa=`<form method='get' action='novela.php' id='ese${i}'>
                            <input type='hidden' name='novela_id' id='novela_id${i}' value='${volu.novela_id}'>
                            <input type='hidden' name='novela_nombre' id='novela_nombre${i}' value='${volu.novela_nombre}'>
                            <div class='cont' onClick='\$("#ese${i}").submit()'>
                                <div class='ima'>
                                    <img id='img' src='../${volu.volumen_miniatura}' alt='${volu.alt}'>
                                </div>
                                <div class='fec' id='fec${i}'>
                                    ${volu.volumen}<br>${volu.fecha}
                                </div>
                                <div class='gen' id='gen${i}'>
                                    ${volu.generos}
                                </div>
                                <div class='nom' id='nom${i}'>
                                    ${volu.novela_nombre}
                                </div>
                            </div>
                        </form>`;
                        $('#nue_vol').append(templa);
                i++
            });
        }
    });
    $.ajax({
        type: "POST",
        url: "ajax/nuevas_novelas.php",
        success: function (resp) {
            var ress=JSON.parse(resp);
            let templat='';
            var i=0;
            ress.forEach(nov => {
                templat=`<form method='get' action='novela.php' id='este${i}'>
                            <input type='hidden' name='novela_id' id='novela_id${i}' value='${nov.novela_id}'>
                            <input type='hidden' name='novela_nombre' id='novela_nombre${i}' value='${nov.novela_nombre}'>
                            <div class='cont' onClick='\$("#este${i}").submit()'>
                                <div class='ima'>
                                    <img id='img' src='../${nov.novela_miniatura}' alt='${nov.alt}'>
                                </div>
                                <div class='fec' id='fec${i}'>
                                    ${nov.fecha}
                                </div>
                                <div class='gen' id='gen${i}'>
                                    ${nov.generos}
                                </div>
                                <div class='nom' id='nom${i}'>
                                    ${nov.novela_nombre}
                                </div>
                            </div>
                        </form>`;
                        $('#nue_nov').append(templat);
                i++
            });
        }
    });
    $.ajax({
        type: "POST",
        url: "ajax/top_descargas.php",
        success: function (respu) {
            var ress=JSON.parse(respu);
            let tem='';
            var i=0;
            ress.forEach(top => {
                tem=`<form method='get' action='novela.php' id='oter${i}'>
                            <input type='hidden' name='novela_id' id='novela_id${i}' value='${top.novela_id}'>
                            <input type='hidden' name='novela_nombre' id='novela_nombre${i}' value='${top.novela_nombre}'>
                            <div class='cont' onClick='\$("#oter${i}").submit()'>
                                <div class='ima'>
                                    <img id='img' src='../${top.novela_miniatura}' alt='${top.alt}'>
                                </div>
                                <div class='fec' id='fec${i}'>
                                    ${top.descargas}
                                </div>
                                <div class='gen' id='gen${i}'>
                                    ${top.generos}
                                </div>
                                <div class='nom' id='nom${i}'>
                                    ${top.novela_nombre}
                                </div>
                            </div>
                        </form>`;
                        $('#top_des').append(tem);
                i++
            });
        }
    });
});
