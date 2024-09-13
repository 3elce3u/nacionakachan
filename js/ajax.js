    function negrita()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[b]' + seleccionado + '[/b]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function italica()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[i]' + seleccionado + '[/i]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function subrayado()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[u]' + seleccionado + '[/u]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function tachado()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[t]' + seleccionado + '[/t]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function enlace()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[link=dirección]' + seleccionado + '[/link]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio+6, inicio+15, "none");
    }
    function spoiler()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[spoiler]' + seleccionado + '[/spoiler]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+19, "none");
    }
    function cita()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[quote=nombre del citado]' + seleccionado + '[/quote]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio+7, inicio+24, "none");
    }
    function XD()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " XD " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function XP()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " XP " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function feliz()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " :) " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function guino()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " ;) " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function triste()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " :( " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function contento()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " :D " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function llorar()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " T.T " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function desaprobacion()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " ¬¬ " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function frustracion()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " ]~[ " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function durmiendo()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " zzz " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function insulto()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " #$!& " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function mareo()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " x.x " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function corazon()
    {
        var textarea = document.getElementById('comentario');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " [3 " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }


    function negrita2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[b]' + seleccionado + '[/b]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function italica2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[i]' + seleccionado + '[/i]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function subrayado2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[u]' + seleccionado + '[/u]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function tachado2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[t]' + seleccionado + '[/t]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+7, "none");
    }
    function enlace2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[link=dirección]' + seleccionado + '[/link]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio+6, inicio+15, "none");
    }
    function spoiler2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[spoiler]' + seleccionado + '[/spoiler]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio, fin+19, "none");
    }
    function cita2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + '[quote=nombre del citado]' + seleccionado + '[/quote]' + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelectionRange(inicio+7, inicio+24, "none");
    }
    function XD2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " XD " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function XP2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " XP " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function feliz2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " :) " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function guino2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " ;) " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function triste2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " :( " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function contento2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " :D " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function llorar2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " T.T " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function desaprobacion2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " ¬¬ " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function frustracion2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " ]~[ " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function durmiendo2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " zzz " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function insulto2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " #$!& " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function mareo2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " x.x " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
    function corazon2()
    {
        var textarea = document.getElementById('comentario2');
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var texto = textarea.value;
        var seleccionado = texto.substring(inicio, fin);
        var nuevoTexto = texto.substring(0, inicio) + seleccionado + " [3 " + texto.substring(fin);
        textarea.value = nuevoTexto;
        textarea.focus();
        textarea.setSelection(fin+4);
    }
            $.ajax({
                type: "POST",
                url: "ajax/generos.php",
                success: function (respue) {
                    var resss=JSON.parse(respue);
                    let uno='';
                    let dos='';
                    var i=0;
                    var clas='dento_boton';
                    resss.forEach(gen => {
                        uno=`<div class='boton' id='`+gen.genero_id+`' style='width:163px;' onclick='cazargenero(`+gen.genero_id+`, "genero" ,1);' >
                        <input type='button' id='geo`+gen.genero_id+`' class='dento_boton'  value='`+gen.genero+`'>
                        </div>`;

                        dos=`<div class='boton' id='h`+gen.genero_id+`' style='width:163px;' onclick='cazargenero(`+gen.genero_id+`, "genero" ,1);' >
                        <input type='button' id='hgeo`+gen.genero_id+`' class='dento_boton'  value='`+gen.genero+`'>
                        </div>`;
                        // Definir una función que comprueba el ancho de la ventana
                        $('#filtro').append(uno);
                        $('#filtroo').append(dos);
                        i++
                    });
                }
            });
    function perfilCargarAvatar()
    {
        var usuario_id=$('#usuario_id').val();
        $.ajax({
            type: "POST",
            url: "ajax/perfilAvatar.php",
            data:{usuario_id},
            success: function (respue) {
                $('#cargarNuevoAvatar').html('<img src="'+respue+'" height="150" width="150">')
            }
        });
    }
    function comentarios(obra_id,video_id){
        $.ajax({
            url:'ajax/comentarios.php',
            type:'POST',
            data:{obra_id,video_id},
            success:function(resu){
                var come=JSON.parse(resu)
                var i=0;
                var usuario_id=$('#usuarioId').val();
                come.forEach(comen => {
                    var margen=comen.margen *35;
                    var temp=`<div class="pre-vieew" style="margin-left:`+margen+`px" id="view`+i+`">
                                <div class="dat-usu" id="dat-usu`+i+`">
                                    <div class="pre-avatar" id="avatar`+i+`">
                                        <img src='`+comen.usuario_avatar+`'>
                                    </div>
                                    <div class="pre-nick" id="nick`+i+`">
                                        `+comen.usuario_nick+`
                                    </div>
                                </div>
                                <div class="pre-coment" id="coment`+i+`">
                                    `+comen.comentario+`<br><br><br><br>
                                    <div class="optcoment" id="optcoment"> 
                                        
                                        <div class="likecoment" id="likecoment">
                                           <img class='imglikes' src='recursos/iconos/like.png' height='25' width='25' onclick='guardarlike(`+comen.comentario_id+`,`+comen.obra_id+`,`+comen.video_id+`)'>  &nbsp;`+comen.likes+`
                                        </div>`;
                                        if(comen.margen<8)
                                        {
                                            temp=temp+`<div class="respcoment" id="respcoment" onclick='mostrarcajacomentarios(`+comen.comentario_id+`,`+comen.obra_id+`,`+comen.video_id+`)'>
                                                Responder
                                            </div>`; 
                                        }
                                        if(usuario_id==comen.usuario_id)
                                        {
                                            temp=temp+`<div class="respcoment" id="respcoment" onclick='editarcomentario(`+comen.comentario_id+`,`+comen.obra_id+`,`+comen.video_id+`);'>
                                                Editar
                                            </div>
                                            <div class="borrar">
                                                <img class='imgbasura' src='recursos/iconos/basura.png' height='25' width='25' onclick='borrarcomentario(`+comen.comentario_id+`,`+comen.obra_id+`,`+comen.video_id+`)'>
                                            </div>`;
                                        }
                            temp=temp+`</div>
                                </div>
                            </div>`;
                    $('#comentarios').append(temp);
                    i=i+1;
                });
                    $('.spoiler-title').click(function() {
                    $(this).next('.spoiler-content').toggle();
                });
            }
        });
    }
    function editarcomentario(comentario_id,obra_id,video_id)
    {
        $.ajax({
            url:'ajax/cercomentario.php',
            type:'post',
            data:{comentario_id,obra_id,video_id},
            success:function(response){
                var res=JSON.parse(response);
                var comentario=res['comentario'];
                $('#comentario2').val(comentario);
               
            }
        })
        $('#control').val('ok');
        if($('#control').val()==='ok') 
        {
            $('#newEdit').css('display','block');
            $('#newComent2').css('display','none');
        } 
        else
        {
            $('#newEdit').css('display','none');
            $('#newComent2').css('display','block');
        }
        $('#comentarfixed').css('display','block');
        $('#comentarioId2').val(comentario_id);
        $('#obraId2').val(obra_id);
        $('#videoId2').val(video_id);
    }
    function borrarcomentario(comentario_id,obra_id,video_id)
    {
        $.ajax({
            type:'POST',
            url:'ajax/borrarcomentario.php',
            data:{comentario_id},
            success:function(response){
                $('#comentarios').empty();
                comentarios(obra_id,video_id)
            }
        });
    }
    function mostrarcajacomentarios(respuesta,obra_id,video_id)
    {
        $('#comentarfixed').css('display','block')
        $('#videoId2').val(video_id);
        $('#obraId2').val(obra_id);
        $('#comentarioId2').val(respuesta);
        $('#comentario2').val("");
        $('#comentario2').empty();
        $('#control').val('');
        if($('#control').val()==='ok') 
        {
            $('#newEdit').css('display','block');
            $('#newComent2').css('display','none');
        } 
        else
        {
            $('#newEdit').css('display','none');
            $('#newComent2').css('display','block');
        }
    }
    function loginn(){
        let te=`<div class="login" id="login">
        <h3>LOGIN</h3>
        <div class="close" onclick="$('#login').css('display','none');$('#login').remove();">x</div>
        <form method="post" action="login.php" class="form-login" id="form-login">
            <br><br><br><br><br><br>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" autocomplete="none" id="log-email">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Contraseña" autocomplete="none" id="log-password">
            <table style="width:100%;margin:0;padding:0;border:none;">
                <tr>
                    <td><input type="submit" class="btn-login" style="height:100%; width:100%;" value="Login" id="log-submit"></td>
                    <td><div class="btn-login" onclick="registroo();">Registro</div></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btn-login" onclick="recpass();">Olvide la pass</div>
                    </td>
                </tr>
            </table>
            <br>
        </form>
    </div>`;
        $('#login').css('display','none');
        $('#new_pass').css('display','none');
        $('#rec_pass').css('display','none');
        $('#registro').css('display','none');
        $('#login').remove();
        $('#registro').remove();
        $('#rec_pass').remove();
        $('#new_pass').remove();
        $('#login').css('display','flex');
        $('#body').append(te)
        $('#form-login').on('submit',function(e){
            let email= $('#log-email').val();
            let password= $('#log-password').val();
            $.ajax({
                type: "post",
                url: "ajax/login.php",
                data: {email,password},
                success: function(response) {
                    let resultado=JSON.parse(response);
                    if(resultado.estado ==="ok")
                    {
                        $('#login').css('display','none');
                        $('#registro').css('display','none');
                        $('#rec_pass').css('display','none');
                        $('#new_pass').css('display','none');
                        $('#login').remove();
                        $('#registro').remove();
                        $('#rec_pass').remove();
                        $('#new_pass').remove();
                        location.reload();
                    }
                    else
                    {
                        $('#mal').css('display','flex');
                        $('#mal-title').html(resultado.titulo);
                        $('#mal-info').html(resultado.info);
                    }
                }
            }); 
            e.preventDefault();
        });
    }
    function recpass(){
        let template=`<div class="rec_pass" id="rec_pass">
        <h3>RECUPERACIÓN</h3>
        <div class="close" onclick="$('#rec_pass').css('display','none');$('#rec_pass').remove();">x</div>
        <form method="post" action="rec_pass.php" class="form-rec_pass" id="form-rec_pass">
            <br><br><br><br><br><br>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" autocomplete="none" id="rec-email">
            <label for="email2">Repite Email</label>
            <input type="email" name="email2" placeholder="Repite Email" autocomplete="none" id="rec-email2">
            <table style="width:100%;margin:0;padding:0;border:none;">
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-rec_pass" style="height:100%; width:100%;" value="confirmar email">
                    </td>
                </tr>
                <tr>
                    <td><div class="btn-rec_pass" onclick="loginn();">Login</div></td>
                    <td><div class="btn-rec_pass" onclick="registroo();">Registro</div></td>
                </tr>   
            </table>
            <br>
        </form>
    </div>`;
    $('#login').css('display','none');
    $('#new_pass').css('display','none');
    $('#rec_pass').css('display','none');
    $('#registro').css('display','none');
    $('#login').remove();
    $('#registro').remove();
    $('#rec_pass').remove();
    $('#new_pass').remove();
    $('#rec_pass').css('display','flex');
    $('#body').append(template);
    $('#form-rec_pass').on('submit',function(e){
        e.preventDefault();
        let email= $('#rec-email').val();
        let email2= $('#rec-email2').val();
        $.ajax({
            type: "post",
            url: "ajax/rec_pass.php",
            data: {email,email2},
            success: function(response) {
                let resultado=JSON.parse(response);
                if(resultado.estado ==="ok")
                {
                    let tit=resultado.titulo;
                    let inf=resultado.info;
                    let ema=resultado.email;
                    let tok=resultado.token
                    $.ajax({ 
                        type: "post",
                        url: "ajax/send.php",
                        data: {ema,tok},
                        success: function(respons) {
                            $('#bien').css('display','flex');
                            $('#bien-title').html(resultado.titulo);
                            $('#bien-info').html(resultado.info);
                            $('#form-rec_pass')[0].reset();
                            $('#login').css('display','none');
                            $('#registro').css('display','none');
                            $('#rec_pass').css('display','none');
                            $('#new_pass').css('display','none');
                            $('#login').remove();
                            $('#registro').remove();
                            $('#rec_pass').remove();
                            $('#new_pass').remove();
                            newpass();
                        }
                    })
                }
                else
                {
                    $('#mal').css('display','flex');
                    $('#mal-title').html(resultado.titulo);
                    $('#mal-info').html(resultado.info);
                }  
            }
        }); 
        
    });
    }
    function newpass(){
        var template=`<div class="new_pass" id="new_pass">
        <h3>Nueva contraseña</h3>
        <div class="close" onclick="$('#new_pass').css('display','none');$('#new_pass').remove();">x</div>
        <form method="post" action="new_pass.php" class="form-new_pass" id="form-new_pass">
            <br><br><br><br><br><br>
            <label for="password">Nueva Pass</label>
            <input type="password" name="password" placeholder="Nueva contraseña" autocomplete="none" id="new-password">
            <label for="password2">Repite Nueva Pass</label>
            <input type="password" name="password2" placeholder="Repite la nueva contraseña" autocomplete="none" id="new-password2">
            <label for="password2">Código</label>
            <input type="text" name="token" placeholder="Código de verificación" autocomplete="none" id="new-verifi">
            <table style="width:100%;margin:0;padding:0;border:none;">
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-new_pass" style="height:100%; width:100%;" value="guardar pass">
                    </td>
                </tr>
                <tr>
                    <td><div class="btn-new_pass" onclick="loginn();">Login</div></td>
                    <td><div class="btn-new_pass" onclick="registroo();">Registro</div></td>
                 </tr>   
            </table>
            <br>
        </form>
    </div>`;
    $('#login').css('display','none');
    $('#new_pass').css('display','none');
    $('#rec_pass').css('display','none');
    $('#registro').css('display','none');
    $('#login').remove();
    $('#registro').remove();
    $('#rec_pass').remove();
    $('#new_pass').remove();
    $('#new_pass').css('display','flex');
    $('#body').append(template)
    $('#form-new_pass').on('submit',function(e){
        let password= $('#new-password').val();
        let password2= $('#new-password2').val();
        let token=$('#new-verifi').val();
        $.ajax({
            type: "post",
            url: "ajax/new_pass.php",
            data: {password,password2,token},
            success: function(response) {
                let resultado=JSON.parse(response);
                if(resultado.estado ==="ok")
                {
                    $('#bien').css('display','flex');
                    $('#bien-title').html(resultado.titulo);
                    $('#bien-info').html(resultado.info);
                    $('#form-new_pass').trigger('reset');
                    $('#login').css('display','none');
                    $('#registro').css('display','none');
                    $('#rec_pass').css('display','none');
                    $('#new_pass').css('display','none');
                    $('#login').remove();
                    $('#registro').remove();
                    $('#rec_pass').remove();
                    $('#new_pass').remove();
                    loginn();
                }
                else
                {
                    $('#mal').css('display','flex');
                    $('#mal-title').html(resultado.titulo);
                    $('#mal-info').html(resultado.info);
                }  
            }
        }); 
        e.preventDefault();
    });
    }
    function registroo(){
        var template=`<div class="registro" id="registro">
        <h3>REGISTRO</h3>
        <div class="close" onclick="$('#registro').css('display','none');$('#registro').remove();">x</div>
        <form method="post" action="registro.php" class="form-registro" id="form-registro">
            <br><br><br><br><br><br>
            <table>
                <tr>
                    <td>
                        <label for="nombre">Nick</label>  
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                    <label for="fecha">Fecha de nacimiento</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nombre" placeholder="Nick" autocomplete="none" id="reg-nombre">
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="date" name="fecha"  autocomplete="none" id="reg-fecha">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>    
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <label for="password">Password</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" placeholder="Email" autocomplete="none" id="reg-email">
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Contraseña" autocomplete="none" id="reg-password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email2">Repite Email</label>    
                    </td>
                    <td>
                         &nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <label for="password2">Repite Password</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email2" placeholder="Repite Email" autocomplete="none" id="reg-email2">
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="password" name="password2" placeholder=" Repite Contraseña" autocomplete="none" id="reg-password2">
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="3">
                    La contraseña debe tener entre 6 y 16 caracteres<br> al menos una letra mayúscula, una minúscula<br> y un número.
                    </td>
                </tr>
                <tr>
                    
                    
                </tr>
            </table>
            <table style="width:50%;margin:0 auto;padding:0;border:none;">
                <tr>
                    <td><input type="submit" class="btn-registro" style="height:100%; width:100%;" value="Registro"></td>
                    <td><div class="btn-registro" onclick="loginn()">Login</div></td>
                </tr>
            </table>
        </form>
    </div>`;
    $('#login').css('display','none');
    $('#new_pass').css('display','none');
    $('#rec_pass').css('display','none');
    $('#registro').css('display','none');
    $('#login').remove();
    $('#registro').remove();
    $('#rec_pass').remove();
    $('#new_pass').remove();
    $('#registro').css('display','flex')
    $('#body').append(template)
    $('#reg-nombre').keyup(function (e) {
        e.preventDefault();
        var nombr= $('#reg-nombre').val();
        $.ajax({
           url:'ajax/comprobarnick.php',
           type:'post',
           data:{nombr},
           success:function(resp){
            var ver=JSON.parse(resp)
               if(ver.estado ==="ok")
               {
                    $('#bien').css('display','flex');
                    $('#bien-title').html(ver.titulo);
                    $('#bien-info').html(ver.info);
               }
               else
               {
                   $('#mal').css('display','flex');
                   $('#mal-title').html(ver.titulo);
                   $('#mal-info').html(ver.info);
               } 
           }
       })
   })
    $('#form-registro').on('submit',function(e){
        let nombre= $('#reg-nombre').val();
        let password= $('#reg-password').val();
        let password2= $('#reg-password2').val();
        let email= $('#reg-email').val();
        let email2= $('#reg-email2').val();
        let fecha= $('#reg-fecha').val();
        $.ajax({
            type: "post",
            url: "ajax/registro.php",
            data: {nombre,email,password,email2,password2,fecha},
            success: function(response) {
                let resultado=JSON.parse(response);
                if(resultado.estado ==="ok")
                {
                    $('#bien').css('display','flex');
                    $('#bien-title').html(resultado.titulo);
                    $('#bien-info').html(resultado.info);
                    $('#form-registro').trigger('reset');
                    $('#login').css('display','none');
                    $('#registro').css('display','none');
                    $('#rec_pass').css('display','none');
                    $('#new_pass').css('display','none');
                    $('#login').remove();
                    $('#registro').remove();
                    $('#rec_pass').remove();
                    $('#new_pass').remove();
                    loginn()
                }
                else
                {
                    $('#mal').css('display','flex');
                    $('#mal-title').html(resultado.titulo);
                    $('#mal-info').html(resultado.info);
                }  
            }
        }); 
        e.preventDefault();
    });
    }
    function guardarlike(comentario_id,obra_id,video_id){
        $.ajax({
            type:'POST',
            url:'ajax/guardarlike.php',
            data:{comentario_id},
            success:function(response){
                $('#comentarios').empty();
                comentarios(obra_id,video_id)
            }
        });
    }
    function paginaa(pagina,filtro,typo)
    {
        $.ajax({
            type: "POST",
            url: "ajax/paginacion.php",
            data:{typo,filtro,pagina},
            success:function(respi){
                
                $('#novelas').append(respi);
            }
        });
    }
    function cazargenero(filtro,typo,pagina)
    {
            var typo=typo;
            var filtro=filtro;
            var pagina=pagina;
            if(typo=="genero")
            {
                if(filtro!="")
                {
                    $('#criterio').css('visibility','visible');
                    $('#criterio').empty();
                    $('#criterio').append('<div class="texto">'+typo+': '+ $('#geo'+filtro+'').val()+'</div>').css('text-transform','uppercase'); 
                    $('#bush')[0].reset();
                    
                }
                if(filtro===0)
                {
                    $('#criterio').css('visibility','hidden');
                    $('#criterio').empty();
                }
            }
            else
            {
                $('#criterio').css('visibility','hidden');
                $('#criterio').empty();
            }
            $('#novelas').empty();
            for(i=0;i<39;i++)
            {
                $('#'+i+'').css('background-color','rgba(0, 0, 0, 0.25)');
                $('#h'+i+'').css('background-color','rgba(0, 0, 0, 0.25)');
            }
            $('#'+filtro+'').css('background-color','rgba(208, 91, 255, 0.3)');
            $('#h'+filtro+'').css('background-color','rgba(208, 91, 255, 0.3)');
            
            $.ajax({
                type: "POST",
                url: "ajax/novelas.php",
                data:{typo,filtro,pagina},
                success:function(resp){
                    respon=JSON.parse(resp);
                    let template='';
                    respon.forEach(respo => {
                        template+=`<form method='GET' action='obra.php' id='no`+respo.obra_id+`'><input type='hidden' name='obra_id' value='`+respo.obra_id+`'>
                        <input type='hidden' name='obra_nombre' value='`+respo.obra_nombre+`'></form>
                        <div class='conta' onclick='$("#no`+respo.obra_id+`").submit();'>
                            <div class='imag'>							
                                <img id='imag' media='screen and (max-width:300px)' style='margin-right: 7px; cursor: pointer;' 
                                    src='`+respo.obra_caratula+`'  alt='`+respo.alt+`' height='320' width='220'>
                            </div>
                            <div class='nomb'>
                                `+respo.obra_nombre+`
                            </div>
                            <div class='nombo'><b style='background-color:`+respo.color+`; margin-top:7px; text-shadow: 1px 1px rgba(0, 0, 0, 1); padding:7px; border-radius:5px; color:white;'>
                                `+respo.tipo+`</b>
                            </div>
                            <div class='genr'>
                                `+respo.obra_generos+`
                            </div>
                            <div class='sin'>
                                `+respo.obra_sinopsis+`
                            </div>
                        </div>`;
                        $('#novelas').empty();
                        $('#novelas').append(template);
                        if(typo=="genero")
                        {
                            for(x=0;x<39;x++)
                            {
                                $('div [name=genn'+x+'').css('background-color','rgba(0, 0, 0, 0.25)');
                            }
                            $('div [name=genn'+filtro+'').css('background-color','rgba(208, 91, 255, 0.3)');
                        }
                    });
                    paginaa(pagina,filtro,typo);  
                }, 
                error: function(e) { 
                }         
            });  
    }
    function obra(obra_id,obra_nombre)
    {
        $.ajax({
            type: "POST",
            url: "ajax/novela.php",
            data: {obra_id,obra_nombre},
            success: function (response) {
                let resp=JSON.parse(response);
                let volu=resp.videos.replace(/`/gi, "'");
                let template=`<div class='principalNovela' style='background-color:`+resp.color+`;'>
                    <div class='caratulaNovela'>`+resp.caratula+`</div>
                    <div class='nombreNovela'>`+resp.obra_nombre+`</div>
                    <div class='nombreOriginalNovela'>`+resp.tipo+`</div>
                    <div class='escritorNovela'>`+resp.estado+`</div>`;
                    if(resp.patrocinador !== undefined || resp.patrocinador !== null)
                    {
                        template+=`<div class='ilustradorNovela'>`+resp.patrocinador+`</div>`;
                    }
                    template+=`<div class='editorialNovela'>`+resp.periodo+`</div>
                    <div class='fansubNovela'>`+resp.fecha+`</div>
                    <div class='generosNovela'>`+resp.generos+`</div>
                    <div class='sinopsisNovela'>`+resp.sinopsis+`</div>
                </div>
                <table style="float:left;">
                    <tr>
                        <td style="margin:0; padding:0px;">
                            <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v16.0" nonce="fHV1byMj">
                                </script>
                            <div class="fb-like" 
                                data-width="55" 
                                data-height="40"
                                data-layout="button_count" 
                                data-action="like" 
                                data-size="small" 
                                data-share="false">
                            </div>
                        </td>
                    </tr>
                </table>
                <table style="float:left;">
                    <tr>
                        <td  style="margin:0; padding:0;">
                            <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v16.0" nonce="uLeM2JZz">
                                </script>
                            <div class="fb-share-button" 
                                data-layout="button_count" 
                                data-width="55"
                                data-height="40" 
                                data-action="share" 
                                data-size="small">
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" 
                                class="fb-xfbml-parse-ignore">Compartir</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <h2 style='margin-top:5px;'>VIDEOS</h2><div style="width:100%; display:flex; flex-wrap:wrap; flex-direction:row; justify-content:center; ">`+volu+`</div>`;
                $('#novela').append(template);
            }
        });
    }
    var vids;
    var index;
    var star;
    var template;
    function video(obra_id,video_id)
    {
    var tiempo;
        $.ajax({
            type: "POST",
            url: "ajax/volumen.php",
            data: {obra_id,video_id},
            success: function (response) {
                let resp=JSON.parse(response);
                if(resp.tipo=="Manga")
                {
                    var color="rgba(0, 191, 255, 0.2)";
                }
                if(resp.tipo=="Manhwa")
                {
                    var color="rgba(0, 250, 154, 0.2)";
                }
                if(resp.tipo=="Manhua")
                {
                    var color="rgba(139, 69, 19, 0.2)";
                }
                template=`<div class="mainVolumen" style="background-color:`+color+`">
                                    
                                    <div class="novnom">
                                        <b>`+resp.tipo+` `+resp.obra_nombre+`</b>
                                    </div>
                                    <div class="numvol" id="numvol"><b>`+resp.video_titulo+`</b></div>
                                    <div class="carvol">
                                        <div class="carvol2">
                                            <iframe src="https://www.youtube.com/embed/`+resp.video_enlace+`" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                                        </div>
                                    </div>
                                    <div class="vidvol" id="vidvol">
                                    </div>
                                    <div class="vfech" id="vfech">
                                    <b>`+resp.video_fecha+`</b>
                                    </div>
                                    <div class="culoo" id="culoo">
                                    </div>`;
                                       
                                   
                $('#volumen').append(template);
                pasar(function(rest){
                    $('#vidvol').append(rest);
                })
                visto(index);
                
            }
        });
    }
    function pasar(callback)
    {
        var obra_id=$('#obraId').val();
        var video_id=$('#videoId').val();
        var obra_nombre=$('#obraNombre').val();
        
        $.ajax({
            type: "POST",
            url: "ajax/pasarvolumen.php",
            data: {video_id,obra_id,obra_nombre},
            success: function (rest) {
                
                callback(rest);
            }
        });
    }
    var player;
    var bar = $('#bar');
    var progressBar = $('#progress-bar');
    var tiempoInicial;
    var corriente;
    function onYouTubeIframeAPIReady(vids,star) {
    // Usar el index para obtener el ID y el título del video
        if(!index)
        {
            index=0;
        }
        if(!star)
        {
            star=0;
        }
        let videoid = vids[index];
        clearInterval(corriente);
        $('#playpause').removeClass('pause'); 
        $('#playpause').addClass('play');
        playing = false;
        player = new YT.Player('player', {
            height: '1',
            width: '1',
            videoId: videoid,
            playerVars: {
                autoplay: 0, // Desactivar la reproducción automática
                start: star || 0 ,
                cc_load_policy:1,
                hl:'es',
                rel:0,
                cc_lang_pref:'es',
                modestbranding: 1,
            },
            events: {
                // Asignamos el evento onStateChange a la función onPlayerStateChange
                onStateChange:  function(event) {onPlayerStateChange(event,vids)},
              },
        });
        var cont=0;
        tiempoInicial=setInterval(function() {
            var percent = Math.floor((100 / player.getDuration()) * player.getCurrentTime());
            $('#progress-bar').css('width', percent + '%');
            var mi=Math.floor(player.getCurrentTime() / 60);
            var sec=Math.floor(player.getCurrentTime()  % 60);
            var hor=Math.floor(mi / 60);
            var min=Math.floor(mi % 60);
            var mimi=Math.floor(player.getDuration() / 60);
            var secsec=Math.floor(player.getDuration()  % 60);
            var horhor=Math.floor(mimi / 60);
            var minmin=Math.floor(mimi % 60);
            document.getElementById('timeri').innerHTML =hor+':'+zfill(min, 2)+':'+zfill(sec, 2)+' / '+horhor+':'+zfill(minmin, 2)+':'+zfill(secsec, 2);
            cont=cont+1;
            if(cont>0)
            {
                clearInterval(tiempoInicial);
            }  
        }, 1000);
    }
    function actualizarbarra() 
    {
        var totalWidth = $('#bar').width();
        var left = $('#bar').offset().left;
        var clickPosition = event.pageX - left;
        var percentage = clickPosition / totalWidth;
        var time = player.getDuration() * percentage;
        player.seekTo(time);
        if(playing == false)
        {
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
            playing = false;
        }
        else
        {
            $('#playpause').removeClass('play'); 
            $('#playpause').addClass('pause');
            playing = true;
        }
    }
    $(document).keydown(function(e) {
        switch(e.which) {
            case 37: // left
            player.seekTo(player.getCurrentTime()-15);
                break;
            case 38: // up
            player.seekTo(player.getCurrentTime()+30);
                break;
            case 39: // right
            player.seekTo(player.getCurrentTime()+15);
                break;
            case 40: // down
            player.seekTo(player.getCurrentTime()-30);
                break;
            default: return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
        if(playing == false)
        {
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
            playing = false;
        }
        else
        {
            $('#playpause').removeClass('play'); 
            $('#playpause').addClass('pause');
            playing = true;
        }
    });
    function zfill(number, width) {
        var numberOutput = Math.abs(number); /* Valor absoluto del número */
        var length = number.toString().length; /* Largo del número */ 
        var zero = "0"; /* String de cero */  
        
        if (width <= length) {
            if (number < 0) {
                 return ("-" + numberOutput.toString()); 
            } else {
                 return numberOutput.toString(); 
            }
        } else {
            if (number < 0) {
                return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
            } else {
                return ((zero.repeat(width - length)) + numberOutput.toString()); 
            }
        }
    }
    function actuindex(v,vids)
    {
        if(!index)
        {
            index=0;
        }
        $('#parte'+index+'').css('background-color','')
        $('#parte'+v+'').css('background-color','green')
        index=v;
        visto(index);
        var sep = ",";
        var vids = vids.split(sep);
        player.destroy();
        var usuario_id=$('#usuarioId').val();
        if(!usuario_id)
        {
            onYouTubeIframeAPIReady(vids,star);
        }
        else
        {
            comienzo(function(culo){
                star=culo;
                onYouTubeIframeAPIReady(vids,star);
            });
        }
    }
    function mostrartiempo(){
        var percent = event.offsetX / $('#bar').width();
        var time = percent * player.getDuration();
        var mi=Math.floor(time / 60);
        var sec=Math.floor(time  % 60);
        var hor=Math.floor(mi / 60);
        var min=Math.floor(mi % 60);
        document.getElementById('progress-bar').innerHTML = hor+':'+zfill(min, 2)+':'+zfill(sec, 2);
    }
    
    function onPlayerStateChange(event,vids) { 
        // Obtener el estado actual del reproductor (un número entero)
        var state = event.data;
        // Comparar el estado con las constantes definidas por la API
        if (state == YT.PlayerState.PLAYING) {
            clearInterval(corriente);
            corriente=setInterval(function() {
                var percent = Math.floor((100 / player.getDuration()) * player.getCurrentTime());
                $('#progress-bar').css('width', percent + '%');
                var mi=Math.floor(player.getCurrentTime() / 60);
                var sec=Math.floor(player.getCurrentTime()  % 60);
                var hor=Math.floor(mi / 60);
                var min=Math.floor(mi % 60);
                var mimi=Math.floor(player.getDuration() / 60);
                var secsec=Math.floor(player.getDuration()  % 60);
                var horhor=Math.floor(mimi / 60);
                var minmin=Math.floor(mimi % 60);
                document.getElementById('timeri').innerHTML =hor+':'+zfill(min, 2)+':'+zfill(sec, 2)+' / '+horhor+':'+zfill(minmin, 2)+':'+zfill(secsec, 2);
            }, 1000);
            $('#playpause').removeClass('play');
            $('#playpause').addClass('pause');
            playing = false;
            timer = setInterval(refrescarSesion, 1200000);
        } else if (state == YT.PlayerState.PAUSED) {
            
            var tiempo = player.getCurrentTime();
            var duracion = player.getDuration();
            if(tiempo<duracion) 
            {
                var novela_id=$('#novelaId').val();
                var volumen_id=$('#volumenId').val();
                var usuario_id=$('#usuarioId').val();
                var indice=index;
                $.ajax({
                    url:'ajax/guardarvideo.php',
                    type:'post',
                    data:{novela_id,volumen_id,usuario_id,indice,tiempo,duracion},
                    success:function(pesul){
                    }
                })
            }
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
            playing = true;
            // El video está pausado
            // Eliminar el temporizador si existe
            if (timer) {
            clearInterval(timer);
            timer = null;
            }
        } else if (state == YT.PlayerState.ENDED) {
            clearInterval(corriente);
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
            var playing = false;
            var tiempo =0;
            var duracion = player.getDuration();
            var novela_id=$('#novelaId').val();
            var volumen_id=$('#volumenId').val();
            var usuario_id=$('#usuarioId').val();
            var indice=index;
            
            $.ajax({
                url:'ajax/guardarvisualizaciones.php',
                type:'post',
                data:{novela_id,volumen_id,indice,usuario_id},
                success:function(pesol){
                    nextVideo(vids);
                }
            });
            // Eliminar el temporizador si existe
            if (timer) {
            clearInterval(timer);
            timer = null;
            }
        }
        else if ( state == YT.PlayerState.UNSTARTED) {
            clearInterval(corriente);
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
            playing = false;
        }
        else if(state == YT.PlayerState.CUED){
            clearInterval(corriente);
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
            playing = false;
        }
    }
   
    function nextVideo(vids) {
        $('#parte'+index+'').css('background-color','')
        // Incrementar el índice sin volver al principio si es el último vídeo 
        if(vids.length==index+1)
        {
            $('#parte'+index+'').css('background-color','green')
        }
        else
        {
            index = (index + 1);
            // Comprobar si el índice es menor que la longitud del array 
            if (index < vids.length) 
            {
                $('#parte'+index+'').css('background-color','green')
                player.loadVideoById(vids[index]);
                // Actualizar el título según el índice 
            } 
            else
            {
                // Mostrar un mensaje de que no hay más vídeos 
            }
        }
    }
    var playing = false;
    function playpause()
    {
        if(playing==false)
        {
            player.playVideo();
            playing = true;
            $('#playpause').removeClass('play');
            $('#playpause').addClass('pause');
        }
        else if(playing==true)
        {     
            player.pauseVideo();
            playing = false;
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
        }
    }
    function pause()
    {
        
        if(playing==true)
        {     
            player.pauseVideo();
            playing = false;
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
        }
        else
        {
            player.pauseVideo();
            playing = false;
            $('#playpause').removeClass('pause'); 
            $('#playpause').addClass('play');
        }
    }
    function comienzo(callback)
    {
        var volumen_id=$('#volumenId').val();
        var usuario_id=$('#usuarioId').val();
        var indice=index;
        $.ajax({
            type:"POST",
            url: "ajax/getstart.php",
            data: {volumen_id,indice,usuario_id},
            success: function (respons) {
                var res=JSON.parse(respons);
                culo=res['tiempo'];
                callback(culo);
            }
        });  
    }
    
    function visto(index)
    {
        var novela_id=$('#novelaId').val();
        var volumen_id=$('#volumenId').val();
        var usuario_id=$('#usuarioId').val();
        if(!index)
        {
        var index=0;
        }
        var indice=index;
        $.ajax({
            type:"POST",
            url: "ajax/getvisualizaciones.php",
            data: {novela_id,volumen_id,indice,usuario_id},
            success: function (respons) {
                var res=JSON.parse(respons);
                if(res['fecha_visualizacion']==null)
                {

                }
                else
                {
                    var temp=`<div><h5><img src="recursos/iconos/v.png" height="20" width="20"> Visto el `+res['fecha_visualizacion']+`</h5></div>`;
                }
                $('#vision').html(temp);
            }
        });  
    }
    // Esta función se ejecuta cada 20 minutos para refrescar la sesión
    function refrescarSesion() {
        // Enviar una petición GET a sesion.php
        $.get("sesion.php", function(data) {
        // Mostrar el resultado en la consola
        });
    }
    function cerrarrespuesta()
    {
        $('#comentarfixed').css('display' , 'none');
        $('#pre-coment2').empty();
        $('#pre-view2').css('display' , 'none');
    }
    function sumardescarga(video_id,obra_id)
    {
        $.ajax({
            url:'ajax/descargarvolumen.php',
            type:'POST',
            data:{video_id,obra_id},
            success:function(response){
            }
        })
    }
$(document).ready(function(){
    $('#newComent').click(function(){
        var usuario_id=$('#usuarioId').val();
        var obra_id=$('#obraId').val();
        var video_id=$('#videoId').val();
        var comentario=$('#comentario').val();
        $.ajax({
            url:'ajax/comentar.php',
            type:'POST',
            data:{usuario_id,obra_id,video_id,comentario},
            success:function(response){
                //$('#pre-coment').html(response);
                $('#comentario').val("");
                $('#pre-view').css('display','none');
                $('#comentarios').empty();
                comentarios(obra_id,video_id)
            }
        })
    })
    $('#patroc').click(function(){
        var usuario_id=$('#usua_ide').val();
        var puntos=$('#puntos').val();
        var coste=$('#coste').val();
        var causa=$('#causa').val();
        var obra=$('#nombreobra').val();
        var nota=$('#nota').val();
        var tipo=$('#pat_tipo').val();
        $.ajax({
            url:'ajax/patrocinar.php',
            type:'POST',
            data:{usuario_id,puntos,tipo,coste,causa,obra,nota},
            success:function(response){
                let res=JSON.parse(response);
                if(res.estado=="ok")
                {
                    var tuspuntos=res.puntos;
                    $('#tuspuntos').empty();
                    $('#tuspuntos').append(tuspuntos);
                    $('#patrocinio')[0].reset();
                    $('#msg').empty();
                    $('#msg').prepend("Patrocinio registrado con exito");
                }
                else
                {
                    $('#msg').empty();
                    $('#msg').prepend(res.estado);
                }
            }
        })
    })
    $('#newComent2').click(function(){
        var usuario_id=$('#usuarioId2').val();
        var respuesta=$('#comentarioId2').val();
        var obra_id=$('#obraId2').val();
        var video_id=$('#videoId2').val();
        var comentario=$('#comentario2').val();
        $.ajax({
            url:'ajax/comentar.php',
            type:'POST',
            data:{usuario_id,obra_id,video_id,comentario,respuesta},
            success:function(response){
                //$('#pre-coment').html(response);
                $('#comentario2').val("");
                $('#comentarfixed').css('display','none');
                $('#pre-view2').css('display','none');
                $('#comentarios').empty();
                comentarios(obra_id,video_id)
            }
        })
    })
    $('#newEdit').click(function(){
        var usuario_id=$('#usuarioId2').val();
        var comentario_id=$('#comentarioId2').val();
        var obra_id=$('#obraId2').val();
        var video_id=$('#videoId2').val();
        var comentario=$('#comentario2').val();
        $.ajax({
            url:'ajax/editar.php',
            type:'POST',
            data:{usuario_id,comentario,comentario_id},
            success:function(response){
                //$('#pre-coment').html(response);
                $('#comentario2').val("");
                $('#comentario2').empty();
                $('#comentarfixed').css('display','none');
                $('#pre-view2').css('display','none');
                $('#comentarios').empty();
                comentarios(obra_id,video_id)
            }
        })
    })
    $('#comentario').on('keydown', function(e) {
        if (e.keyCode === 13) {
            var cursorPosition = this.selectionStart;
            this.value = this.value.substring(0, cursorPosition) +'[space]'+ this.value.substring(cursorPosition);
            this.selectionEnd=cursorPosition + 7;
        }
    });
    $('#comentario2').on('keydown', function(e) {
        if (e.keyCode === 13) {
            var cursorPosition = this.selectionStart;
            this.value = this.value.substring(0, cursorPosition) +'[space]'+ this.value.substring(cursorPosition);
            this.selectionEnd=cursorPosition + 7;
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
        url: "ajax/noticias2.php",
        success: function (respons) {
            $('#noticias2').html(respons);
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
                templa=`<form method='get' action='video.php' id='ese${i}'>
                            <input type='hidden' name='video_id'  value='${volu.video_id}'>
                            <input type='hidden' name='obra_id'  value='${volu.obra_id}'>
                            <input type='hidden' name='obra_nombre'  value='${volu.obra_nombre}'>
                            <div class='cont' onClick='\$("#ese${i}").submit()'>
                                <div class='nom' id='nom${i}'>
                                    ${volu.obra_nombre}
                                </div>
                                <div class='ima'>
                                    <img id='img' src='${volu.video_caratula}' alt='${volu.alt}'>
                                </div>
                                <div class='fec' id='fec${i}'>
                                    ${volu.video}<br>${volu.fecha}
                                </div>
                                <div class='gen' id='gen${i}'>
                                    ${volu.generos}
                                </div>
                                
                            </div>
                        </form>`;
                        $('#nue_vol').append(templa);
                i++
            });
        }
    });
   
   
 
    
   if(!typo)
    {
        var typo="";
    }
    if(!filtro)
    {
        var filtro=0;
    }
    if(!pagina)
    {
        var pagina=0;
    }
    cazargenero(filtro,typo,pagina);
    $('#buscador').keyup(function (e) {
        $('#buscador').keydown(function (e) { 
            if (e.keyCode == 13) 
            e.preventDefault();
        }); 
        if($('#buscador').val()=="")
        {
            cazargenero(0,"",0);
        }
        var filtro=$('#buscador').val();
        var typo='busqueda';
        $('#criterio').empty();
        $('#criterio').css('visibility','hidden');
        cazargenero(filtro,typo,0);
    });
    $('#comentario').keyup(function (e) {
        $('#comentario').keydown(function (e) { 
            $('#pre-view').css('display','flex')
        }); 
        if($('#comentario').val()=="")
        {
            $('#pre-coment').empty();
            $('#pre-view').css('display','none')
        }
        var texto=$('#comentario').val();
        $.ajax({
            type: "POST",
            url: "ajax/preview.php",
            data: {texto},
            success: function(response) {
                $('#pre-coment').html(response);
                $('.spoiler-titl').click(function() {
                    $(this).next('.spoiler-conten').toggle();
                });
            }
        });
    });
    $('#comentario2').keyup(function (e) {
        $('#comentario2').keydown(function (e) { 
            $('#pre-view2').css('display','flex')
        }); 
        if($('#comentario2').val()=="")
        {
            $('#pre-coment2').empty();
            $('#pre-view2').css('display','none')
        }
        var texto=$('#comentario2').val();
        $.ajax({
            type: "POST",
            url: "ajax/preview.php",
            data: {texto},
            success: function(response) {
                $('#pre-coment2').html(response);
                $('.spoiler-titl').click(function() {
                    $(this).next('.spoiler-conten').toggle();
                });
            }
        });
    });
    var div1Width = $("#mainComent").width();
    $("#comentarfixed").width(div1Width)

    $(window).resize(function() {
        var div1Width = $("#mainComent").width();
        $("#comentarfixed").width(div1Width);
    });
   
});
